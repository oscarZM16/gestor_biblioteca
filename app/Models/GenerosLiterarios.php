<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenerosLiterarios extends Model
{
    protected $fillable = ['nombre'];
    protected $table = 'generos_literarios';
}
