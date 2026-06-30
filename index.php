<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Asistencia</title>
    <link rel="stylesheet" href="style/style.css">
    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            text-align: center;
        }

        h1{
            margin-top: 50px;
        }

        .menu{
            margin-top: 40px;
        }

        a{
            display: block;
            width: 250px;
            margin: 15px auto;
            padding: 15px;
            background: #0077cc;
            color: white;
            text-decoration: none;
            border-radius: 10px;
        }

        a:hover{
            background: #005fa3;
        }
    </style>
</head>
<body>

    <h1>Sistema de Control de Asistencia</h1>

    <div class="menu">

        <a href="registrar_docentes.php">
            Registrar Docente
        </a>

        <a href="registrar_asistencia.php">
            Registrar Asistencia
        </a>

        <a href="ver_asistencia.php">
            Ver Asistencias
        </a>


    </div>

</body>
</html>