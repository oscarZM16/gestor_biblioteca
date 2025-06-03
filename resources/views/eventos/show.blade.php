@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row g-4 align-items-start">
        <!-- Imagen a la izquierda -->
        @if($evento->imagen)
            <div class="col-md-5">
                <div class="card shadow mb-3">  {{-- margen abajo para separar de botón --}}
                    <img src="{{ asset('storage/' . $evento->imagen) }}" class="img-fluid rounded" alt="Imagen del evento">
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark mt-3">
                    <i class="bi bi-arrow-left"></i> Volver al Panel Principal
                </a>
            </div>
        @endif
        

        <!-- Información del evento a la derecha -->
        <div class="col-md-7">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h2 class="card-title">{{ $evento->titulo }}</h2>

                    <p class="card-text">
                        <strong>Descripción:</strong><br>
                        {{ $evento->descripcion ?? 'No disponible' }}
                    </p>

                    <p class="card-text">
                        <strong>Ubicación:</strong> {{ $evento->ubicacion ?? 'No disponible' }}
                    </p>

                    <p class="card-text">
                        <strong>Fecha inicio:</strong> {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y H:i') }}
                    </p>

                    <p class="card-text">
                        <strong>Fecha fin:</strong>
                        {{ $evento->fecha_fin ? \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y H:i') : 'No disponible' }}
                    </p>

                    <a href="{{ route('eventos.index') }}" class="btn btn-outline-dark mt-3">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
