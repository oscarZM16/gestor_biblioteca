<?php

namespace App\Http\Controllers;

use App\Exports\LibrosExport;
use Illuminate\Http\Request;
use App\Exports\PrestamosExport;
use  Maatwebsite\Excel\Facades\Excel;
use App\Models\Prestamo;

class ExportController extends Controller
{
    public function index(){
        return view('reportes.excelprestamos');
    }
    public function export(){
        return Excel::download(new PrestamosExport, 'prestamos.xlsx');

    }
    public function mostrarLibros(){
        return view('reportes.excellibros');
    }
    public function exportLibros(){
        return Excel::download(new LibrosExport, 'libros.xlsx');
    }
}
