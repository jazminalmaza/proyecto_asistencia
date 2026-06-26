<?php

$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "sistema_huellas"
);

if(!$conexion){
    die("Error de conexión");
}

?>