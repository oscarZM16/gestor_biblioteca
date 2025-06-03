@extends('layouts.app')

@section('content')
<div class="container">
    {{-- FORMULARIO DE FILTROS --}}
    <form method="GET" action="{{ route('reportes.libros') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre del Libro</label>
                <input type="text" name="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Buscar por nombre">
            </div>
            <div class="col-md-3">
                <label class="form-label">Clasificación Temática</label>
                <select name="clasificaciones_tematicas_id" class="form-select">
                    <option value="">Todas</option>
                    @foreach($clasificaciones_tematicas as $clasificacion)
                        <option value="{{ $clasificacion->id }}" {{ request('clasificaciones_tematicas_id') == $clasificacion->id ? 'selected' : '' }}>
                            {{ $clasificacion->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Género Literario</label>
                <select name="generos_literarios_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach($generos_literarios as $genero)
                        <option value="{{ $genero->id }}" {{ request('generos_literarios_id') == $genero->id ? 'selected' : '' }}>
                            {{ $genero->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Público Objetivo</label>
                <select name="publicos_objetivos_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach($publicos_objetivos as $publico)
                        <option value="{{ $publico->id }}" {{ request('publicos_objetivos_id') == $publico->id ? 'selected' : '' }}>
                            {{ $publico->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tipo de Obra</label>
                <select name="tipos_obras_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach($tipos_obras as $tipo)
                        <option value="{{ $tipo->id }}" {{ request('tipos_obras_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2 align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('reportes.libros') }}" class="btn btn-secondary w-100">Limpiar</a>
            </div>
        </div>

    </form>

    {{-- TÍTULO Y BOTONES DE EXPORTACIÓN --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-book"></i> Reporte de Libros</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('pdf.insumos', request()->query()) }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF
            </a>
            <a href="{{ route('ruta.libros.export', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i> Exportar Excel
            </a>
        </div>
    </div>

    {{-- TABLA DE RESULTADOS --}}
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Cantidad</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($insumos as $insumo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $insumo->nombre }}</td>
                    <td>{{ $insumo->descripcion }}</td>
                    <td>{{ ucfirst($insumo->estado) }}</td>
                    <td>{{ $insumo->cantidad }}</td>
                    <td>{{ $insumo->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay libros registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- BOTÓN DE VOLVER --}}
    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
</div>
@endsection
