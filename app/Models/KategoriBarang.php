<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBarang extends Model
{
    use SoftDeletes;

    protected $table = 'kategori_barang';

    protected $fillable = ['nama', 'keterangan'];

    protected $dates = ['deleted_at'];
}