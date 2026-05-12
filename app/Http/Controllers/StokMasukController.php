<?php

namespace App\Http\Controllers;

use App\Models\StokMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class StokMasukController extends Controller
{
    public function index()
    {
        $stokMasuk = StokMasuk::orderBy('tanggal_masuk', 'desc')->get();
        return view('stok_masuk.index', compact('stokMasuk'));
    }

    public function create()
    {
        return view('stok_masuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'nama_supplier' => 'required',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date'
        ]);

        StokMasuk::create($request->all());

        // TAMBAH STOK BARANG
        Barang::where('nama', $request->nama_barang)->increment('stok', $request->jumlah);

        return redirect()->route('stok-masuk.index')->with('success', 'Stok masuk berhasil ditambahkan');
    }

    public function show(StokMasuk $stokMasuk)
    {
        return view('stok_masuk.show', compact('stokMasuk'));
    }

    public function edit(StokMasuk $stokMasuk)
    {
        return view('stok_masuk.edit', compact('stokMasuk'));
    }

    public function update(Request $request, StokMasuk $stokMasuk)
    {
        $request->validate([
            'nama_barang' => 'required',
            'nama_supplier' => 'required',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date'
        ]);

        $jumlahLama = $stokMasuk->jumlah;
        $namaBarangLama = $stokMasuk->nama_barang;

        $stokMasuk->update($request->all());

        // KOREKSI STOK: kurangi yang lama, tambah yang baru
        if ($namaBarangLama == $request->nama_barang) {
            $selisih = $request->jumlah - $jumlahLama;
            Barang::where('nama', $request->nama_barang)->increment('stok', $selisih);
        } else {
            Barang::where('nama', $namaBarangLama)->decrement('stok', $jumlahLama);
            Barang::where('nama', $request->nama_barang)->increment('stok', $request->jumlah);
        }

        return redirect()->route('stok-masuk.index')->with('success', 'Stok masuk berhasil diupdate');
    }

    public function destroy(StokMasuk $stokMasuk)
    {
        // KEMBALIKAN STOK
        Barang::where('nama', $stokMasuk->nama_barang)->decrement('stok', $stokMasuk->jumlah);

        $stokMasuk->delete();
        return redirect()->route('stok-masuk.index')->with('success', 'Stok masuk berhasil dihapus');
    }
}