$(document).ready(inicio);

function inicio() {
}

function display(e) {
    $display = $(e).parent().parent().next().css("display");
    console.log($display);
    if ($display === "none") {
        $(e).parent().parent().next().css("display", 'block');
    } else {
        $(e).parent().parent().next().css("display", 'none');
    }
}
