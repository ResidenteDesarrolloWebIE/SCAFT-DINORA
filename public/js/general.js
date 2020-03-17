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