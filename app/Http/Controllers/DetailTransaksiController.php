<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\ProductStock;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index() {
        $details = DetailTransaksi::orderBy('created_at', 'desc')->get();
        return view('detail_transaksi.index', compact('details'));
    }
    public function create() {
        return view('detail_transaksi.create');
    }
    public function store(Request $request) {
        $request->validate([
            'kode_transaksi' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'jenis' => 'required|in:jual,retur'
        ]);
        $subtotal = $request->jumlah * $request->harga_satuan;
        DetailTransaksi::create([
            'kode_transaksi' => $request->kode_transaksi,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'subtotal' => $subtotal,
            'jenis' => $request->jenis,
            'alasan_retur' => $request->alasan_retur
        ]);
        $activeBranchId = session('active_branch_id', 1);
        $barang = Barang::where('nama', $request->nama_barang)->first();
        
        if ($barang) {
            $productStock = ProductStock::firstOrCreate(
                [
                    'product_id' => $barang->id,
                    'branch_id' => $activeBranchId
                ],
                ['stock' => 0, 'min_stock' => 0]
            );
            
            if ($request->jenis == 'jual') {
                $productStock->stock -= $request->jumlah;
                StockMovement::create([
                    'product_id' => $barang->id,
                    'branch_id' => $activeBranchId,
                    'type' => 'OUT',
                    'qty' => $request->jumlah,
                    'reason' => 'Penjualan Manual',
                    'note' => 'Detail Transaksi: ' . $request->kode_transaksi
                ]);
            } else {
                $productStock->stock += $request->jumlah;
                StockMovement::create([
                    'product_id' => $barang->id,
                    'branch_id' => $activeBranchId,
                    'type' => 'IN',
                    'qty' => $request->jumlah,
                    'reason' => 'Retur Manual',
                    'note' => 'Detail Transaksi: ' . $request->kode_transaksi
                ]);
            }
            $productStock->save();
        }
        return redirect()->route('detail-transaksi.index')->with('success', 'Detail berhasil ditambahkan');
    }
    public function show(DetailTransaksi $detailTransaksi) {
        return view('detail_transaksi.show', compact('detailTransaksi'));
    }
    public function edit(DetailTransaksi $detailTransaksi) {
        return view('detail_transaksi.edit', compact('detailTransaksi'));
    }
    public function update(Request $request, DetailTransaksi $detailTransaksi) {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'jenis' => 'required|in:jual,retur'
        ]);
        $jumlahLama = $detailTransaksi->jumlah;
        $jenisLama = $detailTransaksi->jenis;
        $activeBranchId = session('active_branch_id', 1);
        $barang = Barang::where('nama', $detailTransaksi->nama_barang)->first();
        
        if ($barang) {
            $productStock = ProductStock::where('product_id', $barang->id)
                ->where('branch_id', $activeBranchId)
                ->first();
            
            if ($productStock) {
                if ($jenisLama == 'jual') {
                    $productStock->stock += $jumlahLama;
                } else {
                    $productStock->stock -= $jumlahLama;
                }
                $productStock->save();
            }
        }
        $subtotal = $request->jumlah * $detailTransaksi->harga_satuan;
        $detailTransaksi->update([
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
            'jenis' => $request->jenis,
            'alasan_retur' => $request->alasan_retur
        ]);
        
        if ($barang) {
            $productStock = ProductStock::where('product_id', $barang->id)
                ->where('branch_id', $activeBranchId)
                ->first();
            
            if ($productStock) {
                if ($request->jenis == 'jual') {
                    $productStock->stock -= $request->jumlah;
                    StockMovement::create([
                        'product_id' => $barang->id,
                        'branch_id' => $activeBranchId,
                        'type' => 'OUT',
                        'qty' => $request->jumlah,
                        'reason' => 'Update Penjualan Manual',
                        'note' => 'Update Detail Transaksi: ' . $detailTransaksi->kode_transaksi
                    ]);
                } else {
                    $productStock->stock += $request->jumlah;
                    StockMovement::create([
                        'product_id' => $barang->id,
                        'branch_id' => $activeBranchId,
                        'type' => 'IN',
                        'qty' => $request->jumlah,
                        'reason' => 'Update Retur Manual',
                        'note' => 'Update Detail Transaksi: ' . $detailTransaksi->kode_transaksi
                    ]);
                }
                $productStock->save();
            }
        }
        return redirect()->route('detail-transaksi.index')->with('success', 'Detail berhasil diupdate');
    }
    public function destroy(DetailTransaksi $detailTransaksi) {
        $activeBranchId = session('active_branch_id', 1);
        $barang = Barang::where('nama', $detailTransaksi->nama_barang)->first();
        
        if ($barang) {
            $productStock = ProductStock::where('product_id', $barang->id)
                ->where('branch_id', $activeBranchId)
                ->first();
            
            if ($productStock) {
                if ($detailTransaksi->jenis == 'jual') {
                    $productStock->stock += $detailTransaksi->jumlah;
                    StockMovement::create([
                        'product_id' => $barang->id,
                        'branch_id' => $activeBranchId,
                        'type' => 'IN',
                        'qty' => $detailTransaksi->jumlah,
                        'reason' => 'Hapus Penjualan Manual',
                        'note' => 'Hapus Detail Transaksi: ' . $detailTransaksi->kode_transaksi
                    ]);
                } else {
                    $productStock->stock -= $detailTransaksi->jumlah;
                    StockMovement::create([
                        'product_id' => $barang->id,
                        'branch_id' => $activeBranchId,
                        'type' => 'OUT',
                        'qty' => $detailTransaksi->jumlah,
                        'reason' => 'Hapus Retur Manual',
                        'note' => 'Hapus Detail Transaksi: ' . $detailTransaksi->kode_transaksi
                    ]);
                }
                $productStock->save();
            }
        }
        $detailTransaksi->delete();
        return redirect()->route('detail-transaksi.index')->with('success', 'Detail berhasil dihapus');
    }
}