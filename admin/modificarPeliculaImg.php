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

        $id = $_GET['id'];

        $queryPoster = "SELECT * FROM imagenes WHERE idPelicula=$id AND poster='si'";
        $resultPoster = mysqli_query($link, $queryPoster);
        $rowPoster = mysqli_fetch_array($resultPoster);


        $queryPortada = "SELECT * FROM imagenes WHERE idPelicula=$id AND portada='si'";
        $resultPortada = mysqli_query($link, $queryPortada);
        $rowPortada = mysqli_fetch_array($resultPortada);
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Administracion - Insertar Pelicula - Imagenes</title>

        <!--Iconos-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Archivos CSS-->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>

        <style>
            #imgPoster{
                background-image: url("../img/<?php echo $rowPoster['ruta'] ?>");
            }
            #imgPortada{
                background-image: url("../img/<?php echo $rowPortada['ruta'] ?>");
            }
        </style>

    </head>
    <body class="insertarImagenes">
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
                            <li><a href="portada.php">Portada</a></li>
                            <li><a href="cerrarSesion.php" class="sinHover"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <h1 class="tituloInsMod">Insertar Película</h1>
        <div class="container-fluid informacion">
            <div class="row bloqueInImHo">
                <div class="col-xs-4">
                    <h2 class="text-center ">Información</h2>
                </div>
                <div class="col-xs-4">
                    <h3 class="text-center ">Imágenes</h3>
                </div>
                <div class="col-xs-4">
                    <h3 class="text-center ">Horarios</h3>
                </div>
            </div>
        </div>

        <div class="container">
            <form class="row form-horizontal" action="modificarImagenes.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                <div class="form-group col-sm-5  poster">
                    <label for="poster">Póster</label>
                    <div class="previewPoster">
                        <div id="imgPoster"></div>
                        <p>Tamaño mínimo: 513px x 762px</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="textoAltPoster">Texto Alternativo:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="textoAltPoster" placeholder="Ingrese el texto alternativo de la imagen" name="textoAltPoster" >
                        </div>
                    </div>
                    <input type="file" class="form-control-file" id="poster" name="poster" >
                </div>
                <div class="form-group col-sm-7  portada">
                    <label for="portada">Portada (Opcional)</label>
                    <div class="previewPortada">
                        <div id="imgPortada"></div>
                        <p>Tamaño mínimo: 1366px x 630px</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="textoAltPortada">Texto Alternativo:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="textoAltPortada" placeholder="Ingrese el texto alternativo de la imagen" name="textoAltPortada">
                        </div>
                    </div>
                    <input type="file" class="form-control-file" id="portada" name="portada">
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-9 ">
                        <input type="submit" class="btn btn-info" name="guardar" value="Guardar">
                        <input type="submit" class="btn btn-info" name="horarios" value="Horarios >">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Archivos JavaScript-->
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            $("#portada").on("change", function ()
            {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        $("#imgPortada").css("background-image", "url(" + this.result + ")");
                    };
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $("#poster").on("change", function ()
            {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        $("#imgPoster").css("background-image", "url(" + this.result + ")");
                    };
                }
            });
        });
    </script>
</body>
</html>
