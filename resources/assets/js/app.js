
/**
 * MIRAGETOWER 2018 Copyright
 */
require('../../assets/js/content.js');
window.Popper = require('popper.js');
require('bootstrap/dist/js/bootstrap.js');
var $ =require('jquery');
require('jquery-smooth-scroll');
require('particles.js');

// ---------------------------------------------------
//         PRELOADERS
// ---------------------------------------------------
if (document.body.contains(document.getElementById("home-overlay"))){
    function homeLoader(){
        let body = document.getElementsByTagName('body');
        let homeOverlay = document.getElementById("home-overlay");
        let leftOverImg = document.querySelector('.home-preload-left-img');
        let rightOverImg = document.querySelector('.home-preload-right-img');
        let lineDraw = document.querySelector('.line-draw');
        window.addEventListener('load', function(){
            body[0].style.overflow = 'hidden';
            leftOverImg.style.opacity = '1';
            rightOverImg.style.opacity = '1';
            leftOverImg.style.marginLeft = '-161.4375px';
            rightOverImg.style.marginRight = '-161.4375px';
            setTimeout(() => {
                lineDraw.style.width = '285px';
            },800);
            setTimeout(() => {
                leftOverImg.style.opacity = '0';
                rightOverImg.style.opacity = '0';
                homeOverlay.style.transition = '0.2s opacity linear';
                homeOverlay.style.opacity = '0';
                main.style.opacity = '1';
                if (document.body.contains(sideNav)){
                    sideNav.style.opacity = '1';
                    topNav.classList.remove('mobile');
                    main.classList.remove('mobile');
                }if (document.body.contains(sideNavM)){
                    sideNavM.style.opacity = '1';
                    topNav.classList.add('mobile');
                    main.classList.add('mobile');
                }
                topNav.style.opacity = '1';
            }, 2000);
            setTimeout(()=>{
                homeOverlay.style.display = 'none';
                body[0].style.overflow = 'unset';
            },2200);

        });
    }
    homeLoader();
}

if (document.body.contains(document.getElementById("overlay"))){
    function preloader(){
        let overlay = document.getElementById("overlay");
        window.addEventListener('load', function(){
            setTimeout(() => {
                overlay.style.transition = '0.5s opacity linear';
                overlay.style.opacity = '0';
                main.style.opacity = '1';
                if (document.body.contains(sideNav)){
                    sideNav.style.opacity = '1';
                    topNav.classList.remove('mobile');
                    main.classList.remove('mobile');
                }if (document.body.contains(sideNavM)){
                    sideNavM.style.opacity = '1';
                    topNav.classList.add('mobile');
                    main.classList.add('mobile');
                }
                topNav.style.opacity = '1';
            }, 300);
            setTimeout(()=>{
                overlay.style.display = 'none';
            },500);
        });
    }
    preloader();
}


// ---------------------------------------------------
//         SIDE MENU
// ---------------------------------------------------
let sideNav = document.querySelector('.side-nav-desktop');
let sideNavM = document.querySelector('.side-nav-mobile');
let sideNavInside = document.querySelector('.side-nav-inside');
let main = document.querySelector('#main');
let topNav = document.querySelector('.top-nav');
let horizontalWidth = window.matchMedia("(max-width: 768px)");
let navToggler = document.querySelector('#toggler');
let hamburger = document.querySelector('.hamburger');
let btnClose = document.querySelector('#mobileCloser');
let newsSection = document.querySelector('.news-section');
let contactSection = document.querySelector('.contact-section');
let copy = document.querySelector('.copy');
let mobileCounter = 0;
let counter = 1;

if (document.body.contains(sideNavM)){
    function sideNavMobile() {
        navToggler.addEventListener('click', function () {
            mobileCounter += 1;
            if( Math.abs(mobileCounter % 2) == 1) {
                expLinks.forEach(function (expLink) {
                    setTimeout(()=>{
                        expLink.style.opacity = '1';
                    },400);
                });
                dropLinks.forEach(function (dropLink) {
                    setTimeout(()=>{
                        dropLink.style.opacity = '1';
                    },400);
                });
                sideNavM.classList.remove('deactivated');
                main.style.opacity = '0';
                setTimeout(() => {
                    sideNavInside.classList.add('visible');
                    copy.classList.add('visible');
                    newsSection.classList.add('visible');
                    if (document.body.contains(contactSection)) {
                        contactSection.classList.add('visible');
                    }
                },500);
                setTimeout(() => {
                    main.style.display = 'none';
                }, 500);
            }
        });
        btnClose.addEventListener('click',function () {
            mobileCounter += 1;
            if(mobileCounter % 2 == 0){
                sideNavInside.classList.remove('visible');
                copy.classList.remove('visible');
                newsSection.classList.remove('visible');
                if (document.body.contains(contactSection)) {
                    contactSection.classList.remove('visible');
                }
                expLinks.forEach(function (expLink) {
                    expLink.style.transition = 'opacity 0.3s';
                    expLink.style.opacity = '0';
                });
                dropLinks.forEach(function (dropLink) {
                    dropLink.style.opacity = '0';
                });
                main.style.opacity = '1';
                main.style.display = 'block';
                setTimeout(() => {
                    sideNavM.classList.add('deactivated');
                },500)
            }
        })
    }
    sideNavMobile();
}

