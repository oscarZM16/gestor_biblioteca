<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'insumo_id','cantidad_prstada', 'estado', 'fecha_inicio','fecha_entrega','fecha_devolucion','multa', 'identificacion_solicitante', 'email_solicitante'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}