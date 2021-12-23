$(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({

      nav:false,
      items: 3,
      dots: false,
      loop: true,
      margin: 30,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      responsive:{
        0:{
            items:1,
        },
        768:{
            items:2,
        },
        992:{
            items:3
        }
    }
    });

  });
