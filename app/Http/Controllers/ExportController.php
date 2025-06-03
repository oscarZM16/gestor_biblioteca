<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PrestamosExport;
use App\Exports\LibrosExport;

class ExportController extends Controller
{
    public function mostrarLibros()
    {
        return view('reportes.excellibros');
    }

    public function exportLibros(Request $request)
    {
        return Excel::download(new LibrosExport($request->all()), 'libros.xlsx');
    }

    public function index()
    {
        return view('reportes.excelprestamos');
    }

    public function export(Request $request)
    {
        return Excel::download(new PrestamosExport($request->all()), 'prestamos.xlsx');
    }
}
