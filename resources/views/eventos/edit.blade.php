@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="mb-4">Editar Evento</h2>
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
    <form action="{{ route('eventos.update', $evento) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Título -->
            <div class="col-md-6">
                <label for="titulo" class="form-label">Título*</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $evento->titulo) }}" required>
                @error('titulo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Ubicación -->
            <div class="col-md-6">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion', $evento->ubicacion) }}">
                @error('ubicacion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Fecha Inicio -->
            <div class="col-md-6">
                <label for="fecha_inicio" class="form-label">Fecha Inicio*</label>
                <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" class="form-control"
                    value="{{ old('fecha_inicio', \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d\TH:i')) }}" required>
                @error('fecha_inicio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Fecha Fin -->
            <div class="col-md-6">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control"
                    value="{{ old('fecha_fin', $evento->fecha_fin ? \Carbon\Carbon::parse($evento->fecha_fin)->format('Y-m-d\TH:i') : '') }}">
                @error('fecha_fin')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="col-12">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion', $evento->descripcion) }}</textarea>
                @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Imagen -->
            <div class="col-md-6">
                <label for="imagen" class="form-label">Imagen</label>
                @if($evento->imagen)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen del evento" class="img-fluid rounded shadow-sm" style="max-width: 100%;">
                    </div>
                @endif
                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                @error('imagen')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
