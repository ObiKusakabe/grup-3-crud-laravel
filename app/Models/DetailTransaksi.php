<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model {
    use SoftDeletes;
    protected $table = 'detail_transaksi';
    protected $fillable = [
        'kode_transaksi', 'nama_barang', 'ukuran', 'warna',
        'jumlah', 'harga_satuan', 'subtotal', 'jenis', 'alasan_retur'
    ];
    protected $dates = ['deleted_at'];
}