@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="mb-4">Crear Usuario</h2>
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Errores en el formulario!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Nombre</label>
                <input name="name" type="text" class="form-control" placeholder="Nombre completo" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input name="apellidos" type="text" class="form-control" placeholder="Apellidos completos" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Correo electrónico</label>
                <input name="email" type="email" class="form-control" placeholder="usuario@correo.com" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Contraseña</label>
                <input name="password" type="password" class="form-control" placeholder="Contraseña segura" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="">Seleccione un rol</option>
                    <option value="administrador">Administrador</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="funcionario">Funcionario</option>
                </select>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Crear usuario</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
