<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoObra extends Model
{
    protected $fillable = ['nombre'];
    protected $table = 'tipo_obra';
}
