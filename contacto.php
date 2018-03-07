<?php
include './conexion.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CineMontevideo - Contacto</title>

        <!--Archivos CSS-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="contacto" class="publico">

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
                            <li><a href="referencias.php" >Referencias</a></li>
                            <li><a href="contacto.php" class="active">Contacto</a></li>
                            <li><form class="navbar-form navbar-right" action="buscar.php" role="search"><input type="text"  placeholder="Buscador" name="q"><button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></form></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>


        <h1 class="firstDiv text-center tituloAzul">Contacto</h1>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6 text-left" id="contenedorFrom">
                    <div >
                        <form action="formularioContacto.php" method="get">

                            <?php
                            if (isset($_GET['mensaje'])) {
                                $mensaje = $_GET['mensaje'];
                                if ($mensaje === "correcto") {
                                    echo '<p class="text-center">Se ha mandado correctamente su consulta</p>';
                                } elseif ($mensaje === 'incorrecto') {
                                    echo '<p class="text-center">No se ha podidio mandar su consulta</p>';
                                }
                            }
                            ?>

                            <!--NOMBRE-->
                            <div class="form-group">
                                <label class="control-label " for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" name="nombre" required>
                            </div>

                            <!--CORREO ELECTRONICO-->
                            <div class="form-group">
                                <label class="control-label " for="email">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="email" placeholder="Ingrese el correo electrónico" name="email" required>
                            </div>

                            <!--TEMA-->
                            <div class="form-group">
                                <label class="control-label " for="nombre">Tema:</label>
                                <select class="form-control " id="tema" name="tema" required>
                                    <option value="horarios">Horarios</option>
                                    <option value="peliculas">Pelicula</option>
                                    <option value="complejo">Complejo</option>
                                    <option value="promociones">Promociones</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            <!--MENSAJE-->
                            <div class="form-group">
                                <label class="control-label " for="email">Mensaje:</label>
                                <textarea class="form-control" rows="10" id="mensaje" name="mensaje" placeholder="Ingrese el mensaje" required></textarea>
                            </div>

                            <input type="submit" class="btn btn-info btn-lg col-sm-4 " value="Enviar">
                            <input type="reset" class="btn btn-info btn-lg col-sm-4 " value="Borrar">
                        </form> 
                    </div>

                </div>
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
        <script src="js/jsContacto.js" type="text/javascript"></script>
    </body>
</html>
