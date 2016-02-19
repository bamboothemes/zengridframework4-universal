/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
	$.fn.delete_theme = function () {
			
		var theme = $('#delete-configs-selector').val();
	
		$.ajax({
	        url : "admin-ajax.php",
	        method: 'post',
	        context: document.body,
	        data: {
	        	theme:theme,
	        	action: 'delete_config',
	        	admin:'1'
	        },
	        
	        beforeSend: function () {
	          	            	                    
	        },
	        success: function (data) {
	 
	        	
	        	$("#delete-configs-selector option[value='"+ theme + "'],#page-type-selector option[value='"+ theme + "']").remove();
	        	
	        	$('#delete-configs-selector,#page-type-selector').val('default');
	
	        }	
	   });	  
	};
})(jQuery);
