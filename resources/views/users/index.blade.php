@extends('layouts.app')

@section('content')
<style>
    #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background: #000000;
        padding: 20px;
        transform: translateX(-260px);
        transition: transform 0.3s ease;
        z-index: 1000;
        color: white;
        overflow-y: auto;
    }

    #sidebar.active {
        transform: translateX(0);
    }

    #sidebarToggle {
        position: fixed;
        top: 50px;
        left: 20px;
        z-index: 1100;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        background-color: #000000;
        color: white;
        font-size: 24px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background 0.3s ease;
    }

    #sidebarToggle:hover {
        background-color: #495057;
    }

    #mainContent {
        margin-left: 0;
        transition: margin-left 0.3s ease;
    }

    #mainContent.active {
        margin-left: 260px;
    }

    .sidebar-section h6 {
        margin-top: 1.2rem;
        font-weight: bold;
        color: #00f2ff;
    }

    .sidebar-section a {
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        color: #ddd;
    }

    .sidebar-section a:hover {
        color: #00f2ff;
    }

    .sidebar-section a.disabled {
        pointer-events: none;
        color: #6c757d;
    }

    .text-neon {
        color: #00f2ff;
        font-family: 'Orbitron', sans-serif;
        letter-spacing: 0.5px;
    }

    #sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
    background: #000000;
    padding: 20px;
    transform: translateX(-260px);
    transition: transform 0.3s ease;
    z-index: 1000;
    color: white;
    overflow-y: scroll; /* permite desplazamiento */
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* IE y Edge */ 
    }

    #sidebar::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Edge */
    }

</style>

<button id="sidebarToggle">
    <span>&#9776;</span>
</button>

<div id="sidebar">
    <div style="height: 60px;"></div>

    <div class="sidebar-section">
        <h6><i class="bi bi-bookshelf me-2"></i> Administración de Libros</h6>
        @if(in_array(auth()->user()->rol, ['administrador']))
            <a href="{{ url('/insumos/create') }}"><i class="bi bi-journal-plus me-2"></i> Crear Libro</a>
            <a href="{{ route('insumos.bandeja') }}"><i class="bi bi-book-half me-2"></i> Bandeja de Libros</a>
            <a href="{{ route('insumos.index') }}"><i class="bi bi-journals me-2"></i> Ver Todos los Libros</a>
        @else
            <a href="{{ route('insumos.bandeja') }}"><i class="bi bi-book-half me-2"></i> Bandeja de Libros</a>
            <a class="disabled"><i class="bi bi-lock me-2"></i> Crear Libros</a>
            <a class="disabled"><i class="bi bi-lock me-2"></i> Ver Todos los Libros</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6><i class="bi bi-journal-arrow-down me-2"></i> Solicitudes de Préstamo</h6>
        <a href="{{ url('/prestamos/create') }}"><i class="bi bi-bookmark-plus me-2"></i> Crear Préstamo</a>
        <a href="{{ url('/prestamos') }}"><i class="bi bi-inboxes me-2"></i> Nuevas Solicitudes</a>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ url('/admin/prestamos') }}"><i class="bi bi-check2-square me-2"></i> Aprobación</a>
        @else
            <a class="disabled"><i class="bi bi-lock me-2"></i> Aprobación</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6><i class="bi bi-person-lines-fill me-2"></i> Administración de Usuarios</h6>
        @if(in_array(auth()->user()->rol, ['administrador']))
            <a href="{{ route('users.create') }}"><i class="bi bi-person-plus me-2"></i> Crear Usuario</a>
            <a href="#" onclick="toggleUsuarios()"><i class="bi bi-people-fill me-2"></i> Mostrar/Ocultar Usuarios</a>
        @else
            <a class="disabled"><i class="bi bi-lock me-2"></i> Crear Usuario</a>
            <a class="disabled"><i class="bi bi-lock me-2"></i> Lista de Usuarios</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6><i class="bi bi-clipboard-data me-2"></i> Generación de Reportes</h6>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ route('reportes.insumos') }}"><i class="bi bi-book me-2"></i> Reporte de Libros</a>
            <a href="{{ route('reportes.prestamos') }}"><i class="bi bi-journal-check me-2"></i> Reporte de Préstamos</a>
            <a href="{{ route('reportes.disponibles') }}"><i class="bi bi-bookmark-check me-2"></i> Libros Disponibles</a>
        @else
            <a class="disabled"><i class="bi bi-lock me-2"></i> Acceso a Reportes</a>
        @endif
    </div>
</div>



<div id="mainContent">
    <div class="text-center mb-5">
        <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
            <i class="bi bi-book fs-1 text-primary"></i>
            <h1 class="fw-bold text-primary m-0">Biblioteca municipal Jorge Eliecer Gaitán</h1>
        </div>
        <h4 class="text-secondary"><i class="bi bi-journal-text me-2"></i>Panel de Administración</h4>
    </div>

    <hr class="mb-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div id="tablaUsuarios" style="display: none;">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellidos</th> 
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->apellidos ?? '-' }}</td> 
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-secondary text-capitalize">{{ $user->rol }}</span>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if(auth()->user()->rol !== 'funcionario')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-square me-1"></i>Editar</a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash3 me-1"></i>Eliminar</button>
                                    </form>
                                @else
                                    <span class="text-muted">Sin acciones</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('mainContent').classList.toggle('active');
    });

    function toggleUsuarios() {
        var tabla = document.getElementById("tablaUsuarios");
        tabla.style.display = tabla.style.display === "none" ? "block" : "none";
    }
</script>
@endsection

