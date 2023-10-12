<!-- 
    Programacion Web
    Seccion: N-1013
    Rafael V. Sanchez A.
    30.393.016

-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Gestion de Archivos</title>
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
        #crearTXT{
            display: table;
            margin: auto;
        }
        #crearCont{
            display: table;
            margin: auto;
        }
        .escoge{
            color: #ffffff;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 16px;   
        }
        #centrarSG{
            display: table;
            margin: auto;
        }
        #centrarG{
            display: table;
            margin: auto;
            
        }
        #LM{
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
        .textos{
            color: white;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            padding-left: 4%;
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

    <div id="contenedor">

            <h1 class="titulos">Gestión de los Archivos/txt</h1>    

        
            
           <div id="crearCont">
                 <form method="POST">
                    <label for="nombre" class="escoge">Crea un archivo de texto</label>
                    <input type="text" name="nombre" placeholder="Escribe el nombre del txt">
                    <br><br>
                    <textarea name="contenido" rows="20" cols="70" placeholder="Escribe el contenido del txt"></textarea>
                    <br><br>

                    <label for="ruta" class="escoge">*Escoge una carpeta donde guardarlo*</label> <br> <br>
                    <div id="centrarSG">
                        <select name="ruta">
                            <?php
                            $carpetas = glob('carpetas/*', GLOB_ONLYDIR);
                            foreach ($carpetas as $carpeta) {
                                $nombre_carpeta = basename($carpeta);
                                echo "<option value='$nombre_carpeta'>Carpeta: '$nombre_carpeta'</option>";
                            }
                            ?>
                        </select>
                        <br><br>
                        <div id="centrarG">
                            <input type="submit" name="guardar" value="Guardar" class="btn">
                        </div>
                    </div>

                </form>
           </div>
<br>
            <div id="LM">
                <p class="escoge">Lee el contenido de un archivo</p>              
                <form method="POST">
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
                    <input type="submit" name="abrir_carpeta" value="Abrir Carpeta">
                </form>

                <ul>
                    <?php
                    $carpeta_seleccionada = isset($_POST['carpeta_seleccionada']) ? $_POST['carpeta_seleccionada'] : '';
                    if (!empty($carpeta_seleccionada)) {
                        $notas = glob("carpetas/$carpeta_seleccionada/*.txt");
                        echo "<h3 class=escoge>Archivos dentro de la carpeta:</h3>";
                        foreach ($notas as $nota) {
                            $nombre_nota = basename($nota, '.txt');
                            echo "<li><a class=escoge style=color:#ff6c6c; href='leer.php?archivo_existente=" . urlencode("$carpeta_seleccionada/$nombre_nota") . "'>$nombre_nota</a></li>";

                        }
                    } else {
                        $notas = glob('archivos/*.txt');
                        foreach ($notas as $nota) {
                            $nombre_nota = basename($nota, '.txt');
                            echo "<li><a class=escoge style=color:#ff6c6c; href='leer.php?archivo_existente=" . urlencode($nombre_nota) . "'>$nombre_nota</a></li>";
                        }
                    }
                    ?>
                </ul>


                <p class="escoge">Modifica el contenido de un archivo</p>
                <form method="POST">
                    <select name="carpeta_seleccionada2">
                        <option value="">Seleccionar carpeta</option>
                        <?php
                        $carpetas = glob('carpetas/*', GLOB_ONLYDIR);
                        foreach ($carpetas as $carpeta) {
                            $nombre_carpeta = basename($carpeta);
                            echo "<option value='$nombre_carpeta'>$nombre_carpeta</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" name="abrir_carpeta" value="Abrir Carpeta">
                </form>

            
                <ul>
                    <?php
                    $carpeta_seleccionada = isset($_POST['carpeta_seleccionada2']) ? $_POST['carpeta_seleccionada2'] : '';
                    if (!empty($carpeta_seleccionada)) {
                        $notas = glob("carpetas/$carpeta_seleccionada/*.txt");
                        echo "<h3 class=escoge>Archivos dentro de la carpeta:</h3>";
                        foreach ($notas as $nota) {
                            $nombre_nota = basename($nota, '.txt');
                            echo "<li><a class=escoge style=color:#ff6c6c; href='modificar.php?archivo_existente=" . urlencode("$carpeta_seleccionada/$nombre_nota") . "'>$nombre_nota</a></li>";

                        }
                    } else {
                        $notas = glob('archivos/*.txt');
                        foreach ($notas as $nota) {
                            $nombre_nota = basename($nota, '.txt');
                            echo "<li><a class=escoge style=color:#ff6c6c; href='modificar.php?archivo_existente=" . urlencode($nombre_nota) . "'>$nombre_nota</a></li>";
                        }
                    }
                    ?>
                </ul>


                <div class="boton">
                    <a href="gestionCarpetas.php"><button class="btn2">Regresar</button></a> 
                    <a href="index.php"><button class="btn2">Volver a inicio</button></a> 
                </div>
            </div>

    </div>

    <br><br><br><br>
    <footer>
            &copy; 2023. Todos los derechos reservados. <br> Maracaibo - Zulia <br> Venezuela.
    </footer>

</body>
</html>


<?php
if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $contenido = $_POST['contenido'];
    $ruta = $_POST['ruta'];

    if ($ruta === 'afuera') {
        $ruta_archivo = "archivos/$nombre.txt";
    } else {
        $ruta_archivo = "carpetas/$ruta/$nombre.txt";
    }
    file_put_contents($ruta_archivo, $contenido);
}
?>

