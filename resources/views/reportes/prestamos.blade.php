@extends('layouts.app')

@section('content')
<main class="container">

    {{-- BOTÓN FIJO VOLVER --}}
    <a href="{{ route('users.index') }}" 
        class="btn btn-outline-dark position-sticky" 
        style="top: 1rem; left: 1rem; z-index: 1050; width: max-content;">
        <i class="bi bi-arrow-left"></i> Volver al Panel Principal
    </a>

    <div class="row mt-5">
        {{-- FILTROS EN LA COLUMNA IZQUIERDA --}}
        <aside class="col-lg-4 mb-4" aria-labelledby="filtros-prestamos">
            <section>
                <h2 id="filtros-prestamos" class="h4 mb-3">Filtros</h2>
                <form method="GET" action="{{ route('reportes.prestamos') }}">
                    <div class="mb-3">
                        <input type="text" name="nombre_libro" class="form-control" placeholder="Nombre del libro" value="{{ request('nombre_libro') }}">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre del usuario" value="{{ request('nombre_usuario') }}">
                    </div>

                    <div class="mb-3">
                        <select name="estado" class="form-select">
                            <option value="">- Estado -</option>
                            <option value="prestado" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Prestado</option>
                            <option value="devuelto" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Devuelto</option>
                            <option value="atrasado" {{ request('estado') == 'atrasado' ? 'selected' : '' }}>Atrasado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha inicio desde</label>
                        <input type="date" name="fecha_inicio_desde" class="form-control" value="{{ request('fecha_inicio_desde') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha inicio hasta</label>
                        <input type="date" name="fecha_inicio_hasta" class="form-control" value="{{ request('fecha_inicio_hasta') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha fin desde</label>
                        <input type="date" name="fecha_fin_desde" class="form-control" value="{{ request('fecha_fin_desde') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha fin hasta</label>
                        <input type="date" name="fecha_fin_hasta" class="form-control" value="{{ request('fecha_fin_hasta') }}">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        <a href="{{ route('reportes.prestamos') }}" class="btn btn-secondary w-100">Limpiar</a>
                    </div>
                </form>
            </section>
        </aside>

        {{-- CONTENIDO PRINCIPAL EN LA COLUMNA DERECHA --}}
        <section class="col-lg-8">
            {{-- ENCABEZADO CON BOTÓN DE REGRESAR Y EXPORTACIÓN --}}
            <header class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 mb-0">
                        <i class="bi bi-journal-text"></i> Reporte de Préstamos
                    </h2>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('pdf.prestamos', request()->query()) }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                    </a>
                    <a href="{{ route('ruta.export', request()->query()) }}" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel-fill"></i> Excel
                    </a>
                </div>
            </header>

            {{-- TABLA DE RESULTADOS --}}
            <div class="table-responsive">
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
            </div>
        </section>
    </div>
</main>
@endsection
