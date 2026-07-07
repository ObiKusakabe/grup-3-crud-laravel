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

// Login/auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::resource('dashboard', DashboardController::class);

// Barang
Route::resource('barang', BarangController::class);

// Stock Management
Route::get('stock-management', [StockManagementController::class, 'index'])->name('stock-management.index');
Route::get('stock-management/create-in', [StockManagementController::class, 'createIn'])->name('stock-management.create-in');
Route::post('stock-management/store-in', [StockManagementController::class, 'storeIn'])->name('stock-management.store-in');
Route::get('stock-management/create-out', [StockManagementController::class, 'createOut'])->name('stock-management.create-out');
Route::post('stock-management/store-out', [StockManagementController::class, 'storeOut'])->name('stock-management.store-out');
Route::post('stock-management/set-branch', [StockManagementController::class, 'setBranch'])->name('stock-management.set-branch');

// Transaksi
Route::resource('transaksi', TransaksiController::class);
Route::patch('transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.status');

Route::resource('kategori-barang', KategoriBarangController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('member', MemberController::class);
Route::resource('detail-transaksi', DetailTransaksiController::class);