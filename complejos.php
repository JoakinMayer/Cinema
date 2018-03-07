<?php
include './conexion.php';

$queryComplejos = "SELECT * FROM complejos";
$resultComplejos = mysqli_query($link, $queryComplejos);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CineMontevideo - Complejos</title>

        <!--Archivos CSS-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="complejos" class="publico">

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
                            <li><a href="complejos.php" class="active">Complejos</a></li>
                            <li><a href="referencias.php">Referencias</a></li>
                            <li><a href="contacto.php">Contacto</a></li>
                            <li><form class="navbar-form navbar-right" action="buscar.php" role="search"><input type="text"  placeholder="Buscador" name="q"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></form></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>


        <h1 class="firstDiv text-center tituloAzul">Complejos</h1>

        <div class="container-fluid" id="salas">
            <?php
            while ($complejo = mysqli_fetch_array($resultComplejos)) {
                echo '<div class="row">';
                echo '<div class="row">';
                echo '<img src="img/complejos/' . $complejo['img'] . '" alt="fachada ' . $complejo['nombre'] . '" class="img-responsive col-md-6">';
                echo '<div class="col-md-6 datosCines">';
                echo '<h2>' . $complejo['nombre'] . '</h2>';
                echo '<p><strong>Dirección: </strong>' . $complejo['direccion'] . '</p>';
                echo '<p><strong>Teléfono: </strong>' . $complejo['telefono'] . '</p>';
                echo '<p><strong>Pantalla: </strong>' . $complejo['pantalla'] . '</p>';
                echo '<p><strong>Aire Aconficionado: </strong>' . $complejo['aireAcondicionado'] . '</p>';
                echo '<p><strong>Cantidad de butacas:</strong>' . $complejo['cantidadButacas'] . '</p>';
                echo '<a href="' . $complejo['sitioOficial'] . '">Sitio Oficial</a>';
                echo '<a href="buscar.php?q=' . $complejo['nombre'] . '" class="verPeliculas" >VER PELICULAS</a>';
                echo '<p class="text-right" onClick="display(this)">Ver más &Vee;</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="row masDatos">';
                echo '<div class="col-sm-4 evaluacionSala">';
                echo '<h3>Evaluacion de Sala</h3>';
                echo '<p>' . $complejo['evaluacionSala'] . '</p>';
                echo '</div>';
                echo '<div class="col-sm-8 precioEntradas">';
                echo '<h3>Precio de entradas</h3>';
                echo '<div class="row">';
                if (($complejo['sala2D']) <> "") {
                    echo '<div class="col-md-4">';
                    echo '<p><strong>SALA 2D</strong><br>' . $complejo['sala2D'] . '</p>';
                    echo '</div>';
                }
                if (($complejo['sala3D']) <> "") {
                    echo '<div class="col-md-4">';
                    echo '<p><strong>SALA 3D</strong><br>' . $complejo['sala3D'] . '</p>';
                    echo '</div>';
                }
                if (($complejo['sala4D']) <> "") {
                    echo '<div class="col-md-4">';
                    echo '<p><strong>SALA 4D</strong><br>' . $complejo['sala4D'] . '</p>';
                    echo '</div>';
                }
                if (($complejo['jubilados']) <> "") {
                    echo '<div class="col-md-4">';
                    echo '<p><strong>JUBILADOS</strong><br>' . $complejo['jubilados'] . '</p>';
                    echo '</div>';
                }if (($complejo['promociones']) <> "") {
                    echo '<div class="col-md-4">';
                    echo '<p><strong>OTROS</strong><br>' . $complejo['promociones'] . '</p>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
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
                    <div><form id="newsletter" ><input type="email"  placeholder="Correo Electrónico" name="email"><button type="submit" class="btn btn-info">Enviar</button></form>
                    </div>
                </div>
                <p class="text-center">Copyrigth &COPY; 2017 | Joaquín Mayer</p>
            </div>
        </div>

        <!--Archivos JavaScript-->
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jsComplejos.js" type="text/javascript"></script>
    </body>
</html>
