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
    location.reload();
}

function posicion(valor, idImg, posicionActual, idPeli) {
    $.ajax({
        url: "modificarPosicion.php",
        success: modificarPosicion,
        type: "GET",
        data: {
            id: idImg,
            posicion: valor,
            posicionActual: posicionActual,
            idPelicula: idPeli
        }
    });
}
function modificarPosicion() {
    location.reload();
}