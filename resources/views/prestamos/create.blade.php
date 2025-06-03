@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="mb-4" >Crear Prestamo</h2>
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige los errores:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    
    @endif
    <form action="{{ route('prestamos.store') }}" method="POST">
        @csrf

        <div class="d-flex justify-content-between">
            <div class="col-md-8">
                <label for="insumo_id" class="form-label">Seleccionar Libro</label>
                <select name="insumo_id" id="insumo_id" class="form-select" required>
                    <option value="">- Selecciona -</option>
                    @foreach($insumos as $insumo)
                        
                        <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="identificacion_s" class="form-label">Cédula del solicitante</label>
            <input type="text" name="identificacion_s" id="identificacion_s" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email_s" class="form-label">Email del solicitante</label>
            <input type="email" name="email_s" id="email_s" class="form-control" required>
        </div>



        <div class="d-flex  justify-content-between">
            <div class="col-md-5">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">Fecha Fin</label>
                <input type="date" name="fecha_fin"class="form-control w-6" required >
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Prestar</button>
            <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Cancelar</a>
            <a href="{{ route('prestamos.index') }}"class="btn btn-secondary">Ver tabla</a>
        </div>
        
    </form>
</div>
@endsection