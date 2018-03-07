<?php
include './conexion.php';

//SLIDER
$querySlider = "SELECT * FROM imagenes WHERE slider = 'si' ORDER BY posicionSlider";
$resultSlider = mysqli_query($link, $querySlider);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CineMontevideo</title>

        <!--Archivos CSS-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="index" class="publico">

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

        <!--SLIDER-->
        <div id="slider" class="carousel slide firstDiv" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                while ($rowSlider = mysqli_fetch_array($resultSlider)) {

                    $idPelicula = $rowSlider['idPelicula'];
                    $posicionSlider = $rowSlider['posicionSlider'];

                    if ($idPelicula <> 0) {
                        echo '<div class="item ';
                        if ($posicionSlider == 1) {
                            echo 'active';
                        }
                        echo '" onclick="pelicula(' . "'" . '' . $idPelicula . '' . "'" . ')">';
                        echo '<img class="img-responsive" src="img/' . $rowSlider['ruta'] . '" alt="' . $rowSlider['alt'] . '" >';
                        echo '<div class="carousel-caption">';

                        $queryPelicula = "SELECT * FROM pelicula WHERE id=$idPelicula";
                        $resultPelicula = mysqli_query($link, $queryPelicula);
                        $rowPelicula = mysqli_fetch_array($resultPelicula);



                        $generosPelicula = $rowPelicula['genero'];
                        $generoPelicula = explode(";", $generosPelicula);

                        $genero1 = $generoPelicula[0];

                        $queryGeneros = "SELECT icoName FROM genero WHERE genero='$genero1'";
                        $resultGeneros = mysqli_query($link, $queryGeneros);
                        $rowGenero = mysqli_fetch_array($resultGeneros);

                        $genero1 = $rowGenero['icoName'];

                        if (isset($generoPelicula[1])) {
                            $genero2 = $generoPelicula[1];
                            $queryGeneros = "SELECT icoName FROM genero WHERE genero='$genero2'";
                            $resultGeneros = mysqli_query($link, $queryGeneros);
                            $rowGenero = mysqli_fetch_array($resultGeneros);

                            $genero2 = $rowGenero['icoName'];
                        }

                        echo '<p class="reseña"><span class="titulo">' . $rowPelicula['titulo'] . '</span> | <span class="clasificacion">' . $rowPelicula['clasificacion'] . '</span> | <span class="duracion">' . $rowPelicula['duracion'] . '' . "'" . '</span> | <span class="genero"><img src="img/icons/generos/' . $genero1 . '.svg" width="27">';
                        if (isset($genero2)) {
                            echo '<img src="img/icons/generos/' . $genero2 . '.svg" width="27">';
                        }
                        echo '</span></p>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class = "item ';
                        if ($posicionSlider == 1) {
                            echo 'active';
                        }
                        echo '">';
                        echo '<img class = "img-responsive" src = "img/' . $rowSlider['ruta'] . '" alt = "' . $rowSlider['alt'] . '" >';
                        echo '</div>';
                    }
                }
                ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#slider" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!--ULTIMOS ESTRENOS-->
        <div class="container">
            <div class="row" id="ultimosEstrenos">
                <h2 class="text-center"><span class="borderBottom">Últimos Estrenos</span></h2>



                <div class="owl-carousel" id="ultimasPeliculas">
                    <?php
                    $queryLastFilms = "SELECT * from pelicula WHERE archivado='no' ORDER BY fechaEstreno LIMIT 10";
                    $resultLastFilms = mysqli_query($link, $queryLastFilms);
                    while ($pelicula = mysqli_fetch_array($resultLastFilms)) {
                        $id = $pelicula['id'];
                        $queryLastFilmsPoster = "SELECT * FROM imagenes WHERE idPelicula=$id";
                        $resultLastFilmsPoster = mysqli_query($link, $queryLastFilmsPoster);

                        $poster = mysqli_fetch_array($resultLastFilmsPoster);
                        echo '<div class = "item">';
                        echo '<a href = "ampliacion.php?id=' . $id . '">';
                        echo '<img src = "img/' . $poster['ruta'] . '" alt = "' . $poster['alt'] . '" width = "187">';
                        echo '<p class = "text-center">' . $pelicula['titulo'] . '</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>    
        </div>

        <!--TECNOLOGIAS-->
        <div class="container-fluid">
            <div class="row">
                <div class="text-center col-md-4 tecnologias"><a href="buscar.php?q=2D"><p>Películas<br><span>2D</span></p></a></div>
                <div class="text-center col-md-4 tecnologias"><a href="buscar.php?q=3D"><p>Películas<br><span>3D</span></p></a></div>
                <div class="text-center col-md-4 tecnologias"><a href="buscar.php?q=4D"><p>Películas<br><span>4D</span></p></a></div>
            </div>
        </div>

        <!--APLICACIONES-->
        <div class="container-fluid">
            <div class="row aplicacion" >
                <div class="text-center col-sm-4 hidden-xs "><img src="img/iphone.png" class="img-responsive" alt="iphone con aplicacion de cineMontevideo"></div>
                <div class="text-center col-sm-4">
                    <h3><span>DESCUBRÍ</span><br>NUESTRA APLICACIÓN</h3>
                    <p class="text-center">DESCARGALA EN:</p>
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2 col-md-5 col-md-offset-1 text-center getIt">
                            <a href="https://play.google.com/store?hl=es"><img src="img/getitongoogleplay.png" alt="Descargala en Google Play" class="img-responsive" width="100%"></a>
                        </div>
                        <div class="col-xs-8 col-xs-offset-2 col-md-5 col-md-offset-0  text-center getIt">
                            <a href="https://www.apple.com/la/ios/app-store/"><img src="img/getitonapplestore.png" alt="Descargala en App Store" class="img-responsive" width="100%" height="50" ></a>
                        </div>
                    </div>
                </div>
                <div class="text-center col-sm-4 hidden-xs "><img src="img/nexus.png" class="img-responsive" alt="nexus con aplicacion de cineMontevideo"></div>
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
        <script src="js/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/jsIndex.js" type="text/javascript"></script>
    </body>
</html>
