@extends('layouts.app')

@section('title', 'Registrar Asistencia')

@section('content')
<div class="card-consulta card-asistencia">
    @if(session('exito'))
        <div class="alerta exito">
            <i class="fa-solid fa-circle-check"></i> {{ session('exito') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alerta error">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <div class="header-consulta">
        <div class="icono-box">
            <i class="fa-solid fa-fingerprint"></i>
        </div>
        <div>
            <h2>Registrar Asistencia</h2>
            <p>Escanee o ingrese el código de huella del docente</p>
        </div>
    </div>

    <form action="{{ route('asistencia.marcar') }}" method="POST">
        @csrf
        
        <div class="campo-asistencia">
            <label for="codigo_huella">Código de huella</label>
            <input 
                type="text" 
                name="codigo_huella" 
                id="codigo_huella" 
                placeholder="Ingrese el código" 
                autofocus 
                required
            >
        </div>

        <div class="acciones-asistencia">
            <button type="submit" class="btn-buscar btn-asistencia">
                <i class="fa-solid fa-circle-check"></i> Marcar Asistencia
            </button>
        </div>
    </form>
</div>
@endsection