@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 30px auto; font-family: Arial, sans-serif;">

    @if(session('success'))
        <div style="background-color: #d1e7dd; color: #0f5132; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tarjeta Formulario -->
    <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h2 style="color: #0d47a1; margin-top: 0; margin-bottom: 20px;">Crear Cuenta de Usuario</h2>

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label style="font-weight: bold; color: #0d47a1; display: block; margin-bottom: 5px;">Tipo de Rol *</label>
                    <select name="rol" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">Seleccionar Rol...</option>
                        <option value="prosecretario" {{ old('rol') == 'prosecretario' ? 'selected' : '' }}>Prosecretario</option>
                        <option value="jefe_preceptores" {{ old('rol') == 'jefe_preceptores' ? 'selected' : '' }}>Jefe de preceptores</option>
                    </select>
                    @error('rol') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label style="font-weight: bold; color: #0d47a1; display: block; margin-bottom: 5px;">Usuario *</label>
                    <input type="text" name="usuario" value="{{ old('usuario') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('usuario') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label style="font-weight: bold; color: #0d47a1; display: block; margin-bottom: 5px;">Contraseña *</label>
                    <input type="password" name="password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('password') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label style="font-weight: bold; color: #0d47a1; display: block; margin-bottom: 5px;">DNI *</label>
                    <input type="text" name="dni" value="{{ old('dni') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('dni') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div style="grid-column: span 2;">
                    <label style="font-weight: bold; color: #0d47a1; display: block; margin-bottom: 5px;">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('email') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="text-align: right; margin-top: 20px;">
                <button type="submit" style="background-color: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 15px;">
                    Crear cuenta
                </button>
            </div>
        </form>
    </div>

    <!-- Tarjeta Tabla -->
    <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h3 style="color: #0d47a1; margin-top: 0; margin-bottom: 15px;">Usuarios Registrados</h3>

        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f0f4f8; border-bottom: 2px solid #ccc;">
                    <th style="padding: 10px;">Rol</th>
                    <th style="padding: 10px;">Usuario</th>
                    <th style="padding: 10px;">DNI</th>
                    <th style="padding: 10px;">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $user)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;"><strong>{{ $user->rol }}</strong></td>
                        <td style="padding: 10px;">{{ $user->usuario }}</td>
                        <td style="padding: 10px;">{{ $user->dni }}</td>
                        <td style="padding: 10px;">{{ $user->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 15px; text-align: center; color: #666;">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection