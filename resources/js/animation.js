(function($) {
    // "use strict"; // Start of use strict

    wow = new WOW({
      animateClass: 'animated',
      offset: 100
    });
    wow.init();
    

    $(document).scroll(function() {
      var scrollDistance = $(this).scrollTop();      
      if (scrollDistance > 100) {
    
        $('#main-nav').css('background-position-y', '-100%');
        
      }
      if (scrollDistance < 100) {  
        $('#main-nav').css('background-position-y', '0%');
        
      }
    });




    $(".navbar-collapse a").on('click', function() {
      $(".navbar-collapse.collapse").removeClass('in');
    });

    function menu_button_handler(){
      var scrollDistance = $(document).scrollTop();
      if ($('.menu-btn').hasClass('collapsed')){
        $('.menu-btn').removeClass('open')
        if (scrollDistance < 100) {
          $('#main-nav').css('background-position-y', '0%');
        }      


      }else{
        $('.menu-btn').addClass('open')
        if (scrollDistance < 100) {
          $('#main-nav').css('background-position-y', '-100%');
        }
      }
    }



    $('.menu-btn').on('click', function(){
      menu_button_handler();
      // background_handler()
    })

    // console.log($('.navbar-collapse'));

    // $('.navbar-collapse').on('classChange', function(){
    //   console.log($('#main-nav-background'));
      
    //   $('#main-nav-background').animate({top:'0px'}, 1000)
    // })

    // $('.navbar-nav>li>a').on('click', function(){
    //     $('.navbar-collapse').collapse('hide');
    // });
    
    $(document).on('click', function(){
        $('.navbar-collapse').collapse('hide');
        menu_button_handler()
        
        

      }).on('scroll', function(){
        $('.navbar-collapse').collapse('hide');
        menu_button_handler()
    });
    
    $('.hvr-radial-out').on('click', function(){
      $(this).blur()
    })
  





    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
        // console.log('testtrtr');
        
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: (target.offset().top - 80)
          }, 1000, "easeInOutExpo");
          return false;
        }
      }
    });

    $(document).ready(function(){
      
      $(".owl-carousel.owl-6").owlCarousel({
        // items:3,
        loop: true,
        margin:10,
        autoplay:true,
        autoplayTimeout:1500,
        responsiveClass:true,
        mouseDrag: false,
        touchDrag:false,
        pullDrag: false,
        freeDrag: false,
        responsive:{
          0:{
              items:1,
              nav:false,
              loop: true
          },
          650:{
              items:3,
              mouseDrag: true,
              touchDrag:true,
              pullDrag: true,
              freeDrag: true
          },
          1050:{
            items:4,
            mouseDrag: true,
            touchDrag:true,
            pullDrag: true,
            freeDrag: true
          },
          1400:{
            items:6,
            loop:false,
            mouseDrag: false,
            touchDrag:false,
            pullDrag: false,
            freeDrag: false,
              // loop:false
          }
        }
      });

      $('.owl-carousel.owl-3').owlCarousel({
        margin:10,
        loop:true,
        autoplay:true,
        autoplayTimeout:1500,
        responsiveClass:true,
        mouseDrag: false,
        touchDrag:false,
        pullDrag: false,
        freeDrag: false,
        responsive:{
          0:{
              items:1,
              nav:false,
              mouseDrag: true,
              touchDrag:true,
              pullDrag: true,
              freeDrag: true,
              loop: true
          },
          650:{
              items:3,
              loop:false,
              mouseDrag: false,
              touchDrag:false,
              pullDrag: false,
              freeDrag: false,
          },
          1050:{
            items:3,
            loop:false,
            mouseDrag: false,
            touchDrag:false,
            pullDrag: false,
            freeDrag: false,
          },
          1400:{
            items:3,
            loop:false,
            mouseDrag: false,
            touchDrag:false,
            pullDrag: false,
            freeDrag: false,
              // loop:false
          }
        }
      });
      
      $('.owl-carousel.owl-2').owlCarousel({
        margin:10,
        loop:true,
        autoplay:true,
        autoplayTimeout:1500,
        responsiveClass:true,
        mouseDrag: false,
        touchDrag:false,
        pullDrag: false,
        freeDrag: false,
        responsive:{
          0:{
              items:1,
              nav:false,
              loop: true,
              mouseDrag: true,
              touchDrag:true,
              pullDrag: true,
              freeDrag: true
          },
          650:{
              items:2,
              loop:false,
              mouseDrag: false,
              touchDrag:false,
              pullDrag: false,
              freeDrag: false,
          },
          1050:{
            items:2,
            loop:false,
            mouseDrag: false,
            touchDrag:false,
            pullDrag: false,
            freeDrag: false,
          },
          1400:{
            items:2,
            loop:false,
            mouseDrag: false,
            touchDrag:false,
            pullDrag: false,
            freeDrag: false,
              // loop:false
          }
        }
      })
    });
    

  // $(document).ready(function(){
  //   $('.achievement-slider').slick({
  //     dots: true,
  //     infinite: true,
  //     speed: 250,
  //     fade: true,
  //     // slide: '> div',
  //     cssEase: 'linear',

  //     // slidesToShow: 3,
  //     // slidesToScroll: 1,
  //     draggable: false,
  //     autoplay: true,
  //     autoplaySpeed: 7000,
  //     prevArrow: false,
  //     nextArrow: false,
  //     pauseOnHover: false,
  //     pauseOnFocus: false

  //   })
  // });
  
  $('.chevron_down').on('hover', function(){
    console.log($(this));
    
  })

  // $('.fade').slick({
    
  // });
    
  // $('.autoplay').slick({
    
  // });
    

  
    // Scroll to top button appear
    // $(document).scroll(function() {
    //   var scrollDistance = $(this).scrollTop();
    //   if (scrollDistance > 100) {
    //     $('.scroll-to-top').fadeIn();
    //   } else {
    //     $('.scroll-to-top').fadeOut();
    //   }
    // });
  
    // Closes responsive menu when a scroll trigger link is clicked
    // $('.js-scroll-trigger').click(function() {
    //   $('.navbar-collapse').collapse('hide');
    // });
  
    // Activate scrollspy to add active class to navbar items on scroll
    // $('body').scrollspy({
    //   target: '#mainNav',
    //   offset: 80
    // });
  
    // Collapse Navbar
    // var navbarCollapse = function() {
    //   if ($("#mainNav").offset().top > 100) {
    //     $("#mainNav").addClass("navbar-shrink");
    //   } else {
    //     $("#mainNav").removeClass("navbar-shrink");
    //   }
    // };
    // Collapse now if page is not at top
    // navbarCollapse();
    // Collapse the navbar when page is scrolled
    // $(window).scroll(navbarCollapse);
  
    // // Modal popup$(function () {
    // $('.portfolio-item').magnificPopup({
    //   type: 'inline',
    //   preloader: false,
    //   focus: '#username',
    //   modal: true
    // });
    // $(document).on('click', '.portfolio-modal-dismiss', function(e) {
    //   e.preventDefault();
    //   $.magnificPopup.close();
    // });
  
    // Floating label headings for the contact form
    // $(function() {
    //   $("body").on("input propertychange", ".floating-label-form-group", function(e) {
    //     $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
    //   }).on("focus", ".floating-label-form-group", function() {
    //     $(this).addClass("floating-label-form-group-with-focus");
    //   }).on("blur", ".floating-label-form-group", function() {
    //     $(this).removeClass("floating-label-form-group-with-focus");
    //   });
    // });

    
    // setTimeout(runForever, 5000)

    // function progress_bar(){

    //   $(".progress-bar").animate({
    //     width: "100%"
    //   }, 7000, function() {
    //     $(this).css('width', '0%');

    //   });
  
    //   setTimeout(progress_bar, 7000);

    // }
  
    // progress_bar();




    $(document).ready(function(){
      var time = 7;
      var $bar,
          $slick,
          isPause,
          tick,
          percentTime;
      
      $slick = $('.achievement-slider');
      $slick.slick({
        dots: true,
        infinite: true,
        speed: 250,
        fade: true,
        // slide: '> div',
        cssEase: 'linear',
        swipe: false,
        touchMove: false,
        // slidesToShow: 3,
        // slidesToScroll: 1,
        draggable: false,
        // autoplay: true,
        // autoplaySpeed: 7000,
        prevArrow: false,
        nextArrow: false,
        pauseOnHover: false,
        pauseOnFocus: false,
      });
      
      $bar = $('.progress .progress-bar');

      $('.slick-dots button').click(()=>{
        startProgressbar();
      });
      
      // $('.slider-wrapper').on({
      //   mouseenter: function() {
      //     isPause = true;
      //   },
      //   mouseleave: function() {
      //     isPause = false;
      //   }
      // })
      
      function startProgressbar() {
        resetProgressbar();
        percentTime = 0;
        isPause = false;
        tick = setInterval(interval, 10);
      }
      
      function interval() {
        if(isPause === false) {
          percentTime += 1 / (time+0.1);
          $bar.css({
            width: percentTime+"%"
          });
          if(percentTime >= 100)
            {
              $slick.slick('slickNext');
              startProgressbar();
            }
        }
      }
      
      


      function resetProgressbar() {
        $bar.css({
         width: 0+'%' 
        });
        clearTimeout(tick);
      }
      
      startProgressbar();
      
    });
    
    

  }); // End of use strict
  