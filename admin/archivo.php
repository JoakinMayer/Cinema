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
        $queryPeliculas = "SELECT * FROM pelicula WHERE archivado='si' ORDER BY id";
        $resultPeliculas = mysqli_query($link, $queryPeliculas);
        $comillas = "'";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Administracion - Archivo</title>

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
                            <li><a  href="peliculasCartel.php">Películas en cartel</a></li>
                            <li><a  class="active" href="archivo.php">Archivo</a></li>
                            <li><a href="portada.php">Portada</a></li>
                            <li><a href="cerrarSesion.php" class="sinHover"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Póster</th>
                        <th>Nombre</th>
                        <th>Fecha de Estreno</th>
                        <th>Última Modificación</th>
                        <th class="text-center">Modificar</th>
                        <th class="text-center">Públicar</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rowPelicula = mysqli_fetch_array($resultPeliculas)) {
                        $id = $rowPelicula['id'];
                        echo '<tr >';
                        echo '<td >' . $id . '</td>';
                        $queryPoster = "SELECT * FROM imagenes WHERE idPelicula=$id AND poster='si'";
                        $resultPoster = mysqli_query($link, $queryPoster);
                        $rowPoster = mysqli_fetch_array($resultPoster);
                        echo '<td><img src="../img/' . $rowPoster['ruta'] . '" alt="' . $rowPoster['alt'] . '" width="57px"></td>';
                        echo '<td>' . $rowPelicula['titulo'] . '</td>';
                        echo '<td>' . $rowPelicula['fechaEstreno'] . '</td>';
                        echo '<td>' . $rowPelicula['modificacion'] . '</td>';
                        echo '<td class="text-center"><a href="modificarPeliculaInfo.php?id=' . $id . '"><i class="material-icons">edit</i></a></td>';
                        echo '<td class="text-center"><a href="publicar.php?id=' . $id . '"><i class="material-icons">unarchive</i></a></td>';
                        echo '<td class="text-center"><a href="eliminar.php?id=' . $id . '"><i class="material-icons">delete</i></a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--Archivos JavaScript-->
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
