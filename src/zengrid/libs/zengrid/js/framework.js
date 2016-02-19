jQuery(document).ready(function($) {
	
	// Fixes for the Wordpress menu classes to make them comaptible for existing themes
	$('#menu .menu-item-has-children').addClass('deeper parent');
	
	
	// Dropdown Menu
	$("#menu.zen-menu-fading ul li.parent").hover(function(){
		 $(this).children("ul").fadeIn("fast");
	},
	  	function(){
		     $(this).children("ul").fadeOut("fast");   
	});
	
	// Check if dropdown is offscreen
		// Check if dropdown is offscreen
	$(".zen-menu-horizontal li.parent").not('.justify').on('mouseenter mouseleave', function () {
		var item = $(this).index();
		$('.zen-menu-horizontal li').removeClass('zen-menu-offscreen');
	    
	    if(!$('html').hasClass('touch')) {
	   	 	$('body').offscreen_check(item);
	   	}
	});
	
	
	// Touch devices
	if (Modernizr.touch) {   
		jQuery('li.parent > a').click(function(e){
		
			//If a menu item is a parent and a link then prevent default if sub is hidden
			if (!jQuery(this).closest('li.parent').hasClass('open')){
				e.preventDefault();
				jQuery(this).closest('li.parent').addClass('open');
			}
		});
		
		jQuery('body').click(function(e){
			//If there is a click elsewhere then remove the open class from parents
			if ( !jQuery(e.target).is('li.parent > a') ) {
				jQuery('.zen-menu li.parent').removeClass('open');
			}
		});
	}
	
	

	// Append link to next prev / pagination if no link exists
	$('.pager li').each(function(index, value) {
		if($(this).find('a').length == 0) {
			var html = $(this).html();
			$(this).html('<a href="#" class="btn disabled">'+html+'</a>');
		}	
	});
	
	$(document).on('click','.pager a.disabled', function() {
		return false;
	});
	
	
	
	
	//
	 // Nav tabs
	 //
	 //
	 //
	 //
	 
	 $(document).on('click', '.zen-nav-tabs li', function() {
	 	
	 	// Active class on nav
	 	$(this).parent().find('li').removeClass('active');
	 	$(this).addClass('active');
	 	
	 	// Activate content block
	 	var target = $(this).attr('data-target');
	 	$(this).parent().next('.zen-tab-content').find('.zen-tab-pane').hide();
	 	$(this).parent().next('.zen-tab-content').find('[data-id="'+ target +'"]').fadeIn();
	 	
	 	return false;
	 });
	 
	 
	 //
	 // Sliders
	 //
	 //
	 //
	 //
	 
	 $(document).on('click', '.zen-slide-trigger', function() {
	 	$(this).next('.zen-slide-content').slideToggle();
	 	return false;
	 });
	 
	 
	 //
	 // Modal
	 //
	 //
	 //
	 //
	 
	 $(document).on('click', '.zen-modal-trigger', function() {
	 	var target = $(this).attr('data-target');
	 	$('[data-id="'+ target +'"],.zen-modal-overlay').fadeToggle().addClass('active');
	 	return false;
	 });
	 
	 $(document).on('click', '.zen-modal-overlay,.zen-modal-close', function() {
	 	$('.zen-modal.active,.zen-modal-overlay').fadeToggle().removeClass('active');
	 	return false;
	 });
	 
	 
	 //
	 // Scroll to top
	 //
	 //
	 //
	 
	 $(".zen-scroll-top").click(function() {
	 	$("html, body").animate({ scrollTop: 0 }, "slow");
	 	 return false;
	 });
	 
	 
	 // 
	 // Scroll to bottom
	 //
	 //
	 //
	 
	 $(".zen-scroll-bottom").click(function() {
	 	$("html, body").animate({ scrollTop: $(document).height() }, "slow");
	 	 return false;
	 });
	 
	 
	 
	 
	 $(window).scroll(function () {
			if ($(this).scrollTop() >200) {
			 	$(".zen-scroll-fade").fadeIn();
			}
			else {
			 	$(".zen-scroll-fade").fadeOut();
			}
	 });
	 
	 
	
    
    
    //
     // Alert Close button
     //
     //
     //
     //
    
    $('[data-dismiss="alert"]').click(function() {
    	$(this).parent().fadeOut();
    });
    
	
});





(function ($) {
	
	$.fn.offscreen_check = function (item) {
		var item = item + 1;
		var elm = $('.zen-menu-horizontal li:nth-child(' + item + ') ul:first', this);
		var off = elm.offset();
		var l = off.left;
		var w = elm.width() + 50;
		var docH = $(window).height();
		var docW = $(window).width();
		var isEntirelyVisible = (l+ w <= docW);
			        
		if ( ! isEntirelyVisible ) {
		    $('.zen-menu-horizontal li:nth-child(' + item + ')').addClass('zen-menu-offscreen');
		} else {
		    $(this).parent().removeClass('zen-menu-offscreen');
		}
	};
	
	// Checks to see if menu is offscreen and attaches zen-menu-offscreen class
	$.fn.append_nav = function (collapse) {
		
		var offcanvastarget = '#off-canvas-menu';	
		var window_width = $(window).width();		
		
		if(window_width < collapse) {
			if(!$(offcanvastarget + ' ul').hasClass('simple-list')) {
				var nav = $('#menu ul').html();
				$(offcanvastarget + ' ul').append(nav).addClass('simple-list').parent().addClass('accordion');
			}
		}	
	};
})(jQuery);

