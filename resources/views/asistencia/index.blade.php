@extends('layouts.app')

@section('content')
<div class="card-consulta">
    <div class="header-consulta">
        <div class="icono-box">
            <i class="fa-solid fa-clipboard-list"></i>
        </div>
        <div>
            <h2>Consulta de Asistencias</h2>
            <p>Visualice el listado de asistencias registradas.</p>
        </div>
    </div>

    <form method="GET" action="{{ route('asistencia.index') }}" class="filtros-box">
        <div class="campo-filtro">
            <label>Fecha</label>
            <input type="date" name="fecha" value="{{ request('fecha') }}">
        </div>

        <div class="campo-filtro">
            <label>Buscar docente</label>
            <input type="text" name="docente" placeholder="Ingrese nombre o apellido" value="{{ request('docente') }}">
        </div>

        <button type="submit" class="btn-buscar">
            <i class="fa-solid fa-magnifying-glass"></i> Buscar
        </button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Docente</th>
                <th>Materia</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Estado</th>
                @if(auth()->user()->rol === 'jefe_de_preceptores')
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $fila)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($fila->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $fila->nombre_docente }}</td>
                    <td>{{ $fila->materia }}</td>
                    <td>{{ $fila->hora_ingreso ?? '-' }}</td>
                    <td>{{ $fila->hora_egreso ?? '-' }}</td>
                    <td>
                        <span class="badge-estado {{ strtolower($fila->estado) }}">
                            {{ $fila->estado }}
                        </span>
                    </td>
                    <td>
                        {{-- El botón Editar solo aparece si el rol es jefe_preceptores --}}
                        @if(Auth::check() && Auth::user()->rol === 'jefe_preceptores')
                        <a href="{{ route('asistencia.edit', ['id' => $fila->id_asistencia]) }}" class="btn-editar">
                            <i class="fa-solid fa-pen"></i> Editar
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection