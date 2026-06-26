<?php

include("conexion.php");

if(isset($_FILES['archivo'])){

    $archivo = fopen(
        $_FILES['archivo']['tmp_name'],
        "r"
    );

    $asistencias = [];

    fgetcsv($archivo,1000,";");

    while(($datos = fgetcsv($archivo,1000,";")) !== FALSE){
      
        $numero = $datos[0];
        $nombre = $datos[1];
        $tiempo = $datos[2];
        $estado = strtolower($datos[3]);

        $partes = explode(" ", $tiempo);
        $partes = explode(" ", $tiempo);

        if(count($partes) > 1){
         $hora = $partes[1];
        }else{
        $hora = "";
}

        $buscar_docente = mysqli_query(
            $conexion,
            "SELECT * FROM docente
            WHERE id_huella='$numero'"
        );

        $materia = "";

        if(mysqli_num_rows($buscar_docente) > 0){

            $docente = mysqli_fetch_assoc(
                $buscar_docente
            );

            $materia = $docente['materia'];

        }

        if(!isset($asistencias[$numero])){

            $asistencias[$numero] = [
                'nombre' => $nombre,
                'materia' => $materia,
                'entrada' => '',
                'salida' => ''
            ];

        }

        if($estado == "entrada"){

            $asistencias[$numero]['entrada'] = $hora;

        }

        if($estado == "salida"){

            $asistencias[$numero]['salida'] = $hora;

        }

    }

    fclose($archivo);

    echo "<table>";
    
    echo "
    <tr>
        <th>Número</th>
        <th>Nombre</th>
        <th>Materia</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Estado</th>
    </tr>
    ";

    foreach($asistencias as $numero => $dato){
        $buscar_docente = mysqli_query(
    $conexion,
    "SELECT * FROM docente
    WHERE id_huella='$numero'"
);

$estado_final = "Presente";

if(mysqli_num_rows($buscar_docente) > 0){

    $docente = mysqli_fetch_assoc($buscar_docente);

    $turno_id = $docente['turno_id'];

    $consulta_turno = mysqli_query(
        $conexion,
        "SELECT * FROM turnos
        WHERE id='$turno_id'"
    );

    $turno = mysqli_fetch_assoc($consulta_turno);

    $hora_tolerancia = $turno['hora_tolerancia'];

    if($dato['entrada'] > $hora_tolerancia){
        $estado_final = "Tarde";
    }
}
        echo "<tr>";

        echo "<td>".$numero."</td>";

        echo "<td>".$dato['nombre']."</td>";

        echo "<td>".$dato['materia']."</td>";

        echo "<td>".$dato['entrada']."</td>";

        echo "<td>".$dato['salida']."</td>";

        echo "<td>".$estado_final."</td>";

        echo "</tr>";

    }

    echo "</table>";

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Control de Asistencia</title>

    <style>
       body{
    font-family: Arial, sans-serif;
    text-align:center;
    background-color:#f4f6f9;
}

h1{
    margin-top:20px;
    color:#333;
}

form{
    margin-top:30px;
    margin-bottom:30px;
}

table{
    width:90%;
    margin:auto;
    border-collapse:collapse;
    background:white;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

th{
    background: #4fbee2;;
    color:white;
    padding:12px;
    border:1px solid #dee2e6;
}

td{
    padding:10px;
    border:1px solid #dee2e6;
}

tr:hover{
    background:#f2f2f2;
}

button{
    background:#0d6efd;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#0b5ed7;
}

input[type=file]{
    padding:8px;
}
    </style>

</head>
<body>

<h1>Control de Asistencia</h1>

<form method="POST" enctype="multipart/form-data">

    <label>
        Seleccionar archivo:
    </label>

    <br><br>

    <input type="file" name="archivo" required>

    <br><br>

    <button type="submit">
        Procesar Archivo
    </button>

</form>

</body>
</html>