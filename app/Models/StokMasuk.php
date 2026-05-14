<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokMasuk extends Model
{
    use SoftDeletes;

    protected $table = 'stok_masuks';

    protected $fillable = [
        'nama_barang',
        'nama_supplier',
        'jumlah',
        'harga_beli',
        'tanggal_masuk',
        'keterangan'
    ];

    protected $dates = ['deleted_at'];
}