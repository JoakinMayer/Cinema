<?php

include '../conexion.php';

$idImg = $_GET["id"];

//CANTIDAD DE SLIDER
$queryCantidadSlider = "SELECT * FROM imagenes WHERE portada='si' AND posicionSlider<>'0' ORDER BY slider ASC";
$resultCantidadSlider = mysqli_query($link, $queryCantidadSlider);
$cantidadSlider = mysqli_num_rows($resultCantidadSlider);

$queryPosicion = "SELECT * FROM imagenes WHERE id=$idImg";
$resultPosicion = mysqli_query($link, $queryPosicion);
$rowPosicion = mysqli_fetch_array($resultPosicion);
$posicion = $rowPosicion['posicionSlider'];


for ($i = $posicion + 1; $i <= $cantidadSlider; $i++) {
    $queryPosiciones = "SELECT * FROM imagenes WHERE posicionSlider='$i'";
    $resultPosiciones = mysqli_query($link, $queryPosiciones);
    $rowPosiciones = mysqli_fetch_array($resultPosiciones);

    $idPortada = $rowPosiciones['id'];
    $posicionSlider = $i - 1;
    $queryModificarPosicion = "UPDATE imagenes SET posicionSlider='$posicionSlider'WHERE id=$idPortada";
    $resultModificarPosicion = mysqli_query($link, $queryModificarPosicion);
}

$queryEliminarImagen = "DELETE FROM imagenes WHERE id=$idImg";
$resultEliminarImagen = mysqli_query($link, $queryEliminarImagen);

if ($resultEliminarImagen) {
    header("location:portada.php");
}
