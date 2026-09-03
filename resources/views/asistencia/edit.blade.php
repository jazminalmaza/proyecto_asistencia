@extends('layouts.app')

@section('title', 'Editar Asistencia')

@section('content')
<div class="card-consulta card-editar">
    <div class="header-consulta">
        <div class="icono-box">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <div>
            <h2>Editar Asistencia</h2>
            <p>{{ $asistencia->nombre_docente }} - {{ $asistencia->materia }}</p>
        </div>
    </div>

        <form action="{{ route('asistencia.update', $asistencia->id_asistencia) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="fila">
                <div class="campo">
                    <label for="materia">Materia</label>
                    <input type="text" name="materia" id="materia" list="lista-materias" value="{{ old('materia', $asistencia->materia) }}" required>
                    <datalist id="lista-materias">
                        @if(isset($materias))
                            @foreach($materias as $mat)
                                <option value="{{ $mat->nombre ?? $mat }}">
                            @endforeach
                        @endif
                    </datalist>
                </div>
                
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