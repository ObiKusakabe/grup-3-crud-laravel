<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $penjualanHariIni = Transaksi::whereDate('tanggal', $today)
            ->where('status', 'Selesai')
            ->sum('total_akhir');

        $transaksiHariIni = Transaksi::whereDate('tanggal', $today)
            ->where('status', 'Selesai')
            ->count();

        $totalProduk = Barang::count();
        $activeBranchId = session('active_branch_id', 1);
        $stokRendah = ProductStock::where('branch_id', $activeBranchId)
            ->where('stock', '<=', 5)
            ->count();

        $transaksiTerbaru = Transaksi::where('status', 'Selesai')
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
