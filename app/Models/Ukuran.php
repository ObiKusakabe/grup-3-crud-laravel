<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ukuran extends Model
{
    use SoftDeletes;

    protected $table = 'ukurans';

    protected $fillable = ['nama'];

    protected $dates = ['deleted_at'];
}