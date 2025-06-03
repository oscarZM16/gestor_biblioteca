@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Gestión de Solicitudes de Préstamo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Solicitante</th>
                    <th>Libro</th>
                    <th>Estado</th>
                    <th>Rango Fechas</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamos as $p)
                    <tr>
                        <td>{{ $p->user->name ?? 'Usuario no disponible' }}</td>
                        <td>{{ $p->insumo->nombre }}</td>
                        <td><strong>{{ ucfirst($p->estado) }}</strong></td>
                        <td>{{ $p->fecha_inicio }} <i class="bi bi-arrow-right"></i>{{ $p->fecha_fin }}</td>
                        <td>
                            @if($p->estado === 'pendiente')
                                @if($p->insumo->cantidad_disponible > 0)
                                    <form action="{{ route('prestamos.estado', $p->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <input type="hidden" name="estado" value="aprobado">
                                        <button class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i> Aprobar
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="bi bi-x-circle"></i> Sin stock
                                    </button>
                                @endif

                                <form action="{{ route('prestamos.estado', $p->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="estado" value="rechazado">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Rechazar
                                    </button>
                                </form>

                            @elseif($p->estado === 'rechazado')
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <i class="bi bi-x-circle"></i> Préstamo rechazado
                                </button>

                            @elseif($p->estado === 'finalizado')
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <i class="bi bi-check-lg"></i> Finalizado
                                </button>

                            @else
                                <form action="{{ route('prestamos.estado', $p->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="estado" value="finalizado">
                                    <button class="btn btn-secondary btn-sm">
                                        <i class="bi bi-flag"></i> Finalizar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
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
