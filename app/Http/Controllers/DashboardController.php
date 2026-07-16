<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\ProductStock;
use App\Models\Branch;
use App\Models\KategoriBarang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;
        $today     = Carbon::today();

        // ── Stat cards ─────────────────────────────────────────
        $penjualanHariIni = Transaksi::whereDate('tanggal', $today)
            ->where('company_id', $companyId)
            ->sum('total_akhir');

        $transaksiHariIni = Transaksi::whereDate('tanggal', $today)
            ->where('company_id', $companyId)
            ->count();

        $totalProduk = Barang::where('company_id', $companyId)->count();

        $activeBranchId = session('active_branch_id');
        if (!$activeBranchId) {
            $firstBranch    = Branch::where('company_id', $companyId)->first();
            $activeBranchId = $firstBranch ? $firstBranch->id : null;
            if ($activeBranchId) {
                session(['active_branch_id' => $activeBranchId]);
            }
        }

        $stokRendah = $activeBranchId
            ? ProductStock::where('branch_id', $activeBranchId)
                ->whereColumn('stock', '<=', 'min_stock')
                ->count()
            : 0;

        // ── Recent transactions ─────────────────────────────────
        $transaksiTerbaru = Transaksi::where('company_id', $companyId)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ── Chart 1: Daily sales — last 7 days (line chart) ─────
        $dailySales = [];
        $dailyLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->translatedFormat('d M');
            $dailySales[]  = (float) Transaksi::whereDate('tanggal', $date)
                ->where('company_id', $companyId)
                ->sum('total_akhir');
        }

        // ── Chart 2: Stock by category (doughnut chart) ─────────
        $kategoriLabels = [];
        $kategoriStock  = [];
        $kategoris = KategoriBarang::where('company_id', $companyId)->get();
        foreach ($kategoris as $kat) {
            $stok = Barang::where('kategori_id', $kat->id)
                ->where('company_id', $companyId)
                ->count();
            if ($stok > 0) {
                $kategoriLabels[] = $kat->nama;
                $kategoriStock[]  = $stok;
            }
        }
        // Fallback if no categories
        if (empty($kategoriLabels)) {
            $kategoriLabels = ['Tanpa Kategori'];
            $kategoriStock  = [$totalProduk ?: 0];
        }

        // ── Chart 3: Top 5 selling products — last 30 days (bar) ─
        $topProdukData = DetailTransaksi::select(
            'nama_barang',
            DB::raw('SUM(jumlah) as total_qty'),
            DB::raw('SUM(subtotal) as total_revenue')
        )
        ->whereHas('transaksi', function ($q) use ($companyId) {
            $q->where('company_id', $companyId)
            ->whereDate('tanggal', '>=', Carbon::today()->subDays(29));
        })
        ->groupBy('nama_barang')
        ->orderByDesc('total_qty')
        ->limit(5)
        ->get();

        $topProdukLabels  = $topProdukData->map(fn($d) => $d->nama_barang)->values()->toArray();
$topProdukQty     = $topProdukData->map(fn($d) => (int) $d->total_qty)->values()->toArray();

        // ── 7-day total for summary card ────────────────────────
        $penjualan7Hari  = array_sum($dailySales);
        $transaksi7Hari  = Transaksi::whereDate('tanggal', '>=', Carbon::today()->subDays(6))
            ->where('company_id', $companyId)
            ->count();

        return view('dashboard', compact(
            'penjualanHariIni',
            'transaksiHariIni',
            'totalProduk',
            'stokRendah',
            'transaksiTerbaru',
            'activeBranchId',
            'penjualan7Hari',
            'transaksi7Hari',
            // chart data
            'dailyLabels',
            'dailySales',
            'kategoriLabels',
            'kategoriStock',
            'topProdukLabels',
            'topProdukQty',
        ));
    }
}
