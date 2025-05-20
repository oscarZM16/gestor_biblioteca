<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposObras extends Model
{
    protected $fillable = ['nombre'];
    protected $table = 'tipos_obras';
}
