<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DetailTransaksiController;

Route::resource('supplier', SupplierController::class);
Route::resource('member', MemberController::class);
Route::resource('detail-transaksi', DetailTransaksiController::class);

Route::get('/', function () {
    return view('welcome');
});
