'use strict';

(function($) {
    $('[data-toggle="tooltip"]').tooltip();
    if (history.forward(1)) {
        location.replace(history.forward(1));
    }
    addActiveClass();
})(jQuery);

$(window).on('load', function() {
    $(".loader").fadeOut();
    $("#preloder").delay(.1).fadeOut("slow");
});

function addActiveClass() {
    var objs = document.getElementsByTagName('a');
    for (var i = 0; i < objs.length; i++) {
        if (objs[i].href == window.location.href) {
            objs[i].className = objs[i].className + " active";
        }
    }
}

function save() {
    $.ajax({
        type: 'post',
        url: 'project/create',
        headers: { 'X-CSRF-TOKEN': $('#token').val() },
        data: $("#formulario").serialize(),
        dataType: 'JSON',

        success: function(data) {
            console.log(data);
        },
        error: function(data) {
            console.log(data);
            if (data.responseJSON.errors.noteQuoteProduct != 'undefined') {
                console.log(data.responseJSON.errors.noteQuoteProduct);
                $('#errorNoteQuoteProduct').html(data.responseJSON.errors.noteQuoteProduct);
            }
            if (data.responseJSON.errors.fileQuotesProduct != 'undefined') {
                console.log(data.responseJSON.errors.fileQuotesProduct);
                $('#errorFileQuotesProduct').html(data.responseJSON.errors.fileQuotesProduct);
            }
            alert(data);
        }
    })
}

/* $('#formulario').on('submit', function(e) {
    $.ajax({
        type: 'post',
        url: 'project/create',
        headers: { 'X-CSRF-TOKEN': $('#token').val() },
        data: $("#formulario").serialize(),
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log("Hola");
        },
        error: function(data) {
            console.log(data.responseJSON);
            alert(data);
        }
    })
}) */