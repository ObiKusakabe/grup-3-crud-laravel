<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'transaksis';

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'kasir',
        'nama_member',
        'total_bayar',
        'diskon',
        'total_akhir',
        'tunai',
        'kembalian',
        'status'
    ];

    protected $dates = ['deleted_at'];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'kode_transaksi', 'kode_transaksi');
    }
}