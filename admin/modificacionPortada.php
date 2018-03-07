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

        $idImg = $_GET['id'];

        $queryImagen = "SELECT * FROM imagenes WHERE id=$idImg";
        $resultImagen = mysqli_query($link, $queryImagen);

        $rowImagen = mysqli_fetch_array($resultImagen);

        $idPelicula = $rowImagen['idPelicula'];
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Administracion - Modificar Portada</title>

        <!--Iconos-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Archivos CSS-->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>



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
        <h1 class="tituloInsMod">Insertar Portada</h1>

        <div class="container">
            <form class="row form-horizontal" action="modificarPortadaImg.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="<?php echo $idImg ?>"
                       <div class="form-group col-sm-12  portada">
                    <label for="portada">Portada</label>
                    <div class="previewPortada">
                        <div id="imgPortada" style="background-image: url('../img/<?php echo $rowImagen['ruta'] ?>');"></div>
                        <p>Tamaño mínimo: 1366px x 630px</p>
                    </div>

                    <!--TEXTO ALTERNATIVO-->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="textoAltPortada">Texto Alternativo:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="textoAltPortada" placeholder="Ingrese el texto alternativo de la imagen" name="textoAltPortada"  value="<?php echo $rowImagen['alt'] ?>" required>
                        </div>
                    </div>

                    <!--TIPO-->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="tipo">Tipo:</label>
                        <div class="col-sm-8">
                            <select class="form-control " id="tipo" name="tipo" required>
                                <?php
                                if ($idPelicula == 0) {
                                    echo '<option  selected value="promo" >Promo</option>';
                                } else {
                                    echo '<option  selected value="pelicula" >Película</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--PELICULAS-->
                    <div class="form-group" id="selectPelicula" style="
                    <?php
                    if ($idPelicula <> 0) {
                        echo 'display: block';
                    } else {
                        echo 'display: none';
                    }
                    ?>">
                        <label class="control-label col-sm-2" for="pelicula">Pelicula:</label>
                        <div class="col-sm-8">
                            <select class="form-control " id="pelicula" name="pelicula" >
                                <?php
                                if ($idPelicula <> 0) {
                                    echo 'display: block';
                                    $queryPeliculas = "SELECT * FROM pelicula WHERE id='$idPelicula'";
                                    $resultPeliculas = mysqli_query($link, $queryPeliculas);
                                    $rowPeliculas = mysqli_fetch_array($resultPeliculas);
                                    echo "<option selected value='" . $idPelicula . "'>$rowPeliculas[titulo]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="portada" name="portada" required>
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-10 ">
                        <input type="submit" class="btn btn-info" name="guardar" value="Guardar">
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

</body>
</html>
