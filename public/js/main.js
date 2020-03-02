'use strict';
/* import Dropzone from "js/dropzone.js"; */

/*------------------	Preloder	--------------------*/
$(window).on('load', function() {
    $(".loader").fadeOut();
    $("#preloder").delay(.1).fadeOut("slow");
});

(function($) {
    /*------------------	Background Set --------------------*/
    $('.set-bg').each(function() {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });
    $('[data-toggle="tooltip"]').tooltip();
})(jQuery);


function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}



$(function() {
    var table = $('#tableProjects').DataTable({
        columnDefs: [{ orderable: false, targets: 'not-sort' }],
        lengthMenu: [[10, 25, 50,100, -1], [10, 25, 50, 100,"Todos"]],
        language: {
            "decimal": ",",
            "thousands": ".",
            "paginate": {
                "first": "Primera",
                "last": "Ultima",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ registros",
            "emptyTable": "Sin Registros",
            "info": "Mostrando _END_ de _TOTAL_ registros",
            "infoEmpty": "Sin resultados para mostrar",
            "search": "Palabra clave:"
        },
    });
    table.column('1:visible').order('asc').draw();
});