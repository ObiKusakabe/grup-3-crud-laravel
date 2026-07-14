<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id',
        'branch_id',
        'type',
        'qty',
        'reason',
        'note',
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
