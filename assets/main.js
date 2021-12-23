
$(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
    //   items: 3,
      dots: false,
      loop: true,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1200:{
            items:3
        }
    }
    });
    // $('.play').on('click', function() {
    //   owl.trigger('play.owl.autoplay', [3000])
    // })
    // $('.stop').on('click', function() {
    //   owl.trigger('stop.owl.autoplay')
    // })
  });

