<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private function companyId(): int
    {
        return auth()->user()->company_id;
    }

    public function index()
    {
        $branches = Branch::where('company_id', $this->companyId())
            ->orderBy('name')
            ->get();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:branches,code',
            'is_active' => 'boolean'
        ]);

        Branch::create([
            'company_id' => $this->companyId(),
            'name' => $request->name,
            'code' => $request->code,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('branches.index')->with('success', 'Cabang berhasil ditambahkan');
    }

    public function edit(Branch $branch)
    {
        if ($branch->company_id !== $this->companyId()) {
            abort(403);
        }
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        if ($branch->company_id !== $this->companyId()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:branches,code,' . $branch->id,
            'is_active' => 'boolean'
        ]);

        $branch->update([
            'name' => $request->name,
            'code' => $request->code,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('branches.index')->with('success', 'Cabang berhasil diperbarui');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->company_id !== $this->companyId()) {
            abort(403);
        }
        
        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'Cabang berhasil dihapus');
    }
}
