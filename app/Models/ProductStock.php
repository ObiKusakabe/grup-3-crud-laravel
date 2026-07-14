<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'product_id',
        'branch_id',
        'stock',
        'min_stock',
        'company_id'
    ];

    public function product()
    {
        return $this->belongsTo(Barang::class, 'product_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
