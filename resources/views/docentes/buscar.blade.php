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
                    @php
                        $idDocente = $docente->id_docente ?? $docente->id;
                        $esInactivo = isset($docente->activo) && !$docente->activo;
                    @endphp
                    <!-- Usamos una CLASE en lugar de ID para afectar a todas las filas repetidas de este docente -->
                    <tr class="fila-docente-{{ $idDocente }}" style="{{ $esInactivo ? 'background-color: #f2f2f2; opacity: 0.6;' : '' }}">
                        <td>{{ $docente->DNI }}</td>
                        <td>{{ $docente->apellido }}, {{ $docente->nombre }}</td>
                        <td>{{ $docente->email }}</td>
                        <td>{{ $docente->telefono }}</td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                                <!-- Botón Editar -->
                                <a href="{{ route('docentes.edit', $idDocente) }}" class="btn-editar">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>

                                <!-- Botón Desactivar Docente -->
                                <button type="button" 
                                        onclick="desactivarDocente({{ $idDocente }})" 
                                        style="background-color: #ffffff; color: #e6a100; border: 1.5px solid #e6a100; padding: 6px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px;">
                                    Desactivar docente
                                </button>

                                <!-- Botón Borrar Docente (Tachito de basura) -->
                                <button type="button" 
                                        onclick="borrarDocente({{ $idDocente }})" 
                                        title="Eliminar docente"
                                        style="background-color: #dc3545; color: white; border: none; padding: 8px 10px; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
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

<script>
    // Función para desactivar (pone en gris TODAS las filas de este docente)
    function desactivarDocente(id) {
        if (!confirm('¿Está seguro de que desea desactivar a este docente?')) return;

        fetch(`/docentes/${id}/desactivar`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                // Selecciona todas las filas que tengan esta clase
                const filas = document.querySelectorAll(`.fila-docente-${id}`);
                filas.forEach(fila => {
                    fila.style.transition = 'all 0.4s ease';
                    fila.style.backgroundColor = '#f2f2f2';
                    fila.style.opacity = '0.6';
                });
            } else {
                alert('No se pudo desactivar el docente.');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Función para eliminar (borra TODas las filas de este docente)
    function borrarDocente(id) {
        if (!confirm('¿Está seguro de que desea eliminar a este docente de forma permanente?')) return;

        fetch(`/docentes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                const filas = document.querySelectorAll(`.fila-docente-${id}`);
                filas.forEach(fila => {
                    fila.style.transition = 'all 0.4s ease';
                    fila.style.opacity = '0';
                    setTimeout(() => fila.remove(), 400);
                });
            } else {
                alert('No se pudo eliminar el docente.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection