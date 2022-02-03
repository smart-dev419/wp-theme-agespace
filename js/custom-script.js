(function ($) {
    
    

    if(jQuery('.animate-placeholder').length){
      
        
        // your custome placeholder goes here!
var ph ,
	searchBar = $('.animate-placeholder .elementor-field-textual'),
	// placeholder loop counter
	phCount = 0;
    }

// function to return random number between
// with min/max range
function randDelay(min, max) {
	return Math.floor(Math.random() * (max-min+1)+min);
}

// function to print placeholder text in a 
// 'typing' effect
function printLetter(string, el) {
	// split string into character seperated array
	var arr = string.split(''),
		input = el,
		// store full placeholder
		origString = string,
		// get current placeholder value
		curPlace = $(input).attr("placeholder"),
		// append next letter to current placeholder
		placeholder = curPlace + arr[phCount];
		
	setTimeout(function(){
		// print placeholder text
		$(input).attr("placeholder", placeholder);
		// increase loop count
		phCount++;
		// run loop until placeholder is fully printed
		if (phCount < arr.length) {
			printLetter(origString, input);
		}
	// use random speed to simulate
	// 'human' typing
	}, randDelay(50, 90));
}  

// function to init animation
function placeholder() {
  
      
        if(jQuery('.animate-placeholder').length){
            
            
              ph =   $(searchBar).attr("placeholder");
        $(searchBar).attr("placeholder", "");
        
        setTimeout(function(){
            printLetter(ph, searchBar);
        },3000);
        
	
        }
   
        
       
 
}
jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ){
            this.addEventListener("touchstart", handle, { passive: true });
        }
    };
placeholder();
$('.submit').click(function(e){
	phCount = 0;
	e.preventDefault();
	placeholder();
});

