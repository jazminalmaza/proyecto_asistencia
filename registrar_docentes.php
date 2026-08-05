<?php
include("conexion.php");

if(isset($_POST['guardar'])){

    $id_docente = $_POST['id_docente'];
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $teléfono = $_POST['teléfono'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO docentes
    (id_docente, DNI , nombre, apellido, teléfono, email)
    VALUES
    ( '$id_docente' , '$dni' , '$nombre' , '$apellido' , '$teléfono' , '$email' )";

    if(mysqli_query($conexion, $sql)){
        echo "<p>Docente registrado con éxito.</p>";
    } else {
        echo "<p>Error al guardar: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Docentes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include("navbar.php"); ?>
<h1>Registrar Docente</h1>
<div class="contenedor">


<form method="POST">

    DNI:
    <input type="number" name="dni" required><br><br>

    Nombre:
    <input type="text" name="nombre" required><br><br>

    Apellido:
    <input type="text" name="apellido" required><br><br>

    Teléfono:
    <input type="number" name="telefono" required><br><br>

    Email:
    <input type="email" name="email" required><br><br>

    <button type="submit" name="guardar">Guardar</button><br><br>

</form>
</div>
</body>
</html>