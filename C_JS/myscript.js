/*Jquery Code*/
  /*========================================================/
 /  |   |   Preloader                              |       /
/========================================================*/
$(window).on('load', function(){
    $('#preloader_status').fadeOut();
    $('#preloader').delay(360).fadeOut('slow');
});

  /*========================================================/
 /  |   | Team  Owl Carousel                           |       /
/========================================================*/

$(document).ready(function(){
  $("#team-members").owlCarousel({
      items: 2,
      autoplay: true,
      smartSpeed: 550,
      loop: true,
      autoplayHoverPause: true,
      dots: false,
      nav: true,
      navText: ['<span><i class="fas fa-angle-left"></i></span>','<span><i class="fas fa-angle-right"></i></span>']
  });
});

  /*========================================================/
 /  |   |   Progress Bars                          |       /
/========================================================*/

$(function(){
    $("#progress-elements").waypoint(function(){
          $(".progress-bar").each(function(){
          $(this).animate({
            width: $(this).attr("aria-valuenow") + "%"
            }, 1000);
        });

        this.destroy();
        }, {
        offset: 'bottom-in-view'
        });
});
  /*========================================================/
 /  |   |   Responsive Tabs                        |       /
/========================================================*/
$(function(){
    $('#services-tabs').responsiveTabs({
    animation: 'slide'
});
});
  /*========================================================/
 /  |   |   Portfolio                     |                /
/========================================================*/
$(window).on('load', function(){
    // init Isotope
var $grid = $('.grid').isotope({
  // options
});
// filter items on button click
$('.portfolio-buttons').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });

    /*adding active class*/
    $('.portfolio-buttons').find('.active').removeClass('active');
    $(this).addClass('active');

});

});

  /*========================================================/
 /  |   |   Magnific Popup                |                /
/========================================================*/
$(function(){
$('.portfolio-item').magnificPopup({
  delegate: 'a', // child items selector, by clicking on it popup will open
  type: 'image',
  // other options
    gallery:{
    enabled:true
  }
});
});

  /*========================================================/
 /  |   | Testimonial  Owl Carousel                |       /
/========================================================*/

$(document).ready(function(){
  $("#testmonial-slider").owlCarousel({
      items: 1,
      autoplay: true,
      smartSpeed: 550,
      loop: true,
      autoplayHoverPause: true,
      dots: false,
      nav: true,
      navText: ['<span><i class="fas fa-angle-left"></i></span>','<span><i class="fas fa-angle-right"></i></span>']
  });
});

  /*========================================================/
 /  |   | Counter                |                         /
/========================================================*/
$(function(){
   $('.counter').counterUp({
        delay: 20,
        time: 3000
    });
});
  /*========================================================/
 /  |   | Clients  Owl Carousel                |       /
/========================================================*/

$(document).ready(function(){
  $("#clients-list").owlCarousel({
      items: 5,
      autoplay: true,
      smartSpeed: 550,
      loop: true,
      autoplayHoverPause: true,
      dots: false,
      nav: true,
      navText: ['<span><i class="fas fa-angle-left"></i></span>','<span><i class="fas fa-angle-right"></i></span>']
  });
});
  /*========================================================/
 /  |   |   Navigation                  |                  /
/========================================================*/
$(function (){
    showHideWhiteNav();

    $(window).scroll(function(){
        showHideWhiteNav();

        });

        function showHideWhiteNav(){
            if($(window).scrollTop() > 50){

            //show white Nav
            $("nav").addClass("white-nav-top");

            //show dark logo Nav
            $(".navbar-brand img").attr("src", "/PHP_WORK/CompleteWeb/GlassLoginform/C_img/favicon/favicon.ico");

            //show Back to Top
                $("#back-to-top").fadeIn();

        }else{
            //Hide white Nav
            $("nav").removeClass("white-nav-top");

            //show normal logo Nav
            $(".navbar-brand img").attr("src", "/PHP_WORK/CompleteWeb/GlassLoginform/C_img/favicon/favicon-32x32.png");

            //Hide Back to Top
                $("#back-to-top").fadeOut();
        }
    }

});

/*smooth scroll*/

$(function(){
 $("a.smooth-scroll").click(function(event){
     event.preventDefault();

     var section_id = $(this).attr("href");


     $("html, body").animate({
         scrollTop: $(section_id).offset().top - 65
     }, 1000, "easeInOutExpo");
 });
});

/*MenuToggle  Effect JS

     window.addEventListener('scroll', function(){
      const header = document.querySelector('header');
      header.classList.toggle("sticky", window.scrollY > 0);
    });

    function toggleMenu(){
      const menuToggle = document.querySelector('.menuToggle');
      const navigation = document.querySelector('.navigation');
      menuToggle.classList.toggle('active');
      navigation.classList.toggle('active');
    }

*/
