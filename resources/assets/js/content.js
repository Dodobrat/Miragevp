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
    $('.project-parallax-img-layer-one').css('background-position', 'center '+(wScroll*0.35)+'px');
    $('.project-parallax-img-layer-two').css('background-position', 'center '+(wScroll*0.5)+'px');
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
$('.floor-head').click(function (){
    $('.modal').modal('hide');
});

// ---------------------------------------------------
//         CONTENT - CAROUSEL IMAGE CHANGE INTERVAL
// ---------------------------------------------------

$(function(){
    $('.carousel').carousel({
        interval: 30000,
    });
});
// ---------------------------------------------------
//         CONTENT - ADDED CUSTOM TOUCH SUPPORT FOR CAROUSEL
// ---------------------------------------------------
let pageWidth = window.innerWidth || document.body.clientWidth;
let treshold = Math.max(1,Math.floor(0.01 * (pageWidth)));
let touchstartX = 0;
let touchstartY = 0;
let touchendX = 0;
let touchendY = 0;

const limit = Math.tan(45 * 1.5 / 180 * Math.PI);
const gestureZone = document.getElementsByTagName('body');

gestureZone[0].addEventListener('touchstart', function(event) {
    touchstartX = event.changedTouches[0].screenX;
    touchstartY = event.changedTouches[0].screenY;
}, false);

gestureZone[0].addEventListener('touchend', function(event) {
    touchendX = event.changedTouches[0].screenX;
    touchendY = event.changedTouches[0].screenY;
    handleGesture(event);
}, false);

function handleGesture(e) {
    let x = touchendX - touchstartX;
    let y = touchendY - touchstartY;
    let yx = Math.abs(y / x);
    if (Math.abs(x) > treshold || Math.abs(y) > treshold) {
        if (yx <= limit) {
            if (x < 0) {
                $(function(){
                    $('.carousel').carousel('next');
                });
            } else {
                $(function(){
                    $('.carousel').carousel('prev');
                });
            }
        }
    }
}


// ---------------------------------------------------
//         CONTENT - CLOSE ACCORDION ON CLICK AWAY
// ---------------------------------------------------
document.addEventListener('click', function (event) {
    if (event.target.closest('.card-body')) return;
    $('.collapse').collapse('hide');

}, false);

if (!Element.prototype.closest) {
    if (!Element.prototype.matches) {
        Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
    }
    Element.prototype.closest = function (s) {
        var el = this;
        var ancestor = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (ancestor.matches(s)) return ancestor;
            ancestor = ancestor.parentElement;
        } while (ancestor !== null);
        return null;
    };
}

// ---------------------------------------------------
//         CONTENT - SHOW APARTMENT INFO ON CLICK
// ---------------------------------------------------

