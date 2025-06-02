@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Panel de multas</h2>

    <form action="{{ route('filtrar.prestamos') }}" method="post">
        @csrf
        <div class="d-flex justify-content-start align-items-end p-2">
            <div class="me-2">
                <label class="form-label">Fecha inicio</label>
                <input type="date" name="fecha_inicio" class="form-control"> 
            </div>
            <div class="me-2">
                <label class="form-label">Fecha fin</label>
                <input type="date" name="fecha_fin" class="form-control">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>


    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Libro</th>
                    <th>Usuario</th>
                    <th>Multa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamos as $prestamo)
                    @if ($prestamo->multa > 0)
                    
                    <tr>
                        <td>{{ $prestamo->insumo->nombre }}</td>
                        <td>{{ $prestamo->email_solicitante }}</td>
                        <td>{{ $prestamo->multa }}</td>
                        
                    </tr>
                    @endif

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
<script>
    function abrirModal(){
        alert('Quiere realizar esta acción?');
    }
</script>    
@endsection
