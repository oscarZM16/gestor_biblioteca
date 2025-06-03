<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\MultaController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\EventoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Ruta raíz: redirige al login (para evitar error 404 en tests)
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔐 Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔒 Rutas protegidas por autenticación
    Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('insumos', InsumoController::class);
    Route::get('/bandeja', [InsumoController::class, 'bandeja'])->name('insumos.bandeja');
    
    Route::get('/reportes/insumos', [ReporteController::class, 'bandejaInsumos'])->name('reportes.libros');
    Route::get('/reportes/libros/pdf', [ReporteController::class, 'pdfInsumos'])->name('pdf.insumos');
    Route::get('/reportes/libros/excel', [ReporteController::class, 'exportarExcel'])->name('ruta.libros.export');
    Route::get('/reportes/prestamos', [ReporteController::class, 'reportePrestamos'])->name('reportes.prestamos');
    Route::get('reportes/prestamos/pdf',[ReporteController::class,'pdfPrestamos'])->name('pdf.prestamos');
    Route::get('reportes/prestamos/excel',[ExportController::class, 'index'])->name('excel.prestamos');
    Route::get('/export/prestamos',[ExportController::class, 'export'])->name('ruta.export');
    Route::get('reportes/libros/excel',[ExportController::class, 'mostrarLibros'])->name('excel.libros');
    Route::get('/export/libros',[ExportController::class, 'exportLibros'])->name('ruta.libros.export');
    Route::get('/reportes/disponibles', [ReporteController::class, 'reporteDisponibles'])->name('reportes.disponibles');

    Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/create', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('/admin/prestamos', [PrestamoController::class, 'adminIndex'])->name('prestamos.admin');
    Route::post('/prestamos/{prestamo}/finalizado', [PrestamoController::class, 'cambiarEstado'])->name('prestamos.estado');
    Route::get('/prestamos/multas',[MultaController::class, 'index'])->name('multa.prestamo');
    Route::post('/filtrar/prestamos',[MultaController::class,'filtrar'])->name('filtrar.prestamos');

    Route::resource('eventos', App\Http\Controllers\EventoController::class);
    Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');

});

