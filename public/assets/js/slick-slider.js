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
              arrows:true,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              arrows:true,
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              arrows:true,
            }
          }
        ]
    });
    $('.avantage-tab-content').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 10000,
      centerMode: true,
      arrows:true,
      dots:false,
      prevArrow: $('.av-prev'),
      nextArrow: $('.av-next'),
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            arrows:true,
            centerMode: true,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows:true,
            centerMode: false,
            centerPadding: '40px',
          }
        },
        
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