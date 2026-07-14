<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBarang extends Model
{
    use SoftDeletes;

    protected $table = 'kategori_barang';

    protected $fillable = ['nama', 'keterangan', 'company_id'];

    protected $dates = ['deleted_at'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}