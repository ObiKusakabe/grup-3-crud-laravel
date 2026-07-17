<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\Member;
use App\Models\ProductStock;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    private function companyId(): int
    {
        return auth()->user()->company_id;
    }

    public function index()
    {
        $transaksi = Transaksi::where('company_id', $this->companyId())
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $companyId = $this->companyId();
        $barang = Barang::with('kategori')->where('company_id', $companyId)->get();
        $kategori = \App\Models\KategoriBarang::where('company_id', $companyId)->orderBy('nama')->get();
        $member = Member::where('company_id', $companyId)->get();
        $kode = 'TRX' . date('Ymd') . rand(1000, 9999);
        return view('transaksi.create', compact('barang', 'kategori', 'member', 'kode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transaksis',
            'tanggal' => 'required|date',
            'kasir' => 'required',
            'tunai' => 'required|numeric|min:0',
            'items' => 'required|array|min:1'
        ]);

        $companyId = $this->companyId();
        $totalBayar = 0;
        foreach ($request->items as $item) {
            $totalBayar += $item['jumlah'] * $item['harga_satuan'];
        }

        $diskon = 0;
        if ($request->nama_member) {
            $member = Member::where('nama', $request->nama_member)
                ->where('company_id', $companyId)
                ->first();
            if ($member) {
                $diskon = $totalBayar * ($member->diskon_persen / 100);
            }
        }

        $totalAkhir = $totalBayar - $diskon;
        $kembalian = $request->tunai - $totalAkhir;

        Transaksi::create([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => $request->tanggal,
            'kasir' => $request->kasir,
            'nama_member' => $request->nama_member,
            'total_bayar' => $totalBayar,
            'diskon' => $diskon,
            'total_akhir' => $totalAkhir,
            'tunai' => $request->tunai,
            'kembalian' => $kembalian,
            'status' => 'Selesai',
            'company_id' => $companyId,
        ]);

        $activeBranchId = session('active_branch_id');
        foreach ($request->items as $item) {
            DetailTransaksi::create([
                'kode_transaksi' => $request->kode_transaksi,
                'nama_barang' => $item['nama_barang'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'subtotal' => $item['jumlah'] * $item['harga_satuan'],
                'jenis' => 'jual',
                'company_id' => $companyId,
            ]);

            if ($activeBranchId) {
                $barang = Barang::where('nama', $item['nama_barang'])
                    ->where('company_id', $companyId)
                    ->first();

                if ($barang) {
                    $productStock = ProductStock::firstOrCreate(
                        ['product_id' => $barang->id, 'branch_id' => $activeBranchId],
                        ['stock' => 0, 'min_stock' => 0]
                    );
                    // Stok tidak boleh minus — kurangi hanya sebesar stok tersedia
                    $productStock->stock = max(0, $productStock->stock - $item['jumlah']);
                    $productStock->save();

                    StockMovement::create([
                        'product_id' => $barang->id,
                        'branch_id' => $activeBranchId,
                        'type' => 'OUT',
                        'qty' => $item['jumlah'],
                        'reason' => 'Penjualan',
                        'note' => 'Transaksi: ' . $request->kode_transaksi
                    ]);
                }
            }
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
    }

    public function show(Transaksi $transaksi)
    {
        abort_if($transaksi->company_id !== $this->companyId(), 403);
        $details = DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->get();
        return view('transaksi.show', compact('transaksi', 'details'));
    }

    public function edit(Transaksi $transaksi)
    {
        abort_if($transaksi->company_id !== $this->companyId(), 403);
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        abort_if($transaksi->company_id !== $this->companyId(), 403);
        $request->validate([
            'status' => 'required|in:Pending,Selesai,Batal'
        ]);

        $transaksi->update(['status' => $request->status]);

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi diupdate');
    }

    public function destroy(Transaksi $transaksi)
    {
        abort_if($transaksi->company_id !== $this->companyId(), 403);

        $activeBranchId = session('active_branch_id');
        $details = DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->get();

        if ($activeBranchId) {
            foreach ($details as $detail) {
                $barang = Barang::where('nama', $detail->nama_barang)
                    ->where('company_id', $this->companyId())
                    ->first();

                if ($barang) {
                    $productStock = ProductStock::where('product_id', $barang->id)
                        ->where('branch_id', $activeBranchId)
                        ->first();

                    if ($productStock) {
                        $productStock->stock += $detail->jumlah;
                        $productStock->save();

                        StockMovement::create([
                            'product_id' => $barang->id,
                            'branch_id' => $activeBranchId,
                            'type' => 'IN',
                            'qty' => $detail->jumlah,
                            'reason' => 'Batal Transaksi',
                            'note' => 'Transaksi dibatalkan: ' . $transaksi->kode_transaksi
                        ]);
                    }
                }
            }
        }

        DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->delete();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        abort_if($transaksi->company_id !== $this->companyId(), 403);
        $request->validate(['status' => 'required|in:Pending,Selesai,Batal']);
        $transaksi->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status diupdate');
    }
}