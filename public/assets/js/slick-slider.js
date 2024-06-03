$(document).ready(function(){
    $('.secteur').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows:true,
        dots:false,
        prevArrow: $('.sec-prev'),
        nextArrow: $('.sec-next'),
        responsive: [
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
              infinite: true,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
    });
  });

  $(document).ready(function() {
    $('.sld-video').slick({
        dot:false,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: $('.prev-btn'),
        nextArrow: $('.next-btn'),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});