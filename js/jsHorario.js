$(document).ready(iniciar);

function iniciar() {
    $.ajax({
        url: "mostrarHorarios.php",
        success: mostrarHorarios,
        type: "GET",
        data: {
            idPelicula: $("#id").val()
        }
    });
}
function mostrarHorarios(datos) {
    $(".horas").remove();
    $("tbody").prepend(datos);
}

function agregarHorario() {

    var dias = [];
    var valorDias = $("input[type=checkbox]");
    var cantidadDias = valorDias.length;
    for (var i = 0; i < cantidadDias; i++) {
        if (valorDias[i].type == 'checkbox' && valorDias[i].checked == true) {
            dias.push(valorDias[i].value);
        }
    }

    dias = dias.toString();

    $.ajax({
        url: "guardarHorarios.php",
        success: mostrarHora,
        type: "GET",
        data: {
            idPelicula: $("#id").val(),
            complejo: $("#complejo").val(),
            tecnologia: $("#tecnologia").val(),
            idioma: $("#idioma").val(),
            horario: $("#horas").val(),
            dias: dias
        }
    });
}

function mostrarHora(datos) {
    $("tbody").prepend(datos);
}

function modificarHorario(id) {
    $.ajax({
        url: "modificarHora.php",
        success: modificarHora,
        type: "GET",
        data: {
            id: id
        }
    });
    eliminarHorario(id);
}

function modificarHora(data) {
    $(".formHora").remove();
    $("tbody").append(data);
}

function eliminarHorario(id) {
    $.ajax({
        url: "eliminarHorario.php",
        success: iniciar,
        type: "GET",
        data: {
            id: id
        }
    });
}