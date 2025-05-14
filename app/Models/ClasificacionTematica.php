<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificacionTematica extends Model
{
    protected $fillable = ['nombre'];

    // Nombre correcto de la tabla
    protected $table = 'clasificacion_tematica';
}
