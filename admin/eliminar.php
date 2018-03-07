<?php

include '../conexion.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $queryEliminarImg = "SELECT * FROM imagenes WHERE idPelicula=$id";
    $resultEliminarImg = mysqli_query($link, $queryEliminarImg);

    while ($row = mysqli_fetch_array($resultEliminarImg)) {
        unlink("../img/$row[ruta]");
    }


    $queryEliminarPelicula = "DELETE FROM pelicula WHERE id=$id";
    $resultElimminarPelicula = mysqli_query($link, $queryEliminarPelicula);

    $queryEliminarImagenes = "DELETE FROM imagenes WHERE idPelicula=$id";
    $resultEliminarImagenes = mysqli_query($link, $queryEliminarImagenes);

    $queryEliminarHorarios = "DELETE FROM horarios WHERE idPelicula=$id";
    $resultEliminarHorarios = mysqli_query($link, $queryEliminarHorarios);


    header("location:peliculasCartel.php");
}
?>

