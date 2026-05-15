<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\Member;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $barang = Barang::all();
        $member = Member::all();
        $kode = 'TRX' . date('Ymd') . rand(1000, 9999);
        return view('transaksi.create', compact('barang', 'member', 'kode'));
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

        $totalBayar = 0;
        foreach ($request->items as $item) {
            $totalBayar += $item['jumlah'] * $item['harga_satuan'];
        }

        $diskon = 0;
        if ($request->nama_member) {
            $member = Member::where('nama', $request->nama_member)->first();
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
            'status' => 'Pending'
        ]);

        foreach ($request->items as $item) {
            DetailTransaksi::create([
                'kode_transaksi' => $request->kode_transaksi,
                'nama_barang' => $item['nama_barang'],
                'ukuran' => $item['ukuran'],
                'warna' => $item['warna'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'subtotal' => $item['jumlah'] * $item['harga_satuan'],
                'jenis' => 'jual'
            ]);

            // KURANGI STOK
            Barang::where('nama', $item['nama_barang'])
                ->where('ukuran', $item['ukuran'])
                ->where('warna', $item['warna'])
                ->decrement('stok', $item['jumlah']);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
    }

    public function show(Transaksi $transaksi)
    {
        $details = DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->get();
        return view('transaksi.show', compact('transaksi', 'details'));
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:Pending,Selesai,Batal'
        ]);

        $transaksi->update(['status' => $request->status]);

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi diupdate');
    }

    public function destroy(Transaksi $transaksi)
    {
        // KEMBALIKAN STOK SEMUA ITEM
        $details = DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->get();
        foreach ($details as $detail) {
            Barang::where('nama', $detail->nama_barang)
                ->where('ukuran', $detail->ukuran)
                ->where('warna', $detail->warna)
                ->increment('stok', $detail->jumlah);
        }

        DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->delete();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        $request->validate(['status' => 'required|in:Pending,Selesai,Batal']);
        $transaksi->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status diupdate');
    }
}