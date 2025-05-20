@extends('layouts.app')

@section('content')
<div class="container">
    <form method="GET" action="{{ route('insumos.bandeja') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Nombre del Libro</label>
            <input type="text" name="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Buscar por nombre">
        </div>
        <div class="col-md-2">
            <label class="form-label">Clasificación Temática</label>
            <select name="clasificaciones_tematicas_id" class="form-select">
                <option value="">Todas</option>
                @foreach($clasificaciones_tematicas as $clasificacion)
                    <option value="{{ $clasificacion->id }}" {{ request('clasificaciones_tematicas_id') == $clasificacion->id ? 'selected' : '' }}>
                        {{ $clasificacion->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Género Literario</label>
            <select name="generos_literarios_id" class="form-select">
                <option value="">Todos</option>
                @foreach($generos_literarios as $genero)
                    <option value="{{ $genero->id }}" {{ request('generos_literarios_id') == $genero->id ? 'selected' : '' }}>
                        {{ $genero->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Público Objetivo</label>
            <select name="publicos_objetivos_id" class="form-select">
                <option value="">Todos</option>
                @foreach($publicos_objetivos as $publico)
                    <option value="{{ $publico->id }}" {{ request('publicos_objetivos_id') == $publico->id ? 'selected' : '' }}>
                        {{ $publico->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Tipo de Obra</label>
            <select name="tipos_obras_id" class="form-select">
                <option value="">Todos</option>
                @foreach($tipos_obras as $tipo)
                    <option value="{{ $tipo->id }}" {{ request('tipos_obras_id') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('insumos.bandeja') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <h2 class="mb-4"><i class="bi bi-archive"></i> Bandeja de Libros</h2>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">Disponibles</div>
        <div class="card-body">
            @forelse($disponibles as $item)
                <p><i class="bi bi-check-circle"></i> {{ $item->nombre }} - {{ $item->descripcion }} - {{ $item->clasificacionesTematicas->nombre ?? 'No definida' }} - {{ $item->generosLiterarios->nombre ?? 'No definido' }} - {{ $item->publicosObjetivos->nombre ?? 'No definido' }} - {{ $item->tiposDeObras->nombre ?? 'No definido' }}</p>
            @empty
                <p>No hay libros disponibles.</p>
            @endforelse
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-warning">Prestados</div>
        <div class="card-body">
            @forelse($prestados as $item)
                <p><i class="bi bi-exclamation-circle"></i> {{ $item->nombre }} - {{ $item->descripcion }} - {{ $item->clasificacionesTematicas->nombre ?? 'No definida' }} - {{ $item->generosLiterarios->nombre ?? 'No definido' }} - {{ $item->publicosObjetivos->nombre ?? 'No definido' }} - {{ $item->tiposDeObras->nombre ?? 'No definido' }}</p>
            @empty
                <p>No hay libros prestados.</p>
            @endforelse
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
</div>
@endsection
