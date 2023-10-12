<!-- 
    Programacion Web
    Seccion: N-1013
    Rafael V. Sanchez A.
    30.393.016

-->

<?php
if (isset($_GET['archivo_existente'])) {
    $nombre_archivo_original = urldecode($_GET['archivo_existente']);
    $ruta_archivo_original = "archivos/$nombre_archivo_original.txt";

    if (strpos($nombre_archivo_original, '/') !== false) {
        $ruta_archivo_original = "carpetas/$nombre_archivo_original.txt";
    }

    if (file_exists($ruta_archivo_original)) {
        $contenido = file_get_contents($ruta_archivo_original);
    } else {
        $contenido = "El archivo no existe.";
    }
} else {
    $nombre_archivo_original = '';
    $contenido = '';
}

if (isset($_POST['guardar_cambios'])) {
    $nombre_archivo_original = $_POST['nombre_archivo_original'];
    $nombre_archivo_nuevo = $_POST['nombre_archivo_nuevo'];

    $ruta_archivo_original = "archivos/$nombre_archivo_original.txt";
    $ruta_archivo_nuevo = "archivos/$nombre_archivo_nuevo.txt";

    if (strpos($nombre_archivo_original, '/') !== false) {
        $ruta_archivo_original = "carpetas/$nombre_archivo_original.txt";
        $ruta_archivo_nuevo = "carpetas/$nombre_archivo_nuevo.txt";
    }

    if (file_exists($ruta_archivo_original)) {
        rename($ruta_archivo_original, $ruta_archivo_nuevo);
    }

    file_put_contents($ruta_archivo_nuevo, $_POST['contenido']);

    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Leer Nota</title>
    <style>
        .titulos{
            color: #ffffff;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 35px;
            text-align: center;
            margin-top: 8%;
        }
        #contenedor{
            display: table;
            margin: auto;
        }

        .textos{
            color: white;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
        }
        .boton{
            display: table;
            margin: auto;
        }
        .btn2{
            width: 150px;
            height: 40px;
            color: black;
            background-color: skyblue;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 86%;
        }
    </style>
</head>
<body>
    <h1 class="titulos">Leer contenido del archivo/txt</h1><br>

    <div id="contenedor">
        <form method="POST">
            <input type="hidden" name="nombre_archivo_original" value="<?php echo htmlspecialchars($nombre_archivo_original); ?>" disabled>

            <label for="nombre_archivo" class="textos">Nombre del archivo:</label>
            <input type="text" name="nombre_archivo_nuevo" value="<?php echo htmlspecialchars($nombre_archivo_original); ?>" disabled>
            <br><br>

            <label for="contenido " class="textos">Contenido:</label> <br>
            <br>
            <textarea name="contenido" rows="20" cols="70" disabled><?php echo htmlspecialchars($contenido); ?></textarea>
            <br>

        </form>
<br><br>
        <div class="boton">
            <a href="gestionCarpetas.php"><button class="btn2">Volver a Carpetas</button></a>
            <a href="gestionArchivos.php"><button class="btn2">Volver a Archivos</button></a>
        </div>


    </div>

    <br><br><br><br>
    <footer>
            &copy; 2023. Todos los derechos reservados. <br> Maracaibo - Zulia <br> Venezuela.
    </footer>
</body>
</html>

