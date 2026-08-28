@extends('layouts.app')

@section('title', 'Editar Asistencia')

@section('content')
<h1>Editar Asistencia</h1>

<div class="contenedor">
    <div class="formulario">
        <h2>{{ $asistencia->nombre_docente }} - {{ $asistencia->materia }}</h2>

        <form action="{{ route('asistencia.update', $asistencia->id_asistencia) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="fila">
                <div class="campo">
                    <label>Hora de entrada</label>
                    <input type="time" name="entrada" step="1" value="{{ $asistencia->hora_ingreso }}">
                </div>

                <div class="campo">
                    <label>Hora de salida</label>
                    <input type="time" name="salida" step="1" value="{{ $asistencia->hora_egreso }}">
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="Presente" {{ $asistencia->estado == 'Presente' ? 'selected' : '' }}>Presente</option>
                        <option value="Tarde" {{ $asistencia->estado == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                        <option value="Ausente" {{ $asistencia->estado == 'Ausente' ? 'selected' : '' }}>Ausente</option>
                        <option value="Adelantado" {{ $asistencia->estado == 'Adelantado' ? 'selected' : '' }}>Adelantado</option>
                    </select>
                </div>
            </div>

            <br>
            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection