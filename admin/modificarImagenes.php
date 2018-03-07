<?php

include "../conexion.php";

$id = $_POST['id'];
if (!empty($_FILES['poster']['name'])) {
    $queryEliminarImg = "SELECT * FROM imagenes WHERE idPelicula=$id AND poster='si'";
    $resultEliminarImg = mysqli_query($link, $queryEliminarImg);

    while ($row = mysqli_fetch_array($resultEliminarImg)) {
        unlink("../img/$row[ruta]");
    }

    $queryEliminarPoster = "DELETE FROM imagenes WHERE idPelicula=$id AND poster='si'";
    $resultEliminarPoster = mysqli_query($link, $queryEliminarPoster);

    $imgPoster = $_FILES['poster']['name'];
    $ubicacionTmpPoster = $_FILES['poster']['tmp_name'];
    $altPoster = $_POST['textoAltPoster'];

    $nombrePoster = $id . "poster.jpg";

    move_uploaded_file($ubicacionTmpPoster, "../img/" . $nombrePoster);

    $subida = date("Y_n_d_H_i_s");

    $queryInsertarPoster = "INSERT INTO imagenes VALUES('', '$id', '$nombrePoster','$altPoster','si','no','no','','$subida')";
    $resultInsertarPoster = mysqli_query($link, $queryInsertarPoster);
}
if (!empty($_FILES['portada']['name'])) {

    $querySelPortada = "SELECT * FROM imagenes WHERE idPelicula=$id AND portada='si'";
    $resultSelPortada = mysqli_query($link, $querySelPortada);

    while ($row = mysqli_fetch_array($resultSelPortada)) {
        unlink("../img/$row[ruta]");
    }

    $queryEliminarImg = "DELETE FROM imagenes WHERE idPelicula=$id AND portada='si'";
    $resultEliminarImg = mysqli_query($link, $queryEliminarImg);


    $imgPortada = $_FILES['portada']['name'];
    $ubicacionTmpPortada = $_FILES['portada']['tmp_name'];
    $altPortada = $_POST['textoAltPortada'];

    $nombrePortada = $id . "portada.jpg";

    move_uploaded_file($ubicacionTmpPortada, "../img/" . $nombrePortada);

    $subida = date("Y_n_d_H_i_s");

    $queryPosicionPortada = "SELECT * FROM imagenes WHERE portada='si' ORDER BY posicionSlider DESC LIMIT 1 ";
    $resultPosicionPortada = mysqli_query($link, $queryPosicionPortada);

    $cantidadPosicionPortada = mysqli_num_rows($resultPosicionPortada);
    $rowPosicionPortada = mysqli_fetch_array($resultPosicionPortada);


    $queryInsertarPortada = "INSERT INTO imagenes VALUES('', '$id', '$nombrePortada','$altPortada','no','si','no','0','$subida')";
    $resultInsertarPortada = mysqli_query($link, $queryInsertarPortada);
}
date_default_timezone_set("America/Montevideo");
$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$id";
$resultUpdate = mysqli_query($link, $queryUpdate);

if (isset($_POST['guardar'])) {
    header("location:peliculasCartel.php");
} elseif (isset($_POST['horarios'])) {
    header("location:modificarPeliculaHora.php?id=$id");
}

