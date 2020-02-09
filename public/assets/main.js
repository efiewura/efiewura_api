// document.addEventListener('mousemove', function(){
//     if (document.querySelector('.navbar').classList.contains('navbar-transparent')){
//         document.querySelector('.navbar .form-control').classList.add('white-form-control-text');
//     } else {
//         document.querySelector('.navbar .form-control').classList.remove('white-form-control-text');
//     }
// });

$(document).ready(function(){
    // Owl Carousel
    let owl = $('.owl-carousel');
    owl.owlCarousel({
        stagePadding: 40,
        loop:false,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
});
