<?php
include "../conexion.php";

$id = $_GET['id'];

//COMPLEJOS
$queryComplejos = "SELECT * FROM complejos ORDER BY nombre";
$resultComplejos = mysqli_query($link, $queryComplejos);
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



    </head>
    <body class="insertarHorarios">
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
            <form action="publicar.php" method="get">
                <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Complejo</th>
                            <th>Tecnología</th>
                            <th>Idioma</th>
                            <th>Horario</th>
                            <th>Días</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <div id="horarios">

                    </div>
                    <tr class="formHora">
                        <td class="form-group col-sm-3">
                            <select class="form-control" id="complejo" name="complejo" required>
                                <?php
                                while ($rowComplejos = mysqli_fetch_array($resultComplejos)) {
                                    echo "<option value='$rowComplejos[nombre]'>$rowComplejos[nombre]</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td class="form-group col-sm-1">
                            <select class="form-control " id="tecnologia" name="tecnologia" required>
                                <option value="2D">2D</option>
                                <option value="3D">3D</option>
                                <option value="4D">4D</option>
                            </select>
                        </td>
                        <td class="form-group col-sm-1">
                            <select class="form-control " id="idioma" name="idioma" required>
                                <option value="ESP">ESP</option>
                                <option value="SUB">SUB</option>
                            </select>
                        </td>
                        <td class="form-group col-sm-4">
                            <input type="text" class="form-control" id="horas" name="horas" placeholder="Ingrese las horas con formato (HH:MM) separadas por ;"
                        </td>
                        <td class="form-group col-sm-4">
                            <label class="control-label" for="Lu">Lu</label>
                            <input type="checkbox"  id="Lu" name="dias" value="Mon">
                            <label class="control-label" for="Ma">Ma</label>
                            <input type="checkbox"  id="Ma" name="dias" value="Tue">
                            <label class="control-label" for="Mi">Mi</label>
                            <input type="checkbox"  id="Mi" name="dias" value="Wed">
                            <label class="control-label" for="Ju">Ju</label>
                            <input type="checkbox"  id="Ju" name="dias" value="Thu">
                            <label class="control-label" for="Vi">Vi</label>
                            <input type="checkbox"  id="Vi" name="dias" value="Fri">
                            <label class="control-label" for="Sa">Sa</label>
                            <input type="checkbox"  id="Sa" name="dias" value="Sat">
                            <label class="control-label" for="Do">Do</label>
                            <input type="checkbox"  id="Do" name="dias" value="Sun">
                        </td>
                        <td></td>
                        <td class="text-center"><a href="" onclick="agregarHorario()"><i class="material-icons">check_circle</i></a></td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">        
                    <div class="col-sm-offset-9 ">
                        <input type="submit" class="btn btn-info" name="guardar" value="Guardar">
                        <input type="submit" class="btn btn-info" name="publicar" value="Publicar">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Archivos JavaScript-->
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/jsHorario.js" type="text/javascript"></script>


</body>
</html>
