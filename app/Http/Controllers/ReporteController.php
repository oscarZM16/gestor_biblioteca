<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;
use App\Models\Prestamo;
use Barryvdh\DomPDF\Facade\Pdf;

// Agrega estos modelos:
use App\Models\ClasificacionesTematicas;
use App\Models\GenerosLiterarios;
use App\Models\PublicosObjetivos;
use App\Models\TiposObras;

class ReporteController extends Controller
{
    public function reporteInsumos()
    {
        $insumos = Insumo::all();
        return view('reportes.insumos', compact('insumos'));
    }

    public function bandejaInsumos(Request $request)
    {
        $clasificaciones_tematicas = ClasificacionesTematicas::all();
        $generos_literarios = GenerosLiterarios::all();
        $publicos_objetivos = PublicosObjetivos::all();
        $tipos_obras = TiposObras::all();

        $query = Insumo::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }
        if ($request->filled('clasificaciones_tematicas_id')) {
            $query->where('clasificaciones_tematicas_id', $request->clasificaciones_tematicas_id);
        }
        if ($request->filled('generos_literarios_id')) {
            $query->where('generos_literarios_id', $request->generos_literarios_id);
        }
        if ($request->filled('publicos_objetivos_id')) {
            $query->where('publicos_objetivos_id', $request->publicos_objetivos_id);
        }
        if ($request->filled('tipos_obras_id')) {
            $query->where('tipos_obras_id', $request->tipos_obras_id);
        }

        $insumos = $query->get();

        return view('reportes.insumos', compact(
            'insumos',
            'clasificaciones_tematicas',
            'generos_literarios',
            'publicos_objetivos',
            'tipos_obras'
        ));
    }

    // Método con filtros para préstamos
    public function reportePrestamos(Request $request)
    {
        $query = Prestamo::with('insumo', 'user');

        if ($request->filled('nombre_libro')) {
            $query->whereHas('insumo', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->nombre_libro . '%');
            });
        }

        if ($request->filled('nombre_usuario')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nombre_usuario . '%');
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_inicio_desde')) {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio_desde);
        }
        if ($request->filled('fecha_inicio_hasta')) {
            $query->whereDate('fecha_inicio', '<=', $request->fecha_inicio_hasta);
        }

        if ($request->filled('fecha_fin_desde')) {
            $query->whereDate('fecha_devolucion', '>=', $request->fecha_fin_desde);
        }
        if ($request->filled('fecha_fin_hasta')) {
            $query->whereDate('fecha_devolucion', '<=', $request->fecha_fin_hasta);
        }

        $prestamos = $query->get();

        return view('reportes.prestamos', compact('prestamos'));
    }

    public function reporteDisponibles()
    {
        $insumos = Insumo::where('estado', 'disponible')->get();
        return view('reportes.disponibles', compact('insumos'));
    }

    public function pdfPrestamos(Request $request)
    {
        $query = Prestamo::with('insumo', 'user');

        if ($request->filled('nombre_libro')) {
            $query->whereHas('insumo', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->nombre_libro . '%');
            });
        }

        if ($request->filled('nombre_usuario')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nombre_usuario . '%');
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_inicio_desde')) {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio_desde);
        }
        if ($request->filled('fecha_inicio_hasta')) {
            $query->whereDate('fecha_inicio', '<=', $request->fecha_inicio_hasta);
        }

        if ($request->filled('fecha__entrega_desde')) {
            $query->whereDate('fecha_entrega', '>=', $request->fecha__entrega_desde);
        }
        if ($request->filled('fecha__entrega_hasta')) {
            $query->whereDate('fecha_entrega', '<=', $request->fecha__entrega_hasta);
        }


        if ($request->filled('fecha_fin_desde')) {
            $query->whereDate('fecha_devolucion', '>=', $request->fecha_fin_desde);
        }
        if ($request->filled('fecha_fin_hasta')) {
            $query->whereDate('fecha_devolucion', '<=', $request->fecha_fin_hasta);
        }

        $prestamos = $query->get();

        $pdf = Pdf::loadView('reportes.pdf', compact('prestamos'));
        return $pdf->stream('prestamos-filtrados.pdf');
    }

    public function pdfInsumos(Request $request)
    {
        $query = Insumo::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('clasificaciones_tematicas_id')) {
            $query->where('clasificaciones_tematicas_id', $request->clasificaciones_tematicas_id);
        }

        if ($request->filled('generos_literarios_id')) {
            $query->where('generos_literarios_id', $request->generos_literarios_id);
        }

        if ($request->filled('publicos_objetivos_id')) {
            $query->where('publicos_objetivos_id', $request->publicos_objetivos_id);
        }

        if ($request->filled('tipos_obras_id')) {
            $query->where('tipos_obras_id', $request->tipos_obras_id);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        $insumos = $query->get();

        $pdf = Pdf::loadView('reportes.pdfinsumos', compact('insumos'));
        return $pdf->stream('libros-filtrados.pdf');
    }

    public function pdfDisponibles()
    {
        //
    }
}
