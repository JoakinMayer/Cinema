$(document).ready(inicio);

function inicio() {
    var heightImg = $("#peliculas div img").height();
    $("#peliculas > div").height(heightImg);
    $(window).resize(function () {
        heightImg = $("#peliculas div img").height();
        $("#peliculas > div").height(heightImg);
    });
}

function display(e) {

    $display = $(e).next().css("display");
    if ($display === "none") {
        $(e).next().css("display", 'block');
    } else {
        $(e).next().css("display", 'none');
    }
}


function filtros() {

    $.ajax({
        url: "filtrosAmpliacion.php",
        success: mostrarResultados,
        type: "GET",
        data: {
            complejo: $("#complejo").val(),
            idPelicula: $("#idPelicula").val()
        }
    });
}

function mostrarResultados(data) {
    $(".contenedorComplejo").remove();
    $(".contenedorHoras").remove();

    $("#ampliacionHorarios").append(data);

}

function pelicula(id) {
    var ampliacion = "ampliacion.php?id=" + id;
    document.location = ampliacion;
}