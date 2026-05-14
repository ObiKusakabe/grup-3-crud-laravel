<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        $supplier = Supplier::orderBy('nama')->get();
        return view('supplier.index', compact('supplier'));
    }
    public function create() {
        return view('supplier.create');
    }
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable'
        ]);
        Supplier::create($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan');
    }
    public function show(Supplier $supplier) {
        return view('supplier.show', compact('supplier'));
    }
    public function edit(Supplier $supplier) {
        return view('supplier.edit', compact('supplier'));
    }
    public function update(Request $request, Supplier $supplier) {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable'
        ]);
        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate');
    }
    public function destroy(Supplier $supplier) {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus');
    }
}