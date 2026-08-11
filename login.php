<?php
session_start();
include("conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT * FROM prosecretario 
            WHERE usuario = '$usuario' 
            AND contraseña = '$contraseña'";

    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 1) {

        $datos = mysqli_fetch_assoc($resultado);

        $_SESSION["id_prosecretario"] = $datos["id_prosecretario"];
        $_SESSION["usuario"] = $datos["usuario"];
        $_SESSION["nombre"] = $datos["nombre"];
        $_SESSION["apellido"] = $datos["apellido"];

        header("Location: index.php");
        exit();

    } else {

        $error = "Usuario o contraseña incorrectos.";

    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">

<div class="container">

    <img src="logo_epet.png" alt="Logo EPET N°20" class="logo">

    <div class="heading">Sistema de Control de Asistencia</div>

   <form class="form" action="" method="POST">

   <input placeholder="Usuario" id="usuario" name="usuario" type="text"class="input" required>
   <input placeholder="Contraseña"id="contraseña"name="contraseña"type="password"class="input"required>
   
    <input value="Iniciar Sesión" type="submit" class="login-button"/>

</form>

</div>

</body>
</html>