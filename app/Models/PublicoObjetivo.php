<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicoObjetivo extends Model
{
    protected $fillable = ['nombre'];
    protected $table = 'publico_objetivo';
}
