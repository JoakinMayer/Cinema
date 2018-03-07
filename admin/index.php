<?php
include '../conexion.php';

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Administracion - Inicio de Sesion</title>

        <!--Archivos CSS-->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="inicioSesion">

        <div class="container">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6 text-left" id="contenedorFrom">
                    <div >
                        <h1 class="text-center">Cine<strong>Montevideo</strong></h1>
                        <p class="text-center">Sistema de Administración</p>
                        <form action="validacionUsuario.php" method="post">
                            <!--USUARIO-->
                            <div class="form-group">
                                <label class="control-label " for="usuario">Usuario:</label>
                                <input type="text" class="form-control" id="usuario" placeholder="Ingrese el usuario" name="usuario" required>
                            </div>

                            <!--CONTRASEÑA-->
                            <div class="form-group">
                                <label class="control-label " for="usuario">Contraseña:</label>
                                <input type="password" class="form-control" id="contrasena" placeholder="Ingrese la contraseña" name="contrasena" required>
                            </div>
                            <input type="submit" class="btn btn-info btn-lg col-sm-12 " value="Ingresar">
                        </form> 
                    </div>

                </div>
            </div>
        </div>

        <!--Archivos JavaScript-->
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>

        <script type="text/javascript">

<?php
if ($mensaje == "incorrecto") {
    echo ' $(document).ready(alert("';
    echo "Usuario o contraseña incorrectos";
    echo '"));';
} elseif ($mensaje == 'iniciarSesion') {
    echo ' $(document).ready(alert("';
    echo "Tienes que iniciar sesion";
    echo '"));';
} elseif ($mensaje == 'tiempoAgotado') {
    echo ' $(document).ready(alert("';
    echo "Tiempo agotado";
    echo '"));';
}elseif ($mensaje == 'cerrado') {
    echo ' $(document).ready(alert("';
    echo "Se ha cerrado la sesion";
    echo '"));';
}
?>
        </script>

    </body>
</html>
