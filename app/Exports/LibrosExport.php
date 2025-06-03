<?php

namespace App\Exports;

use App\Models\Insumo;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LibrosExport implements FromView
{
    protected $filtros;

    public function __construct(array $filtros = [])
    {
        $this->filtros = $filtros;
    }

    public function view(): View
    {
        $query = Insumo::query();

        if (!empty($this->filtros['nombre'])) {
            $query->where('nombre', 'like', '%' . $this->filtros['nombre'] . '%');
        }

        if (!empty($this->filtros['clasificaciones_tematicas_id'])) {
            $query->where('clasificaciones_tematicas_id', $this->filtros['clasificaciones_tematicas_id']);
        }

        if (!empty($this->filtros['generos_literarios_id'])) {
            $query->where('generos_literarios_id', $this->filtros['generos_literarios_id']);
        }

        if (!empty($this->filtros['publicos_objetivos_id'])) {
            $query->where('publicos_objetivos_id', $this->filtros['publicos_objetivos_id']);
        }

        if (!empty($this->filtros['tipos_obras_id'])) {
            $query->where('tipos_obras_id', $this->filtros['tipos_obras_id']);
        }

        if (!empty($this->filtros['fecha_desde'])) {
            $query->whereDate('created_at', '>=', $this->filtros['fecha_desde']);
        }

        if (!empty($this->filtros['fecha_hasta'])) {
            $query->whereDate('created_at', '<=', $this->filtros['fecha_hasta']);
        }

        $insumos = $query->get();

        return view('reportes.excellibros', compact('insumos'));
    }
}
