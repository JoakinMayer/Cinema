<?php

include '../conexion.php';
date_default_timezone_set("America/Montevideo");
$id = $_GET['id'];
$lastUpdatae = date("Y_n_d_H_i_s");
$queryArchivar = "UPDATE pelicula SET archivado='si',modificacion='$lastUpdatae' WHERE id=$id";
$resultArchivar = mysqli_query($link, $queryArchivar);

if ($resultArchivar) {
    header("location:peliculasCartel.php");
};
?>