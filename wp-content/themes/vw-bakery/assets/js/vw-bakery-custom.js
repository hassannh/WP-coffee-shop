function vw_bakery_menu_open_nav() {
	window.vw_bakery_responsiveMenu=true;
	jQuery(".responsive-menu .sidenav").addClass('show');
}
function vw_bakery_menu_close_nav() {
	window.vw_bakery_responsiveMenu=false;
 	jQuery(".responsive-menu .sidenav").removeClass('show');
}

jQuery(document).ready(function () {
	window.vw_bakery_currentfocus=null;
  	vw_bakery_checkfocusdElement();
	var vw_bakery_body = document.querySelector('body');
	vw_bakery_body.addEventListener('keyup', vw_bakery_check_tab_press);
	var vw_bakery_gotoHome = false;
	var vw_bakery_gotoClose = false;
	window.vw_bakery_responsiveMenu=false;
 	function vw_bakery_checkfocusdElement(){
	 	if(window.vw_bakery_currentfocus=document.activeElement.className){
		 	window.vw_bakery_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_bakery_check_tab_press(e) {
		"use strict";
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_bakery_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_bakery_gotoHome) {
					jQuery( ".responsive-menu .main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_bakery_gotoHome = true;
			} else {
				vw_bakery_gotoHome = false;
			}

		}else{

			if(window.vw_bakery_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_bakery_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_bakery_responsiveMenu){
				if(vw_bakery_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".responsive-menu .main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_bakery_gotoClose = true;
				} else {
					vw_bakery_gotoClose = false;
				}
			
			}else{

			if(window.vw_bakery_responsiveMenu){
			}}}}
		}
	 	vw_bakery_checkfocusdElement();
	}
});

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation: {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

(function( $ ) {

	jQuery('document').ready(function($){
	    setTimeout(function () {
    		jQuery("#preloader").fadeOut("slow");
	    },1000);
	});

	$(window).scroll(function(){
		var sticky = $('.header-sticky'),
		scroll = $(window).scrollTop();
		if (scroll >= 100) sticky.addClass('header-fixed');
		else sticky.removeClass('header-fixed');
	});

	$(document).ready(function () {
		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup i').fadeIn();
		    } else {
		        $('.scrollup i').fadeOut();
		    }
		});

		$('.scrollup i').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});
	});
	
})( jQuery );

jQuery(document).ready(function () {
  	function vw_bakery_search_loop_focus(element) {
	  var vw_bakery_focus = element.find('select, input, textarea, button, a[href]');
	  var vw_bakery_firstFocus = vw_bakery_focus[0];  
	  var vw_bakery_lastFocus = vw_bakery_focus[vw_bakery_focus.length - 1];
	  var KEYCODE_TAB = 9;

	  element.on('keydown', function vw_bakery_search_loop_focus(e) {
	    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	    if (!isTabPressed) { 
	      return; 
	    }

	    if ( e.shiftKey ) /* shift + tab */ {
	      if (document.activeElement === vw_bakery_firstFocus) {
	        vw_bakery_lastFocus.focus();
	          e.preventDefault();
	        }
	      } else /* tab */ {
	      if (document.activeElement === vw_bakery_lastFocus) {
	        vw_bakery_firstFocus.focus();
	          e.preventDefault();
	        }
	      }
	  });
	}
	jQuery('.search-box span a').click(function(){
        jQuery(".serach_outer").slideDown(1000);
    	vw_bakery_search_loop_focus(jQuery('.serach_outer'));
    });

    jQuery('.closepop a').click(function(){
        jQuery(".serach_outer").slideUp(1000);
    });
});