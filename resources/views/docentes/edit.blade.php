@extends('layouts.app')

@section('title', 'Editar Docente')

@section('content')
<div class="contenedor">
    <div class="formulario">
        <div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
            <div style="background-color: #e8f0fe; color: #0d47a1; width: 60px; height: 60px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0; margin-right: 1rem;">
                <i class="fa-solid fa-user-pen"></i>
            </div>
            <div>
                <h2 style="color: #1138a6; font-weight: 800; font-family: 'Segoe UI', sans-serif; margin: 0; font-size: 1.8rem;">Editar Docente</h2>
                <p style="color: #6c757d; margin: 0; font-size: 0.95rem;">Modifique los datos o los horarios cargados para el docente.</p>
            </div>
        </div>

        @if(session('exito'))
            <div class="alerta exito"><i class="fa-solid fa-circle-check"></i> {{ session('exito') }}</div>
        @endif

        <form action="{{ route('docentes.update', $docente->id_docente ?? $docente->id) }}" method="POST" id="form-editar-docente">
            @csrf
            @method('PUT')

            <div class="fila">
                <div class="campo">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $docente->nombre) }}" required>
                </div>
                <div class="campo">
                    <label>Apellido</label>
                    <input type="text" name="apellido" value="{{ old('apellido', $docente->apellido) }}" required>
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label>DNI</label>
                    <input type="text" name="DNI" value="{{ old('DNI', $docente->DNI) }}" required>
                </div>
                <div class="campo">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $docente->telefono) }}" required>
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $docente->email) }}" required>
                </div>
                <div class="campo">
                    <label>Código de huella</label>
                    <input type="number" name="id_huella" value="{{ old('id_huella', $docente->id_huella) }}" required>
                </div>
            </div>

            <h2 style="margin-top: 2rem;">Horarios</h2>

            <div id="contenedor-horarios">
                @foreach($materias as $index => $materia)
                    <div class="bloque-horario" style="border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; margin-bottom: 15px; background-color: #f8fafc;">
                        <input type="hidden" name="materia_id[]" value="{{ $materia->id_materias }}">
                        
                        <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
                            <button type="button" onclick="eliminarMateriaBD({{ $materia->id_materias }}, this)" style="background-color: #dc3545; color: #fff; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                <i class="fa-solid fa-trash"></i> Eliminar horario
                            </button>
                        </div>

                        <div class="fila">
                            <div class="campo">
                                <label>Materia</label>
                                <input type="text" name="materia[]" value="{{ $materia->nombre }}" required>
                            </div>
                            <div class="campo">
                                <label>Turno</label>
                                <select name="turno[]" required>
                                    <option value="Mañana" {{ $materia->turno == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                                    <option value="Tarde" {{ $materia->turno == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                    <option value="Vespertino" {{ $materia->turno == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                                </select>
                            </div>
                            <div class="campo">
                                <label>Curso</label>
                                <select name="curso[]" required>
                                    @foreach(['1°','2°','3°','4°','5°','6°'] as $curso)
                                        <option value="{{ $curso }}" {{ $materia->curso == $curso ? 'selected' : '' }}>{{ $curso }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="campo">
                                <label>División</label>
                                <select name="division[]" required>
                                    @foreach(['1°','2°','3°','4°','5°','6°'] as $division)
                                        <option value="{{ $division }}" {{ $materia->division == $division ? 'selected' : '' }}>{{ $division }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fila">
                            <div class="campo">
                                <label>Entrada</label>
                                <input type="time" name="entrada[]" value="{{ $materia->horario_inicio }}" required>
                            </div>
                            <div class="campo">
                                <label>Salida</label>
                                <input type="time" name="salida[]" value="{{ $materia->horario_finalizacion }}" required>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <br>
            <button type="button" id="btn-agregar">+ Agregar horario</button>
        </form>

        <!-- BOTONES DE ACCIÓN PRINCIPALES AL FINAL -->
        <div style="display: flex; gap: 10px; align-items: center; margin-top: 1.5rem; flex-wrap: wrap;">
            <!-- Guardar Cambios -->
            <button type="submit" form="form-editar-docente" style="background-color: #1138a6; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                Guardar cambios
            </button>

            <!-- Desactivar Docente (Amarillo) -->
            <form action="{{ route('docentes.desactivar', $docente->id_docente ?? $docente->id) }}" method="POST" style="margin: 0;">
                @csrf
                @method('PATCH')
                <button type="submit" onclick="return confirm('¿Está seguro de que desea desactivar a este docente?')" style="background-color: #ffc107; color: #000; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
    Desactivar docente
</button>
            </form>

            <!-- Borrar Docente (Rojo) -->
            <form action="{{ route('docentes.destroy', $docente->id_docente ?? $docente->id) }}" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Está seguro de que desea eliminar a este docente de forma permanente?')" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    Borrar docente
                </button>
            </form>
        </div>
    </div>
</div>

<template id="plantilla-nuevo-horario">
    <div class="bloque-horario" style="border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; margin-bottom: 15px; background-color: #f8fafc;">
        <input type="hidden" name="materia_id[]" value="">
        <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
            <button type="button" onclick="this.closest('.bloque-horario').remove()" style="background-color: #dc3545; color: #fff; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                <i class="fa-solid fa-trash"></i> Eliminar horario
            </button>
        </div>
        <div class="fila">
            <div class="campo">
                <label>Materia</label>
                <input type="text" name="materia[]" required form="form-editar-docente">
            </div>
            <div class="campo">
                <label>Turno</label>
                <select name="turno[]" required form="form-editar-docente">
                    <option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
            </div>
            <div class="campo">
                <label>Curso</label>
                <select name="curso[]" required form="form-editar-docente">
                    <option>1°</option><option>2°</option><option>3°</option>
                    <option>4°</option><option>5°</option><option>6°</option>
                </select>
            </div>
            <div class="campo">
                <label>División</label>
                <select name="division[]" required form="form-editar-docente">
                    <option>1°</option><option>2°</option><option>3°</option>
                    <option>4°</option><option>5°</option><option>6°</option>
                </select>
            </div>
        </div>
        <div class="fila">
            <div class="campo">
                <label>Entrada</label>
                <input type="time" name="entrada[]" required form="form-editar-docente">
            </div>
            <div class="campo">
                <label>Salida</label>
                <input type="time" name="salida[]" required form="form-editar-docente">
            </div>
        </div>
    </div>
</template>

<script>
    const alerta = document.querySelector('.alerta');
    if (alerta) {
        setTimeout(() => {
            alerta.style.transition = 'opacity 0.5s ease';
            alerta.style.opacity = '0';
            setTimeout(() => alerta.remove(), 500);
        }, 4000);
    }

    document.getElementById('btn-agregar').addEventListener('click', function() {
        var plantilla = document.getElementById('plantilla-nuevo-horario').content.cloneNode(true);
        document.getElementById('contenedor-horarios').appendChild(plantilla);
    });

    function eliminarMateriaBD(id, boton) {
        fetch(`/horarios/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                boton.closest('.bloque-horario').remove();
            }
        });
    }
</script>
@endsection