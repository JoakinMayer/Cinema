<?php

include "../conexion.php";

$idImg = $_POST['id'];

$tipo = $_POST['tipo'];

date_default_timezone_set("America/Montevideo");
$subida = date("Y_n_d_H_i_s");

$queryEliminarImg = "SELECT * FROM imagenes WHERE id=$idImg";
$resultEliminarImg = mysqli_query($link, $queryEliminarImg);

while ($row = mysqli_fetch_array($resultEliminarImg)) {
    unlink("../img/$row[ruta]");
}

$queryEliminarPoster = "DELETE FROM imagenes WHERE id=$idImg";
$resultEliminarPoster = mysqli_query($link, $queryEliminarPoster);

if ($tipo == 'promo') {

    $imgPromo = $_FILES['portada']['name'];
    $ubicacionTmpPromo = $_FILES['portada']['tmp_name'];
    $altPromo = $_POST['textoAltPortada'];

    $nombrePromo = $subida . "promo.jpg";

    move_uploaded_file($ubicacionTmpPromo, "../img/" . $nombrePromo);

    $queryPosicionPortada = "SELECT * FROM imagenes WHERE portada='si' ORDER BY posicionSlider DESC LIMIT 1 ";
    $resultPosicionPortada = mysqli_query($link, $queryPosicionPortada);

    $cantidadPosicionPortada = mysqli_num_rows($resultPosicionPortada);
    $rowPosicionPortada = mysqli_fetch_array($resultPosicionPortada);

    $queryInsertarPortada = "INSERT INTO imagenes VALUES('', '', '$nombrePromo','$altPromo','no','si','no','0','$subida')";
    $resultInsertarPortada = mysqli_query($link, $queryInsertarPortada);
} else {
    $idPelicula = $_POST['pelicula'];

    $imgPortada = $_FILES['portada']['name'];
    $ubicacionTmpPortada = $_FILES['portada']['tmp_name'];
    $altPortada = $_POST['textoAltPortada'];

    $nombrePortada = $idPelicula . "portada.jpg";

    move_uploaded_file($ubicacionTmpPortada, "../img/" . $nombrePortada);

    $queryPosicionPortada = "SELECT * FROM imagenes WHERE portada='si' ORDER BY posicionSlider DESC LIMIT 1 ";
    $resultPosicionPortada = mysqli_query($link, $queryPosicionPortada);

    $cantidadPosicionPortada = mysqli_num_rows($resultPosicionPortada);
    $rowPosicionPortada = mysqli_fetch_array($resultPosicionPortada);


    $queryInsertarPortada = "INSERT INTO imagenes VALUES('', '$idPelicula', '$nombrePortada','$altPortada','no','si','no','0','$subida')";
    $resultInsertarPortada = mysqli_query($link, $queryInsertarPortada);
}
header("location:portada.php");
