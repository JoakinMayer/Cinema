$(document).ready(iniciar);

function iniciar() {
    $("#tema").change(function () {
        var tema = $(this).val();
        if (tema === "otro") {
            $("#tema").parent().append('<div class="form-group" id="asunto"><label class="control-label " for="asunto">Asunto:</label><input type="text" class="form-control" placeholder="Ingrese el asunto" name="asunto" required></div>');
        } else {
            $("#asunto").remove();
        }
    });
}
