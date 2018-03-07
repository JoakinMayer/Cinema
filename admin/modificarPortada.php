<?php

include '../conexion.php';

$id = $_GET['id'];

$queryPortada = "SELECT * FROM imagenes WHERE id=$id AND portada='si'";
$resultPortada = mysqli_query($link, $queryPortada);

$rowPortada = mysqli_fetch_array($resultPortada);

$idPelicula = $rowPortada['idPelicula'];

date_default_timezone_set("America/Montevideo");

$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$id";
$resultUpdate = mysqli_query($link, $queryUpdate);


$queryCantidadSlider = "SELECT * FROM imagenes WHERE portada='si' AND posicionSlider<>'0' ORDER BY slider ASC";
$resultCantidadSlider = mysqli_query($link, $queryCantidadSlider);
$cantidadSlider = mysqli_num_rows($resultCantidadSlider);

if ($rowPortada['slider'] == 'si') {

    $queryPosicion = "SELECT * FROM imagenes WHERE id='$id'";
    $resultPosicion = mysqli_query($link, $queryPosicion);
    $rowPosicion = mysqli_fetch_array($resultPosicion);
    $posicion = $rowPosicion['posicionSlider'];

    $query = "UPDATE imagenes SET slider='no', posicionSlider='0' WHERE id=$id";
    $result = mysqli_query($link, $query);

    for ($i = $posicion + 1; $i <= $cantidadSlider; $i++) {
        $queryPosiciones = "SELECT * FROM imagenes WHERE posicionSlider='$i'";
        $resultPosiciones = mysqli_query($link, $queryPosiciones);
        $rowPosiciones = mysqli_fetch_array($resultPosiciones);

        $idPortada = $rowPosiciones['id'];
        $posicionSlider = $i - 1;
        $queryModificarPosicion = "UPDATE imagenes SET posicionSlider='$posicionSlider'WHERE id=$idPortada";
        $resultModificarPosicion = mysqli_query($link, $queryModificarPosicion);
    }

    if ($result) {
        echo $rowPortada['slider'];
    }
} else {

    $cantidadSlider = $cantidadSlider + 1;

    $query = "UPDATE imagenes SET slider='si', posicionSlider='$cantidadSlider' WHERE id=$id";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo $rowPortada['slider'];
    }
}

