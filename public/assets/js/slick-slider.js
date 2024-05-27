$(document).ready(function(){
    $('.secteur').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        arrows:false,
        dots:false,
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


  $(document).ready(function(){
    $('.sld-video').slick({
    //   dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      adaptiveHeight: true
    });
  });