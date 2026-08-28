@php
    $route = Route::currentRouteName();
@endphp

<div class="navbar">
    <div class="nav-brand">
        <img src="{{ asset('images/logo_epet.png') }}" alt="Epet N 20" class="nav-logo">
        <div class="nav-title">
            <h2>Epet N° 20</h2>
            <span>Sistema de asistencia</span>
        </div>
    </div>

    <div class="nav-links">
        <a href="{{ route('home') }}" class="{{ $route == 'home' ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Inicio
        </a>
        <a href="{{ route('docentes.create') }}" class="{{ $route == 'docentes.create' ? 'active' : '' }}">
            <i class="fa-solid fa-user-plus"></i> Registrar docente
        </a>
        <a href="{{ route('asistencia.index') }}" class="{{ $route == 'asistencia.index' ? 'active' : '' }}">
            <i class="fa-solid fa-file-circle-plus"></i> Ver asistencias
        </a>
        <a href="{{ route('usuarios.index') }}" class="{{ $route == 'usuarios.index' ? 'active' : '' }}">
            <i class="fa-solid fa-user-shield"></i> Crear cuenta
        </a>
    </div>
</div>