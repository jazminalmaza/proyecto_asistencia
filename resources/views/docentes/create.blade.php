@extends('layouts.app')

@section('title', 'Registrar Docente')

@section('content')

<div class="contenedor">
    <div class="formulario">
        <div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
            <div style="background-color: #e8f0fe; color: #0d47a1; width: 60px; height: 60px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0; margin-right: 1rem;">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <div>
                <h2 style="color: #1138a6; font-weight: 800; font-family: 'Segoe UI', sans-serif; margin: 0; font-size: 1.8rem;">Consulta de Asistencias</h2>
                <p style="color: #6c757d; margin: 0; font-size: 0.95rem;">Visualice el listado de asistencias registradas.</p>
            </div>
        </div>

        @if(session('exito'))
            <div class="alerta exito"><i class="fa-solid fa-circle-check"></i> {{ session('exito') }}</div>
        @endif

        <form action="{{ route('docentes.store') }}" method="POST">
            @csrf
            <div class="fila">
                <div class="campo">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="campo">
                    <label>Apellido</label>
                    <input type="text" name="apellido" required>
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label>DNI</label>
                    <input type="text" name="DNI" required>
                </div>
                <div class="campo">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" required>
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="campo">
                    <label>Código de huella</label>
                    <input type="number" name="id_huella" required>
                </div>
            </div>

            <h2>Horarios</h2>
            <div id="contenedor-horarios">
                <div class="bloque-horario">
                    <div class="header-bloque">
                        <span class="titulo-bloque">Horario</span>
                        <button type="button" class="btn-eliminar" onclick="eliminarHorario(this)">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </button>
                    </div>

                    <div class="fila">
                        <div class="campo">
                            <label>Materia</label>
                            <input type="text" name="materia[]" required>
                        </div>
                        <div class="campo">
                            <label>Turno</label>
                            <select name="turno[]" required>
                                <option value="Mañana">Mañana</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Vespertino">Vespertino</option>
                            </select>
                        </div>
                        <div class="campo">
                            <label>Curso</label>
                            <select name="curso[]" required>
                                <option>1°</option><option>2°</option><option>3°</option>
                                <option>4°</option><option>5°</option><option>6°</option>
                            </select>
                        </div>
                        <div class="campo">
                            <label>División</label>
                            <select name="division[]" required>
                                <option>1°</option><option>2°</option><option>3°</option>
                                <option>4°</option><option>5°</option><option>6°</option>
                            </select>
                        </div>
                    </div>

                    <div class="fila">
                        <div class="campo">
                            <label>Entrada</label>
                            <input type="time" name="entrada[]" required>
                        </div>
                        <div class="campo">
                            <label>Salida</label>
                            <input type="time" name="salida[]" required>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <button type="button" id="btn-agregar">+ Agregar horario</button>
            <br><br>
            <button type="submit">Guardar docente</button>
        </form>
    </div>
</div>

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
        var contenedor = document.getElementById('contenedor-horarios');
        var primerBloque = document.querySelector('.bloque-horario');
        var nuevoBloque = primerBloque.cloneNode(true);
        nuevoBloque.querySelectorAll('input').forEach(input => input.value = '');
        contenedor.appendChild(nuevoBloque);
    });

    function eliminarHorario(boton) {
        var bloque = boton.closest('.bloque-horario');
        if (document.querySelectorAll('.bloque-horario').length > 1) {
            bloque.remove();
        }
    }
</script>
@endsection