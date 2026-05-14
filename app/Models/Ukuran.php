<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ukuran extends Model
{
    use SoftDeletes;

    protected $fillable = ['nama'];

    protected $dates = ['deleted_at'];
}