<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StockManagementController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BranchController;

// ── Auth (Guest only) ──────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [SignUpController::class, 'showSignUp'])->name('signup');
    Route::post('/signup', [SignUpController::class, 'signUp']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard.index')
        : redirect()->route('login');
});

// ── Authenticated ──────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard – semua role boleh akses
    Route::resource('dashboard', DashboardController::class)->only(['index']);

    // ── Admin + Inventaris ──────────────────────────────────────────────
    Route::middleware('checkrole:admin,inventaris')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('kategori-barang', KategoriBarangController::class);
        Route::resource('supplier', SupplierController::class);

        Route::get('stock-management', [StockManagementController::class, 'index'])->name('stock-management.index');
        Route::get('stock-management/create-in', [StockManagementController::class, 'createIn'])->name('stock-management.create-in');
        Route::post('stock-management/store-in', [StockManagementController::class, 'storeIn'])->name('stock-management.store-in');
        Route::get('stock-management/create-out', [StockManagementController::class, 'createOut'])->name('stock-management.create-out');
        Route::post('stock-management/store-out', [StockManagementController::class, 'storeOut'])->name('stock-management.store-out');
        Route::post('stock-management/update-stock', [StockManagementController::class, 'updateStock'])->name('stock-management.update-stock');
        Route::post('stock-management/set-branch', [StockManagementController::class, 'setBranch'])->name('stock-management.set-branch');
    });

    // ── Admin + POS – bisa buat & lihat transaksi ──────────────────────
    Route::middleware('checkrole:admin,pos')->group(function () {
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
    });

    // ── Inventaris – view only transaksi ────────────────────────────────
    Route::middleware('checkrole:inventaris')->group(function () {
        Route::get('transaksi-view', [TransaksiController::class, 'index'])->name('transaksi.view');
    });

    // ── Admin only – edit/delete transaksi & kelola pegawai ────────────
    Route::middleware('checkrole:admin')->group(function () {
        // Route::get('transaksi/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
        // Route::put('transaksi/{transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
        Route::delete('transaksi/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
        // Route::patch('transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.status');

        Route::resource('member', MemberController::class)->except(['index']);
        Route::resource('employees', EmployeeController::class);
        Route::resource('branches', BranchController::class);
        Route::resource('detail-transaksi', DetailTransaksiController::class);
    });

    // ── Admin + POS – view member (untuk diskon) ───────────────────────────────
    Route::middleware('checkrole:admin,pos')->group(function () {
        Route::get('member', [MemberController::class, 'index'])->name('member.index');
    });
});