$(function(){
    $("a[rel='tab']").on('click', function(e){
        e.preventDefault();
        $this = $(this);
        //get the link location that was clicked
        pageurl = $this.attr('href');

        $('nav').find('li').removeClass('active');
        $this.parent('li').addClass('active');

        $(".content").load(pageurl+" .content");

        //to change the browser URL to 'pageurl'
        if(pageurl!=window.location){
            window.history.pushState({path:pageurl},'',pageurl);
        }
        return false;
    });
});

/* the below code is to override back button to get the ajax content without reload*/
//$(window).bind('popstate', function( e ) {
//	console.log(location.pathname);
//    $(".content").load(location.pathname+" .content");
//});


//search form

/*==================================================
  home page script
==================================================*/

// show hide sub nav
var navSlide = {
    init : function () {
        $('.section-title').children('a').on('mouseenter' , function( e ) {
            e.preventDefault();
            $(this).parent().addClass('opened-title').siblings('.sub-nav').slideDown('slow');
        });
    }
};



var sectionWidth = {
    init: function () {
      var holder = $('#holder');
        holder.on({
            mouseenter: function () {
                if( !holder.hasClass('opened') ) {
                    $(this).removeClass('width-20-per').addClass('width-40-per')
                    .siblings('section').removeClass('width-20-per').addClass('width-15-per opacity-20');
                    $(this).find('.btn-more').show();
                }//if
            },

            mouseleave: function () {
                if( !holder.hasClass('opened') ) {

                // mouse_is_inside = false;
                var $this = $(this);

                $this.removeClass('width-40-per').addClass('width-20-per')
                .siblings('section').removeClass('width-15-per opacity-20').addClass('width-20-per');

                $this.find('.sub-nav').slideUp();


                }//if
                $(this).find('.btn-more').hide();
            }
        }, 'section');
    }
};


$(function() {
    (function (){
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  0,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });

    })();

 // residential/ commercial types

  $('#residential-type-btn').on('click', function () {
      //$(this).find('i').toggleClass( [ 'icon-angle-down', 'icon-angle-up' ])
      $('#commercial-types').hide('fast');
      $('#residentail-types').toggle('slow');
      $('html,body').animate({scrollTop: 400}, 1000);

  });

  $('#commercial-type-btn').on('click', function () {
      $('#residentail-types').hide('fast');
      $('#commercial-types').toggle('slow');
      $('html,body').animate({scrollTop: 400}, 1000);

  });

// icon-angle-down

  //slider price range
$('#price-range')
.slider().on('slide', function( ev ){
var theVal =  + ev.value[1],
        $this = $(this),
        theValMin =  + ev.value[0],
        theMax =  + $this.data('slider-max'),
        minSpan = $('.theMin'),
        maxSpan = $('.theMax'),
        unite = $('.unite'),
        uniteVal = unite.text() ;
        unite.siblings('.orMore').hide();
     if ( theVal === theMax ) {
        maxSpan.text( theMax + ' ' + uniteVal  + ' or more' );
        unite.hide();
        minSpan.text( theValMin);
     }else if ( theVal !== theMax ) {
        maxSpan.text( theVal );
        minSpan.text( theValMin );
        unite.show();
     };
});

  //slider

    $(function() {
      $('#ei-slider').eislideshow({
                animation     : 'center',
                autoplay      : false,
                slideshow_interval  : 3000,
                titlesFactor    : 0,
                speed           : 800,
                titlesFactor        : 0.60,
                // titles animation speed
                titlespeed          : 800,
                // titles animation easing
                titleeasing         : '',
                // maximum width for the thumbs in pixels
                thumbMaxWidth       : 150
      });
   });

  var sectionHeader= $('.section-header');

  $(window).scroll(function () {
      if ($(this).scrollTop() > 600) {
          sectionHeader.addClass("sticky").fadeIn('slow');
      } else {
          sectionHeader.removeClass("sticky");
      }
  });


  //type head
  // http://twitter.github.io/typeahead.js/examples/


  $('.selectpicker').selectpicker({
    'selectedText': 'cat'
  });


// This button will increment the value
$('.qtyplus').click(function(e){
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($('input[name='+fieldName+']').val());
    // If is not undefined
    if (!isNaN(currentVal)) {
        // Increment
        $('input[name='+fieldName+']').val(currentVal + 1);
    } else {
        // Otherwise put a 0 there
        $('input[name='+fieldName+']').val(0);
    }
});
// This button will decrement the value till 0
$(".qtyminus").click(function(e) {
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($('input[name='+fieldName+']').val());
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > 0) {
        // Decrement one
        $('input[name='+fieldName+']').val(currentVal - 1);
    } else {
        // Otherwise put a 0 there
        $('input[name='+fieldName+']').val(0);
    }
});




  $('.btn-more').hide();
  navSlide.init();

  $('#home-video').addClass('dropVid').css('display', 'block');

  /*var homeVid = $('<iframe width="640" height="380" class="home-video" src="//www.youtube.com/embed/FMglR-nQnsU?rel=0" frameborder="0" allowfullscreen></iframe>').hide();
  $('#videoHolder').append(homeVid);
  homeVid.slideDown('slow');*/

  //$('#videoHome').modal('show');

  sectionWidth.init();


  $('.article').find('a').on( 'click', function ( e ) {
    e.preventDefault();
    //!$( this ).closest('.article').hasClass('opened')
    if( !$('#holder').hasClass('opened') ) {

      //get the link location that was clicked
      pageurl = $(this).attr('href');

      //$("#divLoad").load(pageurl+'?rel=tab'+" #holer-content");

      var article = $(this).closest('.article');
      var loadDivWrapper = $('<div id=loadDivWrapper class=openedLoad></div>').appendTo( article );
      var loadDiv = $('<div id=loadDiv></div>').appendTo( loadDivWrapper );

      loadDiv.load(pageurl+" #holer-content");

      var offset = parseInt(loadDivWrapper.offset().top);
      var bheight = $(window).height();
      var percent = 0.2;
      var hpercent = bheight * percent;
      $('html,body').animate({scrollTop: offset - hpercent}, 1000);


      $('#holder').addClass('opened');
      article.addClass('opened');
      var closeBtn = $('<a href=index.php id=closeBtn rel=tab >×</a>');
      closeBtn.appendTo( loadDivWrapper );

      $(function(){
          $("#closeBtn").on('click', function(e){
              e.preventDefault();
              $this = $(this);
              //get the link location that was clicked
              pageurl = $this.attr('href');

              $(".content").load(pageurl+" .content");

              //to change the browser URL to 'pageurl'
              if(pageurl!=window.location){
                  window.history.pushState({path:pageurl},'',pageurl);
              }
              return false;
          });
      });


      //to change the browser URL to 'pageurl'
      if(pageurl!=window.location){
          window.history.pushState({path:pageurl},'',pageurl);
      };
      //return false;

      closeBtn.on('click', function ( e ) {

          e.preventDefault();
          loadDivWrapper.remove();
          article.removeClass('opened');
          $('#holder').removeClass('opened');

          $('#holder section').removeClass('width-40-per').addClass('width-20-per')
          .siblings('section').removeClass('width-15-per opacity-20').addClass('width-20-per');

          $('.sub-nav').slideUp();

          //to change the browser URL to 'pageurl'
          if(pageurl!=window.location){
              window.history.pushState({path:pageurl},'',pageurl);
          }
          return false;

      });
    };
  });
});
