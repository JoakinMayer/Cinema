<?php
include './conexion.php';

if (!isset($_GET['id'])) {
    header("location:index.php");
} else {
    $id = $_GET['id'];
    $queryPeliculas = "SELECT * FROM pelicula WHERE id='$id'";
    $resultPeliculas = mysqli_query($link, $queryPeliculas);
    $pelicula = mysqli_fetch_array($resultPeliculas);

    $queryPoster = "SELECT * FROM imagenes WHERE idPelicula='$id'";
    $resultPoster = mysqli_query($link, $queryPoster);
    $poster = mysqli_fetch_array($resultPoster);

    $titulo = $pelicula['titulo'];


    $queryComplejo = "SELECT DISTINCT complejo FROM horarios WHERE idPelicula=$id";
    $resultComplejo = mysqli_query($link, $queryComplejo);
}
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
    <body id="ampliacion" class="publico">

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


        <p class="tituloInsMod firstDiv text-left">Catálogo > <?php echo $titulo ?></p>

        <!--PELICULA-->
        <div class="container" >
            <div class="row" id="ampliacionPelicula">
                <div class="col-md-6" id="ampliacionPoster">
                    <img src="img/<?php echo $poster['ruta'] ?>" alt="<?php echo $poster['alt'] ?>" width="90%">
                </div>

                <div class="col-md-6" id="ampliacionDatos">
                    <div class="row">
                        <h1 class="col-xs-12"><?php echo $titulo . ' (' . $pelicula['ano'] . ')' ?></h1>
                        <p class="col-xs-12"><strong>Título Original: </strong><?php echo $pelicula['tituloOriginal'] ?></p>
                        <p class="col-xs-6"><strong>Clasificación: </strong><?php echo $pelicula['clasificacion'] ?></p>


                        <?php
                        $generosPelicula = $pelicula['genero'];
                        $generoPelicula = explode(";", $generosPelicula);

                        $genero1 = $generoPelicula[0];

                        $queryGeneros = "SELECT * FROM genero WHERE genero='$genero1'";
                        $resultGeneros = mysqli_query($link, $queryGeneros);
                        $rowGenero = mysqli_fetch_array($resultGeneros);

                        $genero1 = $rowGenero['icoName'];
                        $generoUno = $rowGenero['genero'];

                        if (isset($generoPelicula[1])) {
                            $genero2 = $generoPelicula[1];
                            $queryGeneros = "SELECT * FROM genero WHERE genero='$genero2'";
                            $resultGeneros = mysqli_query($link, $queryGeneros);
                            $rowGenero = mysqli_fetch_array($resultGeneros);

                            $genero2 = $rowGenero['icoName'];
                            $generoDos = $rowGenero['genero'];
                        }
                        ?>
                        <p class="col-xs-6"><strong>Género: </strong><?php
                            echo '<img src="img/icons/generos/' . $genero1 . '.svg" width="20">';
                            echo '<img src="img/icons/generos/' . $genero2 . '.svg" width="20">';
                            ?></p>

                        <p class="col-xs-6"><strong>Puntuación Imdb: </strong><img src="img/icons/star.svg" width="15"><?php echo $pelicula['puntuacion'] ?>/10</p>
                        <p class="col-xs-6"><strong>Idioma: </strong><?php echo $pelicula['idioma'] ?></p>
                        <p class="col-xs-6"><strong>Duración: </strong><?php echo $pelicula['duracion'] ?>min</p>
                        <p class="col-xs-6"><strong>País: </strong><?php echo $pelicula['pais'] ?></p>
                        <p class="col-xs-12 text-justify"><strong>Sinopsis: </strong><br><?php echo $pelicula['sinopsis'] ?></p>
                        <p class="col-xs-12"><strong>Dirección: </strong><br><?php echo $pelicula['direccion'] ?></p>
                        <p class="col-xs-12"><strong>Elenco: </strong><br><?php echo $pelicula['elenco'] ?></p>
                        <p ><a class="col-xs-6" href="<?php echo $pelicula['sitioOficial'] ?>">Sitio Oficial</a></p>
                        <p class="col-xs-6"><a href="<?php echo $pelicula['sitioImdb'] ?>">Sitio Imdb</a></p>
                    </div>
                </div>
                <div class="col-xs-12" id="ampliacionTrialer">
                    <p class="col-xs-12 text-left"><strong>Tráiler</strong></p>
                    <video id="my-video" width="100%" height="480">
                        <source class="embed-responsive-item" type="video/youtube" src="<?php echo $pelicula['trailer'] ?>" />
                    </video>
                </div>

                <div class="col-xs-12" id="ampliacionHorarios">
                    <p class="col-xs-12 text-left"><strong>Horarios</strong></p>
                    <div class="col-xs-12" id="contenedorHorarios">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" id="idPelicula" value="<?php echo $id ?>">
                                <label for="complejo" >Complejo</label>
                                <select  name="complejo" id="complejo" onchange="filtros()">
                                    <option selected disabled>Seleccione un un complejo</option>
                                    <?php
                                    $queryComplejos = "SELECT DISTINCT complejo FROM horarios WHERE idPelicula=$id";
                                    $resultComplejos = mysqli_query($link, $queryComplejos);
                                    while ($rowComplejos = mysqli_fetch_array($resultComplejos)) {
                                        echo '<option value="' . $rowComplejos['complejo'] . '">' . $rowComplejos['complejo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                    while ($complejos = mysqli_fetch_array($resultComplejo)) {

                        $complejo = $complejos['complejo'];
                        echo '<div class="col-xs-12 contenedorComplejo">';
                        echo '<p class="col-xs-6">' . $complejo . '</p>';
                        echo '<p class="col-xs-6 text-right precio" onClick="display(this)">Precio de Entradas <span>&vee;</span></p>';

                        echo '<div class="row preciosComplejo" >';

                        $queryPrecios = "SELECT * FROM complejos WHERE nombre='$complejo'";
                        $resultPrecios = mysqli_query($link, $queryPrecios);

                        while ($precioComplejo = mysqli_fetch_array($resultPrecios)) {
                            if (($precioComplejo['sala2D']) <> "") {
                                echo '<div class="col-md-4">';
                                echo '<p><strong>SALA 2D</strong><br>' . $precioComplejo['sala2D'] . '</p>';
                                echo '</div>';
                            }
                            if (($precioComplejo['sala3D']) <> "") {
                                echo '<div class="col-md-4">';
                                echo '<p><strong>SALA 3D</strong><br>' . $precioComplejo['sala3D'] . '</p>';
                                echo '</div>';
                            }
                            if (($precioComplejo['sala4D']) <> "") {
                                echo '<div class="col-md-4">';
                                echo '<p><strong>SALA 4D</strong><br>' . $precioComplejo['sala4D'] . '</p>';
                                echo '</div>';
                            }
                            if (($precioComplejo['jubilados']) <> "") {
                                echo '<div class="col-md-4">';
                                echo '<p><strong>JUBILADOS</strong><br>' . $precioComplejo['jubilados'] . '</p>';
                                echo '</div>';
                            }if (($precioComplejo['promociones']) <> "") {
                                echo '<div class="col-md-4">';
                                echo '<p><strong>OTROS</strong><br>' . $precioComplejo['promociones'] . '</p>';
                                echo '</div>';
                            }
                        }

                        echo '</div>';

                        echo '</div>';

                        $queryHorarioComplejoESP = "SELECT * FROM horarios WHERE complejo='$complejo' AND idPelicula=$id AND idioma='ESP'";
                        $resultHorarioComplejoESP = mysqli_query($link, $queryHorarioComplejoESP);

                        while ($rowHorarioComplejoESP = mysqli_fetch_array($resultHorarioComplejoESP)) {
                            echo '<div class="col-xs-12 contenedorHoras">';
                            echo '<p class="col-md-4">(ESP) Doblada al Español </p>';

                            echo '<p class = "col-md-4">';
                            $horariosPelicula = $rowHorarioComplejoESP['horario'];
                            $horarioPelicula = explode(";", $horariosPelicula);

                            $cantidadHoras = count($horarioPelicula);
                            for ($i = 0; $i < $cantidadHoras; $i++) {
                                $horario = $horarioPelicula[$i];
                                echo $horario;
                                echo '<span>';
                                echo $rowHorarioComplejoESP['tecnologia'];
                                echo '</span>';
                            }
                            echo '</p>';

                            echo '<p class="col-md-4">';
                            $diasPelicula = $rowHorarioComplejoESP['dias'];
                            $diaPelicula = explode(",", $diasPelicula);
                            $cantidadDias = count($diaPelicula);

                            for ($i = 0; $i < $cantidadDias; $i++) {
                                $dia = $diaPelicula[$i];
                                if ($dia == "Mon") {
                                    echo ' Lun ';
                                } elseif ($dia == "Tue") {
                                    echo ' Mar ';
                                } elseif ($dia == "Wed") {
                                    echo ' Mie ';
                                } elseif ($dia == "Thu") {
                                    echo ' Jue ';
                                } elseif ($dia == "Fri") {
                                    echo ' Vie ';
                                } elseif ($dia == "Sat") {
                                    echo ' Sáb ';
                                } elseif ($dia == "Sun") {
                                    echo ' Dom ';
                                }
                            }

                            echo '</p>';


                            echo '</div>';
                        }

                        $queryHorarioComplejoSUB = "SELECT * FROM horarios WHERE complejo='$complejo' AND idPelicula=$id AND idioma='SUB'";
                        $resultHorarioComplejoSUB = mysqli_query($link, $queryHorarioComplejoSUB);

                        while ($rowHorarioComplejoSUB = mysqli_fetch_array($resultHorarioComplejoSUB)) {
                            echo '<div class="col-xs-12 contenedorHoras">';
                            echo '<p class="col-md-4">(SUB) Subtitulada al Español </p>';

                            echo '<p class = "col-md-4">';
                            $horariosPelicula = $rowHorarioComplejoSUB['horario'];
                            $horarioPelicula = explode(";", $horariosPelicula);

                            $cantidadHoras = count($horarioPelicula);
                            for ($i = 0; $i < $cantidadHoras; $i++) {
                                $horario = $horarioPelicula[$i];
                                echo $horario;
                                echo '<span>';
                                echo $rowHorarioComplejoSUB['tecnologia'];
                                echo '</span>';
                            }
                            echo '</p>';

                            echo '<p class="col-md-4">';
                            $diasPelicula = $rowHorarioComplejoSUB['dias'];
                            $diaPelicula = explode(",", $diasPelicula);
                            $cantidadDias = count($diaPelicula);

                            for ($i = 0; $i < $cantidadDias; $i++) {
                                $dia = $diaPelicula[$i];
                                if ($dia == "Mon") {
                                    echo ' Lun ';
                                } elseif ($dia == "Tue") {
                                    echo ' Mar ';
                                } elseif ($dia == "Wed") {
                                    echo ' Mie ';
                                } elseif ($dia == "Thu") {
                                    echo ' Jue ';
                                } elseif ($dia == "Fri") {
                                    echo ' Vie ';
                                } elseif ($dia == "Sat") {
                                    echo ' Sáb ';
                                } elseif ($dia == "Sun") {
                                    echo ' Dom ';
                                }
                            }
                            echo '</p>';

                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--PELLICULAS RELACIONADAS-->

        <div class="container">
            <div class="row" id="peliculas">
                <p>Películas Relacionadas</p>
                <?php
                if (!empty($generoDos)) {
                    $queryRelacionadas = "SELECT * FROM pelicula WHERE archivado='no' AND (genero LIKE '%$generoUno%' OR genero LIKE '%$generoDos%') AND NOT titulo='$titulo' LIMIT 4";
                } else {
                    $queryRelacionadas = "SELECT * FROM pelicula WHERE archivado='no' AND genero LIKE '%$generoUno%' AND NOT titulo='$titulo' LIMIT 4";
                }
                $resultRelacionadas = mysqli_query($link, $queryRelacionadas);

                while ($peliculas = mysqli_fetch_array($resultRelacionadas)) {
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
        <script src="js/youtube-video-min.js" type="text/javascript"></script>
        <script>
                                    var videoEl = document.getElementById("my-video");
                                    var player = new YoutubeVideo({
                                        el: videoEl
                                    });
                                    var stateText = document.body.getElementsByClassName('video-state')[0];

                                    // add event listeners
                                    videoEl.addEventListener('playing', function () {
                                        stateText.textContent = 'playing';
                                    });
                                    videoEl.addEventListener('ended', function () {
                                        stateText.textContent = 'finished';
                                    });

                                    videoEl.addEventListener('pause', function () {
                                        stateText.textContent = 'paused';
                                    });

                                    videoEl.load().then(function () {
                                        return videoEl;
                                    })

        </script>
        <script src="js/jsAmpliacion.js" type="text/javascript"></script>
    </body>
</html>
