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

//Pelicula
        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='no' ORDER BY id";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);
        $comillas = "'";
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
        <link href="../css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>



    </head>
    <body>
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
                            <li><a class="active" href="peliculasCartel.php">Películas en cartel</a></li>
                            <li><a href="archivo.php">Archivo</a></li>
                            <li><a href="portada.php">Portada</a></li>
                            <li><a href="cerrarSesion.php" class="sinHover"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <div class="container-fluid">
            <a href="insertarPeliculaInfo.php" class="btn btn-info" role="button">Insertar Película</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Póster</th>
                        <th>Nombre</th>
                        <th>Fecha de Estreno</th>
                        <th class="text-center">Portada</th>
                        <th class="text-center">Modificar</th>
                        <th class="text-center">Archivar</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rowPelicula = mysqli_fetch_array($resultPeliculas)) {
                        $id = $rowPelicula['id'];

                        $queryHorarios = "SELECT * FROM horarios WHERE idPelicula=$id";
                        $resultHorarios = mysqli_query($link, $queryHorarios);
                        $horas = mysqli_num_rows($resultHorarios);
                        if ($horas > 0) {
                            echo '<tr >';
                            echo '<td >' . $id . '</td>';
                            $queryPoster = "SELECT * FROM imagenes WHERE idPelicula=$id AND poster='si'";
                            $resultPoster = mysqli_query($link, $queryPoster);
                            $rowPoster = mysqli_fetch_array($resultPoster);
                            echo '<td><img src="../img/' . $rowPoster['ruta'] . '" alt="' . $rowPoster['alt'] . '" width="57px"></td>';
                            echo '<td>' . $rowPelicula['titulo'] . '</td>';
                            echo '<td>' . $rowPelicula['fechaEstreno'] . '</td>';
                            $queryPortada = "SELECT * FROM imagenes WHERE idPelicula=$id AND portada='si'";
                            $resultPortada = mysqli_query($link, $queryPortada);
                            $contadorPortada = mysqli_num_rows($resultPortada);
                            if ($contadorPortada > 0) {
                                $rowPortada = mysqli_fetch_array($resultPortada);
                                $slider = $rowPortada['slider'];
                                $idImg = $rowPortada['id'];
                                if ($slider == 'si') {
                                    echo '<td class="text-center"><div class="checkbox" onclick="portada(' . $comillas . $idImg . $comillas . ')"><label><input checked type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                                } else {
                                    echo '<td class="text-center"><div class="checkbox" onclick="portada(' . $comillas . $idImg . $comillas . ')"><label><input type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                                }
                            } else {
                                echo '<td class="text-center"><div class="checkbox disabled"><label><input disabled type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                            }



                            echo '<td class="text-center"><a href="modificarPeliculaInfo.php?id=' . $id . '"><i class="material-icons">edit</i></a></td>';
                            echo '<td class="text-center"><a href="archivar.php?id=' . $id . '"><i class="material-icons">archive</i></a></td>';
                            echo '<td class="text-center"><a href="eliminar.php?id=' . $id . '"><i class="material-icons">delete</i></a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--Archivos JavaScript-->
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap-toggle.min.js" type="text/javascript"></script>
        <script src="../js/jsPeliculasCartel.js" type="text/javascript"></script>

    </body>
</html>
