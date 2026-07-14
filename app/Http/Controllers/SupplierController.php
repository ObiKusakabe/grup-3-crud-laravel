<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private function companyId(): int
    {
        return auth()->user()->company_id;
    }

    public function index() {
        $supplier = Supplier::where('company_id', $this->companyId())
            ->orderBy('nama')
            ->get();
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
        Supplier::create(array_merge($request->all(), ['company_id' => $this->companyId()]));
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan');
    }
    public function show(Supplier $supplier) {
        abort_if($supplier->company_id !== $this->companyId(), 403);
        return view('supplier.show', compact('supplier'));
    }
    public function edit(Supplier $supplier) {
        abort_if($supplier->company_id !== $this->companyId(), 403);
        return view('supplier.edit', compact('supplier'));
    }
    public function update(Request $request, Supplier $supplier) {
        abort_if($supplier->company_id !== $this->companyId(), 403);
        $request->validate([
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable'
        ]);
        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate');
    }
    public function destroy(Supplier $supplier) {
        abort_if($supplier->company_id !== $this->companyId(), 403);
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus');
    }
}