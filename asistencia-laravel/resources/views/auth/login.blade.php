<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">

<div class="container">

    <img src="{{ asset('images/logo_epet.png') }}" alt="Logo EPET N°20" class="logo">

    <div class="heading">Sistema de Control de Asistencia</div>

    @if ($errors->has('error'))
        <p style="color: red; text-align: center;">{{ $errors->first('error') }}</p>
    @endif

   <form class="form" action="{{ route('login') }}" method="POST" autocomplete="off">
    @csrf

    <input placeholder="Usuario" id="usuario" name="login_username" type="text" class="input" value="{{ old('login_username') }}" required autofocus autocomplete="off">
    
    <!-- Input de contraseña camuflado como texto para bloquear a Chrome -->
    <input placeholder="Contraseña" id="contraseña" name="login_password" type="text" class="input" required autocomplete="off" onfocus="this.type='password'">

    <input value="Iniciar Sesión" type="submit" class="login-button"/>
</form>

</div>

</body>
</html>