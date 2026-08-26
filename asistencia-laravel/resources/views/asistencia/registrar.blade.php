@extends('layouts.app')

@section('title', 'Registrar Asistencia')

@section('content')
<h1>Registrar Asistencia</h1>

<div class="contenedor">
    <div class="formulario">
        @if(session('exito'))
            <div class="alerta exito">
                <h3><i class="fa-solid fa-circle-check"></i> Éxito</h3>
                <p>{{ session('exito') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="alerta error">
                <h3><i class="fa-solid fa-circle-exclamation"></i> Error</h3>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ route('asistencia.marcar') }}" method="POST">
            @csrf
            <label for="codigo_huella">Ingresar Código de Huella:</label>
            <input type="text" name="codigo_huella" id="codigo_huella" autofocus required>
            <button type="submit">Marcar Asistencia</button>
        </form>
    </div>
</div>
@endsection