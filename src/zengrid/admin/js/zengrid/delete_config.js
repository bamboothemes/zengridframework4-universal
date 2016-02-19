/*

Zen Grid Framework
This is only used in Wordpress because the configs are tied to page types rather than instances of the template.
In Joomla to delete a config the user deletes the instance of the template using the template manager.

 */

(function ($) {
		
	$.fn.delete_config = function (url) {
		
		var config = $('#delete-configs-selector').val();
	
		$.ajax({
	        url : url,
	        method: 'post',
	        context: document.body,
	        data: {
	        	config:config,
	        	action: 'delete_config',
	        	admin:'1'
	        },
	        
	        beforeSend: function () {
	          	            	                    
	        },
	        success: function (data) {
	 
	        	
	        	$("#delete-configs-selector option[value='"+ config + "'],#page-type-selector option[value='"+ config + "']").remove();
	        	
	        	$('#delete-configs-selector,#page-type-selector').val('default');
				
	        }	
	   });	  
	};
})(jQuery);
