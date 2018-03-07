$(document).ready(iniciar);

function iniciar() {

}

function portada(id) {
    $.ajax({
        url: "modificarPortada.php",
        success: modificarPortada,
        type: "GET",
        data: {
            id: id
        }
    });
}
function modificarPortada(data) {
}
