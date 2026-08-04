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
<?php include("navbar.php"); ?>
<h1>Registrar Docente</h1>
<div class="contenedor">


<div class="formulario">

    <form method="POST">

        <div class="fila">

            <div class="campo">
                <label>Nombre</label>
                <input type="text" name="nombre">
            </div>

            <div class="campo">
                <label>Apellido</label>
                <input type="text" name="apellido">
            </div>

        </div>

        <div class="fila">

            <div class="campo">
                <label>DNI</label>
                <input type="text" name="dni">
            </div>

            <div class="campo">
                <label>Teléfono</label>
                <input type="text" name="telefono">
            </div>

        </div>

        <div class="fila">

            <div class="campo">
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div class="campo">
                <label>Código de huella</label>
                <input type="number" name="id_huella">
            </div>

        </div>
        <h2>Horarios</h2>

<div class="fila">

    <div class="campo">
        <label>Materia</label>
        <input type="text" name="materia[]">
    </div>

    <div class="campo">
        <label>Curso</label>
        <select name="curso[]">
            <option>1°</option>
            <option>2°</option>
            <option>3°</option>
            <option>4°</option>
            <option>5°</option>
            <option>6°</option>
        </select>
    </div>

    <div class="campo">
        <label>División</label>
        <select name="division[]">
            <option>1°</option>
            <option>2°</option>
            <option>3°</option>
            <option>4°</option>
            <option>5°</option>
            <option>6°</option>
        </select>
    </div>

</div>

<div class="fila">

    <div class="campo">
        <label>Entrada</label>
        <input type="time" name="entrada[]">
    </div>

    <div class="campo">
        <label>Salida</label>
        <input type="time" name="salida[]">
    </div>

</div>

<button type="button">+ Agregar horario</button>

<br><br>

<button type="submit" name="guardar">
    Guardar docente
</button>


    </form>

</div>
</form>
</div>
</body>
</html>