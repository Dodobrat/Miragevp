var $ =require('jquery');

// ---------------------------------------------------
//         CONTENT - DISABLING RIGHT CLICK ON IMAGES
// ---------------------------------------------------


$('img').bind('contextmenu', function(e) {
    return false;
});

// ---------------------------------------------------
//         CONTENT - CLOSE BUTTON FOR MODAL
// ---------------------------------------------------

$('.close-modal-carousel').click(function (){
    $('.modal').modal('hide');
});

// ---------------------------------------------------
//         CONTENT - CAROUSEL IMAGE CHANGE INTERVAL
// ---------------------------------------------------

$(function(){
    $('.carousel').carousel({
        interval: 30000
    });
});