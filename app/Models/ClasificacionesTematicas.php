<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificacionesTematicas extends Model
{
    protected $fillable = ['nombre'];

    // Nombre correcto de la tabla
    protected $table = 'clasificaciones_tematicas';
}
