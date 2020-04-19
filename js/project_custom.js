jQuery(document).ready(function() {
	
	'use strict';
	
	/* Submenu Parent Style */
	$('.submenu li:first-child a').hover(function(){
		$(this).parent().parent().toggleClass('hover');
	});
	
	/* Sticky Header */
	jQuery(window).scroll(function() {
		if (jQuery(window).scrollTop() > 130) {
			jQuery('.main_header').addClass('sticky');
			jQuery('.main_header').removeClass('non_sticky');
		}
		else {
			jQuery('.main_header').removeClass('sticky');
			jQuery('.main_header').addClass('non_sticky');
		}
	});
	
	/* Active Link */
	var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); 
        $('.nav_listing li a ,#os_mobile_menu ul li a').each(function(){
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).parent().addClass('active_nav');
         }
    });	
	
	
	/************************************ OnScroll Animations *************************************************/
	
	function onScrollInit( items, trigger ) {
	
	  items.each( function() {
		var osElement = $(this),
			osAnimationClass = osElement.attr('data-animation'),
			osAnimationDelay = osElement.attr('data-animation-delay');
		  
			osElement.css({
			  '-webkit-animation-delay':  osAnimationDelay,
			  '-moz-animation-delay':     osAnimationDelay,
			  'animation-delay':          osAnimationDelay
			});
	
			var osTrigger = ( trigger ) ? trigger : osElement;        
	
			osTrigger.waypoint(function() {
			  osElement.addClass('animated').addClass(osAnimationClass);
			  },{
				  triggerOnce: true,
				  offset: '70%'
			});
	  });
	}
	
	/* Trigger OnScroll */
	/* Hompage */
	onScrollInit( $('.notices , .quick , .our_blog , .map_section '));

	/* Close sumbenu on click of body */
	$("body").hover(function() {
		if($('.main_nav_row').is(":visible")){	
			$('.main_nav_row').slideToggle();
		}
	});
	
	$(".sticky_menubtn , .has_sub i , .go-back").click(function(e)
	{
		e.stopPropagation();
		return;
	});
	
	/************************** Smooth Scroll **************************/

	$('.top_inner .small_container > ul li a[href*=#]').click(function() {	
		if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
		  var $target = $(this.hash);
		  $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
		  if ($target.length) {
			var targetOffset = $target.offset().top - 80;
			$('html,body')
			.animate({scrollTop: targetOffset}, 1000);
		   return false;
		  }
		}
	});

	$('.owl-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        center: true,
        loop: true,
        margin: 10,
        nav: true,
        navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
	})
	
		$("#mobile_menu").mmenu({
			extensions: ["pageshadow", "border-full", "effect-listitems-slide"],
			offCanvas: { position: "right" }
		}, {
			// configuration
			classNames: {
				fixedElements: {
					fixed: "abc"
				}
			}
		});
	
});