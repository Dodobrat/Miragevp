var $ =require('jquery');
require('swup');

// const swup = new Swup();

// ---------------------------------------------------
//         CONTENT - PARALLAX
// ---------------------------------------------------
$(window).scroll(function () {
    parallax();
});

function parallax() {
    let wScroll = $(window).scrollTop();
    $('.parallax-img').css('background-position', 'center '+(wScroll*0.6)+'px');
    // $('.view-container-parallax-img').css('background-position', 'center '+(wScroll*0.3)+'px');
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
let carousels = document.getElementsByClassName('carousel');
carousels = Array.from(carousels);
carousels.reverse();
carousels.forEach(function (carousel) {
    $(function(){
        $(carousel).carousel({
            interval: 30000,
        });
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
$('.ap-link').click(function (e) {
    $('.ap-link').removeClass('active');
    e.preventDefault();
    $(this).tab('show');
});

// ---------------------------------------------------
//         CONTENT - APARTMENT VIEW GALLERY ON CLICK
// ---------------------------------------------------

let open = document.querySelector('.open-carousel');
let apartmentInfo = document.querySelector('.desk');
let apartmentMediaCont = document.querySelector('.apartment-carousel');
let carInd = document.querySelector('.ap-car-ind');
let carPrev = document.querySelector('.ap-car-prev');
let carNext = document.querySelector('.ap-car-next');
let carInfo = document.querySelector('.car-info');

if (document.body.contains(open)){
    let count = 0;
    open.addEventListener('click', function () {
        count += 1;
        if( Math.abs(count % 2) == 1) {
            apartmentInfo.style.opacity = 0;
            apartmentMediaCont.style.width = '95%';
            open.style.right = '95%';
            open.classList.add('rotated');
            carInfo.style.left = '50px';
            carInd.style.opacity = 1;
            carPrev.style.opacity = 1;
            carNext.style.opacity = 1;
            setTimeout(() => {
                apartmentInfo.style.display = 'none';
                carInd.style.display = 'flex';
                carPrev.style.display = 'flex';
                carNext.style.display = 'flex';
                carInfo.style.opacity = 1;
            }, 300);
        }else if(count % 2 == 0){
            apartmentInfo.style.display = 'block';
            carInd.style.display = 'none';
            carPrev.style.display = 'none';
            carNext.style.display = 'none';
            apartmentMediaCont.style.width = '50%';
            open.style.right = '50%';
            open.classList.remove('rotated');
            setTimeout(() => {
                apartmentInfo.style.opacity = 1;
                carInd.style.opacity = 0;
                carPrev.style.opacity = 0;
                carNext.style.opacity = 0;
                carInfo.style.left = '-600px';
                carInfo.style.opacity = 0;
            },1);
        }
    })
}

// ---------------------------------------------------
//         CONTENT - SHOWROOMS SLIDE LIST
// ---------------------------------------------------
if (document.body.contains(document.querySelector('.showroom-container-list'))){
(function() {
    let x, newX, left, down;

    $(".showroom-container-list").mousedown(function(e) {
        down = true;
        x = e.pageX;
        left = $(this).scrollLeft();
    });

    $(".showroom-container-list").mousemove(function(e) {
        e.preventDefault();
        if (down) {
            newX = e.pageX;
            $(this).scrollLeft(left+x-newX);
        }
    });

    $("body").mouseup(function(e) {down=false;});
    $("body").keydown(function(e) {
        left = $("div").scrollLeft();
        let articleWidth = $('article').width();
        let margin = 2 * parseInt($('article').css("marginLeft"));
        if (e.keyCode == 39)
            $("div").scrollLeft(left + articleWidth + margin);
        if (e.keyCode == 37)
            $("div").scrollLeft(left - articleWidth - margin);
    });

    //MOBILE
    let slideDiv = document.querySelector('.showroom-container-list');
    slideDiv.addEventListener('touchstart', function() {
        let touches = event.changedTouches;
        down = true;
        x = touches[0].pageX;
        left = $('.showroom-container-list').scrollLeft();
    });

    slideDiv.addEventListener('touchmove', function(event){
        event.stopPropagation();
        let touches = event.changedTouches;
        if (down) {
            let newX = touches[0].pageX;
            $('.showroom-container-list').scrollLeft(left+x-newX);
        }
    });

    slideDiv.addEventListener('touchend', function(){ down = false;});
})();
}
