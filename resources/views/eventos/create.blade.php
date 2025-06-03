@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="mb-4">Crear Evento</h2>
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>

    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Título -->
            <div class="col-md-6 mb-3">
                <label for="titulo" class="form-label">Título*</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}" required>
                @error('titulo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Ubicación -->
            <div class="col-md-6 mb-3">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
                @error('ubicacion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Fecha Inicio -->
            <div class="col-md-6 mb-3">
                <label for="fecha_inicio" class="form-label">Fecha Inicio*</label>
                <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Fecha Fin -->
            <div class="col-md-6 mb-3">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
                @error('fecha_fin')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Imagen -->
            <div class="col-md-6 mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                @error('imagen')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="col-md-12 mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
