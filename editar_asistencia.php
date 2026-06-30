<?php
include("conexion.php");

$id = $_GET['id'];

if(isset($_POST['guardar'])){

    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];
    $estado = $_POST['estado'];

    mysqli_query(
        $conexion,
        "UPDATE asistencias
        SET
        entrada='$entrada',
        salida='$salida',
        estado='$estado'
        WHERE id='$id'"
    );

<<<<<<< HEAD
   header("Location: ver_asistencia.php");
exit;
=======
    echo "<h3>Asistencia actualizada</h3>";
>>>>>>> 9f117a7 (primer commit jijijija)
}

$sql = "
SELECT
a.*,
d.nombre,
d.apellido
FROM asistencias a
INNER JOIN docente d
ON a.docente_id=d.id
WHERE a.id='$id'
";

$resultado = mysqli_query($conexion,$sql);

$fila = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Asistencia</title>
</head>
<body>

<h1>Editar Asistencia</h1>

<p>

<?php
echo $fila['nombre']." ".$fila['apellido'];
?>

</p>

<form method="POST">

    Entrada:

    <input
        type="time"
        name="entrada"
        value="<?php echo $fila['entrada']; ?>"
    >

    <br><br>

    Salida:

    <input
        type="time"
        name="salida"
        value="<?php echo $fila['salida']; ?>"
    >

    <br><br>

    Estado:

    <select name="estado">

        <option
        <?php if($fila['estado']=="Presente") echo "selected"; ?>
        >
        Presente
        </option>

        <option
        <?php if($fila['estado']=="Tarde") echo "selected"; ?>
        >
        Tarde
        </option>

        <option
        <?php if($fila['estado']=="Ausente") echo "selected"; ?>
        >
        Ausente
        </option>

        <option
        <?php if($fila['estado']=="Adelantado") echo "selected"; ?>
        >
        Adelantado
        </option>

    </select>

    <br><br>

    <button
        type="submit"
        name="guardar"
    >
        Guardar
    </button>

</form>

</body>
</html>