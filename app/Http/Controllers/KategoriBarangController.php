<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    private function companyId(): int
    {
        return auth()->user()->company_id;
    }

    public function index()
    {
        $kategori = KategoriBarang::where('company_id', $this->companyId())
            ->orderBy('nama')
            ->get();
        return view('kategori-barang.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategori_barang,nama,NULL,id,company_id,' . $this->companyId(),
            'keterangan' => 'nullable'
        ]);

        KategoriBarang::create(array_merge($request->all(), ['company_id' => $this->companyId()]));
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(KategoriBarang $kategoriBarang)
    {
        abort_if($kategoriBarang->company_id !== $this->companyId(), 403);
        return view('kategori-barang.show', compact('kategoriBarang'));
    }

    public function edit(KategoriBarang $kategoriBarang)
    {
        abort_if($kategoriBarang->company_id !== $this->companyId(), 403);
        return view('kategori-barang.edit', compact('kategoriBarang'));
    }

    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        abort_if($kategoriBarang->company_id !== $this->companyId(), 403);
        $request->validate([
            'nama' => 'required|unique:kategori_barang,nama,' . $kategoriBarang->id . ',id,company_id,' . $this->companyId(),
            'keterangan' => 'nullable'
        ]);

        $kategoriBarang->update($request->all());
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(KategoriBarang $kategoriBarang)
    {
        abort_if($kategoriBarang->company_id !== $this->companyId(), 403);
        $kategoriBarang->delete();
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil dihapus');
    }
}