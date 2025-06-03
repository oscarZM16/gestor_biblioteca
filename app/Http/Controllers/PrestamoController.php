<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Insumo;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function index()
    {
        // Mostrar todos los préstamos del funcionario autenticado
        $prestamos = Prestamo::with('insumo')
            ->where('user_id', Auth::id())
            ->get();

        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        // Mostrar todos los libros que están disponibles
        $insumos = Insumo::where('estado','disponible')->get();

        return view('prestamos.create', compact('insumos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'insumo_id' => 'required|exists:insumos,id',
            'cantidad' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required',
            'identificacion_s' => 'required',
            'email_s' => 'required'
            
        ]);

        
        $insumo = Insumo::find($request->insumo_id);
        
        $resta = $insumo->cantidad - $request->cantidad ;
        if($resta >= 0){
            
            Prestamo::create([
                'user_id' => Auth::id(),
                'insumo_id' => $request->insumo_id,
                'cantidad_prstada' => $request->cantidad,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_devolucion' => $request->fecha_fin,
                'estado' => 'prestado',
                'identificacion_solicitante' => $request->identificacion_s,
                'email_solicitante' => $request->email_s
                
            ]);
            
            return redirect()->route('prestamos.index')->with('success', 'Libro prestado');
         
        }else{
            
            return redirect()->route('prestamos.create')->with('error','El libro se agotó');
            }
    }


    // SOLO PARA ADMINISTRADORES

    // public function adminIndex(){
    //     // Ver todas las solicitudes de todos los usuarios
    //     $prestamos = Prestamo::with(['user', 'insumo'])->orderBy('created_at', 'desc')->get();
    //     return view('prestamos.index', compact('prestamos'));
    // }

    public function cambiarEstado($id){
        if (!in_array(Auth::user()->rol, ['administrador','funcionario'])) {
            abort(403, 'Acceso no autorizado');
        }
        $prestamos = Prestamo::findOrFail($id);
        if($prestamos->estado == 'devuelto'){
            return back()->with('info','esta acción ya se efectuó.');
        }
        elseif($prestamos->estado = 'prestado'){
            $prestamos->fecha_entrega = now();
            $prestamos->estado = 'devuelto';
            $prestamos->save();
        }

        return redirect()->route('prestamos.index')->with('success', 'Prestamo finalizado');
    }
    



}