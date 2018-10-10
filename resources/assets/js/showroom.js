var $ =require('jquery');

// ---------------------------------------------------
//         CONTENT - SMOOTH SCROLL
// ---------------------------------------------------
// $(document).ready(function(){
//     $(".class").on('click', function(event) {
//         if (this.hash !== "") {
//             event.preventDefault();
//             var hash = this.hash;
//             $('html, body').animate({
//                 scrollTop: $(hash).offset().top
//             }, 800, function(){
//                 window.location.hash = hash;
//             });
//         }
//     });
// });

$('img').bind('contextmenu', function(e) {
    return false;
});