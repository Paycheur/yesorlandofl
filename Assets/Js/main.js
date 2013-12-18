/*==================================================
  Ajax for link load
==================================================*/

/*var ajaxLinks = {
    init : function ( link ) {
      link.on('click', function(e){
          e.preventDefault();
          $this = $(this);
          //get the link location that was clicked
          pageurl = $this.attr('href');
          //loading
          $(".content").load(pageurl+" .content");
          //to change the browser URL to 'pageurl'
          if(pageurl!=window.location){
              window.history.pushState({path:pageurl},'',pageurl);
          }
          return false;
      })
    }
};
*/
/* the below code is to override back button to get the ajax content without reload*/
/*$(window).bind('popstate', function( e ) {
    $(".content").load(location.pathname+" .content");
});
*/
/*var navActiveLink = {
    init : function ( link ) {
      link.on('click', function(e){
        //activing class
        $this = $(this);
        $this.parent().siblings().removeClass('active');
        $this.parent('li').addClass('active');
      })
    }
};

var navLinks = $("a[rel='tab']");*/


/*==================================================
  Search
==================================================*/
// types
var btnDropdownTypes = {
      init : function ( theBtn, closeOpen , openClose ) {
        theBtn.on('click', function () {
            closeOpen.hide('fast');
            openClose.toggle('slow');
          // $('html,body').animate({scrollTop: 400}, 1000);
        });
      }
};

