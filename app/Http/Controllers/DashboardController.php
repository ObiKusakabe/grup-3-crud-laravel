<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\ProductStock;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;
        $today = Carbon::today();

        $penjualanHariIni = Transaksi::whereDate('tanggal', $today)
            ->where('status', 'Selesai')
            ->where('company_id', $companyId)
            ->sum('total_akhir');

        $transaksiHariIni = Transaksi::whereDate('tanggal', $today)
            ->where('status', 'Selesai')
            ->where('company_id', $companyId)
            ->count();

        $totalProduk = Barang::where('company_id', $companyId)->count();

        $activeBranchId = session('active_branch_id');
        if (!$activeBranchId) {
            $firstBranch = Branch::where('company_id', $companyId)->first();
            $activeBranchId = $firstBranch ? $firstBranch->id : null;
        }

        $stokRendah = $activeBranchId
            ? ProductStock::where('branch_id', $activeBranchId)
                ->where('stock', '<=', 5)
                ->count()
            : 0;

        $transaksiTerbaru = Transaksi::where('status', 'Selesai')
            ->where('company_id', $companyId)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'penjualanHariIni',
            'transaksiHariIni',
            'totalProduk',
            'stokRendah',
            'transaksiTerbaru'
        ));
    }
}
