<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model {
    use SoftDeletes;
    protected $table = 'detail_transaksi';
    protected $fillable = [
        'kode_transaksi', 'nama_barang',
        'jumlah', 'harga_satuan', 'subtotal', 'jenis', 'alasan_retur', 'company_id'
    ];
    protected $dates = ['deleted_at'];
    
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_transaksi', 'kode_transaksi');
    }
}