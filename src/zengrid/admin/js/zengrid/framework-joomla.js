/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
		setTimeout(function() {
			 $('#system-message-container').fadeOut();
		},2000);
		
		
		
		// Das ist Smooth linking
		jQuery('.subnavlink-item').smoothScroll({
			offset: 0,
			easing: 'swing'
		});
		
		jQuery('.subnavlink-item').click(function() {
			return false;
		});
		
		
		
		$(window).scroll(function(){
			var scrolled = $(window).scrollTop();
		      
		      if(scrolled > 120) { 
		     	 $(".subnavlinks").addClass('sticky');
		     } else {
		     	$(".subnavlinks").removeClass('sticky');
		     }
		
		});
		
})(jQuery);
