<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    private function companyId(): int
    {
        return auth()->user()->company_id;
    }

    public function index()
    {
        $barang = Barang::where('company_id', $this->companyId())
            ->orderBy('nama')
            ->get();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = KategoriBarang::where('company_id', $this->companyId())
            ->orderBy('nama')
            ->get();
        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Auto-generate SKU (kode_barang) with format: [active_branch_code]-[ddmmyyyy]-[sequence]
        $activeBranchId = session('active_branch_id', 1);
        $branch = \App\Models\Branch::find($activeBranchId);
        $branchCode = $branch ? $branch->code : 'CBG';
        
        $today = now()->format('dmY');
        
        // Count products created today in this company to get sequence number
        $countToday = Barang::where('company_id', $this->companyId())
            ->whereDate('created_at', now()->toDateString())
            ->count();
            
        $sequence = str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);
        $sku = strtoupper("{$branchCode}-{$today}-{$sequence}");
        
        // Merge SKU into request
        $request->merge(['kode_barang' => $sku]);

        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,NULL,id,company_id,' . $this->companyId(),
            'nama' => 'required',
            'ukuran' => 'nullable|string|max:100',
            'kategori_id' => 'required|exists:kategori_barang,id',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['company_id'] = $this->companyId();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Barang $barang)
    {
        abort_if($barang->company_id !== $this->companyId(), 403);
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        abort_if($barang->company_id !== $this->companyId(), 403);
        $kategori = KategoriBarang::where('company_id', $this->companyId())
            ->orderBy('nama')
            ->get();
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, Barang $barang)
    {
        abort_if($barang->company_id !== $this->companyId(), 403);

        $request->validate([
            'nama' => 'required',
            'ukuran' => 'nullable|string|max:100',
            'kategori_id' => 'required|exists:kategori_barang,id',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('kode_barang'); // Prevent updating SKU directly

        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        abort_if($barang->company_id !== $this->companyId(), 403);
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}