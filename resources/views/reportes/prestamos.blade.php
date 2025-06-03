@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('reportes.prestamos') }}" class="row g-3 mb-3">

    <div class="col-md-3">
        <input type="text" name="nombre_libro" class="form-control" placeholder="Nombre del libro" value="{{ request('nombre_libro') }}">
    </div>

    <div class="col-md-3">
        <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre del usuario" value="{{ request('nombre_usuario') }}">
    </div>

    <div class="col-md-2">
        <select name="estado" class="form-select">
            <option value="">-- Estado --</option>
            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
            <option value="atrasado" {{ request('estado') == 'atrasado' ? 'selected' : '' }}>Atrasado</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label mb-0">Fecha inicio desde</label>
        <input type="date" name="fecha_inicio_desde" class="form-control" value="{{ request('fecha_inicio_desde') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label mb-0">Fecha inicio hasta</label>
        <input type="date" name="fecha_inicio_hasta" class="form-control" value="{{ request('fecha_inicio_hasta') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label mb-0">Fecha fin desde</label>
        <input type="date" name="fecha_fin_desde" class="form-control" value="{{ request('fecha_fin_desde') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label mb-0">Fecha fin hasta</label>
        <input type="date" name="fecha_fin_hasta" class="form-control" value="{{ request('fecha_fin_hasta') }}">
    </div>

    <div class="col-md-12 text-end mt-2">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ route('reportes.prestamos') }}" class="btn btn-secondary">Limpiar</a>
    </div>
    

</form>

<div class="container">
    <div class="d-flex justify-content-between">
        <h2 class="mb-4">
            <i class="bi bi-journal-text"></i> Reporte de Préstamos
        </h2>
        <div>
            <a href="{{ route('pdf.prestamos', request()->query()) }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF
            </a>
            <a href="{{ route('ruta.export', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i> Exportar Excel
            </a>
        </div>
    </div>
    
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Libro</th>
                <th>Solicitado por</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Solicitado el</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestamos as $prestamo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prestamo->insumo->nombre }}</td>
                    <td>{{ $prestamo->user->name }}</td>
                    <td>{{ $prestamo->fecha_inicio }}</td>
                    <td>{{ $prestamo->fecha_devolucion }}</td>
                    <td>{{ ucfirst($prestamo->estado) }}</td>
                    <td>{{ $prestamo->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay préstamos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
</div>
@endsection
