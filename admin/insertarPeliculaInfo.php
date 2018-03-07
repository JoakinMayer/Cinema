<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:index.php?mensaje=iniciarSesion");
} else {
    $fechaAhora = date("Y-n-d H:i:s");
    $tiempoTrancurrido = strtotime($fechaAhora) - strtotime($_SESSION['fechaGuardada']);
    if ($tiempoTrancurrido > 300) {
        $_SESSION = array();
        session_destroy();
        header("location:index.php?mensaje=tiempoAgotado");
    } else {
        $_SESSION['fechaGuardada'] = $fechaAhora;
        include "../conexion.php";

//GENEROS
        $queryGeneros = "SELECT * FROM genero ORDER BY genero";
        $resultGenero = mysqli_query($link, $queryGeneros);

        $generos = array();

        while ($rowGenero = mysqli_fetch_array($resultGenero)) {
            array_push($generos, $rowGenero['genero']);
        }
        $cantidadGeneros = count($generos);

//CLASIFICACION
        $queryClasificacion = "SELECT * FROM clasificacion";
        $resultClasificacion = mysqli_query($link, $queryClasificacion);
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Administracion - Peliculas en Cartel</title>

        <!--Iconos-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Archivos CSS-->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>



    </head>
    <body class="insertarInformacion">
        <header>
            <nav class="navbar">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="peliculasCartel.php">Cine<strong>Montevideo</strong> - <span>Sistema de Administración</span></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="peliculasCartel.php">Películas en cartel</a></li>
                            <li><a href="archivo.php">Archivo</a></li>
                            <li><a href="portada.php">Portada</a></li>
                            <li><a href="cerrarSesion.php" class="sinHover"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <h1 class="tituloInsMod">Insertar Película</h1>
        <div class="container-fluid informacion">
            <div class="row bloqueInImHo">
                <div class="col-xs-4">
                    <h2 class="text-center ">Información</h2>
                </div>
                <div class="col-xs-4">
                    <h3 class="text-center ">Imágenes</h3>
                </div>
                <div class="col-xs-4">
                    <h3 class="text-center ">Horarios</h3>
                </div>
            </div>
        </div>

        <div class="container">
            <form class="form-horizontal" action="insertarInformacion.php" method="get">
                <!--TITULO-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="titulo">Titulo:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="titulo" placeholder="Ingrese el titulo en español de la película" name="titulo" required>
                    </div>
                </div>
                <!--TITULO ORIGINAL-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="tituloOriginal">Titulo Original:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tituloOriginal" placeholder="Ingrese el titulo original de la película" name="tituloOriginal" required>
                    </div>
                </div>
                <!--AÑO-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="ano">Año:</label>
                    <div class="col-sm-4">
                        <input type="number" min="0" max="9999" class="form-control" id="ano" placeholder="Ingrese el año" name="ano" required>
                    </div>
                </div>
                <!--CLASIFICACION-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="clasificacion">Clasificación:</label>
                    <div class="col-sm-8">
                        <select class="form-control "name="clasificacion" required>
                            <?php
                            while ($rowClasificacion = mysqli_fetch_array($resultClasificacion)) {
                                echo "<option value='$rowClasificacion[categoria]'>$rowClasificacion[categoria] - $rowClasificacion[descripcion]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!--GENERO-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="genero">Género:</label>
                    <div class="col-sm-8">
                        <div class="col-sm-6">
                            <select class="form-control " id="genero1" name="genero1" required>
                                <?php
                                for ($i = 0; $i <= $cantidadGeneros - 1; $i++) {
                                    echo "<option value='$generos[$i]'>$generos[$i]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" id="genero2" name="genero2">
                                <option value=""></option>
                                <?php
                                for ($i = 0; $i <= $cantidadGeneros - 1; $i++) {
                                    echo "<option value='$generos[$i]'>$generos[$i]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!--PUNTUACIÓN-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="puntuacion">Puntuación Imdb:</label>
                    <div class="col-sm-8">
                        <input type="number" min="0" max="10" step="0.1" class="form-control" id="puntuacion" placeholder="Ingrese la puntuación de Imdb" name="puntuacion" required>
                    </div>
                </div>
                <!--IDIOMA-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="idioma">Idioma:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="idioma" placeholder="Ingrese el idioma de la película. Separe con ; si son varios" name="idioma" required>
                    </div>
                </div>
                <!--DURACIÓN-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="duracion">Duración (min):</label>
                    <div class="col-sm-4">
                        <input type="number" min="0" max="999" class="form-control" id="duracion" placeholder="Ingrese la duración" name="duracion" required>
                    </div>
                </div>
                <!--PAIS-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pais">País:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="pais" placeholder="Ingrese el pais de la pelicula. Separe con ; si son varios" name="pais" required>
                    </div>
                </div>
                <!--SINOPSIS-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sinopsis">Sinopsis:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="5" id="sinopsis" name="sinopsis" placeholder="Ingrese la sinopsis de la película"></textarea>
                    </div>
                </div>
                <!--DIRECCIÓN-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="direccion">Dirección:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="direccion" placeholder="Ingrese la dirección de la película. Separe con ; si son varios" name="direccion" required>
                    </div>
                </div>
                <!--ELENCO-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="elenco">Elenco:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="elenco" placeholder="Ingrese el elenco de la película. Separe con ; si son varios" name="elenco" required>
                    </div>
                </div>
                <!--SITIO OFICIAL-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sitioOficial">Sitio Oficial:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sitioOficial" placeholder="Ingrese el link del sitio oficial de la película" name="sitioOficial" required>
                    </div>
                </div>
                <!--SITIO IMDB-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sitioImdbl">Sitio Imdb:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sitioImdb" placeholder="Ingrese el link del sitio Imdb de la película" name="sitioImdb" required>
                    </div>
                </div>
                <!--TRÁILER-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="trailer">Tráiler:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="trailer" placeholder="Ingrese el link del tráiler de la película" name="trailer" required>
                    </div>
                </div>
                <!--FECHA DE ESTRENO-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="fechaEstreno">Fecha de estreno:</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="fechaEstreno" placeholder="Ingrese la fecha de estreno" name="fechaEstreno" required>
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-7 ">
                        <input type="submit" class="btn btn-info" name="guardar" value="Guardar">
                        <input type="submit" class="btn btn-info" name="imagenes" value="Imágenes >">
                    </div>
                </div>
            </form>
        </div>

        <!--Archivos JavaScript-->
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
