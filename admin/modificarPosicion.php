<?php

include '../conexion.php';

//VARIABLES DE LA IMAGEN
$idImagen = $_GET['id'];
$posicion = $_GET['posicion'];
$idPelicula = $_GET['idPelicula'];
$posicionActual = $_GET['posicionActual'];

if ($idPelicula <> 0) {
    //ULTIMA MODIFICACION
    date_default_timezone_set("America/Montevideo");
    $lastUpdatae = date("Y_n_d_H_i_s");
    $queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$idPelicula";
    $resultUpdate = mysqli_query($link, $queryUpdate);
}


//CANTIDAD DE IMAGENES PARA LA PORTADA
$queryCantidadSlider = "SELECT * FROM imagenes WHERE portada='si' AND posicionSlider<>'0' ORDER BY slider ASC";
$resultCantidadSlider = mysqli_query($link, $queryCantidadSlider);
$cantidadSlider = mysqli_num_rows($resultCantidadSlider);

if ($posicionActual < $posicion) {

    for ($i = $posicionActual + 1; $i <= $posicion; $i++) {
//        CONSULTO LAS POSICIONES DE LAS PORTADAS
        $queryCambioPosicion = "SELECT * FROM imagenes WHERE posicionSlider='$i'";
        $resultCambioPosicion = mysqli_query($link, $queryCambioPosicion);
        $rowCambioPosicion = mysqli_fetch_array($resultCambioPosicion);

//        Selecciono el id de la imagen a cambiar la posicion
        $idCambio = $rowCambioPosicion['id'];
//        Especifico la posicion que va
        $posisionCambiar = $i - 1;
//        Actualizo la posicion
        $queryPosicionSlider = "UPDATE imagenes SET posicionSlider='$posisionCambiar' WHERE id=$idCambio";
        $resultPosicionSlider = mysqli_query($link, $queryPosicionSlider);
    }

    //CAMBIA A LA POSICION SELECCIONADA
    $query = "UPDATE imagenes SET posicionSlider='$posicion' WHERE id=$idImagen";
    $result = mysqli_query($link, $query);
} elseif ($posicionActual > $posicion) {

    for ($i = $posicionActual - 1; $i >= $posicion; $i--) {
//        CONSULTO LAS POSICIONES DE LAS PORTADAS
        $queryCambioPosicion = "SELECT * FROM imagenes WHERE posicionSlider='$i'";
        $resultCambioPosicion = mysqli_query($link, $queryCambioPosicion);
        $rowCambioPosicion = mysqli_fetch_array($resultCambioPosicion);

//        Selecciono el id de la imagen a cambiar la posicion
        $idCambio = $rowCambioPosicion['id'];
//        Especifico la posicion que va
        $posicionCambiar = $i + 1;
//        Actualizo la posicion
        $queryPosicionSlider = "UPDATE imagenes SET posicionSlider='$posicionCambiar' WHERE id=$idCambio";
        $resultPosicionSlider = mysqli_query($link, $queryPosicionSlider);
    }

    //CAMBIA A LA POSICION SELECCIONADA
    $query = "UPDATE imagenes SET posicionSlider='$posicion' WHERE id=$idImagen";
    $result = mysqli_query($link, $query);
}







