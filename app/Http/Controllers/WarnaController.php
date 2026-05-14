<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    public function index()
    {
        $warna = Warna::orderBy('nama')->get();
        return view('warna.index', compact('warna'));
    }

    public function create()
    {
        return view('warna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:warna',
            'kode_hex' => 'nullable'
        ]);
        Warna::create($request->all());
        return redirect()->route('warna.index')->with('success', 'Warna berhasil ditambahkan');
    }

    public function show(Warna $warna)
    {
        return view('warna.show', compact('warna'));
    }

    public function edit(Warna $warna)
    {
        return view('warna.edit', compact('warna'));
    }

    public function update(Request $request, Warna $warna)
    {
        $request->validate([
            'nama' => 'required|unique:warna,nama,' . $warna->id,
            'kode_hex' => 'nullable'
        ]);
        $warna->update($request->all());
        return redirect()->route('warna.index')->with('success', 'Warna berhasil diupdate');
    }

    public function destroy(Warna $warna)
    {
        $warna->delete();
        return redirect()->route('warna.index')->with('success', 'Warna berhasil dihapus');
    }
}