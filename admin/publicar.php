<?php

include '../conexion.php';

$id = $_GET['id'];

date_default_timezone_set("America/Montevideo");

$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$id";
$resultUpdate = mysqli_query($link, $queryUpdate);

if (isset($_GET['guardar'])) {
    $queryHorarios = "SELECT * FROM horarios where idPelicula=$id";
    $resultHorarios = mysqli_query($link, $queryHorarios);

    $cantidadHorarios = mysqli_num_rows($resultHorarios);

    if ($cantidadHorarios > 0) {
        header("location:peliculasCartel.php");
    } else {
        $queryModificar = "UPDATE pelicula SET archivado='si' WHERE id=$id";
        $resultModificar = mysqli_query($link, $queryModificar);
        header("location:archivo.php");
    }
} else {

    $queryHorarios = "SELECT * FROM horarios where idPelicula=$id";
    $resultHorarios = mysqli_query($link, $queryHorarios);

    $cantidadHorarios = mysqli_num_rows($resultHorarios);

    if ($cantidadHorarios > 0) {
        $queryModificar = "UPDATE pelicula SET archivado='no' WHERE id=$id";
        $resultModificar = mysqli_query($link, $queryModificar);
        header("location:peliculasCartel.php");
    } else {
        $queryModificar = "UPDATE pelicula SET archivado='si' WHERE id=$id";
        $resultModificar = mysqli_query($link, $queryModificar);
        header("location:archivo.php");
    }
}