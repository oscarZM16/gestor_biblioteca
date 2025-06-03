@extends('layouts.app')

@section('content')
<main class="container position-relative">

    {{-- BOTÓN FIJO VOLVER --}}
    <a href="{{ route('users.index') }}" 
        class="btn btn-outline-dark position-sticky" 
        style="top: 1rem; left: 1rem; z-index: 1050; width: max-content;">
        <i class="bi bi-arrow-left"></i> Volver al Panel Principal
    </a>

    <div class="row mt-5">

        {{-- FILTROS EN LA COLUMNA IZQUIERDA --}}
        <aside class="col-lg-4 mb-4" aria-labelledby="filtros-libros">
            <section>
                <h2 id="filtros-libros" class="h4 mb-3">Filtros</h2>
                <form method="GET" action="{{ route('reportes.libros') }}">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Libro</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Buscar por nombre">
                    </div>
                    <div class="mb-3">
                        <label for="clasificacion" class="form-label">Clasificación Temática</label>
                        <select name="clasificaciones_tematicas_id" id="clasificacion" class="form-select">
                            <option value="">Todas</option>
                            @foreach($clasificaciones_tematicas as $clasificacion)
                                <option value="{{ $clasificacion->id }}" {{ request('clasificaciones_tematicas_id') == $clasificacion->id ? 'selected' : '' }}>
                                    {{ $clasificacion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="genero" class="form-label">Género Literario</label>
                        <select name="generos_literarios_id" id="genero" class="form-select">
                            <option value="">Todos</option>
                            @foreach($generos_literarios as $genero)
                                <option value="{{ $genero->id }}" {{ request('generos_literarios_id') == $genero->id ? 'selected' : '' }}>
                                    {{ $genero->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="publico" class="form-label">Público Objetivo</label>
                        <select name="publicos_objetivos_id" id="publico" class="form-select">
                            <option value="">Todos</option>
                            @foreach($publicos_objetivos as $publico)
                                <option value="{{ $publico->id }}" {{ request('publicos_objetivos_id') == $publico->id ? 'selected' : '' }}>
                                    {{ $publico->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_obra" class="form-label">Tipo de Obra</label>
                        <select name="tipos_obras_id" id="tipo_obra" class="form-select">
                            <option value="">Todos</option>
                            @foreach($tipos_obras as $tipo)
                                <option value="{{ $tipo->id }}" {{ request('tipos_obras_id') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        <a href="{{ route('reportes.libros') }}" class="btn btn-secondary w-100">Limpiar</a>
                    </div>
                </form>
            </section>
        </aside>

        {{-- RESULTADOS EN LA COLUMNA DERECHA --}}
        <section class="col-lg-8">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4"><i class="bi bi-book"></i> Reporte de Libros</h2>
                <nav class="d-flex gap-2">
                    <a href="{{ route('pdf.insumos', request()->query()) }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                    </a>
                    <a href="{{ route('ruta.libros.export', request()->query()) }}" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel-fill"></i> Excel
                    </a>
                </nav>
            </header>

            <div class="table-responsive">
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
            </div>
        </section>
    </div>
</main>
@endsection
