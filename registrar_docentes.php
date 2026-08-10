<?php
session_start();
include("conexion.php");

$mensaje = "";

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
}

if(isset($_POST['guardar'])){

    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $id_huella = !empty($_POST['id_huella']) ? $_POST['id_huella'] : "NULL";
    
    $sql = "INSERT INTO docentes (DNI, nombre, apellido, teléfono, email, id_huella) 
                VALUES ('$dni', '$nombre', '$apellido', '$telefono', '$email', $id_huella)";
    
    if(mysqli_query($conexion, $sql)){

        $id_docente_creado = mysqli_insert_id($conexion);

            if(isset($_POST['materia']) && is_array($_POST['materia'])){
                for($i = 0; $i < count($_POST['materia']); $i++){

                    $nom_materia = $_POST['materia'][$i];
                    $turno = $_POST['turno'][$i];
                    $curso = $_POST['curso'][$i];
                    $division = $_POST['division'][$i];
                    $curso_completo = $curso . " " . $division;
                    $entrada = $_POST['entrada'][$i];
                    $salida = $_POST['salida'][$i];

                    if(!empty($nom_materia)){
                        $sql_materia = "INSERT INTO materia (nombre, turno, curso, horario_inicio, horario_finalizacion) 
                                        VALUES ('$nom_materia', '$turno', '$curso_completo', '$entrada', '$salida')";

                        if(mysqli_query($conexion, $sql_materia)){
                            $id_materia_creada = mysqli_insert_id($conexion);

                            $sql_relacion = "INSERT INTO docentes_materias (id_docente, id_materia) 
                                            VALUES ('$id_docente_creado', '$id_materia_creada')";
                            mysqli_query($conexion, $sql_relacion);
                        }
                    }
                }
            }

            $_SESSION['mensaje'] = "<div class='alerta exito'><i class='fa-solid fa-circle-check'></i> Docente y horarios registrados con éxito.</div>";
    } else {
        $_SESSION['mensaje'] = "<div class='alerta error'><i class='fa-solid fa-circle-exclamation'></i> Error al guardar docente: " . mysqli_error($conexion) . "</div>";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Docentes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include("navbar.php"); ?>
<h1>Registrar Docente</h1>
<div class="contenedor">

<div class="formulario">

    <?php echo $mensaje; ?>

    <form method="POST">

        <div class="fila">

            <div class="campo">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="campo">
                <label>Apellido</label>
                <input type="text" name="apellido" required>
            </div>

        </div>

        <div class="fila">

            <div class="campo">
                <label>DNI</label>
                <input type="text" name="dni" required>
            </div>

            <div class="campo">
                <label>Teléfono</label>
                <input type="text" name="telefono" required>
            </div>

        </div>

        <div class="fila">

            <div class="campo">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="campo">
                <label>Código de huella</label>
                <input type="number" name="id_huella" required>
            </div>

        </div>
        <h2>Horarios</h2>

        <div id="contenedor-horarios">
            <div class="bloque-horario">

                <div class="header-bloque">
                    <span class="titulo-bloque">Horario</span>
                    <button type="button" class="btn-eliminar" onclick="eliminarHorario(this)">
                        <i class="fa-solid fa-trash"></i> Eliminar
                    </button>
                </div>

                <div class="fila">

                    <div class="campo">
                        <label>Materia</label>
                        <input type="text" name="materia[]" required>
                    </div>

                    <div class="campo">
                        <label>Turno</label>
                        <select name="turno[]" required>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Vespertino">Vespertino</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Curso</label>
                        <select name="curso[]" required>
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
                        <select name="division[]" required>
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
                        <input type="time" name="entrada[]" required>
                    </div>

                    <div class="campo">
                        <label>Salida</label>
                        <input type="time" name="salida[]" required>
                    </div>

                </div>
            </div>
        </div>

        <br>
        <button type="button" id="btn-agregar">+ Agregar horario</button>

        <br><br>

        <button type="submit" name="guardar"> Guardar docente </button>

    </form>
</div>
</div>

<script>
const alerta = document.querySelector('.alerta');

        if (alerta) {
            setTimeout(() => {
                alerta.style.transition = 'opacity 0.5s ease';
                alerta.style.opacity = '0';
                
                setTimeout(() => {
                    alerta.remove();
                }, 500);
            }, 4000);
        }

document.getElementById('btn-agregar').addEventListener('click', function() {
    var contenedor = document.getElementById('contenedor-horarios');
    var primerBloque = document.querySelector('.bloque-horario');
    
    var nuevoBloque = primerBloque.cloneNode(true);
    
    var inputs = nuevoBloque.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.value = '';
    });
    
    contenedor.appendChild(nuevoBloque);
});

function eliminarHorario(boton) {
    var bloque = boton.closest('.bloque-horario');
    var totalBloques = document.querySelectorAll('.bloque-horario').length;
    if (totalBloques > 1) {
        bloque.remove();
    }
}

</script>

</body>
</html>