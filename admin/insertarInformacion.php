<?php

include "../conexion.php";

$titulo = $_GET['titulo'];
$tituloOriginal = $_GET['tituloOriginal'];
$ano = $_GET['ano'];
$clasificacion = $_GET['clasificacion'];
$genero1 = $_GET['genero1'];
if (isset($_GET['genero2'])) {
    $genero2 = $_GET['genero2'];
} else {
    $genero2 = "";
}
$puntuacion = $_GET['puntuacion'];
$idioma = $_GET['idioma'];
$duracion = $_GET['duracion'];
$pais = $_GET['pais'];
$sinopsis = $_GET['sinopsis'];
$direccion = $_GET['direccion'];
$elenco = $_GET['elenco'];
$sitioOficial = $_GET['sitioOficial'];
$sitioImdb = $_GET['sitioImdb'];
$trailer = $_GET['trailer'];
$fechaEstreno = $_GET['fechaEstreno'];

if (isset($_GET['guardar'])) {
    date_default_timezone_set("America/Montevideo");
    $lastUpdatae = date("Y_n_d_H_i_s");

    $queryInsertar = "INSERT INTO pelicula VALUES ('', '$titulo', '$tituloOriginal', '$sinopsis', '$ano', '$pais', '$duracion', '$genero1;$genero2', '$fechaEstreno', '$clasificacion', '$direccion', '$elenco', '$puntuacion', '$sitioOficial', '$sitioImdb', '$idioma', '$trailer', 'si', '$lastUpdatae')";
    $resultInsertar = mysqli_query($link, $queryInsertar);

    $id = mysqli_insert_id($link);

    if ($resultInsertar) {
        header("location:archivo.php");
    }
} elseif (isset($_GET['imagenes'])) {
    date_default_timezone_set("America/Montevideo");
    $lastUpdatae = date("Y_n_d_H_i_s");

    $queryInsertar = "INSERT INTO pelicula VALUES ('', '$titulo', '$tituloOriginal', '$sinopsis', '$ano', '$pais', '$duracion', '$genero1;$genero2', '$fechaEstreno', '$clasificacion', '$direccion', '$elenco', '$puntuacion', '$sitioOficial', '$sitioImdb', '$idioma', '$trailer', 'si', '$lastUpdatae')";
    $resultInsertar = mysqli_query($link, $queryInsertar);

    $id = mysqli_insert_id($link);

    if ($resultInsertar) {
        header("location:insertarPeliculaImg.php?id=$id");
    }
}


