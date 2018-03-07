$(document).ready(iniciar());

function iniciar() {
    $('#ultimasPeliculas').owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        stagePadding: 100,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

}
;
function pelicula(id){
    var ampliacion = "ampliacion.php?id=" + id;
    document.location = ampliacion;
}