if (document.body.contains(sideNav)){
    function sideNavDesktop(){
        navToggler.addEventListener('click', function () {
            counter += 1;
            if( Math.abs(counter % 2) == 1) {
                hamburger.classList.add('is-active');
                sideNav.classList.remove('deactivated');
                expLinks.forEach(function (expLink) {
                    setTimeout(()=>{
                        expLink.style.opacity = '1';
                    },400);
                });
                setTimeout(()=>{
                    dropLinks.forEach(function (dropLink) {
                        dropLink.style.opacity = '1';
                    });
                },400);
                main.style.marginLeft = '250px';
                topNav.style.marginLeft = '250px';
                setTimeout(() => {
                    sideNavInside.classList.add('visible');
                    copy.classList.add('visible');
                    newsSection.classList.add('visible');
                    if (document.body.contains(contactSection)) {
                        contactSection.classList.add('visible');
                    }
                },500)
            }else if(counter % 2 == 0){
                hamburger.classList.remove('is-active');
                sideNavInside.classList.remove('visible');
                copy.classList.remove('visible');
                newsSection.classList.remove('visible');
                if (document.body.contains(contactSection)) {
                    contactSection.classList.remove('visible');
                }
                expLinks.forEach(function (expLink) {
                    expLink.style.opacity = '0';
                });
                dropLinks.forEach(function (dropLink) {
                    dropLink.style.opacity = '0';
                });
                main.style.marginLeft = '0';
                topNav.style.marginLeft = '0';
                setTimeout(() => {
                    sideNav.classList.add('deactivated');
                },500)
            }
        })
    }
    sideNavDesktop();
}



// ---------------------------------------------------
//         SIDE MENU LOCKED LINKS
// ---------------------------------------------------
let customModal = document.querySelector('#modalForm');
let customModalContent = document.querySelector('.custom-modal-content');
let modalTriggers = document.getElementsByClassName('not-logged');
let customModalClose = document.querySelector('.closeBtn');
modalTriggers = Array.from(modalTriggers);
modalTriggers.reverse();

if (document.body.contains(customModalClose)){
    modalTriggers.forEach(function (modalTrigger) {
        modalTrigger.addEventListener('click',function () {
            customModal.style.height='100vh';
            setTimeout(() => {
                customModalContent.style.opacity = '1';
            }, 500);
        });
    });

    customModalClose.addEventListener('click',function () {
        customModalContent.style.opacity = '0';
        setTimeout(() => {
            customModal.style.height='0';
        }, 500);
    });
}


