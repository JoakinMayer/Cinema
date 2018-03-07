<?php

include './conexion.php';

$idFiltro = array();

//SI NO ESTA VACIO GENERO
if (!empty($_GET['genero'])) {
    $genero = $_GET['genero'];

    if (!empty($_GET['complejo'])) {
        $complejo = $_GET['complejo'];

        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no'";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);

        while ($peliculas = mysqli_fetch_array($resultPeliculas)) {
            $generoPelicula = $peliculas['genero'];
            if (strpos($generoPelicula, $genero) === false) {
                
            } else {
                $idPelicula = $peliculas['id'];

                $queryComplejos = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula AND complejo='$complejo' LIMIT 1";
                $resultComplejos = mysqli_query($link, $queryComplejos);

                while ($complejos = mysqli_fetch_array($resultComplejos)) {
                    $idPelicula = $complejos['idPelicula'];
                    array_push($idFiltro, $idPelicula);
                }
            }
        }
    } elseif (!empty($_GET['dia'])) {
        $idFiltro = array();
        $dia = $_GET['dia'];

        $dia = date('D', strtotime(str_replace('-', '/', $dia)));

        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no'";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);

        while ($peliculas = mysqli_fetch_array($resultPeliculas)) {
            $generoPelicula = $peliculas['genero'];
            if (strpos($generoPelicula, $genero) === false) {
                
            } else {
                $idPelicula = $peliculas['id'];

                if (empty($_GET['complejo'])) {
                    $queryComplejos = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula  LIMIT 1";
                    $resultComplejos = mysqli_query($link, $queryComplejos);
                } else {
                    $queryComplejos = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula AND complejo='$complejo' LIMIT 1";
                    $resultComplejos = mysqli_query($link, $queryComplejos);
                }

                while ($complejos = mysqli_fetch_array($resultComplejos)) {

                    $diasPelicula = $complejos['dias'];
                    if (strpos($diasPelicula, $dia) === false) {
                        
                    } else {
                        $idPelicula = $complejos['idPelicula'];
                        array_push($idFiltro, $idPelicula);
                    }
                }
            }
        }
    } else {
        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no'";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);

        while ($peliculas = mysqli_fetch_array($resultPeliculas)) {
            $generoPelicula = $peliculas['genero'];
            if (strpos($generoPelicula, $genero) === false) {
                
            } else {
                $idPelicula = $peliculas['id'];
                array_push($idFiltro, $idPelicula);
            }
        }
    }
}
if ((!empty($_GET['complejo'])) and ( empty($_GET['genero']))) {
    $idFiltro = array();
    $complejo = $_GET['complejo'];

    if (!empty($_GET['dia'])) {
        $idFiltro = array();
        $dia = $_GET['dia'];

        $dia = date('D', strtotime(str_replace('-', '/', $dia)));

        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no'";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);

        while ($peliculas = mysqli_fetch_array($resultPeliculas)) {

            $idPelicula = $peliculas['id'];

            if (empty($_GET['complejo'])) {
                $queryComplejos = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula  LIMIT 1";
                $resultComplejos = mysqli_query($link, $queryComplejos);
            } else {
                $queryComplejos = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula AND complejo='$complejo' LIMIT 1";
                $resultComplejos = mysqli_query($link, $queryComplejos);
            }

            while ($complejos = mysqli_fetch_array($resultComplejos)) {

                $diasPelicula = $complejos['dias'];
                if (strpos($diasPelicula, $dia) === false) {
                    
                } else {
                    $idPelicula = $complejos['idPelicula'];
                    array_push($idFiltro, $idPelicula);
                }
            }
        }
    } else {
        $idFiltro = array();
        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no'";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);

        while ($peliculas = mysqli_fetch_array($resultPeliculas)) {
            $idPelicula = $peliculas['id'];

            $queryComplejos = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula AND complejo='$complejo' LIMIT 1";
            $resultComplejos = mysqli_query($link, $queryComplejos);

            while ($complejos = mysqli_fetch_array($resultComplejos)) {
                $idPelicula = $complejos['idPelicula'];
                array_push($idFiltro, $idPelicula);
            }
        }
    }
}
if ((!empty($_GET['dia'])) and ( empty($_GET['genero'])) and ( empty($_GET['complejo']))) {
    $idFiltro = array();
    $dia = $_GET['dia'];

    $dia = date('D', strtotime(str_replace('-', '/', $dia)));

    $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no'";
    $resultPeliculas = mysqli_query($link, $queryPeliculas);

    while ($peliculas = mysqli_fetch_array($resultPeliculas)) {

        $idPelicula = $peliculas['id'];


        $queryDias = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula  LIMIT 1";
        $resultDias = mysqli_query($link, $queryDias);

        while ($dias = mysqli_fetch_array($resultDias)) {

            $diasPelicula = $dias['dias'];
            if (strpos($diasPelicula, $dia) === false) {
                
            } else {
                $idPelicula = $dias['idPelicula'];
                array_push($idFiltro, $idPelicula);
            }
        }
    }
}

$cantidad = count($idFiltro);
if ($cantidad > 0) {
    for ($i = 0; $i < $cantidad; $i++) {
        $id = $idFiltro[$i];

        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no' AND id=$id";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);

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

            if (isset($generoPelicula[1])) {
                $genero2 = $generoPelicula[1];
                $queryGeneros = "SELECT icoName FROM genero WHERE genero='$genero2'";
                $resultGeneros = mysqli_query($link, $queryGeneros);
                $rowGenero = mysqli_fetch_array($resultGeneros);

                $genero2 = $rowGenero['icoName'];
            }

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
} else {
    echo 'No se encontraron resultados';
}





    