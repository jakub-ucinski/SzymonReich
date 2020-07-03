import Typed from 'typed.js';

$(document).ready(function() {


    $(function () {
      $('[data-toggle="popover"]').popover({
        offset: '-100px',
        delay:{'hide': 3000}
        }).click(function () {
          setTimeout(function () {
              $('[data-toggle="popover"]').popover('hide');
          }, 3000);});
    })
  
    $('.nav-link').on('click', function(){
      $(this).blur()
    })
  

  
    // var typede = $(".typed");
    var options = {
        strings: ["odelem.", "uzykiem.", "inistrantem."],
        typeSpeed: 50,
        loop: true,
      }
    var typed = new Typed('.typed', options);

    // $(function() {
    //   typed.typed({
    //     strings: ["odelem.", "uzykiem.", "inistrantem."],
    //     typeSpeed: 50,
    //     loop: true,
    //   });
    // });
  
  
  
    // setInterval()
    var goToNextAboutInterval = setInterval(goToNextAbout, 10000);
  
    function goToNextAbout() {
    //  console.log('worksee');
    
    //  var test = $('#about_section .section_switcher .focused_on').next()
  
     var nextAbout = ($('#about_section .section_switcher .focused_on').next().length ? $('#about_section .section_switcher .focused_on').next() : $('#about_section .section_switcher span').first())
  
     $('#about_section .section_switcher .focused_on').removeClass('focused_on')
     
     nextAbout.addClass('focused_on')
      
     var heading = nextAbout.text()
  
      $('#about_section .about_text span').each(function(){
        if ($(this.attributes.datatarget).val().toUpperCase() == heading.toUpperCase()){
          $(this.parentNode).addClass('focused_on');
          $(this.parentNode).siblings().removeClass('focused_on');
        }
      });
    }
  
    $('#about_section .section_switcher span').on('click', function(){
      clearInterval(goToNextAboutInterval);
      goToNextAboutInterval = setInterval(goToNextAbout, 10000);
  
  
      $(this).siblings().removeClass('focused_on')
      $(this).addClass('focused_on')
      var heading = $(this).text()
  
      $('#about_section .about_text span').each(function(){
        if ($(this.attributes.datatarget).val().toUpperCase() == heading.toUpperCase()){
          $(this.parentNode).addClass('focused_on');
          $(this.parentNode).siblings().removeClass('focused_on');
        }
      });
    })
  
  });