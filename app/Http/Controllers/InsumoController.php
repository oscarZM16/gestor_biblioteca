<?php

namespace App\Http\Controllers;

use App\Models\ClasificacionesTematicas;
use App\Models\GenerosLiterarios;
use App\Models\Insumo;
use App\Models\PublicosObjetivos;
use App\Models\TiposObras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!in_array(Auth::user()->rol, ['administrador', 'supervisor'])) {
                return redirect()->route('users.index')->with('error', 'Acceso denegado');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $insumos = Insumo::with([
            'clasificacionesTematicas', 
            'generosLiterarios', 
            'publicosObjetivos', 
            'tiposDeObras',
            'prestamos',
        ])->get();

        return view('insumos.index', compact('insumos'));
    }


    public function create()
    {
        $clasificaciones_tematicas = ClasificacionesTematicas::all();
        $generos_literarios = GenerosLiterarios::all();
        $publicos_objetivos = PublicosObjetivos::all();
        $tipos_obras = TiposObras::all();

        return view('insumos.create', compact('clasificaciones_tematicas', 'generos_literarios', 'publicos_objetivos', 'tipos_obras'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'clasificaciones_tematicas_id' => 'required|exists:clasificaciones_tematicas,id',
            'generos_literarios_id' => 'required|exists:generos_literarios,id',
            'publicos_objetivos_id' => 'required|exists:publicos_objetivos,id',
            'tipos_obras_id' => 'required|exists:tipos_obras,id',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|string',
        ]);

        Insumo::create($request->all());

        return redirect()->route('insumos.index')->with('success', 'Libro creado correctamente');
    }

    public function edit(Insumo $insumo)
    {
        $clasificaciones_tematicas = ClasificacionesTematicas::all();
        $generos_literarios = GenerosLiterarios::all();
        $publicos_objetivos = PublicosObjetivos::all();
        $tipos_obras = TiposObras::all();

        return view('insumos.edit', compact('insumo', 'clasificaciones_tematicas', 'generos_literarios', 'publicos_objetivos', 'tipos_obras'));
    }

    public function update(Request $request, Insumo $insumo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'clasificaciones_tematicas_id' => 'required|exists:clasificaciones_tematicas,id',
            'generos_literarios_id' => 'required|exists:generos_literarios,id',
            'publicos_objetivos_id' => 'required|exists:publicos_objetivos,id',
            'tipos_obras_id' => 'required|exists:tipos_obras,id',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|string',
        ]);

        $insumo->update($request->all());

        return redirect()->route('insumos.index')->with('success', 'Libro actualizado correctamente');
    } 

    public function destroy(Insumo $insumo)
    {
        $insumo->delete();
        return redirect()->route('insumos.index')->with('success', 'Libro eliminado');
    }

    public function bandeja(Request $request)
    {
        $nombre = $request->input('nombre');

        $query = Insumo::query();

        if ($nombre) {
            $query->where('nombre', 'like', "%{$nombre}%");
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

        $todos = $query->get();
        $disponibles = $todos->where('estado', 'disponible');
        $prestados = $todos->where('estado', 'prestado');

        $clasificaciones_tematicas = ClasificacionesTematicas::all();
        $generos_literarios = GenerosLiterarios::all();
        $publicos_objetivos = PublicosObjetivos::all();
        $tipos_obras = TiposObras::all();

        return view('insumos.bandeja', compact(
            'disponibles',
            'prestados',
            'nombre',
            'clasificaciones_tematicas',
            'generos_literarios',
            'publicos_objetivos',
            'tipos_obras'
        ));
    }
}