<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Branch;
use App\Models\ProductStock;
use App\Models\StockMovement;

class StockManagementController extends Controller
{
    public function index()
    {
        $activeBranchId = session('active_branch_id', 1);
        $branches = Branch::all();
        $movements = StockMovement::with(['product', 'branch'])
            ->where('branch_id', $activeBranchId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('stock-management.index', compact('movements', 'branches', 'activeBranchId'));
    }

    public function createIn()
    {
        $activeBranchId = session('active_branch_id', 1);
        $branches = Branch::all();
        $products = Barang::all();

        return view('stock-management.create-in', compact('branches', 'products', 'activeBranchId'));
    }

    public function storeIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:barangs,id',
            'branch_id' => 'required|exists:branches,id',
            'qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'note' => 'nullable|string'
        ]);

        $product = Barang::find($request->product_id);
        $branch = Branch::find($request->branch_id);

        // Create or update product stock
        $productStock = ProductStock::firstOrCreate(
            [
                'product_id' => $request->product_id,
                'branch_id' => $request->branch_id
            ],
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
        $activeBranchId = session('active_branch_id', 1);
        $branches = Branch::all();
        $products = Barang::all();

        return view('stock-management.create-out', compact('branches', 'products', 'activeBranchId'));
    }

    public function storeOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:barangs,id',
            'branch_id' => 'required|exists:branches,id',
            'qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'note' => 'nullable|string'
        ]);

        $product = Barang::find($request->product_id);
        $branch = Branch::find($request->branch_id);

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

        session(['active_branch_id' => $request->branch_id]);

        return back()->with('success', 'Cabang aktif berhasil diubah');
    }
}
