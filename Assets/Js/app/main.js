$(function(){
    // a[rel='tab']
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
$(window).bind('popstate', function( e ) {
    $(".content").load(location.pathname+" .content");
});


//nav bar .navbar-fixed-
/*var nav = $('#navbar');
$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    nav.addClass("navbar-fixed-top");
  } else {
    nav.removeClass("navbar-fixed-top");
  }
});*/


//search form

(function () {

})();


/*==================================================
  home page script
==================================================*/

var holder = $('#holder');
// show hide sub nav
var navSlide = {
    init : function () {
        $('.section-title').children('a').on('click' , function( e ) {
            e.preventDefault();
            $(this).parent().addClass('opened-title').siblings('.sub-nav').slideToggle('fast');
        });
    }
};


var sectionWidth = {
    init: function () {
        $('#holder').on({
            mouseenter: function () {
                if( !$('#holder').hasClass('opened') ) {
                    //mouse_is_inside = true;
                    $(this).removeClass('width-20-per').addClass('width-40-per')
                    .siblings('section').removeClass('width-20-per').addClass('width-15-per opacity-20');
                    $(this).find('.btn-more').show();

                }//if
            },

            mouseleave: function () {
                if( !$('#holder').hasClass('opened') ) {

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




$( document ).ajaxComplete(function( event,request, settings ) {



  //range slider
/*  var rangeValues = {
      "1": "100 000 or less",
      "2": "200 000 or less",
      "3": "300 000 or less",
      "4": "400 000 or less",
      "5": "500 000 or less",
      "6": "600 000 or less",
      "7": "700 000 or less",
      "8": "800 000 or less",
      "9": "900 000 or less",
      "10": "1000 000 or More",
  };

  $('#rangeText').text(rangeValues[$('#rangeInput').val()]);

  $('#rangeInput').on('change', function () {
        $('#rangeText').text(rangeValues[$(this).val()]);
  });
*/
  //type head
  // http://twitter.github.io/typeahead.js/examples/

  $('#location').typeahead({
    local: [
          "Alabama",
          "Alaska",
          "Arizona",
          "Arkansas",
          "California",
          "Colorado",
          "Connecticut",
          "Delaware",
          "Florida",
          "Georgia",
          "Hawaii",
          "Idaho",
          "Illinois",
          "Indiana",
          "Iowa",
          "Kansas",
          "Kentucky",
          "Louisiana",
          "Maine",
          "Maryland",
          "Massachusetts",
          "Michigan",
          "Minnesota",
          "Mississippi",
          "Missouri",
          "Montana",
          "Nebraska",
          "Nevada",
          "New Hampshire",
          "New Jersey",
          "New Mexico",
          "New York",
          "North Carolina",
          "North Dakota",
          "Ohio",
          "Oklahoma",
          "Oregon",
          "Pennsylvania",
          "Rhode Island",
          "South Carolina",
          "South Dakota",
          "Tennessee",
          "Texas",
          "Utah",
          "Vermont",
          "Virginia",
          "Washington",
          "West Virginia",
          "Wisconsin",
          "Wyoming"
        ]
  });

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


/*$('#property-type').typeahead({
  minLength: 0,
  local: [
        "Any",
        "Single-Family Home",
        "Condo"
      ]
});
$("#property-type").on('focus', function() {

});
*/








  $('.btn-more').hide();
  navSlide.init();
  sectionWidth.init();


  $('.article').find('a').on( 'click', function (e ) {
    e.preventDefault();

    if( !$( this ).closest('.article').hasClass('opened') ) {

      //get the link location that was clicked
      pageurl = $(this).attr('href');

      //$("#divLoad").load(pageurl+'?rel=tab'+" #holer-content");

      var article = $(this).closest('.article');
      var loadDivWrapper = $('<div id=loadDivWrapper class=openedLoad></div>').appendTo( article );
      var loadDiv = $('<div id=loadDiv></div>').appendTo( loadDivWrapper );

      loadDiv.load(pageurl+" #holer-content");

      $('html,body').animate({
          scrollTop: loadDivWrapper.offset().top},
          'slow');


      $('#holder').addClass('opened');
      article.addClass('opened');
      var closeBtn = $('<span id=closeBtn>×</span>');
      closeBtn.appendTo( loadDivWrapper );


      //to change the browser URL to 'pageurl'
      if(pageurl!=window.location){
          window.history.pushState({path:pageurl},'',pageurl);
      };
      //return false;

      closeBtn.on('click', function ( ) {
          /*loadDivWrapper.fadeOut(100, function(){ $(this).remove();});*/
          loadDivWrapper.remove();
          article.removeClass('opened');
          $('#holder').removeClass('opened');
          //window.history.back();

          $('#holder section').removeClass('width-40-per').addClass('width-20-per')
          .siblings('section').removeClass('width-15-per opacity-20').addClass('width-20-per');

      });
    };
})

});

