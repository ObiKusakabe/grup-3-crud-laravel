<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Branch;
use App\Models\ProductStock;
use App\Models\StockMovement;

class StockManagementController extends Controller
{
    private function companyId(): int
    {
        return auth()->user()->company_id;
    }

    public function index(Request $request)
    {
        $companyId = $this->companyId();
        $activeBranchId = session('active_branch_id');
        $branches = Branch::where('company_id', $companyId)->get();

        if (!$activeBranchId && $branches->isNotEmpty()) {
            $activeBranchId = $branches->first()->id;
            session(['active_branch_id' => $activeBranchId]);
        }

        $search = $request->input('search');
        $query = Barang::where('company_id', $companyId)->with(['productStocks']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(20);

        return view('stock-management.index', compact('products', 'branches', 'activeBranchId'));
    }

    public function updateStock(Request $request)
    {
        $companyId = $this->companyId();
        $activeBranchId = session('active_branch_id');

        $request->validate([
            'product_id' => 'required|exists:barangs,id',
            'type' => 'required|in:IN,OUT',
            'qty' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
            'note' => 'nullable|string'
        ]);

        $branch = Branch::where('id', $activeBranchId)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $product = Barang::where('id', $request->product_id)
            ->where('company_id', $companyId)
            ->firstOrFail();

        // Create or update product stock
        $productStock = ProductStock::firstOrCreate(
            ['product_id' => $request->product_id, 'branch_id' => $activeBranchId],
            ['stock' => 0, 'min_stock' => 0]
        );

        if ($request->type === 'OUT') {
            if ($productStock->stock < $request->qty) {
                return back()->with('error', "Stok tidak mencukupi untuk pengurangan. Stok saat ini: {$productStock->stock}");
            }
            $productStock->stock -= $request->qty;
        } else {
            $productStock->stock += $request->qty;
        }
        
        $productStock->save();

        // Create stock movement record
        StockMovement::create([
            'product_id' => $request->product_id,
            'branch_id' => $activeBranchId,
            'type' => $request->type,
            'qty' => $request->qty,
            'reason' => $request->reason,
            'note' => $request->note
        ]);

        $typeSymbol = $request->type === 'IN' ? '+' : '-';
        return redirect()->route('stock-management.index')
            ->with('success', "Stok {$product->nama} berhasil diubah ({$typeSymbol}{$request->qty})");
    }

    public function createIn()
    {
        $companyId = $this->companyId();
        $activeBranchId = session('active_branch_id');
        $branches = Branch::where('company_id', $companyId)->get();
        $products = Barang::where('company_id', $companyId)->get();

        return view('stock-management.create-in', compact('branches', 'products', 'activeBranchId'));
    }

    public function storeIn(Request $request)
    {
        $companyId = $this->companyId();
        $request->validate([
            'product_id' => 'required|exists:barangs,id',
            'branch_id' => 'required|exists:branches,id',
            'qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'note' => 'nullable|string'
        ]);

        // Authorization: branch must belong to company
        $branch = Branch::where('id', $request->branch_id)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $product = Barang::where('id', $request->product_id)
            ->where('company_id', $companyId)
            ->firstOrFail();

        // Create or update product stock
        $productStock = ProductStock::firstOrCreate(
            ['product_id' => $request->product_id, 'branch_id' => $request->branch_id],
            ['stock' => 0, 'min_stock' => 0]
        );

        $productStock->stock += $request->qty;
        $productStock->save();

        // Create stock movement record
        StockMovement::create([
            'product_id' => $request->product_id,
            'branch_id' => $request->branch_id,
            'type' => 'IN',
            'qty' => $request->qty,
            'reason' => $request->reason,
            'note' => $request->note
        ]);

        return redirect()->route('stock-management.index')
            ->with('success', "Stok {$product->nama} bertambah {$request->qty} di cabang {$branch->name}");
    }

    public function createOut()
    {
        $companyId = $this->companyId();
        $activeBranchId = session('active_branch_id');
        $branches = Branch::where('company_id', $companyId)->get();
        $products = Barang::where('company_id', $companyId)->get();

        return view('stock-management.create-out', compact('branches', 'products', 'activeBranchId'));
    }

    public function storeOut(Request $request)
    {
        $companyId = $this->companyId();
        $request->validate([
            'product_id' => 'required|exists:barangs,id',
            'branch_id' => 'required|exists:branches,id',
            'qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'note' => 'nullable|string'
        ]);

        $branch = Branch::where('id', $request->branch_id)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $product = Barang::where('id', $request->product_id)
            ->where('company_id', $companyId)
            ->firstOrFail();

        // Check if product stock exists
        $productStock = ProductStock::where('product_id', $request->product_id)
            ->where('branch_id', $request->branch_id)
            ->first();

        if (!$productStock || $productStock->stock < $request->qty) {
            $currentStock = $productStock ? $productStock->stock : 0;
            return back()->withInput()
                ->with('error', "Stok tidak mencukupi. Stok saat ini: {$currentStock}");
        }

        // Update product stock
        $productStock->stock -= $request->qty;
        $productStock->save();

        // Create stock movement record
        StockMovement::create([
            'product_id' => $request->product_id,
            'branch_id' => $request->branch_id,
            'type' => 'OUT',
            'qty' => $request->qty,
            'reason' => $request->reason,
            'note' => $request->note
        ]);

        return redirect()->route('stock-management.index')
            ->with('success', "Stok {$product->nama} berkurang {$request->qty} di cabang {$branch->name}");
    }

    public function setBranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id'
        ]);

        // Ensure branch belongs to user's company
        Branch::where('id', $request->branch_id)
            ->where('company_id', $this->companyId())
            ->firstOrFail();

        session(['active_branch_id' => $request->branch_id]);

        return back()->with('success', 'Cabang aktif berhasil diubah');
    }
}

