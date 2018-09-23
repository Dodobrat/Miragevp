
/**
 * MIRAGETOWER 2018 Copyright
 */

window.Popper = require('popper.js');
require('bootstrap/dist/js/bootstrap.js');
var $ =require('jquery');
require('particles.js');

// ---------------------------------------------------
//         PRELOADER
// ---------------------------------------------------
function preloader(){
    let overlay = document.getElementById("overlay");
    window.addEventListener('load', function(){
        setTimeout(() => {
            overlay.style.transition = '0.5s opacity linear';
            overlay.style.opacity = '0';
            main.style.opacity = '1';
            sideNav.style.opacity = '1';
            topNav.style.opacity = '1';
            setTimeout(()=>{
                overlay.style.display = 'none';
            },500);
        }, 300);
    });
}
preloader();

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
                sideNav.style.width = '100vw';
                main.style.opacity = '0';
                setTimeout(() => {
                    main.style.display = 'none';
                }, 500);
            }
        })
        btnClose.addEventListener('click',function () {
            mobileCounter += 1;
            if(mobileCounter % 2 == 0){
                sideNav.style.width = '0';
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
                // sideNavLinks[].style.marginLeft = '0';
                sideNavLinks.forEach(function (side) {
                   side.style.marginLeft = '0';
                   side.style.transition = 'margin-left 0.8s';
                });
                main.style.marginLeft = '250px';
                topNav.style.marginLeft = '250px';
            }else if(counter % 2 == 0){
                hamburger.classList.remove('is-active');
                sideNav.style.width = '0';
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
let dropContent = document.querySelector('.side-nav-link-drop');
let dropLink = document.querySelector('.link-drop');
let drop = 0;
if (document.body.contains(nameDrop) && document.body.contains(dropContent) && document.body.contains(dropLink)) {
    function openDropDown(){
        nameDrop.addEventListener('click',function () {
            drop += 1;
            if( Math.abs(drop % 2) == 1) {
                nameDrop.classList.add('active');
                setTimeout(() => {
                    dropLink.style.opacity = '1';

                }, 200);
                dropContent.style.height = '44px';

            }else if(drop % 2 == 0){
                nameDrop.classList.remove('active');
                setTimeout(() => {
                    dropContent.style.height = '0px';
                }, 200);
                dropLink.style.opacity = '0';

            }
        })
    }
    openDropDown();
}




// Change Navigation on Scroll
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

// $(document).ready(function () {
//     $('#sidebarCollapse').on('click', function () {
//         $('#sidebar').toggleClass('active');
//         $(this).toggleClass('active');
//         $('.cont-wrap').toggleClass('expanded');
//     });
// });

// // Navigation DropDown
// $('.dropdown').on('show.bs.dropdown', function(e){
//     $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
// });
// $('.dropdown').on('hide.bs.dropdown', function(e){
//     $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
// });

// Moving Placeholder Up in Input fields
// $('input').focus(function(){
//     $(this).parents('.form-gr-cust').addClass('focused');
// });
//
// $('input').blur(function(){
//     var inputValue = $(this).val();
//     if ( inputValue == "" ) {
//         $(this).removeClass('filled');
//         $(this).parents('.form-gr-cust').removeClass('focused');
//     } else {
//         $(this).addClass('filled');
//     }
// })

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

// Form Dynamic Validation
// const firstName = document.querySelector("#first_name");
// const lastName = document.querySelector("#last_name");
// const inputEmail = document.querySelector("#email");
// if (firstName != null && lastName != null && inputEmail != null){
//     firstName.addEventListener('keyup', validateFirstName);
//     lastName.addEventListener('keyup', validateLastName);
//     inputEmail.addEventListener('keyup', validateEmail);
//     function validateFirstName(){
//         const name = document.querySelector("#first_name");
//         const re = /^[a-zA-Zа-яА-Я\ \-]{2,20}$/;
//
//         if (!re.test(name.value)) {
//             name.style.borderBottom = "3px solid rgb(150,50,50)";
//         } else{
//             name.style.borderBottom = "3px solid rgb(50,150,50)";
//         }
//     }
//     function validateLastName(){
//         const name = document.querySelector("#last_name");
//         const re = /^[a-zA-Zа-яА-Я\ \-]{2,20}$/;
//
//         if (!re.test(name.value)) {
//             name.style.borderBottom = "3px solid rgb(150,50,50)";
//         } else{
//             name.style.borderBottom = "3px solid rgb(50,150,50)";
//         }
//     }
//     function validateEmail() {
//         const email = document.querySelector("#email");
//         const re = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
//
//         if (!re.test(email.value)) {
//             email.style.borderBottom = "3px solid rgb(150,50,50)";
//         } else {
//             email.style.borderBottom = "3px solid rgb(50,150,50)";
//         }
//     }
// }else{
//
// }


