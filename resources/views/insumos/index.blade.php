@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Libros</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('insumos.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Agregar Libro
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Clasificacion Tematica</th>
                    <th>Genero Literario</th>
                    <th>Publico Objetivo</th>
                    <th>Tipo de Obra</th>
                    <th>Cantidad</th>
                    <th>Cantidad Disponible</th>
                    <th>Cantidad Prestada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($insumos as $insumo)
                    <tr>
                        <td>{{ $insumo->id }}</td>
                        <td>{{ $insumo->nombre }}</td>
                        <td>{{ $insumo->descripcion }}</td>
                        <td>{{ $insumo->clasificacionesTematicas->nombre ?? 'Sin clasificar' }}</td>
                        <td>{{ $insumo->generosLiterarios->nombre ?? 'Sin clasificar' }}</td>
                        <td>{{ $insumo->publicosObjetivos->nombre ?? 'Sin clasificar' }}</td>
                        <td>{{ $insumo->tiposDeObras->nombre ?? 'Sin clasificar' }}</td>
                        <td>{{ $insumo->cantidad }}</td>
                        <td>{{ $insumo->cantidad_disponible }}</td>
                        <td>{{ $insumo->cantidad_prestada }}</td>
                        <td>{{ $insumo->estado }}</td>
                        <td>
                            <a href="{{ route('insumos.edit', $insumo) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{ route('insumos.destroy', $insumo) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar este libro?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10">No hay libros registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left"></i> Volver al Panel Principal
            </a>
        </div>
    </div>
</div>
@endsection
