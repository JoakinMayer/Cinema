<?php
include './conexion.php';

$buscar = $_GET['q'];
$query = "SELECT *  FROM pelicula WHERE titulo LIKE '%$buscar%' OR tituloOriginal LIKE '%$buscar%' OR ano LIKE '%$buscar%' OR pais LIKE '%$buscar%' OR direccion LIKE '%$buscar%' OR elenco LIKE '%$buscar%' OR genero LIKE '%$buscar%' OR idioma LIKE '%$buscar%'";
$result = mysqli_query($link, $query);

$queryHorarios = "SELECT DISTINCT idPelicula  FROM horarios WHERE complejo LIKE '%$buscar%' OR tecnologia LIKE '%$buscar%'";
$resultHorarios = mysqli_query($link, $queryHorarios);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CineMontevideo - Busqueda</title>

        <!--Archivos CSS-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="buscar" class="publico">

        <header>
            <nav class="navbar navbar-fixed-top">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">Cine<strong>Montevideo</strong></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="catalogo.php">Cátalogo</a></li>
                            <li><a href="complejos.php">Complejos</a></li>
                            <li><a href="referencias.php">Referencias</a></li>
                            <li><a href="contacto.php">Contacto</a></li>
                            <li><form class="navbar-form navbar-right" action="buscar.php" role="search"><input type="text"  placeholder="Buscador" name="q"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></form></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>


        <!--PELICULAS-->
        <div class="container firstDiv">
            <p>Resultados de: "<?php echo $buscar ?>"</p>
            <div class="row" id="peliculas">

                <?php
                while ($peliculas = mysqli_fetch_array($result)) {
                    $idPelicula = $peliculas['id'];

                    echo '<div class=" col-xs-12 col-sm-6 col-md-3" onclick="pelicula(' . "'" . $idPelicula . "'" . ')">';


                    $queryPoster = "SELECT * FROM imagenes WHERE idPelicula = $idPelicula";
                    $resultPoster = mysqli_query($link, $queryPoster);
                    $poster = mysqli_fetch_array($resultPoster);

                    echo '<img src="img/' . $poster['ruta'] . '" alt="' . $poster['alt'] . '" class="col-xs-10 img-responsive" height="311">';
                    echo '<div class="col-xs-2 datos">';
                    echo '<div>';
                    echo '<p class="text-center">' . $peliculas['ano'] . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '<p class="text-center">' . $peliculas['duracion'] . "'" . '</p>';
                    echo '</div>';

                    $generosPelicula = $peliculas['genero'];
                    $generoPelicula = explode(";", $generosPelicula);

                    $genero1 = $generoPelicula[0];

                    $queryGeneros = "SELECT icoName FROM genero WHERE genero='$genero1'";
                    $resultGeneros = mysqli_query($link, $queryGeneros);
                    $rowGenero = mysqli_fetch_array($resultGeneros);

                    $genero1 = $rowGenero['icoName'];



                    echo '<div>';
                    echo '<p class="text-center"><img src="img/icons/generos/' . $genero1 . '.svg" width="27"></p>';
                    echo '</div>';


                    if (isset($generoPelicula[1])) {
                        $genero2 = $generoPelicula[1];
                        $queryGeneros = "SELECT icoName FROM genero WHERE genero='$genero2'";
                        $resultGeneros = mysqli_query($link, $queryGeneros);
                        $rowGenero = mysqli_fetch_array($resultGeneros);

                        $genero2 = $rowGenero['icoName'];

                        echo '<div>';
                        echo '<p class="text-center"><img src="img/icons/generos/' . $genero2 . '.svg" width="27"></p>';
                        echo '</div>';
                    } else {
                        echo '<div>';
                        echo '</div>';
                    }


                    echo '<div>';
                    echo '<p class="text-center">' . $peliculas['clasificacion'] . '</p>';
                    echo '</div>';

                    echo '<div>';

                    $queryTecnologia = "SELECT DISTINCT tecnologia FROM horarios WHERE idPelicula=$idPelicula ORDER BY tecnologia";
                    $resultTecnologia = mysqli_query($link, $queryTecnologia);
                    while ($rowTecnologia = mysqli_fetch_array($resultTecnologia)) {
                        $tecnologia = $rowTecnologia['tecnologia'];
                        if ($tecnologia == "2D") {
                            echo '<p class = "text-center">' . $tecnologia . '</p>';
                        }
                        if ($tecnologia == "3D") {
                            echo '<p class = "text-center">' . $tecnologia . '</p>';
                        }
                        if ($tecnologia == "4D") {
                            echo '<p class = "text-center">' . $tecnologia . '</p>';
                        }
                    }

                    echo '</div>';

                    echo '</div>';

                    echo '<div class = "col-xs-12">';
                    echo '<p class = "text-center">' . $peliculas['titulo'] . '</p>';
                    echo '</div>';

                    echo '</div>';
                }
                while ($horarios = mysqli_fetch_array($resultHorarios)) {
                    $idPelicula = $horarios['idPelicula'];

                    $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no' AND id=$idPelicula";
                    $resultPeliculas = mysqli_query($link, $queryPeliculas);
                    while ($peliculas = mysqli_fetch_array($resultPeliculas)) {
                        echo '<div class=" col-xs-12 col-sm-6 col-md-3" onclick="pelicula(' . "'" . $idPelicula . "'" . ')">';


                        $queryPoster = "SELECT * FROM imagenes WHERE idPelicula = $idPelicula";
                        $resultPoster = mysqli_query($link, $queryPoster);
                        $poster = mysqli_fetch_array($resultPoster);

                        echo '<img src="img/' . $poster['ruta'] . '" alt="' . $poster['alt'] . '" class="col-xs-10 img-responsive" height="311">';
                        echo '<div class="col-xs-2 datos">';
                        echo '<div>';
                        echo '<p class="text-center">' . $peliculas['ano'] . '</p>';
                        echo '</div>';
                        echo '<div>';
                        echo '<p class="text-center">' . $peliculas['duracion'] . "'" . '</p>';
                        echo '</div>';

                        $generosPelicula = $peliculas['genero'];
                        $generoPelicula = explode(";", $generosPelicula);

                        $genero1 = $generoPelicula[0];

                        $queryGeneros = "SELECT icoName FROM genero WHERE genero='$genero1'";
                        $resultGeneros = mysqli_query($link, $queryGeneros);
                        $rowGenero = mysqli_fetch_array($resultGeneros);

                        $genero1 = $rowGenero['icoName'];



                        echo '<div>';
                        echo '<p class="text-center"><img src="img/icons/generos/' . $genero1 . '.svg" width="27"></p>';
                        echo '</div>';


                        if (isset($generoPelicula[1])) {
                            $genero2 = $generoPelicula[1];
                            $queryGeneros = "SELECT icoName FROM genero WHERE genero='$genero2'";
                            $resultGeneros = mysqli_query($link, $queryGeneros);
                            $rowGenero = mysqli_fetch_array($resultGeneros);

                            $genero2 = $rowGenero['icoName'];

                            echo '<div>';
                            echo '<p class="text-center"><img src="img/icons/generos/' . $genero2 . '.svg" width="27"></p>';
                            echo '</div>';
                        } else {
                            echo '<div>';
                            echo '</div>';
                        }


                        echo '<div>';
                        echo '<p class="text-center">' . $peliculas['clasificacion'] . '</p>';
                        echo '</div>';

                        echo '<div>';

                        $queryTecnologia = "SELECT DISTINCT tecnologia FROM horarios WHERE idPelicula=$idPelicula ORDER BY tecnologia";
                        $resultTecnologia = mysqli_query($link, $queryTecnologia);
                        while ($rowTecnologia = mysqli_fetch_array($resultTecnologia)) {
                            $tecnologia = $rowTecnologia['tecnologia'];
                            if ($tecnologia == "2D") {
                                echo '<p class = "text-center">' . $tecnologia . '</p>';
                            }
                            if ($tecnologia == "3D") {
                                echo '<p class = "text-center">' . $tecnologia . '</p>';
                            }
                            if ($tecnologia == "4D") {
                                echo '<p class = "text-center">' . $tecnologia . '</p>';
                            }
                        }

                        echo '</div>';

                        echo '</div>';

                        echo '<div class = "col-xs-12">';
                        echo '<p class = "text-center">' . $peliculas['titulo'] . '</p>';
                        echo '</div>';

                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>


        <!--FOOTER-->
        <div class="container-fluid">
            <div class="row footer">
                <div class="text-center col-sm-4 ">
                    <h4><span class="borderBottom">Contacto</span></h4>
                    <ul class="list-unstyled">
                        <li>Mercedes 2632</li>
                        <li>2402 5032</li>
                        <li>cine@montevideo.uy</li>
                    </ul>
                </div>
                <div class="text-center col-sm-4 ">
                    <h4><span class="borderBottom">Redes Sociales</span></h4>
                    <ul class="list-inline list-unstyled redesSociales">
                        <li><a href="https://www.facebook.com/"><img src="img/redes/facebook.svg" width="35"></a></li>
                        <li><a href="https://www.instagram.com/"><img src="img/redes/instagram.svg" width="35"></a></li>
                        <li><a href="https://www.twitter.com/"><img src="img/redes/twitter.svg" width="35"></a></li>
                    </ul>
                </div>
                <div class="text-center col-sm-4 ">
                    <h4><span class="borderBottom">Newsletter</span></h4>
                    <p>Recibí información de la cartelera montevideana.</p>
                    <div><form id="newsletter"  ><input type="email"  placeholder="Correo Electrónico" name="email"><button type="submit" class="btn btn-info">Enviar</button></form>
                    </div>
                </div>
                <p class="text-center">Copyrigth &COPY; 2017 | Joaquín Mayer</p>
            </div>
        </div>

        <!--Archivos JavaScript-->
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jsBuscar.js" type="text/javascript"></script>
    </body>
</html>
