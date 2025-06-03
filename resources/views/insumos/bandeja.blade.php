@extends('layouts.app')

@section('content')
<div class="container">
    <form method="GET" action="{{ route('insumos.bandeja') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre del Libro</label>
                <input type="text" name="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Buscar por nombre">
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
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

            <div class="col-md-4">
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
            <div class="col-md-4">
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
            <div class="col-md-4 d-flex gap-2 align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('insumos.bandeja') }}" class="btn btn-secondary w-100">Limpiar</a>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left"></i> Volver al Panel Principal
            </a>
        </div>
    </form>


    <h2 class="mb-4"><i class="bi bi-archive"></i> Bandeja de Libros</h2>

    <div class="card mb-5 shadow">
        <div class="card-header bg-success text-white d-flex align-items-center">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Libros Disponibles</strong>
        </div>
        <div class="card-body bg-light">
            @forelse($disponibles as $item)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body bg-white rounded-3">
                        <h5 class="card-title text-success">
                            <i class="bi bi-book"></i> {{ $item->nombre }}
                        </h5>
                        <p class="card-text"><strong>Descripción:</strong> {{ $item->descripcion }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Clasificación:</strong> {{ $item->clasificacionesTematicas->nombre ?? 'No definida' }}</p>
                                <p class="mb-1"><strong>Género:</strong> {{ $item->generosLiterarios->nombre ?? 'No definido' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Público Objetivo:</strong> {{ $item->publicosObjetivos->nombre ?? 'No definido' }}</p>
                                <p class="mb-0"><strong>Tipo de Obra:</strong> {{ $item->tiposDeObras->nombre ?? 'No definido' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No hay libros disponibles.</div>
            @endforelse
        </div>
    </div>

    <div class="card mb-5 shadow">
        <div class="card-header bg-warning text-dark d-flex align-items-center">
            <i class="bi bi-exclamation-circle me-2"></i>
            <strong>Libros Prestados</strong>
        </div>
        <div class="card-body bg-light">
            @forelse($prestados as $item)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body bg-white rounded-3">
                        <h5 class="card-title text-warning">
                            <i class="bi bi-book-half"></i> {{ $item->nombre }}
                        </h5>
                        <p class="card-text"><strong>Descripción:</strong> {{ $item->descripcion }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Clasificación:</strong> {{ $item->clasificacionesTematicas->nombre ?? 'No definida' }}</p>
                                <p class="mb-1"><strong>Género:</strong> {{ $item->generosLiterarios->nombre ?? 'No definido' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Público Objetivo:</strong> {{ $item->publicosObjetivos->nombre ?? 'No definido' }}</p>
                                <p class="mb-0"><strong>Tipo de Obra:</strong> {{ $item->tiposDeObras->nombre ?? 'No definido' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary">No hay libros prestados.</div>
            @endforelse
        </div>
    </div>


</div>
@endsection
