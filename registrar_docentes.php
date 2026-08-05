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


<div class="formulario">

<<<<<<< HEAD
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
=======
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
>>>>>>> 7e1591432d9252be3518b2f45b060c80dcdbee0a

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