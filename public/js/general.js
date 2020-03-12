'use strict';
/*------------------	Preloder	--------------------*/
$(window).on('load', function () {
    $(".loader").fadeOut();
    $("#preloder").delay(.1).fadeOut("slow");
});
(function ($) {
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });
    $('[data-toggle="tooltip"]').tooltip();
})(jQuery);

function addActiveClass() {
    var objs = document.getElementsByTagName('a');          // take all 'a' tags
    for (var i = 0; i < objs.length; i++) {
        if (objs[i].href == window.location.href) {             // check if the user is on this link
            objs[i].className = objs[i].className + " active";  // add additional 'active' class
        }
    }
}
addActiveClass();