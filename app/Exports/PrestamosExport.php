<?php

namespace App\Exports;

use App\Models\Prestamo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PrestamosExport implements FromView
{
    protected $filtros;

    public function __construct(array $filtros = [])
    {
        $this->filtros = $filtros;
    }

    public function view(): View
    {
        $query = Prestamo::with('insumo', 'user');

        if (!empty($this->filtros['nombre_libro'])) {
            $query->whereHas('insumo', function ($q) {
                $q->where('nombre', 'like', '%' . $this->filtros['nombre_libro'] . '%');
            });
        }

        if (!empty($this->filtros['nombre_usuario'])) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->filtros['nombre_usuario'] . '%');
            });
        }

        if (!empty($this->filtros['estado'])) {
            $query->where('estado', $this->filtros['estado']);
        }

        if (!empty($this->filtros['fecha_inicio_desde'])) {
            $query->whereDate('fecha_inicio', '>=', $this->filtros['fecha_inicio_desde']);
        }

        if (!empty($this->filtros['fecha_inicio_hasta'])) {
            $query->whereDate('fecha_inicio', '<=', $this->filtros['fecha_inicio_hasta']);
        }

        if (!empty($this->filtros['fecha_entrega_desde'])) {
            $query->whereDate('fecha_entrega', '>=', $this->filtros['fecha_entrega_desde']);
        }

        if (!empty($this->filtros['fecha_entrega_hasta'])) {
            $query->whereDate('fecha_entrega', '<=', $this->filtros['fecha_entrega_hasta']);
        }

        if (!empty($this->filtros['fecha_fin_desde'])) {
            $query->whereDate('fecha_devolucion', '>=', $this->filtros['fecha_fin_desde']);
        }

        if (!empty($this->filtros['fecha_fin_hasta'])) {
            $query->whereDate('fecha_devolucion', '<=', $this->filtros['fecha_fin_hasta']);
        }

        $prestamos = $query->get();

        return view('reportes.excelprestamos', compact('prestamos'));
    }
}
