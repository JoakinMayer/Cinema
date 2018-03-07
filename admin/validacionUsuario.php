<?php

include '../conexion.php';

$user = $_POST['usuario'];
$pass = $_POST['contrasena'];

$queryAdmin = "SELECT * FROM administradores WHERE user='$user' AND pass='$pass'";
$resultAdmin = mysqli_query($link, $queryAdmin);

$cantidadAdmin = mysqli_num_rows($resultAdmin);

if ($cantidadAdmin == 0){
    header("location:index.php?mensaje=incorrecto");
}  else {
    $usuario = mysqli_fetch_array($resultAdmin);
    $nombre = $usuario['user'];
    //Se inicia una nueva sesion
    session_start();
    //Se crean las variables de esta sesion.
    $_SESSION['login']="OK";
    $_SESSION['usuario']=$nombre;
    $fechaGuardada=date("Y-n-d H:i:s");
    $_SESSION['fechaGuardada']=$fechaGuardada;

    header("location:peliculasCartel.php");
}