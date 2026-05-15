<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warna extends Model
{
    use SoftDeletes;
    protected $table = 'warnas';

    protected $fillable = ['nama', 'kode_hex'];

    protected $dates = ['deleted_at'];
}