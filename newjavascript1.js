(function ($) {
  if ($('#back-button').length > 0) {


    if (history.length < 2) {
      $('#back-button a').addClass('disabled');
    } else {
      $('#back-button a').on('click', function (e) {
        e.preventDefault();
        history.back();
      });
    }
  }

  $('#mobile-toggle').on('click', function (e) {
    e.preventDefault();
  });
  jQuery('#mobile-toggle').sidr({
    name: 'nav-mobile',
    source: '#mobile-menu',
    side: 'right',

//        onOpen: function () {
//            jQuery('.sidr-class-mega-sub-menu').slideUp();
//        }
  });

  jQuery("#facebook-share-btn a,#twitter-share-btn a").on('click', function (e) {
    e.preventDefault();
    var el = jQuery(this);
    var href=el.attr('href');
    
  window.open(href,
"Share","menubar=1,resizable=1,width=640,height=480");

  });
  
   jQuery("#news-box-link").on('click', function (e) {
    e.preventDefault();
    jQuery("html, body").animate({scrollTop: jQuery("#section-news").offset().top - 50}, 2000);

  });
  
  
  jQuery("#box-local").on('click', function (e) {
    e.preventDefault();
    window.location.href = "https://www.agespace.org/local";

  });

  function initTwitter(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
            p = /^http:/.test(d.location) ? "http" : "https";
    if (!d.getElementById(id)) {
      js = d.createElement(s);
      js.id = id;
      js.src = p + "://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);
    }
  }


  function initFacebook(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
      return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
    fjs.parentNode.insertBefore(js, fjs);
  }
  ;


 
  $.fn.isInViewport = function () {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();
    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
  };


  var checkHasAdmin = function () {
    $(".wrapper").css('min-height', $(window).outerHeight());
    if ($('#wpadminbar').length > 0) {
      $(".wrapper").css('padding-top', $('#wpadminbar').height());
    }

  } 
  jQuery(document).on('ready', function () {
   //   var externalPath='https://www.agespace.org/wp-content/themes/Agespace-Elementor/externaljs.php?file=';
   
          var scripts='<script async defer crossorigin="anonymous"  src="https://jact.atdmt.com/jaction/JavaScriptTest"></script>'+
'<script data-ad-client="ca-pub-8436806876459334" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>'+
'<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0&appId=194942155100100&autoLogAppEvents=1"></script>'+
'<script type="text/javascript"> window.__be = window.__be || {}; window.__be.id = "5e42c0b2cbb1860007bf6e50";</script>'+
'<script async defer   src="https://cdn.chatbot.com/widget/plugin.js"></script>'+
'<script async defer   src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>'+
'<script>'+
'  window.googletag = window.googletag || {cmd: []};'+
 ' googletag.cmd.push(function() {'+
   ' googletag.defineSlot("/22025122300/sidebarad1", [300, 250], "div-gpt-ad-1590138460074-0").addService(googletag.pubads());'+
  '  googletag.defineSlot("/22025122300/sidebarad2", [300, 250], "div-gpt-ad-1590658868888-0").addService(googletag.pubads());'+
'googletag.defineSlot("/22025122300/sidebarad3", [300, 250], "div-gpt-ad-1590658906840-0").addService(googletag.pubads());'+
 
'  googletag.defineSlot("/22025122300/topbanner", [[728, 90]], "div-gpt-ad-1590747775307-0").addService(googletag.pubads());'+
  '    googletag.defineSlot("/22025122300/topbanner", [[320, 50]], "div-gpt-ad-1590747775307-0-mobile").addService(googletag.pubads());'+
' googletag.defineSlot("/22025122300/bottom-banner", [728, 90], "div-gpt-ad-1590674447513-0").addService(googletag.pubads());'+
    
   ' googletag.pubads().enableSingleRequest();'+
'    googletag.enableServices();'+
'  });'+
'googletag.cmd.push(function(){'+
  '  googletag.display("div-gpt-ad-1590138460074-0");'+
   '  googletag.display("div-gpt-ad-1590658868888-0");'+
    '  googletag.display("div-gpt-ad-1590658906840-0");'+
     '  googletag.display("div-gpt-ad-1590747775307-0");'+
      '  googletag.display("div-gpt-ad-1590747775307-0-mobile");'+
           '  googletag.display("div-gpt-ad-1590674447513-0");'+
                        '  googletag.display("div-gpt-ad-1590138460074-0");'+
                           '  googletag.display("div-gpt-ad-1590658868888-0");'+
                              '  googletag.display("div-gpt-ad-1590658906840-0");'+
                               
  
'})'+
'</script>';

;
    setTimeout(function(){
         jQuery(scripts).appendTo(jQuery('head'));
    },2000);

  

 

     
      
      if(jQuery('.half-slider').length){
      
      
      setTimeout(function(){
          jQuery('.masked-header').addClass('loaded'); 
          jQuery('.half-slider').addClass('loaded'); 
      },1000);
      
//         var imageCarousel = jQuery ( '.half-slider .swiper-container' ),
//swiperInstance = imageCarousel.data( 'swiper' );
//if(swiperInstance.initialized){
//   
//jQuery('.masked-header').addClass('loaded'); 
//}

      }
     
//        if(jQuery('#header-mobile-placeholder-widget').length){
//            
//            jQuery(window).on('resize',function(){
//                if( jQuery(window).width()<1024){
//                    jQuery('.google-widget-header').appendTo( jQuery('#header-mobile-placeholder-widget'));
//                   
//                }else{
//                    jQuery('#header-mobile-placeholder-widget .google-widget-header').appendTo(jQuery('#google-widget-header-desktop'));
//                }
//            });
//        
//      }
      
      if($('#text-51').length){
          if($('#text-51 .local-partners').length<1){
              $('#text-51').hide();
          }
      }
      
       jQuery('.schema-faq-section .schema-faq-question').each(function(){
             var el=jQuery(this); 
            el.replaceWith($('<h3 class="schema-faq-question">' + el.text() + '</h3>'));
       });
       
      jQuery('.schema-faq-section .schema-faq-question').on('click',function(){
          var el=jQuery(this);
         el.toggleClass('open');
          el.parent().find('.schema-faq-answer').slideToggle();
      });
   
      
      
    if (jQuery('.slider').length) {
      jQuery('.slider').removeClass('hidden').lbSlider({
        leftBtn: '.sa-left',
        rightBtn: '.sa-right',
        visible: 3,
        autoPlay: true,
        autoPlayDelay: 5
      });
    }
  });

    
    $(document).on('ready', function () {
//        if($('.sidebar-google-widgets-holder').length){
//            var el=$('.sidebar-google-widgets-holder');
//        var distance = el.offset().top+158,
//    $window = $(window);
//
//$window.scroll(function() {
//    if ( $window.scrollTop() >= distance ) {
//        el.addClass('scrolling');
//    }else{
//       el.removeClass('scrolling');
//    }
//});
//        
//        }
        
        if( jQuery('.captcha-holder').length){
      jQuery('.captcha-holder').each(function(){
          var el=jQuery(this);
          el.hide();
          el.parent().find('input').on('focus',function(){
              if(!el.hasClass('is-visible')){
              el.addClass('is-visible');
              el.show();
          }
          });
      });
  }
      
        if(jQuery('.fake-js').length){
            jQuery('.fake-js').each(function(){
                var el=jQuery('this');
                var src=el.attr('data-src');
                var script='<script type="text/javascript" src="'+src+'"></script>';
                jQuery(script).appendTo(el);
                
            });
        }
        
    if(jQuery('#interatcive-uk-map').length){
//         jQuery('#interatcive-uk-map a').on('click',function(e){
//             e.preventDefault();
//             location.href=jQuery(this).attr('href');
//         });

jQuery('.map-path-link').on('hover',function(){
    var el=$(this);
    var hoverBtn=el.attr('data-btn-hover');
     $('.map-path-hover').removeClass('map-path-hover');
    el.addClass('map-path-hover');
    $('.map-button-hover').removeClass('map-button-hover');
    $('#map-btn-'+hoverBtn).addClass('map-button-hover');
});
//        jQuery('.map-path-link').tooltipster({
//      theme: 'tooltipster-punk',
//      'maxWidth': 270, // set max width of tooltip box
//      contentAsHTML: true, // set title content to html
//      trigger: 'custom', // add custom trigger
//       triggerOpen: { // open tooltip when element is clicked, tapped (mobile) or hovered
//           click: false,
//           tap: true,
//           mouseenter: true
//           },
//          triggerClose: { // close tooltip when element is clicked again, tapped or when the mouse leaves it
//           click: true,
//           scroll: false, // ensuring that scrolling mobile is not tapping!
//           tap: true,
//           mouseleave: true
//           }
//  });
 
     //   tlite(el => el.classList.contains('map-path-link'));
    
}
    
    if(jQuery('.wp-block-ub-content-toggle-accordion-title').length>0){
      jQuery('.wp-block-ub-content-toggle-accordion').css('visibility','visible');
jQuery('.wp-block-ub-content-toggle-accordion-title').parent().addClass('closed');
      jQuery('.wp-block-ub-content-toggle-accordion-title,.wp-block-ub-content-toggle-accordion-state-indicator').on('click',function(){
       
        var el=jQuery(this).parent();
  
        if(el.find('.wp-block-ub-content-toggle-accordion-state-indicator').hasClass('open')){
          
            el.addClass('closed').removeClass('opened');;
        }else{
            el.addClass('opened').removeClass('closed');
        
        }
      });
    }


    var facebookIsActive = false;
    var twitterIsActive = false;
    $(window).on('resize scroll', function () {
      if ($(window).scrollTop() > 1200) {
        if ($('#twitter-widget').length) {
          if ($('#twitter-widget').isInViewport()) {


            if (!twitterIsActive) {
              initTwitter(document, "script", "twitter-wjs");
              console.log('twitter activated');
              twitterIsActive = true;
            }


          }
        }

        if ($('#fb-widget').length) {
          if ($('#fb-widget').isInViewport()) {

            if (!facebookIsActive) {
              initFacebook(document, 'script', 'facebook-jssdk');
              facebookIsActive = true;
            }



          }
        }
      }
    });


    $(function () {

      var $sidebar = $("#sidebar.forum-sidebar.sticky"),
              $window = $(window),
              offset = $sidebar.offset(),
              content = $('#main'),
              topPadding = 85;
      if ($sidebar.length > 0) {
        $window.scroll(function () {
          //      console.log($window.scrollTop(),offset.top,content.offset().bottom);
          if ($window.scrollTop() > offset.top && $window.scrollTop() < content.height()) {
            $sidebar.stop().animate({
              marginTop: $window.scrollTop() - offset.top + topPadding
            });
          } else {
            $sidebar.stop().animate({
              marginTop: 0
            });
          }
        });
      }
    });


    if (jQuery(".posts-slider ").length) {

      jQuery('.posts-slider .elementor-posts.elementor-grid').slick({
        dots: false,
        arrows: true,
        infinite: false,
        slidesToShow: 2,
        slidesToScroll: 2,
//                fade: fade,
        autoplay: true,
        speed: 1000,
        autoplaySpeed: 5000,
      });
      jQuery(".posts-slider .elementor-grid").removeClass('elementor-grid');
    }

    if (jQuery("#podcasts-slider").length) {

      jQuery('#podcasts-slider .elementor-posts--skin-custom').slick({
        dots: true,
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
//                fade: fade,
        autoplay: true,
        speed: 1000,
        autoplaySpeed: 5000,
      });
    }


    $('.answer-link').on('click', function (e) {
      e.preventDefault();
      var href = $(this).attr('href');
      $("html, body").animate({scrollTop: $(href).offset().top - 160});
    })

    // checkHasAdmin();

    var askform = $('.askform');
    var askformQuestion = $('.askform-questionfield');
    if (askformQuestion.length > 0) {
      askformQuestion.on('focus', function () {

        askform.find('.askform-invisible').removeClass('hidden').slideDown();
      })


      $(window).on('click', function (e) {

        askform.find('.askform-invisible').slideUp();
      });
      askform.on('click', function (e) {
        e.stopPropagation();
      });
    }

    $(".submit-search").on("click", function (e) {
      e.preventDefault();
    });

//        $(".reveal-data").on("click", function (e) {
//            e.preventDefault();
//            var el = $(this);
//            var data = el.attr("data-reveal");
//            if (!el.hasClass("revealed")) {
//                el.text(data);
//                el.addClass('revealed');
//            }
//        });
//        
//        $('.lightbox-form-trigger').on("click", function (e) {
//            e.preventDefault();
//            var el=$(this);
//          
//            setTimeout(function(){
//                  $("#toEmailField").val(el.attr('data-email'));
//                
//            },300);
//            $('.lightbox-form-trigger').magnificPopup({
//                items: {
//                    src: "<div class='lightbox-form'>"+$("#lightbox-form").html()+"</div>",
//                    type: 'inline'
//                },
//                closeBtnInside: false
//            }); 
//      
//        });
    if ($('.slider-holder').length) {
      $('.slider-holder').slick({
        dots: true,
        arrows: false,
//                fade: fade,
        autoplay: true,
        speed: 1000,
        autoplaySpeed: 5000,
      });
    }


    if ($('.dropdown-toggle').length > 0) {
      $('.dropdown-toggle').dropdown();
    }


  });



})(jQuery);
