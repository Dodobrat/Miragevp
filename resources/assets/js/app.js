
/**
 * MIRAGETOWER 2018 Copyright
 */

window.Popper = require('popper.js');
require('bootstrap/dist/js/bootstrap.js');
var $ =require('jquery');
require('particles.js');

// ---------------------------------------------------
//         PRELOADERS
// ---------------------------------------------------
if (document.body.contains(document.getElementById("home-overlay"))){
    function homeLoader(){
        let homeOverlay = document.getElementById("home-overlay");
        let leftOverImg = document.querySelector('.home-preload-left-img');
        let rightOverImg = document.querySelector('.home-preload-right-img');
        window.addEventListener('load', function(){
            leftOverImg.style.opacity = '1';
            rightOverImg.style.opacity = '1';
            leftOverImg.style.marginLeft = '-161.4375px';
            rightOverImg.style.marginRight = '-161.4375px';
            setTimeout(() => {
                leftOverImg.style.opacity = '0';
                rightOverImg.style.opacity = '0';
                homeOverlay.style.transition = '0.2s opacity linear';
                homeOverlay.style.opacity = '0';
                main.style.opacity = '1';
                sideNav.style.opacity = '1';
                topNav.style.opacity = '1';
            }, 1500);
            setTimeout(()=>{
                homeOverlay.style.display = 'none';
            },1700);
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
                sideNav.style.opacity = '1';
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
let sideNav = document.querySelector('.side-nav');
let sideNavLinks = document.getElementsByClassName('side-nav-link');
let main = document.querySelector('#main');
let topNav = document.querySelector('.top-nav');
let horizontalWidth = window.matchMedia("(max-width: 768px)");
let navToggler = document.querySelector('#toggler');
let hamburger = document.querySelector('.hamburger');
let btnClose = document.querySelector('#mobileCloser');
let newsSection = document.querySelector('.news-section');
let copy = document.querySelector('.copy');
let mobileCounter = 0;
let counter = 1;
sideNavLinks = Array.from(sideNavLinks);
sideNavLinks.reverse();
function sideNavMobile() {
    if (horizontalWidth.matches){
        btnClose.style.display = 'block';
        navToggler.addEventListener('click', function () {
            mobileCounter += 1;
            if( Math.abs(mobileCounter % 2) == 1) {
                sideNavLinks.forEach(function (side) {
                    side.style.marginLeft = '0';
                });
                newsSection.style.transition = '0.8s';
                newsSection.style.opacity = '1';
                newsSection.style.marginLeft = '0';
                sideNav.style.width = '100vw';
                main.style.opacity = '0';
                setTimeout(() => {
                    main.style.display = 'none';
                }, 500);
                setTimeout(() => {
                    copy.style.opacity = '1';
                }, 500);
            }
        })
        btnClose.addEventListener('click',function () {
            mobileCounter += 1;
            if(mobileCounter % 2 == 0){
                newsSection.style.transition = '0.5s';
                newsSection.style.opacity = '0';
                newsSection.style.marginLeft = '-100vw';
                sideNav.style.width = '0';
                copy.style.opacity = '0';
                sideNavLinks.forEach(function (side) {
                    side.style.marginLeft = '-250px';
                });
                main.style.opacity = '1';
                main.style.display = 'block';
            }
        })
    }else{
        navToggler.addEventListener('click', function () {
            counter += 1;
            if( Math.abs(counter % 2) == 1) {
                hamburger.classList.add('is-active');
                sideNav.style.width = '250px';
                copy.style.left = '75px';
                newsSection.style.transition = '1s';
                newsSection.style.opacity = '1';
                newsSection.style.marginLeft = '0';
                sideNavLinks.forEach(function (side) {
                   side.style.marginLeft = '0';
                   side.style.transition = 'margin-left 0.8s';
                });
                main.style.marginLeft = '250px';
                topNav.style.marginLeft = '250px';
            }else if(counter % 2 == 0){
                hamburger.classList.remove('is-active');
                sideNav.style.width = '0';
                copy.style.left = '-300px';
                newsSection.style.transition = '0.5s';
                newsSection.style.opacity = '0';
                newsSection.style.marginLeft = '-500px';
                sideNavLinks.forEach(function (side) {
                    side.style.marginLeft = '-250px';
                });
                main.style.marginLeft = '0';
                topNav.style.marginLeft = '0';
            }
        })
    }
}
sideNavMobile(horizontalWidth);

// ---------------------------------------------------
//         SIDE MENU DROPDOWNS
// ---------------------------------------------------
let nameDrop = document.querySelector('#name-drop');
let nameDropIcon = document.querySelector('#name-drop-icon');
let dropContent = document.querySelector('.side-nav-link-drop');
let dropLink = document.querySelector('.link-drop');
let drop = 0;
if (document.body.contains(nameDrop) && document.body.contains(dropContent) && document.body.contains(dropLink)) {
    function openDropDown(){
        nameDrop.addEventListener('click',function () {
            drop += 1;
            if( Math.abs(drop % 2) == 1) {
                dropLink.style.display = 'block';
                nameDrop.classList.add('active');
                setTimeout(() => {
                    dropLink.style.opacity = '1';
                }, 200);
                nameDropIcon.classList.add('name-drop-icon-rotate');
                dropContent.style.height = '44px';

            }else if(drop % 2 == 0){
                nameDrop.classList.remove('active');
                setTimeout(() => {
                    dropContent.style.height = '0px';
                    dropLink.style.display = 'none';
                }, 200);
                nameDropIcon.classList.remove('name-drop-icon-rotate');
                dropLink.style.opacity = '0';

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

    $('.input-effect input').focusout(function(){
        if($(this).val() != ''){
            $(this).addClass('has-content');
        }else{
            $(this).removeClass('has-content');
        }
    })
});

// ---------------------------------------------------
//         CHANGE NAVIGATION ON SCROLL
// ---------------------------------------------------

// $(function(){
//     $(window).scroll(function() {
//         if($(window).scrollTop() >= 100) {
//             $('nav').addClass('scrolled');
//         }
//         else {
//             $('nav').removeClass('scrolled');
//         }
//     });
// });



// ---------------------------------------------------
//         COMMENT
// ---------------------------------------------------



