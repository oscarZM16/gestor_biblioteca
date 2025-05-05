<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset("images/fondo.jpeg") }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
        }

        .container {
            background-color: rgb(255, 255, 255);
            padding: 2rem;
            border-radius: 1rem;
        }
    </style>

</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
    <div class="container-fluid">
        @if (auth()->check())
            <div class="d-flex justify-content-between w-100 align-items-center">
                <span class="text-white fw-semibold">Bienvenido, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light ms-3">Cerrar sesión</button>
                </form>
            </div>
        @endif
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- Bootstrap JS opcional -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
