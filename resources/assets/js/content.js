var $ =require('jquery');

// ---------------------------------------------------
//         CONTENT - PARALLAX
// ---------------------------------------------------
$(window).scroll(function () {
    parallax();
});

function parallax() {
    let wScroll = $(window).scrollTop();

    $('.parallax-img').css('background-position', 'center '+(wScroll*0.6)+'px');
}

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
$('.close-blog-modal').click(function (){
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
// ---------------------------------------------------
//         CONTENT - LOAD POST CONTENT ON CLICK
// ---------------------------------------------------