window.addEventListener('click', function (e) {
   if (e.target == customModal){
       customModalContent.style.opacity = '0';
       setTimeout(() => {
           customModal.style.height='0';
       }, 500);
   }
});
// ---------------------------------------------------
//         SIDE MENU DROPDOWNS
// ---------------------------------------------------
let expDrop = document.querySelector('#exp-drop');
let expDropIcon = document.querySelector('#exp-drop-icon');
let expDropContent = document.querySelector('.exp-link-drop');
let expLinks = document.getElementsByClassName('exp-link');
let exp = 0;
expLinks = Array.from(expLinks);
expLinks.reverse();
if (document.body.contains(expDrop) && document.body.contains(expDropContent)){
    function openExpDrop(){
        expDrop.addEventListener('click',function () {
            exp += 1;
            if (horizontalWidth.matches){
                if( Math.abs(exp % 2) == 1) {
                    expLinks.forEach(function (expLink) {
                        setTimeout(() => {
                            expLink.style.display = 'block';
                            expLink.style.opacity = '1';
                        }, 300);
                    });
                    expDrop.classList.add('active');
                    expDropIcon.classList.add('exp-drop-icon-rotate');
                    expDropContent.style.height = '132px';

                }else if(exp % 2 == 0){
                    expLinks.forEach(function (expLink) {
                        setTimeout(() => {
                            expLink.style.display = 'none';
                        }, 200);
                        expLink.style.opacity = '0';
                    });
                    setTimeout(() => {
                        expDropContent.style.height = '0px';
                    }, 200);
                    expDrop.classList.remove('active');
                    expDropIcon.classList.remove('exp-drop-icon-rotate');
                }
            }else{
                if( Math.abs(exp % 2) == 1) {
                    expLinks.forEach(function (expLink) {
                        setTimeout(() => {
                            expLink.style.display = 'block';
                        }, 300);setTimeout(() => {
                            expLink.style.opacity = '1';
                        }, 400);
                    });
                    expDrop.classList.add('active');
                    expDropIcon.classList.add('exp-drop-icon-rotate');
                    expDropContent.style.height = '132px';

                }else if(exp % 2 == 0){
                    expLinks.forEach(function (expLink) {
                        setTimeout(() => {
                            expLink.style.display = 'none';
                        }, 200);
                        expLink.style.opacity = '0';
                    });
                    setTimeout(() => {
                        expDropContent.style.height = '0px';
                    }, 200);
                    expDrop.classList.remove('active');
                    expDropIcon.classList.remove('exp-drop-icon-rotate');
                }
            }

        })
    }
    openExpDrop();
}

let nameDrop = document.querySelector('#name-drop');
let nameDropIcon = document.querySelector('#name-drop-icon');
let dropContent = document.querySelector('.side-nav-link-drop');
let dropLinks = document.getElementsByClassName('link-drop');
let drop = 0;
dropLinks = Array.from(dropLinks);
dropLinks.reverse();
if (document.body.contains(nameDrop) && document.body.contains(dropContent)) {
    function openDropDown(){
        nameDrop.addEventListener('click',function () {
            drop += 1;
            if( Math.abs(drop % 2) == 1) {
                dropLinks.forEach(function (dropLink) {
                    setTimeout(() => {
                        dropLink.style.display = 'block';
                    }, 200);setTimeout(() => {
                        dropLink.style.opacity = '1';
                    }, 200);
                });
                nameDrop.classList.add('active');
                nameDropIcon.classList.add('name-drop-icon-rotate');
                dropContent.style.height = '88px';

            }else if(drop % 2 == 0){
                dropLinks.forEach(function (dropLink) {
                    setTimeout(() => {
                        dropLink.style.display = 'none';
                    }, 200);
                    dropLink.style.opacity = '0';
                });
                nameDrop.classList.remove('active');
                setTimeout(() => {
                    dropContent.style.height = '0px';
                }, 200);
                nameDropIcon.classList.remove('name-drop-icon-rotate');

            }
        })
    }
    openDropDown();
}

// ---------------------------------------------------
//         FORM INPUTS
// ---------------------------------------------------

$(document).ready(function(){
    $('.positioning input').val('');
    $('.positioning textarea').val('');

    $('.input-effect input').focusout(function(){
        if($(this).val() != ''){
            $(this).addClass('has-content');
        }else{
            $(this).removeClass('has-content');
        }
    });
    $('.input-effect textarea').focusout(function(){
        if($(this).val() != ''){
            $(this).addClass('has-content');
        }else{
            $(this).removeClass('has-content');
        }
    })
});

// ---------------------------------------------------
//         SMOOTH SCROLL
// ---------------------------------------------------
$('.collapse').on('shown.bs.collapse', function () {

    var $panel = $(this).closest('.card');

    $('html, body').animate({
        scrollTop: $panel.offset().top -54
    }, 500);

});

// $('.floor-numbers').on('shown.bs.collapse', function () {
//
//     var $panel = $(this).closest('.card');
//
//     $('html, body').animate({
//         scrollTop: $panel.offset().top -54
//     }, 500);
//
// });

$('.animate').smoothScroll({
    offset: -55,
    speed: 800,
});

$('.arrow-up').smoothScroll({
    offset: -55,
    speed: 1000,
});

// ---------------------------------------------------
//         SHOW BACK TO TOP ON SCROLL
// ---------------------------------------------------
if (document.body.contains(document.querySelector('.arrow-up'))) {
    window.addEventListener("scroll", function () {
        let target = document.querySelector('.arrow-up');
        if (window.pageYOffset > 300) {
            target.style.display = "block";
            setTimeout(() => {
                target.style.opacity = '1';
            }, 300);
        }
        else {
            target.style.opacity = '0';
            setTimeout(() => {
                target.style.display = "none";
            }, 300);
        }
    }, false);
}


