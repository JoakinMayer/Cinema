<?php

include "../conexion.php";

$idPelicula = $_GET['idPelicula'];
$complejo = $_GET['complejo'];
$tecnologia = $_GET['tecnologia'];
$idioma = $_GET['idioma'];
$horario = $_GET['horario'];
$dias = $_GET['dias'];


$queryHorarios = "INSERT INTO horarios VALUES ('', '$idPelicula', '$complejo', '$tecnologia', '$idioma', '$horario', '$dias')";
$resultHorarios = mysqli_query($link, $queryHorarios);

$id = mysqli_insert_id($link);

$queryInsertado = "SELECT * FROM horarios WHERE id=$id";
$resultInsertado = mysqli_query($link, $queryInsertado);

date_default_timezone_set("America/Montevideo");

$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$idPelicula";
$resultUpdate = mysqli_query($link, $queryUpdate);

$cantidad = mysqli_num_rows($resultInsertado);
if ($resultInsertado) {
    $rowHorario = mysqli_fetch_array($resultInsertado);
    echo '<tr class="horas" id="'.$rowHorario["id"].'">'
    . '<td class="form-group col-sm-3">'
    . $rowHorario["complejo"] . ''
    . '</td>'
    . '<td class="form-group col-sm-1">'
    . $rowHorario["tecnologia"] . ''
    . '</td>'
    . '<td class="form-group col-sm-1">'
    . $rowHorario["idioma"] . ''
    . '</td>'
    . '<td class="form-group col-sm-4">'
    . $rowHorario["horario"] . ''
    . '</td>'
    . '<td class="form-group col-sm-3">'
    . $rowHorario["dias"] . ''
    . '</td>'
    . '<td class="form-group">'
    . '<a onclick="modificarHorario('
    . $rowHorario["id"] . ''
    . ')"><i class = "material-icons">edit</i></a>'
    . '</td>'
    . '<td class="form-group">'
    . '<a onclick="eliminarHorario('
    . $rowHorario["id"] . ''
    . ')"><i class = "material-icons">delete</i></a>'
    . '</td>'
    . '</tr>';
}
?>