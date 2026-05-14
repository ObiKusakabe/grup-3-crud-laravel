<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\UkuranController;
use App\Http\Controllers\WarnaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DetailTransaksiController;

Route::resource('barang', BarangController::class);
Route::resource('stok-masuk', StokMasukController::class);
Route::resource('transaksi', TransaksiController::class);
Route::patch('transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.status');

Route::resource('kategori-barang', KategoriBarangController::class);
Route::resource('ukuran', UkuranController::class);
Route::resource('warna', WarnaController::class);

Route::resource('supplier', SupplierController::class);
Route::resource('member', MemberController::class);
Route::resource('detail-transaksi', DetailTransaksiController::class);