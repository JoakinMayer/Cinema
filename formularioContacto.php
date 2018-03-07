<?php

$destinatario = "cine@montevideo.uy";

$asunto = $_GET['tema'];

if ($asunto === "otro") {
    $asuntoOtro = $_GET['asunto'];
    $asunto = $asunto . ' - ' . $asuntoOtro;
}

$mensaje = "Nombre:$_GET[nombre] . \n";
$mensaje .= "Correo Electrónico:$_GET[email] . \n";
$mensaje .= "Mensaje:$_GET[mensaje] . \n";

$enviado = mail($destinatario, $asunto, $mensaje);

if ($enviado) {
    echo "El mensaje fue enviado";
    header("location:contacto.php?mensaje=correcto");
} else {
    echo "No se pudo enviar su mensaje";
    header("location:contacto.php?mensaje=incorrecto");
}
