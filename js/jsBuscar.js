$(document).ready(inicio);

function inicio() {
    var heightImg = $("#peliculas div img").height();
    $("#peliculas > div").height(heightImg);
    $(window).resize(function () {
        heightImg = $("#peliculas div img").height();
        $("#peliculas > div").height(heightImg);

    });

}

function filtros() {
    
    
    $.ajax({
        url: "filtros.php",
        success: mostrarResultados,
        type: "GET",
        data: {
            genero: $("#genero").val(),
            complejo: $("#complejo").val(),
            dia: $("#dia").val()
        }
    });
}
function mostrarResultados(data) {
    $("#peliculas").empty();
    $("#peliculas").html(data);

    var heightImg = $("#peliculas div img").height();
    $("#peliculas > div").height(heightImg);
    $(window).resize(function () {
        heightImg = $("#peliculas div img").height();
        $("#peliculas > div").height(heightImg);

    });
}
function pelicula(id){
    var ampliacion = "ampliacion.php?id=" + id;
    document.location = ampliacion;
}