
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Popper = require('popper.js');
require('bootstrap/dist/js/bootstrap.js');
var $ =require('jquery');
require('particles.js');

// Preloader
// Function declarations
function preloader(){
    let overlay = document.getElementById("overlay");
    window.addEventListener('load', function(){
        setTimeout(() => {
            overlay.style.transition = '0.5s opacity linear';
            overlay.style.opacity = '0';
            overlay.style.zIndex = '0';
            overlay.style.display = 'none';
        }, 1);
    });
}
// callbacks
preloader();

// Shrinking Navigation on Scroll
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


