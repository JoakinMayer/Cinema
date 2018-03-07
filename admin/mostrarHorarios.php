<?php

include '../conexion.php';

$idPelicula = $_GET['idPelicula'];

$queryHorarios = "SELECT * FROM horarios WHERE idPelicula=$idPelicula";
$resultHorarios = mysqli_query($link, $queryHorarios);

$cantidad = mysqli_num_rows($resultHorarios);

$comillas = "'";

if ($cantidad > 0) {
    while ($rowHorario = mysqli_fetch_array($resultHorarios)) {
        echo '<tr class="horas" id="' . $rowHorario["id"] . '">'
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
        . '<a  onclick="modificarHorario(' . $comillas . ''
        . $rowHorario["id"] . ''
        . '' . $comillas . ')"><i class = "material-icons">edit</i></a>'
        . '</td>'
        . '<td class="form-group">'
        . '<a onclick="eliminarHorario(' . $comillas . ''
        . $rowHorario["id"] . ''
        . '' . $comillas . ')"><i class = "material-icons">delete</i></a>'
        . '</td>'
        . '</tr>';
    }
}
?>