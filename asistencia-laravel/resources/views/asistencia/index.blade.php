@extends('layouts.app')

@section('title', 'Ver Asistencias')

@section('content')
<h1>Listado de Asistencias</h1>

<form method="GET" action="{{ route('asistencia.index') }}" class="buscar-fecha">
    Fecha:
    <input type="date" name="fecha" value="{{ request('fecha') }}">
    <button type="submit">Buscar</button>
</form>

<br>
<div class="leyenda">
    <span class="presente">● Presente</span>
    <span class="tarde">● Tarde</span>
    <span class="ausente">● Ausente</span>
    <span class="adelantado">● Adelantado</span>
</div>

<br>
<table>
    <tr>
        <th>Fecha</th>
        <th>Docente</th>
        <th>Materia</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Estado</th>
        <th>Acción</th>
    </tr>
    @foreach($asistencias as $fila)
    <tr>
        <td>{{ \Carbon\Carbon::parse($fila->fecha)->format('d/m/Y') }}</td>
        <td>{{ $fila->nombre_docente }}</td>
        <td>{{ $fila->materia }}</td>
        <td>{{ $fila->hora_ingreso ?? '-' }}</td>
        <td>{{ $fila->hora_egreso ?? '-' }}</td>
        <td>
            @if($fila->estado == 'Presente')
                <span class="presente">Presente</span>
            @elseif($fila->estado == 'Tarde')
                <span class="tarde">Tarde</span>
            @elseif($fila->estado == 'Ausente')
                <span class="ausente">Ausente</span>
            @elseif($fila->estado == 'Adelantado')
                <span class="adelantado">Adelantado</span>
            @endif
        </td>
        <td>
            <a href="{{ route('asistencia.edit', ['id' => $fila->id_asistencia]) }}" class="btn-editar">
                <i class="fa-solid fa-pen"></i> Editar
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection