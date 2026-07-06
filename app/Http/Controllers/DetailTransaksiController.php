<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Barang;
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
        if ($request->jenis == 'jual') {
            Barang::where('nama', $request->nama_barang)->decrement('stok', $request->jumlah);
        } else {
            Barang::where('nama', $request->nama_barang)->increment('stok', $request->jumlah);
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
        if ($jenisLama == 'jual') {
            Barang::where('nama', $detailTransaksi->nama_barang)->increment('stok', $jumlahLama);
        } else {
            Barang::where('nama', $detailTransaksi->nama_barang)->decrement('stok', $jumlahLama);
        }
        $subtotal = $request->jumlah * $detailTransaksi->harga_satuan;
        $detailTransaksi->update([
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
            'jenis' => $request->jenis,
            'alasan_retur' => $request->alasan_retur
        ]);
        if ($request->jenis == 'jual') {
            Barang::where('nama', $detailTransaksi->nama_barang)->decrement('stok', $request->jumlah);
        } else {
            Barang::where('nama', $detailTransaksi->nama_barang)->increment('stok', $request->jumlah);
        }
        return redirect()->route('detail-transaksi.index')->with('success', 'Detail berhasil diupdate');
    }
    public function destroy(DetailTransaksi $detailTransaksi) {
        if ($detailTransaksi->jenis == 'jual') {
            Barang::where('nama', $detailTransaksi->nama_barang)->increment('stok', $detailTransaksi->jumlah);
        } else {
            Barang::where('nama', $detailTransaksi->nama_barang)->decrement('stok', $detailTransaksi->jumlah);
        }
        $detailTransaksi->delete();
        return redirect()->route('detail-transaksi.index')->with('success', 'Detail berhasil dihapus');
    }
}