if(jQuery('.weird-slider').length){
    
     $(".weird-slider").on("mousedown touchstart", function(e) {
    $(this).addClass('grabbing');
});


$(".weird-slider").on("mouseup touchend", function(e) {
    $(this).removeClass('grabbing');
});

}
  
    
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

    jQuery("#facebook-share-btn a,#twitter-share-btn a").on('click', function (e) {
        e.preventDefault();
        var el = jQuery(this);
        var href = el.attr('href');

        window.open(href,
                "Share", "menubar=1,resizable=1,width=640,height=480");

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


    function initFacebook() {
        console.log('facebook-injected');
    }
    ;






    var checkHasAdmin = function () {
        $(".wrapper").css('min-height', $(window).outerHeight());
        if ($('#wpadminbar').length > 0) {
            $(".wrapper").css('padding-top', $('#wpadminbar').height());
        }

    };
    jQuery(document).on('ready', function () {
//        jQuery('<div class="enhanced-box-wrap"></div>').appendTo('.gform_body > div');
//   
//    
//     
//     var myDiv1 =  jQuery('.gform_body > div > div:nth-last-child(1)');
//  
//     var myDiv2 =  jQuery('.gform_body > div > div:nth-last-child(2)');
//     var myDiv3 =  jQuery('.gform_body > div > div:nth-last-child(3)');
//     
//  myDiv1.appendTo('.enhanced-box-wrap');
//    myDiv2.appendTo('.enhanced-box-wrap');
//      myDiv3.appendTo('.enhanced-box-wrap');
//         jQuery('.gform_body > div > div:nth-last-child(1),.gform_body > div > div:nth-last-child(2),.gform_body > div > div:nth-last-child(3)').detach();
          
        
        if( jQuery('.counties-select').length){
            jQuery('.counties-select').on('change',function(){
                 window.location.href= jQuery('.counties-select').val();
            });
            
        }
        
        if( jQuery('[data-settings*="background_background"]').length){
              jQuery('[data-settings*="background_background"]').attr('rel','preload');
        }
 
//   if( jQuery('.home-top-banner').length){
//              jQuery('.home-top-banner').attr('rel','preload');
//        }
        
        jQuery('p').each(function() {
    var $this = jQuery(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
});
        
if(jQuery('#wp-admin-bar-edit').length){
    jQuery('#wp-admin-bar-edit a').attr('href',encodeURI(jQuery('#edit-link-fix').text()));
}


        if (jQuery('.step1form').length > 0) {


            var step1form = jQuery('.step1form');
            var allFieldsFilled;

            jQuery('.step1form').each(function () {
                el = jQuery(this);
                allFieldsFilled = true;

                el.find('.input-field input').each(function () {


                    // console.log(jQuery(this).val());
                    if (jQuery(this).val() === '') {
                        //    console.log(jQuery(this).val()+' this is not ok');
                        allFieldsFilled = false;
                        el.find('.gform_footer').removeClass('active');

                    }
                });


                //  console.log(allFieldsFilled);
                if (allFieldsFilled) {
                    el.find('.gform_footer').addClass('active');


                }
            });

            step1form.each(function () {
                var el = jQuery(this);
                el.find('.input-field input').on('keyup', function () {
                    allFieldsFilled = true;

                    el.find('.input-field input').each(function () {


                        // console.log(jQuery(this).val());
                        if (jQuery(this).val() === '') {
                            //    console.log(jQuery(this).val()+' this is not ok');
                            allFieldsFilled = false;
                            el.find('.gform_footer').removeClass('active');

                        }
                    });


                    //  console.log(allFieldsFilled);
                    if (allFieldsFilled) {
                        el.find('.gform_footer').addClass('active');


                    }


                });



            });


        }

        if (jQuery('.step2form').length > 0) {


            var formIsValid = false;


            var username = jQuery('#input_18_21');
            var password = jQuery('#input_18_22');
            var agerange = jQuery('#input_18_23');
            var gender = jQuery('#input_18_20');

            var zipcode = jQuery('#input_18_25');
            var postcode = jQuery('#input_18_10');

            var countryDropdown = jQuery('#input_18_11');
            var countyDropdown = jQuery('.county-field select');

            var hiddenState = jQuery('#input_18_18');
            var englandValue = jQuery('#input_18_13');
            var scotlandValue = jQuery('#input_18_14');
            var walsValue = jQuery('#input_18_15');
            var irlandalue = jQuery('#input_18_16');
           // var otherValue = jQuery('#input_18_19');

            var fieldsTexts = [username, password, hiddenState, zipcode, postcode];
            var fieldsRadios = [agerange, gender];
             var fieldsDropdowns = [countryDropdown,englandValue, scotlandValue,walsValue,irlandalue];
var selectorsToCheck = fieldsDropdowns.concat(fieldsTexts).concat(fieldsRadios);

var validatorTimer = setInterval(elValidate,1000);

fieldsTexts.forEach(function (item, index) {
    item.on('keyup', elValidate);
});

 jQuery('#gform_18 .gform_footer').on('hover', elValidate);
 
function elValidate() {

                formIsValid = true;

                fieldsTexts.forEach(function (item, index) {
                    if (item.is(':visible')) {
                        if (item.val() == "Empty" || item.val() == '') {
                            formIsValid = false;
                        //    console.log(item.selector);
                        //    console.log('is NOT valid INPUT');
                        }
                    }
                });
                fieldsRadios.forEach(function (item, index) {
                    if (item.find('input:checked').val() == '' || item.find('input:checked').val() == undefined || item.find('input:checked').val() == 'undefined' || item.find('input:checked').val() == 'NULL') {
                        formIsValid = false;
                     //    console.log(item.selector);
                     //   console.log('is NOT valid RADIOS' );
                    }
                });
                fieldsDropdowns.forEach(function (item, index) {
                  
                    if (item.parent().parent().is(':visible')) {
                      if(item.find('option:selected').val()=='first'){
                       //      console.log(item.selector);
                      formIsValid = false;
                     //     console.log('DROPDOWN is NOT valid' );
               }
           }
                });
             
               
if(!jQuery('#input_18_22_strength_indicator').hasClass('strong')){
    //  formIsValid = false; jQuery('.corona-guide-form input[type="submit"]').on('click')
       // console.log('password is not strong' );
}               
             

                console.log('Final formIsValid: ' + formIsValid);
                
                
                if(formIsValid){
                    clearInterval(validatorTimer);

                   jQuery('#gform_submit_button_18').parent().addClass('active'); 
                }else{
                      jQuery('#gform_submit_button_18').parent().removeClass('active'); 
                }
                
            }
           




            //    jQuery('.selectize-input.disabled.locked').removeClass('disabled locked');
//     countryDropdown.on('click',function(){
//                 jQuery(this).selectize({
            countryDropdown.selectize({
                render: {
                    option: function (data, escape) {
                        if (data.value == 'first') {
                            return '<div class="option" style="pointer-events: none; ">' + escape(data.text) + '</div>';

                        }


                        return '<div class="option"><span class="flag-icon flag-icon-' + String(escape(data.value)).toLowerCase() + '"></span>' + escape(data.text) + '</div>';
                    },
                    item: function (data, escape) {
                        return '<div class="item"><span class="flag-icon flag-icon-' + String(escape(data.value)).toLowerCase() + '"></span>' + escape(data.text) + '</div>';
                    }

                },
                onChange: function (value) {
                    console.log('Selectize changed: ' + value);

                    var val = value;
                    var valEnter = "";
                    switch (val) {
                        case "england":
                            setTimeout(function () {
                                englandValue.selectize({
                                    create: true,
                                    sortField: 'text'
                                });
                            }, 500);
                            break;
                        case "wales":
                            setTimeout(function () {
                                walsValue.selectize({
                                    create: true,
                                    sortField: 'text'
                                });
                            }, 500);

                            break;
                        case "scotland":
                            setTimeout(function () {
                                scotlandValue.selectize({
                                    create: true,
                                    sortField: 'text'
                                });
                            }, 500);

                            break;
                        case "ireland":


                            setTimeout(function () {
                                irlandalue.selectize({
                                    create: true,
                                    sortField: 'text'
                                });
                            }, 500);
                            break;

                        default:

                            break;
                    }
                    console.log('country changed:' + valEnter + '  ' + walsValue);
                    console.log(hiddenState);
                    hiddenState.val(valEnter);

                }
            });
//     });


            countyDropdown.on('change', function () {

                var val = jQuery(this).children("option:selected").val();


                console.log('county changed:' + val);
                hiddenState.val(val);
                console.log('hiddenState changed:' + hiddenState.val());
            });



//jQuery('.select-field select').not('#input_18_11').not('.hidden-select select').selectize({
//   create: true,
//    sortField: 'text'
//});

            jQuery('#input_18_13,#input_18_14,#input_18_15,#input_18_16').on('change', function () {
                var val = jQuery(this).children("option:selected").val();

                hiddenState.val(val);

            });

            jQuery('#input_18_19').on('keyup', function () {
                var val = jQuery(this).val();
                console.log(val);
                jQuery('#input_18_18').val(val);


            });



        }


        if (jQuery('.ag-btn').length > 0) {
            jQuery('.ag-btn.btn-inline').parent().parent().addClass('btn-inline');
            jQuery('.ag-btn.btn-alignnone').parent().parent().addClass('btn-align-none');
            jQuery('.ag-btn.btn-aligncenter').parent().parent().addClass('btn-align-center');
            jQuery('.ag-btn.btn-alignleft').parent().parent().addClass('btn-align-left');
            jQuery('.ag-btn.btn-alignright').parent().parent().addClass('btn-align-right');
        }
        if (jQuery('.article-content a').length > 0) {

            if (jQuery('.article-content a')) {
                jQuery('.article-content a').has('img').addClass('link-has-image');
            }


        }

        //   var externalPath='https://www.agespace.org/wp-content/themes/Agespace-Elementor/externaljs.php?file=';
        //'<script async defer crossorigin="anonymous" src="//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0&appId=194942155100100&autoLogAppEvents=1"></script>'+


        var scripts = '<script async defer crossorigin="anonymous"  src="//jact.atdmt.com/jaction/JavaScriptTest"></script>' +
                '<script data-ad-client="ca-pub-8436806876459334" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>' +
                '<script type="text/javascript"> window.__be = window.__be || {}; window.__be.id = "5e42c0b2cbb1860007bf6e50";</script>' +
                '<script async defer   src="//securepubads.g.doubleclick.net/tag/js/gpt.js"></script>' +
                '<script>' +
                '  window.googletag = window.googletag || {cmd: []};<script>' +
//                ' googletag.cmd.push(function() {' +
//                ' googletag.defineSlot("/22025122300/sidebarad1", [300, 250], "div-gpt-ad-1590138460074-0").addService(googletag.pubads());' +
//                '  googletag.defineSlot("/22025122300/sidebarad2", [300, 250], "div-gpt-ad-1590658868888-0").addService(googletag.pubads());' +
//                'googletag.defineSlot("/22025122300/sidebarad3", [300, 250], "div-gpt-ad-1590658906840-0").addService(googletag.pubads());' +
//                '  googletag.defineSlot("/22025122300/topbanner", [[728, 90]], "div-gpt-ad-1590747775307-0").addService(googletag.pubads());' +
//                '    googletag.defineSlot("/22025122300/topbanner", [[320, 50]], "div-gpt-ad-1590747775307-0-mobile").addService(googletag.pubads());' +
//                ' googletag.defineSlot("/22025122300/bottom-banner", [728, 90], "div-gpt-ad-1590674447513-0").addService(googletag.pubads());' +
//                ' googletag.pubads().enableSingleRequest();' +
//                '    googletag.enableServices();' +
//                '  });' +
//                
//                'googletag.cmd.push(function(){' +
//                '  googletag.display("div-gpt-ad-1590138460074-0");' +
//                '  googletag.display("div-gpt-ad-1590658868888-0");' +
//                '  googletag.display("div-gpt-ad-1590658906840-0");' +
//                '  googletag.display("div-gpt-ad-1590747775307-0");' +
//                '  googletag.display("div-gpt-ad-1590747775307-0-mobile");' +
//                '  googletag.display("div-gpt-ad-1590674447513-0");' +
//                '  googletag.display("div-gpt-ad-1590138460074-0");' +
//                '  googletag.display("div-gpt-ad-1590658868888-0");' +
//                '  googletag.display("div-gpt-ad-1590658906840-0");' +
//                '})\n\
//</script>' +


                setTimeout(function () {
           
                }, 1000);
        var chatJsLoaded = false;
        $('#chat-btn').on('click', function (e) {
            e.preventDefault();
                    
         window.__be = window.__be || {};
    window.__be.id = "5e42c0b2cbb1860007bf6e50";
            var chatjs = '<script async defer   src="//cdn.chatbot.com/widget/plugin.js"></script>' +
                    '';

            if (!chatJsLoaded) {
                setTimeout(function () {
                    jQuery('#chat-btn').remove();
                    jQuery(chatjs).appendTo(jQuery('head'));
                }, 100);
                chatJsLoaded = true;
            }
        })

        function loadElementAdsJs(ID, scr) {

//var scr="";
//switch (ID){
//    case '#div-gpt-ad-1590138460074-0':scr='googletag.defineSlot("/22025122300/sidebarad1", [300, 250], "div-gpt-ad-1590138460074-0").addService(googletag.pubads());';break;
//}

            if ($(ID).length) {


                var adScript = '<script>googletag.cmd.push(function(){' + scr +
                        ' googletag.pubads().enableSingleRequest();' +
                        '    googletag.enableServices();});' +
                        '</script>';
                setTimeout(function () {
                    jQuery(adScript).appendTo(jQuery('footer'));
                }, 2500);
            }

//console.log(adScript);
        }



        loadElementAdsJs('#div-gpt-ad-1590138460074-0', 'googletag.defineSlot("/22025122300/sidebarad1", [300, 250], "div-gpt-ad-1590138460074-0").addService(googletag.pubads());');
        loadElementAdsJs('#div-gpt-ad-1590658868888-0', 'googletag.defineSlot("/22025122300/sidebarad2", [300, 250], "div-gpt-ad-1590658868888-0").addService(googletag.pubads());');
        loadElementAdsJs('#div-gpt-ad-1590658906840-0', 'googletag.defineSlot("/22025122300/sidebarad3", [300, 250], "div-gpt-ad-1590658906840-0").addService(googletag.pubads());');
        loadElementAdsJs('#div-gpt-ad-1590747775307-0', 'googletag.defineSlot("/22025122300/topbanner", [[728, 90]], "div-gpt-ad-1590747775307-0").addService(googletag.pubads());');
        loadElementAdsJs('#div-gpt-ad-1590747775307-0-mobile', 'googletag.defineSlot("/22025122300/topbanner", [[320, 50]], "div-gpt-ad-1590747775307-0-mobile").addService(googletag.pubads());');
        loadElementAdsJs('#div-gpt-ad-1590674447513-0', 'googletag.defineSlot("/22025122300/bottom-banner", [728, 90], "div-gpt-ad-1590674447513-0").addService(googletag.pubads());');

//        var pushCommand = '<script>' +
//                ' googletag.cmd.push(function() {' +
//                ' googletag.pubads().enableSingleRequest();' +
//                '    googletag.enableServices();' +
//                '  });';
//    setTimeout(function () {
//          //  jQuery(pushCommand).appendTo(jQuery('head'));
//        }, 2200);

        var ads1Enabled = false;
        var ads2Enabled = false;
        var ads3Enabled = false;
        var ads4Enabled = false;
        var ads5Enabled = false;
        var ads6Enabled = false;


        function loadElementAdsDisplay(ID, controller) {
            var el = $("#" + ID);

            if (el.length) {
                if (el.isInViewport()) {

                    if (!controller) {

                        var tempSrc = '<script>googletag.cmd.push(function(){googletag.display("' + ID + '")});</script>';

                        switch (ID) {
                            case 'div-gpt-ad-1590138460074-0':
                                ads1Enabled = true;
                                break;
                            case 'div-gpt-ad-1590658868888-0':
                                ads2Enabled = true;
                                break;
                            case 'div-gpt-ad-1590658906840-0':
                                ads3Enabled = true;
                                break
                            case 'div-gpt-ad-1590747775307-0':
                                ads4Enabled = true;
                                break;
                            case 'div-gpt-ad-1590747775307-0-mobile':
                                ads5Enabled = true;
                                break;
                            case 'div-gpt-ad-1590674447513-0':
                                ads6Enabled = true;
                                break;



                        }

                        setTimeout(function () {
                            jQuery(tempSrc).appendTo(jQuery('footer'));
                        }, 2600);
                    }



                }
            }
        }

function isElementInViewport (el) {

    // Special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
    }

    var rect = el.getBoundingClientRect();

    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
        rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
    );
}


function modifyNewsLetterSidebar(){
    
//    if(jQuery(window).width()<600){
//        jQuery('#gform_submit_button_11').val('Save Time');
//    }else{
//         jQuery('#gform_submit_button_11').val('Yes Please!');
//    }
}
        $.fn.isInViewport = function () {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            return elementBottom > viewportTop && elementTop < viewportBottom;
        };
        // var twitterIsActive = false;
        loadElementAdsDisplay('div-gpt-ad-1590138460074-0', ads1Enabled);
        loadElementAdsDisplay('div-gpt-ad-1590658868888-0', ads2Enabled);
        loadElementAdsDisplay('div-gpt-ad-1590658906840-0', ads3Enabled);
        loadElementAdsDisplay('div-gpt-ad-1590747775307-0', ads4Enabled);
        loadElementAdsDisplay('div-gpt-ad-1590747775307-0-mobile', ads5Enabled);
        loadElementAdsDisplay('div-gpt-ad-1590674447513-0', ads6Enabled);
modifyNewsLetterSidebar();
        $(window).on('resize scroll', function () {

modifyNewsLetterSidebar();

            loadElementAdsDisplay('div-gpt-ad-1590138460074-0', ads1Enabled);
            loadElementAdsDisplay('div-gpt-ad-1590658868888-0', ads2Enabled);
            loadElementAdsDisplay('div-gpt-ad-1590658906840-0', ads3Enabled);
            loadElementAdsDisplay('div-gpt-ad-1590747775307-0', ads4Enabled);
            loadElementAdsDisplay('div-gpt-ad-1590747775307-0-mobile', ads5Enabled);
            loadElementAdsDisplay('div-gpt-ad-1590674447513-0', ads6Enabled);


        });




        if (jQuery('.half-slider').length) {


            setTimeout(function () {
                jQuery('.masked-header').addClass('loaded');
                jQuery('.half-slider').addClass('loaded');
            }, 1000);


        }


        if ($('#text-51').length) {
            if ($('#text-51 .local-partners').length < 1) {
                $('#text-51').hide();
            }
        }

        jQuery('.schema-faq-section .schema-faq-question').each(function () {
            var el = jQuery(this);
            el.replaceWith($('<h3 class="schema-faq-question">' + el.text() + '</h3>'));
        });

        jQuery('.schema-faq-section .schema-faq-question').on('click', function () {
            var el = jQuery(this);
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

jQuery('[data-elementor-type^="header"]').append('<div class="overlay-menu"></div>');



    jQuery('.jet-menu-item').on('mouseenter',function(){
       
     
       jQuery('.elementor-location-header > .elementor-section-wrap').addClass('toptop');
       jQuery('.overlay-menu').addClass('show');
       jQuery('[data-elementor-type^="wp-page"]').addClass('move-back');
    }).on('mouseleave',function(){
         jQuery('.elementor-location-header > .elementor-section-wrap').removeClass('toptop');
         jQuery('.overlay-menu').removeClass('show');
           jQuery('[data-elementor-type^="wp-page"]').removeClass('move-back');
    });
 
  jQuery('.elementor-element-bc45658 a').on("click", function(){
            var el=jQuery(this);
 
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'RequestCallback',


  'eventValue': "Request a Call Back"
        });
     
    });
    
  jQuery('.partner_section a').on("click", function(){
            var el=jQuery(this);
    var linkTitle=el.find('.elementor-cta__title').text();
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'partnersBottom',


  'eventValue': linkTitle
        });
     
    });
    
  jQuery('.sidebar-newsletter-widget .elementor-button-link').on("click", function(){
            var el=jQuery(this);
    
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'sideBarCustom',


  'eventValue': "click on newsletter sign up button"
        });
     
    });
    
    
    
      
  jQuery('.partner-element .wp-caption a').on("click", function(){
            var el=jQuery(this);
   var caption= el.parent().find('figcaption').text();
    console.log(caption);
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'partnerClick',


  'eventValue': caption
        });
     
    });
    
  jQuery('.sidebar-sticky-widget .elementor-button-link').on("click", function(){
            var el=jQuery(this);
    
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'sideBarCustom',


  'eventValue': "click on sticky container link"
        });
     
    });
    
    
 if (jQuery('.widget-join').length>0) { 
      jQuery('.widget-join .login-btn').on("click", function(){
            var el=jQuery(this);
    
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'forumEvent',


  'eventValue': "click on Login button (sidebar) "
        });
     
    });
    
    jQuery('.widget-join .register-btn').on("click", function(){
            var el=jQuery(this);
    
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'forumEvent',


  'eventValue': "click on Register button (sidebar) "
        });
     
    });
 }
 
 
 
 if (jQuery('.singlequestionbox').length>0) { 
      jQuery('.singlequestionbox  .questiontext a').on("click", function(){
           
    
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'forumEvent',


  'eventValue': "click on Topic Question Title "
        });
     
    });
     jQuery('.singlequestionbox  .askform-questionfield').on("click", function(){
           
    
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'forumEvent',


  'eventValue': "click on Ask a Question field "
        });
     
    });
    
    
    jQuery('.widget-join .register-btn').on("click", function(){
            var el=jQuery(this);
    
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'forumEvent',


  'eventValue': "click on Register button (sidebar) "
        });
     
    });
 }
 
 
 
 
 if (jQuery('.competition-box').length>0) { 
      jQuery('.competition-box .elementor-cta').on("click", function(){
            var el=jQuery(this);
       var title=   el.find('.elementor-cta__title').text().trim();
        var href=   el.attr('href');
        
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'competitionBox',

 'label': href,
  'eventValue': "Competition entry - "+title
        });
     
    });
 }
 
 
  if (jQuery('body.home').length>0) { 
      
      
       
      jQuery('.top-join-btn').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'navClick',
   'eventValue': "click on login/register button"
        });
     
    });
      
      jQuery('.home-join-btn .elementor-button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'homeClick',
   'eventValue': "click on join button"
        });
     
    });
    
   
    
         jQuery('.home-cards a').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'homeClick',
   'eventValue': "click on card link"
        });
     
    });
    
    
     jQuery('.popular-products a').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'homeClick',
   'eventValue': "click on popular products link"
        });
     
    });
    
     jQuery('.blogs-pods-posts a').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'homeClick',
   'eventValue': "click on blogs/pods link"
        });
     
    });
    
    
    
         jQuery('.newsletter-event-tracker .button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'homeClick',
   'eventValue': "click on newsletter signup button"
        });
     
    });
        jQuery('.livein-tracker .elementor-button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'homeClick',
   'eventValue': "click on live-in care search"
        });
     
    });
      jQuery('.top-new-home-menu a').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'navClick',
   'eventValue': "click on link"
        });
     
    });
    
      jQuery('.top-bar-covid-btn a').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'navClick',
   'eventValue': "click on Top bar Coronavirus Button"
        });
     
    });
    
    
    
      jQuery('.nav-search-btn a').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'navClick',
   'eventValue': "click on search button"
        });
     
    });
    
    
      jQuery('.nav-search-btn a').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'navClick',
   'eventValue': "click on search button"
        });
     
    });
    
    
   
 }
 
 
 if (jQuery('.download-form-trigger').length>0) { 
      jQuery('.download-form-trigger.corona-guide .button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'downloadForm',
 'eventValue':'Get our Free Coronavirus Guide'
        });
     
    });
    
    
      jQuery('.download-form-trigger.care-guide .button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'downloadForm',
 'eventValue':'Get our Free Care Guide'
        });
     
    });
    
         jQuery('.download-form-trigger.dementia-guide .button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'downloadForm',
 'eventValue':'Get our Free Dementia Guide (With Image)'
        });
     
    });
          jQuery('.download-form-trigger.dementia-guide.no-image .button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'downloadForm',
 'eventValue':'Get our Free Dementia Guide'
        });
     
    });
    
             jQuery('.download-form-trigger.media-pack .button').on("click", function(){
          
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'downloadForm',
 'eventValue':'Download our Media Pack'
        });
     
    });
 
 }
 

 
 
  if (jQuery('.mostpopular-sidebar').length>0) { 
      jQuery('.mostpopular-sidebar a').on("click", function(){
          console.log('click on popular sidebar');
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'sideBar',
  'eventValue': "click on popular content link"
        });
     
    });
 }
 
 
 
 if (jQuery('iframe[data-name="pb-iframe-player"]').length>0) { 
      jQuery('iframe[data-name="pb-iframe-player"]').load(function(){
           jQuery(this).contents();
           var el=jQuery(this);
       el.contents().on("mousedown, mouseup, click", function(){
       
             window.dataLayer = window.dataLayer || [];
 window.dataLayer.push({
 'event': 'podcastPlayed',
 'label': el.attr('title')
        });
     
    });
 })
 }
 
       if (jQuery('.elementor-element-4792c007 .elementor-pagination').length>0) { 
            jQuery('.elementor-pagination').find('a').each(function () {
                var url = jQuery(this).attr('href');
                var pieces = url.split("/");
                var newhrf = window.location.origin + '/blog/page/' + pieces[4];
             
                if(pieces[4]!==""){
                jQuery(this).attr('href', newhrf);
            }
            });
        }
        if (jQuery("#download-advertise-form").length) {

            jQuery("#download-advertise-form").submit();
        }
        if (jQuery('.captcha-holder').length) {
            jQuery('.captcha-holder').each(function () {
                var el = jQuery(this);
                el.hide();
                el.parent().find('input').on('focus', function () {
                    if (!el.hasClass('is-visible')) {
                        el.addClass('is-visible');
                        el.show();
                    }
                });
            });
        }

        if (jQuery('.fake-js').length) {
            jQuery('.fake-js').each(function () {
                var el = jQuery('this');
                var src = el.attr('data-src');
                var script = '<script type="text/javascript" src="' + src + '"></script>';
                jQuery(script).appendTo(el);

            });
        }

        if (jQuery('#interatcive-uk-map').length) {


            jQuery('.map-path-link').on('hover', function () {
                var el = $(this);
                var hoverBtn = el.attr('data-btn-hover');
                $('.map-path-hover').removeClass('map-path-hover');
                el.addClass('map-path-hover');
                $('.map-button-hover').removeClass('map-button-hover');
                $('#map-btn-' + hoverBtn).addClass('map-button-hover');
            });


        }

        if (jQuery('.wp-block-ub-content-toggle-accordion-title').length > 0) {
            jQuery('.wp-block-ub-content-toggle-accordion').css('visibility', 'visible');
            jQuery('.wp-block-ub-content-toggle-accordion-title').parent().addClass('closed');
            jQuery('.wp-block-ub-content-toggle-accordion-title,.wp-block-ub-content-toggle-accordion-state-indicator').on('click', function () {

                var el = jQuery(this).parent();

                if (el.find('.wp-block-ub-content-toggle-accordion-state-indicator').hasClass('open')) {

                    el.addClass('closed').removeClass('opened');
                    ;
                } else {
                    el.addClass('opened').removeClass('closed');

                }
            });
        }



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


 if (jQuery(".weird-slider").length) {
     jQuery('.postcode-form form').on('submit',function(e){
e.preventDefault();
window.location="https://www.agespace.org/find-local-care?postcode="+jQuery(".postcode-form form #form-field-postcode").val();
});
    jQuery('.jet-sub-mega-menu h2.elementor-heading-title').replaceWith(jQuery('<h4>' + jQuery(this).innerHTML + '</h4>'));
    
        jQuery('.weird-slider > .elementor-container').slick({
                dots: true,
                arrows: false,
                infinite: false,
                slidesToShow:4,
                slidesToScroll: 4,
                 responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4,
      
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
 
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
             
                autoplay: false,
                speed: 1000,
                autoplaySpeed: 5000,
            });
       
        }

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

        if (jQuery('.ag-border-tabs').length) {
            var jQuerytabs = jQuery('.ag-border-tabs');

            jQuerytabs.responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: false
            });
        }



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

 if (jQuery('#share-buttons').length) {
        jQuery(window).on('scroll', function () {

            if (jQuery(window).scrollTop() > (jQuery(document).height()/3)*2) {


               jQuery('#share-buttons').fadeOut();

            } else {

                jQuery('#share-buttons').fadeIn();

            }

        });
 }

    if ($('.find-local-widget').length) {

        $(window).on('scroll', function () {

            if (jQuery(window).scrollTop() > 200) {


                $('.find-local-widget').addClass('make-show');

            } else {

                $('.find-local-widget').removeClass('make-show');

            }

        });
    }


    if (jQuery("[class^=agesp-sidebar]").length)
    {


    }
    if (jQuery(".agesp-sidebar-1").length)
    {
        //  jQuery(".agesp-sidebar-1").parent().addClass('sidebar-placement-widget');

    }



})(jQuery);
