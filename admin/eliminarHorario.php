<?php

include '../conexion.php';

$idEliminar = $_GET['id'];

$queryEliminar = "DELETE FROM horarios WHERE id=$idEliminar";
$resultElimminar = mysqli_query($link, $queryEliminar);

date_default_timezone_set("America/Montevideo");

$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$idEliminar";
$resultUpdate = mysqli_query($link, $queryUpdate);
