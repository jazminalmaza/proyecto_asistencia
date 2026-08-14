<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include("conexion.php");

$mensaje = "";

if(isset($_POST['registrar'])){

   $id_huella = intval($_POST['id_huella']);

    $sql_docente = "SELECT * FROM docentes WHERE id_huella = $id_huella";
    $res_docente = mysqli_query($conexion, $sql_docente);

    if(mysqli_num_rows($res_docente) > 0){

        $docente = mysqli_fetch_assoc($res_docente);
        $id_docente = isset($docente['id_docente']) ? $docente['id_docente'] : (isset($docente['id']) ? $docente['id'] : 0);
        $nombre_completo = $docente['nombre'] . " " . $docente['apellido'];

        $fecha = date("Y-m-d");
        $hora_actual = date("H:i:s");

       $nombre_materia = "Sin Materia";
       $hora_inicio = "08:00:00";

        if ($id_docente > 0) {
            $sql_materia = "SELECT m.* FROM materia m
                            INNER JOIN docentes_materias dm ON m.id_materia = dm.id_materia
                            WHERE dm.id_docente = $id_docente
                            LIMIT 1";
            $res_materia = mysqli_query($conexion, $sql_materia);

            if ($res_materia && $row_materia = mysqli_fetch_assoc($res_materia)) {
                $nombre_materia = $row_materia['nombre'];
                $hora_inicio = $row_materia['horario_inicio'];
            }
        }

        $timestamp_actual = strtotime($hora_actual);
        $timestamp_inicio = strtotime($hora_inicio);
        $diferencia_minutos = ($timestamp_actual - $timestamp_inicio) / 60;

        if ($diferencia_minutos < -15) {
            $estado = "Adelantado";
        } elseif ($diferencia_minutos <= 10) {
            $estado = "Presente";
        } else {
            $estado = "Tarde";
        }

        $sql_asistencia = "SELECT * FROM asistencia 
                   WHERE nombre_docente = '$nombre_completo' AND fecha = '$fecha'";
        $res_asistencia = mysqli_query($conexion, $sql_asistencia);

        if (mysqli_num_rows($res_asistencia) == 0) {
            
            // REGISTRAR ENTRADA
           $sql_insert = "INSERT INTO asistencia (fecha, nombre_docente, materia, hora_ingreso, estado) 
               VALUES ('$fecha', '$nombre_completo', '$nombre_materia', '$hora_actual', '$estado')";
            
            if (mysqli_query($conexion, $sql_insert)) {
                $mensaje = "<div class='alerta exito'>
                                <h3><i class='fa-solid fa-circle-check'></i> Entrada registrada</h3>
                                <p><strong>Docente:</strong> $nombre_completo</p>
                                <p><strong>Materia:</strong> $nombre_materia</p>
                                <p><strong>Hora:</strong> $hora_actual</p>
                                <p><strong>Estado:</strong> $estado</p>
                            </div>";
            }

        } else {

            $asistencia = mysqli_fetch_assoc($res_asistencia);

            if (empty($asistencia['hora_egreso']) || $asistencia['hora_egreso'] == "00:00:00") {
                
                // REGISTRAR SALIDA
                $id_asistencia = $asistencia['id_asistencia'];
                $sql_update = "UPDATE asistencia 
                               SET hora_egreso = '$hora_actual' 
                               WHERE id_asistencia = $id_asistencia";

                if (mysqli_query($conexion, $sql_update)) {
                    $mensaje = "<div class='alerta exito'>
                                    <h3><i class='fa-solid fa-circle-check'></i> Salida registrada</h3>
                                    <p><strong>Docente:</strong> $nombre_completo</p>
                                    <p><strong>Hora de salida:</strong> $hora_actual</p>
                                </div>";
                }

            } else {
                $mensaje = "<div class='alerta error'>
                                <h3><i class='fa-solid fa-circle-exclamation'></i> Aviso</h3>
                                <p>El docente $nombre_completo ya registró entrada y salida el día de hoy.</p>
                            </div>";
            }
        }

    } else {
        $mensaje = "<div class='alerta error'>
                        <h3><i class='fa-solid fa-circle-exclamation'></i> Error</h3>
                        <p>Código de huella no encontrado.</p>
                    </div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Asistencia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include("navbar.php"); ?>
<h1>Registrar Asistencia</h1>

<div class="contenedor">
    <div class="formulario">
        
        <?php echo $mensaje; ?>

        <form method="POST">
            <div class="campo">
                <label>Ingrese Código de Huella</label>
                <input type="number" name="id_huella" autofocus required>
            </div>

            <br>
            <button type="submit" name="registrar">Registrar Marcar</button>
        </form>
    </div>
</div>

</body>
</html>