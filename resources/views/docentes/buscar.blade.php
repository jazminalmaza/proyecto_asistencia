@extends('layouts.app')

@section('title', 'Buscar Docente para Editar')

@section('content')
<div class="card-consulta card-editar">
    <div class="header-consulta">
        <div class="icono-box">
            <i class="fa-solid fa-user-pen"></i>
        </div>
        <div>
            <h2>Gestión de Docentes</h2>
            <p>Busque un docente por nombre, apellido o DNI para modificar sus datos u horarios.</p>
        </div>
    </div>

    @if(session('exito'))
        <div class="alerta exito" style="margin-bottom: 20px;">
            <i class="fa-solid fa-circle-check"></i> {{ session('exito') }}
        </div>
    @endif

    <form action="{{ route('docentes.buscar') }}" method="GET" class="form-busqueda" style="margin-bottom: 25px;">
        <div class="fila" style="align-items: flex-end;">
            <div class="campo" style="flex: 1;">
                <label for="buscar">Buscar docente</label>
                <input type="text" name="buscar" id="buscar" placeholder="Ingrese nombre, apellido o DNI..." value="{{ request('buscar') }}">
            </div>
            <div class="campo" style="flex: 0 0 auto;">
                <button type="submit" class="btn-buscar">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                </button>
            </div>
        </div>
    </form>

    <div class="tabla-contenedor">
        <table class="tabla-asistencias" style="width: 100%;">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Apellido y Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th style="text-align: center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($docentes as $docente)
                    <tr>
                        <td>{{ $docente->DNI }}</td>
                        <td>{{ $docente->apellido }}, {{ $docente->nombre }}</td>
                        <td>{{ $docente->email }}</td>
                        <td>{{ $docente->telefono }}</td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                                <!-- Botón Editar -->
                                <a href="{{ route('docentes.edit', $docente->id_docente ?? $docente->id) }}" class="btn-editar">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>

                                <!-- Botón Desactivar Docente -->
                                <form action="{{ route('docentes.desactivar', $docente->id_docente ?? $docente->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            onclick="return confirm('¿Está seguro de que desea desactivar a este docente?')" 
                                            style="background-color: #ffffff; color: #e6a100; border: 1.5px solid #e6a100; padding: 6px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px;">
                                        Desactivar docente
                                    </button>
                                </form>

                                <!-- Botón Borrar Docente (Tachito de basura) -->
                                <form action="{{ route('docentes.destroy', $docente->id_docente ?? $docente->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('¿Está seguro de que desea eliminar a este docente de forma permanente?')" 
                                            title="Eliminar docente"
                                            style="background-color: #dc3545; color: white; border: none; padding: 8px 10px; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            No se encontraron docentes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection