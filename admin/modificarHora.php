<?php

include '../conexion.php';

$id = $_GET['id'];

$queryHora = "SELECT * FROM horarios WHERE id=$id";
$resultHora = mysqli_query($link, $queryHora);
$rowHora = mysqli_fetch_array($resultHora);

$dias = $rowHora['dias'];
$dia = explode(",", $dias);
$cantidadDias = count($dia);

//COMPLEJOS
$queryComplejos = "SELECT * FROM complejos ORDER BY nombre";
$resultComplejos = mysqli_query($link, $queryComplejos);

date_default_timezone_set("America/Montevideo");
$lastUpdatae = date("Y_n_d_H_i_s");
$queryUpdate = "UPDATE pelicula SET modificacion='$lastUpdatae' WHERE id=$id";
$resultUpdate = mysqli_query($link, $queryUpdate);

if ($resultComplejos) {
    echo '<tr class = "formHora">';
    echo '<td class = "form-group col-sm-3">';
    echo '<select class = "form-control" id = "complejo" name = "complejo" required>';
    while ($rowComplejos = mysqli_fetch_array($resultComplejos)) {
        if ($rowComplejos[nombre] == $rowHora[complejo]) {
            echo "<option value='$rowComplejos[nombre]' selected>$rowComplejos[nombre]</option>";
        } else {
            echo "<option value='$rowComplejos[nombre]'>$rowComplejos[nombre]</option>";
        }
    }
    echo '</select>';
    echo '</td>';
    echo '<td class="form-group col-sm-1">';
    echo '<select class="form-control " id="tecnologia" name="tecnologia" required>';
    if ('2D' == $rowHora[tecnologia]) {
        echo '<option value="2D" selected>2D</option>';
    } else {
        echo '<option value="2D">2D</option>';
    }
    if ('3D' == $rowHora[tecnologia]) {
        echo '<option value="3D" selected>3D</option>';
    } else {
        echo '<option value="3D">3D</option>';
    }
    if ('4D' == $rowHora[tecnologia]) {
        echo '<option value="4D" selected>4D</option>';
    } else {
        echo '<option value="4D">4D</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '<td class="form-group col-sm-1">';
    echo '<select class="form-control " id="idioma" name="idioma" required>';
    if ('ESP' == $rowHora[idioma]) {
        echo '<option value="ESP" selected>ESP</option>';
    } else {
        echo '<option value="ESP">ESP</option>';
    }
    if ('SUB' == $rowHora[idioma]) {
        echo '<option value="SUB" selected>SUB</option>';
    } else {
        echo '<option value="SUB">SUB</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '<td class="form-group col-sm-4">';
    echo '<input type="text" class="form-control" id="horas" name="horas" value="' . $rowHora['horario'] . '">';
    echo '</td>';
    echo '<td class="form-group col-sm-4">';
    echo '<label class="control-label" for="Lu">Lu </label>';
    echo '<input type="checkbox"  id="Lu" name="dias" value="Mon"';
    for ($i = 0; $i < $cantidadDias; $i++) {
        if ($dia[$i] == "Mon") {
            echo 'checked';
        }
    }
    echo '>';
    echo '<label class="control-label" for="Ma">Ma </label>';
    echo '<input type="checkbox"  id="Ma" name="dias" value="Tue"';
    for ($i = 0; $i < $cantidadDias; $i++) {
        if ($dia[$i] == "Tue") {
            echo 'checked';
        }
    }
    echo '>';
    echo '<label class="control-label" for="Mi">Mi </label>';
    echo '<input type="checkbox"  id="Mi" name="dias" value="Wed"';
    for ($i = 0; $i < $cantidadDias; $i++) {
        if ($dia[$i] == "Wed") {
            echo 'checked';
        }
    }
    echo '>';
    echo '<label class="control-label" for="Ju">Ju </label>';
    echo '<input type="checkbox"  id="Ju" name="dias" value="Thu"';
    for ($i = 0; $i < $cantidadDias; $i++) {
        if ($dia[$i] == "Thu") {
            echo 'checked';
        }
    }
    echo '>';
    echo '<label class="control-label" for="Vi">Vi </label>';
    echo '<input type="checkbox"  id="Vi" name="dias" value="Fri"';
    for ($i = 0; $i < $cantidadDias; $i++) {
        if ($dia[$i] == "Fri") {
            echo 'checked';
        }
    }
    echo '>';
    echo '<label class="control-label" for="Sa">Sa </label>';
    echo '<input type="checkbox"  id="Sa" name="dias" value="Sat"';
    for ($i = 0; $i < $cantidadDias; $i++) {
        if ($dia[$i] == "Sat") {
            echo 'checked';
        }
    }
    echo '>';
    echo '<label class="control-label" for="Do">Do </label>';
    echo '<input type="checkbox"  id="Do" name="dias" value="Sun"';
    for ($i = 0; $i < $cantidadDias; $i++) {
        if ($dia[$i] == "Sun") {
            echo 'checked';
        }
    }
    echo '>';
    echo '</td>';
    echo '<td></td>';
    echo '<td class="text-center"><a href="" onclick="agregarHorario()"><i class="material-icons">check_circle</i></a></td>';
    echo '</tr>';
} else {
    echo 'Error';
}
?>





