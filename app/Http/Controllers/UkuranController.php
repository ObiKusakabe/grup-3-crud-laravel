<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    public function index()
    {
        $ukuran = Ukuran::orderBy('nama')->get();
        return view('ukuran.index', compact('ukuran'));
    }

    public function create()
    {
        return view('ukuran.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|unique:ukuran']);
        Ukuran::create($request->all());
        return redirect()->route('ukuran.index')->with('success', 'Ukuran berhasil ditambahkan');
    }

    public function show(Ukuran $ukuran)
    {
        return view('ukuran.show', compact('ukuran'));
    }

    public function edit(Ukuran $ukuran)
    {
        return view('ukuran.edit', compact('ukuran'));
    }

    public function update(Request $request, Ukuran $ukuran)
    {
        $request->validate(['nama' => 'required|unique:ukuran,nama,' . $ukuran->id]);
        $ukuran->update($request->all());
        return redirect()->route('ukuran.index')->with('success', 'Ukuran berhasil diupdate');
    }

    public function destroy(Ukuran $ukuran)
    {
        $ukuran->delete();
        return redirect()->route('ukuran.index')->with('success', 'Ukuran berhasil dihapus');
    }
}