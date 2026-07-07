<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'barangs';

    protected $fillable = [
        'kode_barang',
        'nama',
        'kategori_id',
        'harga_beli',
        'harga_jual',
        'foto'
    ];

    protected $dates = ['deleted_at'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class, 'product_id');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'product_id');
    }

    public function getStockForBranch(int $branchId)
    {
        return $this->productStocks()->where('branch_id', $branchId)->first()?->stock ?? 0;
    }
}