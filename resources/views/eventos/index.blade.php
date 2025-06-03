@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="mb-4">Eventos</h2>
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('eventos.create') }}" class="btn btn-primary mb-3">Crear Evento</a>

    @if($eventos->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventos as $evento)
                    <tr>
                        <td>{{ $evento->titulo }}</td>
                        <td>{{ $evento->fecha_inicio }}</td>
                        <td>{{ $evento->fecha_fin ?? '-' }}</td>
                        <td>{{ $evento->ubicacion ?? '-' }}</td>
                        <td>
                            <a href="{{ route('eventos.show', $evento) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('eventos.destroy', $evento) }}" method="POST" style="display:inline-block" onsubmit="return confirm('¿Eliminar evento?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $eventos->links() }}
    @else
        <p>No hay eventos registrados.</p>
    @endif
@endsection
