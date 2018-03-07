<?php
include './conexion.php';

$queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no' ORDER BY fechaEstreno";
$resultPeliculas = mysqli_query($link, $queryPeliculas);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CineMontevideo - Cátalogo</title>

        <!--Archivos CSS-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="catalogo" class="publico">

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
                            <li><a href="catalogo.php" class="active">Cátalogo</a></li>
                            <li><a href="complejos.php">Complejos</a></li>
                            <li><a href="referencias.php">Referencias</a></li>
                            <li><a href="contacto.php">Contacto</a></li>
                            <li><form class="navbar-form navbar-right" action="buscar.php" role="search"><input type="text"  placeholder="Buscador" name="q"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></form></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>

        <!--FILTROS-->
        <div class="container-fluid firstDiv" >
            <div class="row text-center" id="filtros">
                <div class="col-sm-3">
                    <form id="buscador"  action="buscar.php" method="get">
                        <label for="buscar" class="col-sm-12">Buscar</label>
                        <input type="text" name="q" class="col-xs-10">
                        <button type="submit" class="btn btn-info col-xs-2">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
                <div class="col-sm-3">
                    <label for="genero" class="col-sm-12">Género</label>
                    <select class="col-xs-12" name="genero" id="genero" onchange="filtros()">
                        <option selected disabled>Seleccione un género</option>
                        <?php
                        $queryGeneros = "SELECT * FROM genero";
                        $resultGeneros = mysqli_query($link, $queryGeneros);
                        while ($rowGeneros = mysqli_fetch_array($resultGeneros)) {
                            echo '<option value="' . $rowGeneros['genero'] . '">' . $rowGeneros['genero'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="complejo" class="col-sm-12">Complejo</label>
                    <select class="col-xs-12" name="complejo" id="complejo" onchange="filtros()">
                        <option selected disabled>Seleccione un un complejo</option>
                        <?php
                        $queryComplejos = "SELECT * FROM complejos";
                        $resultComplejos = mysqli_query($link, $queryComplejos);
                        while ($rowComplejos = mysqli_fetch_array($resultComplejos)) {
                            echo '<option value="' . $rowComplejos['nombre'] . '">' . $rowComplejos['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="dia" class="col-sm-12">Dia</label>
                    <input type="date" name="dia" id="dia" class="col-xs-12" onchange="filtros()">
                </div>

            </div>
        </div>


        <!--PELICULAS-->
        <div class="container">
            <div class="row" id="peliculas">

                <?php
                while ($peliculas = mysqli_fetch_array($resultPeliculas)) {
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
        <script src="js/jsCatalogo.js" type="text/javascript"></script>
    </body>
</html>
