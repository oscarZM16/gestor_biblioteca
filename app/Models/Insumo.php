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
        'clasificaciones_tematicas_id',
        'generos_literarios_id',
        'publicos_objetivos_id',
        'tipos_obras_id',
    ];

    // Relaciones con otras tablas
    public function clasificacionesTematicas()
    {
        return $this->belongsTo(ClasificacionesTematicas::class, 'clasificaciones_tematicas_id');
    }

    public function generosLiterarios()
    {
        return $this->belongsTo(GenerosLiterarios::class, 'generos_literarios_id');
    }

    public function publicosObjetivos()
    {
        return $this->belongsTo(PublicosObjetivos::class, 'publicos_objetivos_id');
    }

    public function tiposDeObras()
    {
        return $this->belongsTo(TiposObras::class, 'tipos_obras_id');
    }

    // Relación con préstamos
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'insumo_id');
    }

    // Accesor: cantidad prestada actualmente (aprobados y en curso)
    public function getCantidadPrestadaAttribute()
    {
        return $this->prestamos()
            ->where('estado', 'aprobado')
            ->where('fecha_inicio', '<=', now())
            ->where('fecha_fin', '>=', now())
            ->count();
    }

    // Accesor: cantidad disponible
    public function getCantidadDisponibleAttribute()
    {
        return $this->cantidad - $this->cantidad_prestada;
    }
}
