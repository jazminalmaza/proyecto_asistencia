@extends('layouts.app')

@section('title', 'Crear Cuenta')

@section('content')
<h1>Crear Cuenta de Usuario</h1>

<div class="contenedor">
    <div class="formulario">
        
        @if(session('success'))
            <div class="alerta exito"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            
            <div class="fila">
                <div class="campo">
                    <label>Tipo de Rol *</label>
                    <select name="rol" required>
                        <option value="">Seleccionar Rol...</option>
                        <option value="prosecretario" {{ old('rol') == 'prosecretario' ? 'selected' : '' }}>Prosecretario</option>
                        <option value="jefe_preceptores" {{ old('rol') == 'jefe_preceptores' ? 'selected' : '' }}>Jefe de preceptores</option>
                    </select>
                    @error('rol') <span class="error-texto" style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div class="campo">
                    <label>Usuario *</label>
                    <input type="text" name="usuario" value="{{ old('usuario') }}" placeholder="Nombre de usuario" required>
                    @error('usuario') <span class="error-texto" style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div class="campo">
                    <label>Contraseña *</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                    @error('password') <span class="error-texto" style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <br>
            <button type="submit">Crear cuenta</button>
        </form>

        <br><hr><br>

        <h2>Usuarios Registrados</h2>

        <div class="tabla-contenedor">
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                    <tr style="background-color: #e3f2fd; color: #0d47a1; text-align: left;">
                        <th style="padding: 12px; border-radius: 8px 0 0 8px;">Rol</th>
                        <th style="padding: 12px; border-radius: 0 8px 8px 0;">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $user)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px; font-weight: bold; color: #1565c0;">{{ $user->rol }}</td>
                            <td style="padding: 12px;">{{ $user->usuario }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="padding: 15px; text-align: center; color: #666;">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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
</script>
@endsection