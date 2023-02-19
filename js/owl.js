$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    loop:true,
    autoplay:true,
    pagination: false,
    autoplayHoverPause: true,
    dots:false,
    responsive:{
        0:{items:1},
        617:{items:3},
        900:{items:5},
    },
  });
});