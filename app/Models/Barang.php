<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama',
        'kategori',
        'ukuran',
        'warna',
        'harga_beli',
        'harga_jual',
        'stok',
        'foto'
    ];

    protected $dates = ['deleted_at'];
}