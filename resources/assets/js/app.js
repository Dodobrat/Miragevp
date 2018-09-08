
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
        }, 1);

    })
}
// callbacks
preloader();

// Moving Placeholder Up in Input fields
$('input').focus(function(){
    $(this).parents('.form-group').addClass('focused');
});

$('input').blur(function(){
    var inputValue = $(this).val();
    if ( inputValue == "" ) {
        $(this).removeClass('filled');
        $(this).parents('.form-group').removeClass('focused');
    } else {
        $(this).addClass('filled');
    }
})