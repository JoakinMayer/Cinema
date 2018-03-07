<?php

include "../conexion.php";

$id = $_POST['id'];

$imgPoster = $_FILES['poster']['name'];
$ubicacionTmpPoster = $_FILES['poster']['tmp_name'];
$altPoster = $_POST['textoAltPoster'];

$nombrePoster = $id . "poster.jpg";
$subida = date("Y_n_d_H_i_s");
move_uploaded_file($ubicacionTmpPoster, "../img/" . $nombrePoster);

$queryInsertarPoster = "INSERT INTO imagenes VALUES('', '$id', '$nombrePoster','$altPoster','si','no','no','','$subida')";
$resultInsertarPoster = mysqli_query($link, $queryInsertarPoster);

date_default_timezone_set("America/Montevideo");

$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$id";
$resultUpdate = mysqli_query($link, $queryUpdate);

if (!empty($_FILES['portada']['name'])) {
    $imgPortada = $_FILES['portada']['name'];
    $ubicacionTmpPortada = $_FILES['portada']['tmp_name'];
    $altPortada = $_POST['textoAltPortada'];

    $nombrePortada = $id . "portada.jpg";

    move_uploaded_file($ubicacionTmpPortada, "../img/" . $nombrePortada);

    $queryPosicionPortada = "SELECT * FROM imagenes WHERE portada='si' ORDER BY posicionSlider DESC LIMIT 1 ";
    $resultPosicionPortada = mysqli_query($link, $queryPosicionPortada);

    $cantidadPosicionPortada = mysqli_num_rows($resultPosicionPortada);
    $rowPosicionPortada = mysqli_fetch_array($resultPosicionPortada);


    $queryInsertarPortada = "INSERT INTO imagenes VALUES('', '$id', '$nombrePortada','$altPortada','no','si','no','0','$subida')";
    $resultInsertarPortada = mysqli_query($link, $queryInsertarPortada);
}

if (!empty($_POST['guardar'])) {
    header("location:archivo.php");
} elseif (isset($_POST['horarios'])) {
    header("location:insertarPeliculaHora.php?id=$id");
}

