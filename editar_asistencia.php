<?php
include("conexion.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ver_asistencia.php");
    exit;
}

$id = intval($_GET['id']);

if (isset($_POST['guardar'])) {
    $entrada = !empty($_POST['entrada']) ? "'" . mysqli_real_escape_string($conexion, $_POST['entrada']) . "'" : "NULL";
    $salida = !empty($_POST['salida']) ? "'" . mysqli_real_escape_string($conexion, $_POST['salida']) . "'" : "NULL";
    $estado = mysqli_real_escape_string($conexion, $_POST['estado']);

    $sql_update = "UPDATE asistencia
                   SET hora_ingreso = $entrada, 
                       hora_egreso = $salida, 
                       estado = '$estado'
                   WHERE id_asistencia = $id";

    mysqli_query($conexion, $sql_update);

    header("Location: ver_asistencia.php");
    exit;
}

$sql = "SELECT * FROM asistencia WHERE id_asistencia = $id";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($resultado);

if (!$fila) {
    header("Location: ver_asistencia.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Asistencia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include("navbar.php"); ?>
<h1>Editar Asistencia</h1>

<div class="contenedor">
    <div class="formulario">
        <h2><?php echo htmlspecialchars($fila['nombre_docente']); ?> - <?php echo htmlspecialchars($fila['materia']); ?></h2>

        <form method="POST">
            <div class="fila">
                <div class="campo">
                    <label>Hora de entrada</label>
                    <input type="time" name="entrada" value="<?php echo $fila['hora_ingreso']; ?>">
                </div>

                <div class="campo">
                    <label>Hora de salida</label>
                    <input type="time" name="salida" value="<?php echo $fila['hora_egreso']; ?>">
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="Presente" <?php if ($fila['estado'] == "Presente") echo "selected"; ?>>Presente</option>
                        <option value="Tarde" <?php if ($fila['estado'] == "Tarde") echo "selected"; ?>>Tarde</option>
                        <option value="Ausente" <?php if ($fila['estado'] == "Ausente") echo "selected"; ?>>Ausente</option>
                        <option value="Adelantado" <?php if ($fila['estado'] == "Adelantado") echo "selected"; ?>>Adelantado</option>
                    </select>
                </div>
            </div>

            <br>
            <button type="submit" name="guardar">Guardar cambios</button>
        </form>
    </div>
</div>

</body>
</html>