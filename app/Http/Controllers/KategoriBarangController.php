<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $kategori = KategoriBarang::orderBy('nama')->get();
        return view('kategori_barang.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategori_barang',
            'keterangan' => 'nullable'
        ]);

        KategoriBarang::create($request->all());
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(KategoriBarang $kategoriBarang)
    {
        return view('kategori_barang.show', compact('kategoriBarang'));
    }

    public function edit(KategoriBarang $kategoriBarang)
    {
        return view('kategori_barang.edit', compact('kategoriBarang'));
    }

    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        $request->validate([
            'nama' => 'required|unique:kategori_barang,nama,' . $kategoriBarang->id,
            'keterangan' => 'nullable'
        ]);

        $kategoriBarang->update($request->all());
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(KategoriBarang $kategoriBarang)
    {
        $kategoriBarang->delete();
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil dihapus');
    }
}