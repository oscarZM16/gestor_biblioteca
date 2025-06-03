@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mis Solicitudes de Préstamo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>    
    @endif

    <a href="{{ route('prestamos.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Solicitar Préstamo
    </a>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Libro</th>
                    <th>Cantidad</th>
                    <th>Solicitante</th>
                    <th>Estado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Fecha Devolución</th>
                    <th>Solicitado el</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestamos as $prestamo)
                    <tr>
                        <td>{{ $prestamo->insumo->nombre }}</td>
                        <td>{{ $prestamo->cantidad_prstada }}</td>
                        <td>{{ $prestamo->email_solicitante }}</td>
                        <td>{{ ucfirst($prestamo->estado) }}</td>
                        <td>{{ $prestamo->fecha_inicio }}</td>
                        <td>{{ $prestamo->fecha_devolucion }}</td>
                        <td>{{ $prestamo->fecha_entrega}}</td>
                        <td>{{ $prestamo->created_at->format('Y-m-d H:i') }}</td>
                        @if($prestamo->estado === 'devuelto')
                            <td>
                                <button class="btn btn-success" disabled>Finalizado</button>
                            </td>
                        @else
                            <form action="{{ route('prestamos.estado', $prestamo->id) }}" method="POST">
                                @csrf
                                <td>
                                    <button type="submit" class="btn btn-outline-dark">Finalizar</button>
                                </td>
                            </form>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="5">No has solicitado ningún préstamo aún.</td></tr>
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
<script>
    function abrirModal(){
        alert('Quiere realizar esta acción?');
    }
</script>    
@endsection
