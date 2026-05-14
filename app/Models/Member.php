<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model {
    use SoftDeletes;
    protected $table = 'member';
    protected $fillable = ['nama', 'telepon', 'alamat', 'diskon_persen'];
    protected $dates = ['deleted_at'];
}