<!-- 
    Programacion Web
    Seccion: N-1013
    Rafael V. Sanchez A.
    30.393.016

-->

<?php
    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];

        // Verifica si la carpeta ya existe
        if (!file_exists("carpetas/$nombre")) {
            mkdir("carpetas/$nombre", 0777, true);
        } else {
            echo "La carpeta '$nombre' ya existe.";
        }
    }

    if (isset($_POST['borrar'])) {

        $nombre = $_POST['nombre'];

        foreach(glob("carpetas/$nombre" . "/*") as $archivos_carpeta){             
            if (is_dir($archivos_carpeta)){
              rmDir_rf($archivos_carpeta);
            } else {
            unlink($archivos_carpeta);
            }
          }
          rmdir("carpetas/$nombre");
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Carpetas</title>
    <link rel="stylesheet" href="assets/styles.css">


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
            padding-left: 4%;
        }
        .entrada{
            display: table;
            margin: auto;
        }

        .boton{
            display: table;
            margin: auto;
        }

        .btn{
            width: 130px;
            height: 30px;
            color: white;
            background-color: gray;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 100%;
        }
        .btn2{
            width: 150px;
            height: 40px;
            color: black;
            background-color: skyblue;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 86%;
        }
        .escoge{
            color: #ffffff;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 16px;   
        }
    
    </style>

</head>
<body>
    <h1 class="titulos">Gestión de Carpetas</h1>

    <div id="contenedor">

        <form method="POST">
            <label for="nombre" class="textos">Crear una carpeta</label><br><br>
            <div class="entrada">
                <input type="text" name="nombre" placeholder="Escribe el nombre de la carpeta" style="width : 200px; heigth : 20px"><br><br>
                <div class="boton">
                    <input type="submit" name="crear" value="Crear Carpeta" class="btn"><br>
                </div>

            </div>
        </form><br><br>


        <form method="POST">

            <label class="textos">Elimina alguna carpeta</label><br><br>
            
            <div class="entrada">

                <select name="nombre" style="width : 200px; heigth : 20px">
                    <option value="">Eliminar carpeta</option> 
                    <?php
                    $carpetas = glob('carpetas/*', GLOB_ONLYDIR);
                    foreach ($carpetas as $carpeta) {
                        $nombre = basename($carpeta);
                        echo "<option value='$nombre'>$nombre</option>";
                    }
                    ?>
                </select><br><br>
                <div class="boton">
                    <input type="submit" name="borrar" value="Borrar Carpeta" class="btn">

                </div>
            </div>
        </form><br><br>


        <form method="POST">
        <label class="textos">Lee alguna carpeta abajo</label><br><br>
            <select name="carpeta_seleccionada">
                <option value="">Seleccionar carpeta</option>
                <?php
                $carpetas = glob('carpetas/*', GLOB_ONLYDIR);
                foreach ($carpetas as $carpeta) {
                    $nombre_carpeta = basename($carpeta);
                    echo "<option value='$nombre_carpeta'>$nombre_carpeta</option>";
                }
                ?>
            </select>
            <input type="submit" name="abrir_carpeta" value="Abrir Carpeta" class="btn">
        </form>
        
        
            <?php
            $carpeta_seleccionada = isset($_POST['carpeta_seleccionada']) ? $_POST['carpeta_seleccionada'] : '';
            if (!empty($carpeta_seleccionada)) {
                $notas = glob("carpetas/$carpeta_seleccionada/*.txt");
                echo "<h3 class=escoge>Archivos dentro de la carpeta:</h3>";
                foreach ($notas as $nota) {
                    $nombre_nota = basename($nota, '.txt');
                    echo "<a class=escoge style=color:#ff6c6c; href='leer.php?archivo_existente=" . urlencode("$carpeta_seleccionada/$nombre_nota") . "'>$nombre_nota</a><br>";

                }
            } else {
                $notas = glob('archivos/*.txt');
                foreach ($notas as $nota) {
                    $nombre_nota = basename($nota, '.txt');
                    echo "<a class=escoge style=color:#ff6c6c; href='leer.php?archivo_existente=" . urlencode($nombre_nota) . "'>$nombre_nota</a> <br>";
                }
            }
            ?>
        
        <br><br>
        
        <div class="boton">
            <a href="index.php" ><button class="btn2">Volver a inicio</button></a>
            <a href="gestionArchivos.php"><button class="btn2">Gestionar Archivos</button></a> 
        </div>

    </div>

            <br><br><br><br>
    <footer>
            &copy; 2023. Todos los derechos reservados. <br> Maracaibo - Zulia <br> Venezuela.
    </footer>

</body>
</html>
