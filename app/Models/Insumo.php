<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'estado',
        'clasificacion_tematica_id',
        'genero_literario_id',
        'publico_objetivo_id',
        'tipo_de_obra_id',
    ];

    // Relaciones con otras tablas

    public function clasificacionTematica()
    {
        return $this->belongsTo(ClasificacionTematica::class, 'clasificacion_tematica_id');
    }

    public function generoLiterario()
    {
        return $this->belongsTo(GeneroLiterario::class, 'genero_literario_id');
    }

    public function publicoObjetivo()
    {
        return $this->belongsTo(PublicoObjetivo::class, 'publico_objetivo_id');
    }

    public function tipoDeObra()
    {
        return $this->belongsTo(TipoObra::class, 'tipo_de_obra_id');
    }
}