<?php

include './conexion.php';

$complejoSeleccionado = $_GET['complejo'];
$idPelicula = $_GET['idPelicula'];

$queryComplejos = "SELECT DISTINCT * FROM horarios WHERE idPelicula=$idPelicula AND complejo='$complejoSeleccionado' LIMIT 1";
$resultComplejos = mysqli_query($link, $queryComplejos);

while ($complejos = mysqli_fetch_array($resultComplejos)) {

    $complejo = $complejos['complejo'];
    echo '<div class="col-xs-12 contenedorComplejo">';
    echo '<p class="col-xs-6">' . $complejo . '</p>';
    echo '<p class="col-xs-6 text-right precio" onClick="display(this)">Precio de Entradas <span>&vee;</span></p>';

    echo '<div class="row preciosComplejo" >';

    $queryPrecios = "SELECT * FROM complejos WHERE nombre='$complejo'";
    $resultPrecios = mysqli_query($link, $queryPrecios);

    while ($precioComplejo = mysqli_fetch_array($resultPrecios)) {
        if (($precioComplejo['sala2D']) <> "") {
            echo '<div class="col-md-4">';
            echo '<p><strong>SALA 2D</strong><br>' . $precioComplejo['sala2D'] . '</p>';
            echo '</div>';
        }
        if (($precioComplejo['sala3D']) <> "") {
            echo '<div class="col-md-4">';
            echo '<p><strong>SALA 3D</strong><br>' . $precioComplejo['sala3D'] . '</p>';
            echo '</div>';
        }
        if (($precioComplejo['sala4D']) <> "") {
            echo '<div class="col-md-4">';
            echo '<p><strong>SALA 4D</strong><br>' . $precioComplejo['sala4D'] . '</p>';
            echo '</div>';
        }
        if (($precioComplejo['jubilados']) <> "") {
            echo '<div class="col-md-4">';
            echo '<p><strong>JUBILADOS</strong><br>' . $precioComplejo['jubilados'] . '</p>';
            echo '</div>';
        }if (($precioComplejo['promociones']) <> "") {
            echo '<div class="col-md-4">';
            echo '<p><strong>OTROS</strong><br>' . $precioComplejo['promociones'] . '</p>';
            echo '</div>';
        }
    }

    echo '</div>';

    echo '</div>';

    $queryHorarioComplejoESP = "SELECT * FROM horarios WHERE complejo='$complejo' AND idPelicula=$idPelicula AND idioma='ESP'";
    $resultHorarioComplejoESP = mysqli_query($link, $queryHorarioComplejoESP);

    while ($rowHorarioComplejoESP = mysqli_fetch_array($resultHorarioComplejoESP)) {
        echo '<div class="col-xs-12 contenedorHoras">';
        echo '<p class="col-md-4">(ESP) Doblada al Español </p>';

        echo '<p class = "col-md-4">';
        $horariosPelicula = $rowHorarioComplejoESP['horario'];
        $horarioPelicula = explode(";", $horariosPelicula);

        $cantidadHoras = count($horarioPelicula);
        for ($i = 0; $i < $cantidadHoras; $i++) {
            $horario = $horarioPelicula[$i];
            echo $horario;
            echo '<span>';
            echo $rowHorarioComplejoESP['tecnologia'];
            echo '</span>';
        }
        echo '</p>';

        echo '<p class="col-md-4">';
        $diasPelicula = $rowHorarioComplejoESP['dias'];
        $diaPelicula = explode(",", $diasPelicula);
        $cantidadDias = count($diaPelicula);

        for ($i = 0; $i < $cantidadDias; $i++) {
            $dia = $diaPelicula[$i];
            if ($dia == "Mon") {
                echo ' Lun ';
            } elseif ($dia == "Tue") {
                echo ' Mar ';
            } elseif ($dia == "Wed") {
                echo ' Mie ';
            } elseif ($dia == "Thu") {
                echo ' Jue ';
            } elseif ($dia == "Fri") {
                echo ' Vie ';
            } elseif ($dia == "Sat") {
                echo ' Sáb ';
            } elseif ($dia == "Sun") {
                echo ' Dom ';
            }
        }

        echo '</p>';


        echo '</div>';
    }

    $queryHorarioComplejoSUB = "SELECT * FROM horarios WHERE complejo='$complejo' AND idPelicula=$idPelicula AND idioma='SUB'";
    $resultHorarioComplejoSUB = mysqli_query($link, $queryHorarioComplejoSUB);

    while ($rowHorarioComplejoSUB = mysqli_fetch_array($resultHorarioComplejoSUB)) {
        echo '<div class="col-xs-12 contenedorHoras">';
        echo '<p class="col-md-4">(SUB) Subtitulada al Español </p>';

        echo '<p class = "col-md-4">';
        $horariosPelicula = $rowHorarioComplejoSUB['horario'];
        $horarioPelicula = explode(";", $horariosPelicula);

        $cantidadHoras = count($horarioPelicula);
        for ($i = 0; $i < $cantidadHoras; $i++) {
            $horario = $horarioPelicula[$i];
            echo $horario;
            echo '<span>';
            echo $rowHorarioComplejoSUB['tecnologia'];
            echo '</span>';
        }
        echo '</p>';

        echo '<p class="col-md-4">';
        $diasPelicula = $rowHorarioComplejoSUB['dias'];
        $diaPelicula = explode(",", $diasPelicula);
        $cantidadDias = count($diaPelicula);

        for ($i = 0; $i < $cantidadDias; $i++) {
            $dia = $diaPelicula[$i];
            if ($dia == "Mon") {
                echo ' Lun ';
            } elseif ($dia == "Tue") {
                echo ' Mar ';
            } elseif ($dia == "Wed") {
                echo ' Mie ';
            } elseif ($dia == "Thu") {
                echo ' Jue ';
            } elseif ($dia == "Fri") {
                echo ' Vie ';
            } elseif ($dia == "Sat") {
                echo ' Sáb ';
            } elseif ($dia == "Sun") {
                echo ' Dom ';
            }
        }
        echo '</p>';

        echo '</div>';
    }
}
?>
