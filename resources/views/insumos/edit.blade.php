@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Libro</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige los siguientes errores:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('insumos.update', $insumo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $insumo->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $insumo->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="clasificaciones_tematicas_id" class="form-label">Clasificacion Tematica</label>
            <select name="clasificaciones_tematicas_id" id="clasificaciones_tematicas_id" class="form-select" required>
                <option value="">-Selecciona-</option>
                @foreach($clasificaciones_tematicas as $clasificacion_tematica)
                    <option value="{{ $clasificacion_tematica->id }}" 
                    {{ $insumo->clasificaciones_tematicas_id == $clasificacion_tematica->id ? 'selected' : '' }}>
                    {{ $clasificacion_tematica->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="generos_literarios_id" class="form-label">Genero Literario</label>
            <select name="generos_literarios_id" id="generos_literarios_id" class="form-select" required>
                <option value="">-Selecciona-</option>
                @foreach($generos_literarios as $genero_literario)
                    <option value="{{ $genero_literario->id }}" 
                        {{ $insumo->generos_literarios_id == $genero_literario->id ? 'selected' : '' }}>
                        {{ $genero_literario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="publicos_objetivos_id" class="form-label">Publico Objetivo</label>
            <select name="publicos_objetivos_id" id="publicos_objetivos_id" class="form-select" required>
                <option value="">-Selecciona-</option>
                @foreach($publicos_objetivos as $publico_objetivo)
                    <option value="{{ $publico_objetivo->id }}" 
                        {{ $insumo->publicos_objetivos_id == $publico_objetivo->id ? 'selected' : '' }}>
                        {{ $publico_objetivo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipos_obras_id" class="form-label">Tipo de Obra</label>
            <select name="tipos_obras_id" id="tipos_obras_id" class="form-select" required>
                <option value="">-Selecciona-</option>
                @foreach($tipos_obras as $tipo_obra)
                    <option value="{{ $tipo_obra->id }}" 
                        {{ $insumo->tipos_obras_id == $tipo_obra->id ? 'selected' : '' }}>
                        {{ $tipo_obra->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $insumo->cantidad }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="disponible" {{ $insumo->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="prestado" {{ $insumo->estado == 'prestado' ? 'selected' : '' }}>Prestado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('insumos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
</div>
@endsection