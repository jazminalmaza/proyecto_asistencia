<?php
include("conexion.php");

if(isset($_POST['guardar'])){

    $legajo = $_POST['legajo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cargo = $_POST['cargo'];
    $materia = $_POST['materia'];
    $id_huella = $_POST['id_huella'];
    $turno_id = $_POST['turno_id'];

    $sql = "INSERT INTO docente
    (legajo,nombre,apellido,cargo,materia,id_huella,turno_id)
    VALUES
    ('$legajo','$nombre','$apellido','$cargo','$materia','$id_huella','$turno_id')";

    mysqli_query($conexion,$sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Docentes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Registrar Docente</h1>

<form method="POST">

    Legajo:
    <input type="text" name="legajo"><br><br>

    Nombre:
    <input type="text" name="nombre"><br><br>

    Apellido:
    <input type="text" name="apellido"><br><br>

    Cargo:
    <input type="text" name="cargo"><br><br>

    Materia:
    <input type="text" name="materia"><br><br>

    ID Huella:
    <input type="number" name="id_huella"><br><br>

    Turno:
    <select name="turno_id">
        <option value="1">Mañana</option>
        <option value="2">Tarde</option>
        <option value="3">Noche</option>
    </select>

    <br><br>

    <button type="submit" name="guardar">
        Guardar
    </button>

</form>

</body>
</html>