//slider price range
var priceRange = {
    init : function  ( theInput ) {
      theInput.slider({

            step: 1

          }).on('slide', function( ev ){
              var theVal =  + ev.value[1],
              $this = $(this),
              theValMin =  + ev.value[0],
              theMax =  + $this.data('slider-max'),
              minSpan = $this.parent('.slider').siblings('label').find('.theMin'),
              maxSpan = $this.parent('.slider').siblings('label').find('.theMax'),
              unite = $('.unite'),
              uniteVal = unite.text() ;
              unite.siblings('.orMore').hide();
              console.log(ev.value);
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
    }

};

var plusMinus = {
    init : function ( thePlusBtn, theMinusBtn) {
          thePlusBtn.click(function(e){
              // Stop acting like a button
              e.preventDefault();
              // Get the field name
              fieldName = $(this).attr('field');
              var theInput  = $('input[name='+fieldName+']');
              // Get its current value
              var currentVal = parseInt(theInput.val());

              // If is not undefined
              if (!isNaN(currentVal)) {
                  // Increment
                  if (  theInput.val() < 5 ) {
                        theInput.val(currentVal + 1);
                        var updatedVal = theInput.val();

                        if (  theInput.parents('.bedsHolder').length ) {
                            if (  theInput.val() == 0 )  {
                              $('#bedsNum').text( 'Any beds');
                            }else if (  theInput.val() == 1 )  {
                              $('#bedsNum').text( updatedVal + ' bed or more');
                            }else {
                              $('#bedsNum').text( updatedVal + ' beds or more');
                            }
                        } else {
                            if (  theInput.val() == 0 )  {
                              $('#bathNum').text( 'Any baths');
                            }else if (  theInput.val() == 1 )  {
                              $('#bathNum').text( updatedVal + ' bath or more');
                            }else {
                              $('#bathNum').text( updatedVal + ' baths or more');
                            }
                        }
                  };

              } else {
                  // Otherwise put a 0 there
                  theInput.val(0);
              }
          });
          theMinusBtn.click(function(e) {
              // Stop acting like a button
              e.preventDefault();
              // Get the field name
              fieldName = $(this).attr('field');
              // Get its current value
              var currentVal = parseInt($('input[name='+fieldName+']').val());

              var theInput = $('input[name='+fieldName+']');
              // If it isn't undefined or its greater than 0
              if (!isNaN(currentVal) && currentVal > 0) {
                  // Decrement one
                  theInput.val(currentVal - 1);
                  var updatedVal = theInput.val();

                  if (  theInput.parents('.bedsHolder').length ) {

                      if (  theInput.val() == 0 )  {
                        $('#bedsNum').text( 'Any beds');
                      }else if (  theInput.val() == 1 )  {
                        $('#bedsNum').text( updatedVal + ' bed or more');
                      }

                      else {
                        $('#bedsNum').text( updatedVal + ' beds or more');
                      }
                  }else {
                      if (  theInput.val() == 0 )  {
                        $('#bathNum').text( 'Any baths');
                      }else if (  theInput.val() == 1 )  {
                        $('#bathNum').text( updatedVal + ' bath or more');
                      }else {
                        $('#bathNum').text( updatedVal + ' baths or more');
                      }
                  }

              } else {
                  // Otherwise put a 0 there
                  theInput.val(0);
              }
          });
    }
};


/*==================================================
  Homepage
==================================================*/

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

var loadItem = {
    init : function () {
      $('.article').find('a').on( 'click', function ( e ) {
        e.preventDefault();
        if( !$('#holder').hasClass('opened') ) {

          //get the link location that was clicked
          pageurl = $(this).attr('href');


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
    }
};
/*==================================================
  when document is ready
==================================================*/
(function($) {
  //ajaxLinks.init( navLinks );
  //navActiveLink.init( navLinks );


  // SEARCH CALLING FUNCTIONS
    // --cities
    $('.selectpicker').selectpicker({
      'selectedText': 'cat'
    });
    //http://www.eyecon.ro/bootstrap-datepicker/
    var $dataPickerInput = $( "#dataPickerInput" );

    if ( $dataPickerInput.length ) {

        $dataPickerInput.datepicker();

    }


    // --types
//    var  residentialTypeBtn= $('#residential-type-btn'),
//         residentialTypeBtn= $('#commercial-type-btn'),
//         commercialTypes= $('#commercial-types'),
//         residentailTypes= $('#residentail-types'),;
//    btnDropdownTypes.init( $('#residential-type-btn'),  commercialTypes, residentailTypes);
//    btnDropdownTypes.init( $('#commercial-type-btn'),  residentailTypes, commercialTypes);

    $('#residential-type-btn').on('click', function () {
        //$(this).find('i').toggleClass( [ 'icon-angle-down', 'icon-angle-up' ])
        $('#commercial-types').hide('fast');
        $('#vacant_land-types').hide('fast');
        $('#rental-types').hide('fast');
        $('#residentail-types').toggle('slow');
        //$('html,body').animate({scrollTop: 400}, 1000);

    });

    $('#commercial-type-btn').on('click', function () {
        $('#residentail-types').hide('fast');
        $('#vacant_land-types').hide('fast');
        $('#rental-types').hide('fast');
        $('#commercial-types').toggle('slow');
        //$('html,body').animate({scrollTop: 400}, 1000);

    });

    $('#vacant_land-type-btn').on('click', function () {
        $('#commercial-types').hide('fast');
        $('#rental-types').hide('fast');
        $('#residentail-types').hide('fast');
        $('#vacant_land-types').toggle('slow');
        //$('html,body').animate({scrollTop: 400}, 1000);

    });

    $('#rental-type-btn').on('click', function () {
        $('#commercial-types').hide('fast');
        $('#vacant_land-types').hide('fast');
        $('#residentail-types').hide('fast');
        $('#rental-types').toggle('slow');
        //$('html,body').animate({scrollTop: 400}, 1000);

    });
    // -- price Range slider
    priceRange.init( $('#price-range') );
    $('#price-range').slider( 'getValue',  function (value) {
        return 'Current value: '+value;
    });

    priceRange.init( $('#price-range-lease') );


    // -- + et - buttons
    plusMinus.init( $('.qtyplus'), $(".qtyminus") );

  //Home page init


    navSlide.init();
    sectionWidth.init();
    loadItem.init();



    // timeline fade
    imgs = $('#fadeImages').find("img").not(':first').fadeTo(0, 0);
    $(window).scroll(function(d,h) {
      imgs.each(function(i) {
      a = $(this).offset().top + $(this).height();
      b = $(window).scrollTop() + $(window).height();
      if (a < b) $(this).fadeTo(500,1);
      });
    });



})(jQuery);

/*==================================================
  Register a handler to be called when Ajax requests complete
==================================================*/
/*$( document ).ajaxComplete(function() {

  //main homepage slider
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

  // SEARCH CALLING FUNCTIONS
    // --cities
    $('.selectpicker').selectpicker({
      'selectedText': 'cat'
    });
    // --types
    var  residentialTypeBtn= $('#residential-type-btn'),
         residentialTypeBtn= $('#commercial-type-btn'),
         commercialTypes= $('#commercial-types'),
         residentailTypes= $('#residentail-types');
    btnDropdownTypes.init( $('#residential-type-btn'),  commercialTypes, residentailTypes);
    btnDropdownTypes.init( $('#commercial-type-btn'),  residentailTypes, commercialTypes);
    // -- price Range slider
    priceRange.init( $('#price-range') );
    // -- + et - buttons
    plusMinus.init( $('.qtyplus'), $(".qtyminus") );

  //Home page init
    stickyHeaders.init();
    navSlide.init();
    sectionWidth.init();


});*/
//Run a function when the page is fully loaded including graphics.
$( window ).load(function() {
  // Run code
});

