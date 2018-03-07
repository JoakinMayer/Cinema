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



        $querySlider = "SELECT * FROM imagenes WHERE portada='si' ORDER BY slider ASC, posicionSlider ASC ";
        $resultSlider = mysqli_query($link, $querySlider);

        $queryCantidadSlider = "SELECT * FROM imagenes WHERE portada='si' AND posicionSlider<>'0' ORDER BY slider ASC";
        $resultCantidadSlider = mysqli_query($link, $queryCantidadSlider);
        $cantidadSlider = mysqli_num_rows($resultCantidadSlider);

        $comillas = "'";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Administracion - Portada</title>

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
                            <li><a href="peliculasCartel.php">Películas en cartel</a></li>
                            <li><a href="archivo.php">Archivo</a></li>
                            <li><a class="active" href="portada.php">Portada</a></li>
                            <li><a href="cerrarSesion.php" class="sinHover"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <div class="container-fluid">
            <a href="insertarPortada.php" class="btn btn-info" role="button">Insertar Portada</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Posicion</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th class="text-center">Fecha de Subida</th>
                        <th class="text-center">Portada</th>
                        <th class="text-center">Modificar</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rowSlider = mysqli_fetch_array($resultSlider)) {

                        $idSlider = $rowSlider['idPelicula'];

                        if ($idSlider == 0) {
                            $idImg = $rowSlider['id'];
                            echo '<tr >';
                            $posicionSlider = $rowSlider['posicionSlider'];
                            if ($posicionSlider == 0) {
                                echo '<td >';
                                echo '</td>';
                            } else {
                                echo '<td >';
                                echo '<select class="form-control" onchange="posicion(this.value,' . $idImg . ',' . $posicionSlider . ', 0)">';
                                for ($i = 1; $i <= $cantidadSlider; $i++) {
                                    if ($posicionSlider == $i) {
                                        echo '<option selected value="' . $i . '">';
                                        echo $i;
                                        echo '</option>';
                                    } else {
                                        echo '<option value="' . $i . '">';
                                        echo $i;
                                        echo '</option>';
                                    }
                                }
                                echo '</select>';
                                echo '</td>';
                            }
                            echo '<td><img src="../img/' . $rowSlider['ruta'] . '" alt="' . $rowSlider['alt'] . '" width="200px"></td>';
                            echo '<td>' . $rowSlider['alt'] . '</td>';
                            echo '<td>Promo</td>';
                            echo '<td class="text-center">' . $rowSlider['fechaSubida'] . '</td>';
                            $queryPortada = "SELECT * FROM imagenes WHERE id=$idImg AND portada='si'";
                            $resultPortada = mysqli_query($link, $queryPortada);
                            $contadorPortada = mysqli_num_rows($resultPortada);
                            if ($contadorPortada > 0) {

                                $slider = $rowSlider['slider'];
                                if ($slider == 'si') {
                                    echo '<td class="text-center"><div class="checkbox" onclick="portada(' . $comillas . $idImg . $comillas . ')"><label><input checked type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                                } else {
                                    echo '<td class="text-center"><div class="checkbox" onclick="portada(' . $comillas . $idImg . $comillas . ')"><label><input type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                                }
                            } else {
                                echo '<td class="text-center"><div class="checkbox disabled"><label><input disabled type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                            }

                            echo '<td class="text-center"><a href="modificacionPortada.php?id=' . $idImg . '"><i class="material-icons">edit</i></a></td>';
                            echo '<td class="text-center"><a href="eliminarPortada.php?id=' . $idImg . '"><i class="material-icons">delete</i></a></td>';
                            echo '</tr>';
                        } else {

                            //Pelicula
                            $queryPeliculas = "SELECT * FROM pelicula WHERE id='$idSlider' AND archivado='no'";
                            $resultPeliculas = mysqli_query($link, $queryPeliculas);

                            while ($rowPelicula = mysqli_fetch_array($resultPeliculas)) {
                                $id = $rowPelicula['id'];

                                $queryPortada = "SELECT * FROM imagenes WHERE idPelicula=$id AND portada='si'";
                                $resultPortada = mysqli_query($link, $queryPortada);
                                $rowPortada = mysqli_fetch_array($resultPortada);

                                $idImg = $rowPortada['id'];

                                echo '<tr >';
                                $posicionSlider = $rowPortada['posicionSlider'];
                                if ($posicionSlider == 0) {
                                    echo '<td >';
                                    echo '</td>';
                                } else {
                                    echo '<td >';
                                    echo '<select class="form-control" onchange="posicion(this.value,' . $idImg . ',' . $posicionSlider . ',' . $id . ')">';
                                    for ($i = 1; $i <= $cantidadSlider; $i++) {
                                        if ($posicionSlider == $i) {
                                            echo '<option selected value="' . $i . '">';
                                            echo $i;
                                            echo '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">';
                                            echo $i;
                                            echo '</option>';
                                        }
                                    }
                                    echo '</select>';
                                    echo '</td>';
                                }


                                echo '<td><img src="../img/' . $rowPortada['ruta'] . '" alt="' . $rowPortada['alt'] . '" width="200px"></td>';
                                echo '<td>' . $rowPelicula['titulo'] . '</td>';
                                echo '<td>Película</td>';
                                echo '<td class="text-center">' . $rowPortada['fechaSubida'] . '</td>';
                                $queryPortada = "SELECT * FROM imagenes WHERE idPelicula=$id AND portada='si'";
                                $resultPortada = mysqli_query($link, $queryPortada);
                                $contadorPortada = mysqli_num_rows($resultPortada);
                                if ($contadorPortada > 0) {

                                    $slider = $rowPortada['slider'];
                                    if ($slider == 'si') {
                                        echo '<td class="text-center"><div class="checkbox" onclick="portada(' . $comillas . $idImg . $comillas . ')"><label><input checked type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                                    } else {
                                        echo '<td class="text-center"><div class="checkbox" onclick="portada(' . $comillas . $idImg . $comillas . ')"><label><input type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                                    }
                                } else {
                                    echo '<td class="text-center"><div class="checkbox disabled"><label><input disabled type="checkbox" data-toggle="toggle" data-style="ios" data-size="small"></label></div></td>';
                                }



                                echo '<td class="text-center"><a href="modificacionPortada.php?id=' . $idImg . '"><i class="material-icons">edit</i></a></td>';
                                echo '<td class="text-center"><a href="eliminarPortada.php?id=' . $idImg . '"><i class="material-icons">delete</i></a></td>';
                                echo '</tr>';
                            }
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
        <script src="../js/jsPortada.js" type="text/javascript"></script>

    </body>
</html>
