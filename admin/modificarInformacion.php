<?php

include "../conexion.php";
$id = $_GET['id'];
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

date_default_timezone_set("America/Montevideo");
$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$id";
$resultUpdate = mysqli_query($link, $queryUpdate);

if (isset($_GET['guardar'])) {
    $queryModificar = "UPDATE pelicula SET titulo='$titulo', tituloOriginal='$tituloOriginal', sinopsis='$sinopsis', ano=$ano, pais='$pais', duracion=$duracion, genero='$genero1;$genero2', fechaEstreno='$fechaEstreno', clasificacion='$clasificacion', direccion='$direccion', elenco='$elenco', puntuacion='$puntuacion', idioma='$idioma', sitioOficial='$sitioOficial', sitioImdb='$sitioImdb', trailer='$trailer' WHERE id=$id";
    $resultModificar = mysqli_query($link, $queryModificar);

    if ($resultModificar) {
        header("location:peliculasCartel.php");
    }
} elseif (isset($_GET['imagenes'])) {
    $queryModificar = "UPDATE pelicula SET titulo='$titulo', tituloOriginal='$tituloOriginal', sinopsis='$sinopsis', ano=$ano, pais='$pais', duracion=$duracion, genero='$genero', fechaEstreno='$fechaEstreno', clasificacion='$clasificacion', direccion='$direccion', elenco='$elenco', puntuacion='$puntuacion', sitioOficial='$sitioOficial', sitioImdb='$sitioImdb', trailer='$trailer' WHERE id=$id";
    $resultModificar = mysqli_query($link, $queryModificar);

    if ($resultModificar) {
        header("location:modificarPeliculaImg.php?id=$id");
    }
}


