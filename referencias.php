<?php
include './conexion.php';

$queryGeneros = "SELECT * FROM genero  ORDER BY genero";
$resultGeneros = mysqli_query($link, $queryGeneros);

$queryClasificacion = "SELECT * FROM clasificacion";
$resultClasificacion = mysqli_query($link, $queryClasificacion);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CineMontevideo - Referencias</title>

        <!--Archivos CSS-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="referencias" class="publico">

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
                            <li><a href="catalogo.php" >Cátalogo</a></li>
                            <li><a href="complejos.php" >Complejos</a></li>
                            <li><a href="referencias.php" class="active">Referencias</a></li>
                            <li><a href="contacto.php">Contacto</a></li>
                            <li><form class="navbar-form navbar-right" action="buscar.php" role="search"><input type="text"  placeholder="Buscador" name="q"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></form></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>


        <h1 class="firstDiv text-center tituloAzul">Referencias</h1>

        <div class="container-fluid">
            <div class="row"  id="generos">
                <h2 class="text-center">Géneros</h2>
                <?php
                while ($generos = mysqli_fetch_array($resultGeneros)) {
                    echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 contenidoGeneros">';
                    echo '<img src="img/icons/generos/' . $generos['icoName'] . '.svg" alt="pistola" height="50" class="col-md-3">';
                    echo '<p class="col-md-8">' . $generos['genero'] . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row"  id="clasificacion">
                <h2 class="text-center">Clasificación</h2>
                <?php
                while ($clasificacion = mysqli_fetch_array($resultClasificacion)) {
                    echo '<div class="col-xs-12 contenidoClasificacion">';
                    echo '<p class="col-xs-1 text-center">' . $clasificacion['categoria'] . '</p>';
                    echo '<p class="col-xs-12 col-sm-8 col-md 6 ">' . $clasificacion['descripcion'] . '</p>';
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
    </body>
</html>
