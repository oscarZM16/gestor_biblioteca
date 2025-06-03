<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;
use App\Models\Prestamo;
use Carbon\Carbon;

class MultaController extends Controller
{
    public function index(){
        $prestamos = Prestamo::all();
        foreach ($prestamos as $prestamo) {
            $multa = $this->calcularmulta($prestamo);
            $prestamo->multa = $multa;
            $prestamo->save();
        }
        return view('multas.prestamos', compact('prestamos'));
    }
    public function filtrar(Request $request){
        $prestamos = Prestamo::where('fecha_inicio', '>=', $request->fecha_inicio)
            ->where('fecha_devolucion', '<=', $request->fecha_fin) // corregido aquí también
            ->get();

        foreach ($prestamos as $prestamo) {
            $prestamo->multa = $this->calcularmulta($prestamo);
        }
        return view('multas.prestamos', compact('prestamos'));
    }
    public function calcularmulta($prestamos){
        $multa = 0;
        $precio =5;

        $estado = $prestamos->estado;
        $fecha_fin = Carbon::parse($prestamos->fecha_devolucion);
        $fecha_entrega = Carbon::parse($prestamos->fecha_entrega);
        $fecha_actual = Carbon::now();

        if($estado == 'prestado'){
            if($fecha_actual > $fecha_fin){
                $diferencia = $fecha_actual->diffInDays($fecha_fin);
                $multa = $multa + ($diferencia * $precio);

            }
            else{
                $multa = $multa + 0;
            }
        }
        else{
            if($fecha_entrega > $fecha_fin){
                $diferencia = $fecha_entrega->diffInDays($fecha_fin);
                $multa = $multa + ($diferencia * $precio);
            }
            else{
                $multa = $multa + 0;
            }
        }
        return $multa;
    }
}
