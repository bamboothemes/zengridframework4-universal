/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
	$.fn.delete_theme = function (url, template) {
			
		var theme = $('#cssfile').val();
	
		$.ajax({
	        url : url,
	        method: 'post',
	        context: document.body,
	        data: {
	        	'option' : 'com_ajax',
	        	'plugin' : 'zengridframework',
	        	theme:theme,
	        	content: theme,
	        	template: template,
	        	action: 'delete_theme',
	        	admin:'1'
	        },
	        
	        beforeSend: function () {
	          	            	                    
	        },
	        success: function (data) {
	        	console.log(data);
	        	
	        	$("#cssfile option[value='"+ theme + "']").remove();
	        	
	        	var new_theme = $('#cssfile').val();
	        		new_theme = new_theme.replace('presets/theme.[example]-','');
	        	$('#style-name,#theme').val(new_theme);    
	        	
	        	jQuery('#zgfmessage,#zgfmessage .delete-theme').fadeIn('normal', function() {
	        		jQuery('#zgfmessage,#zgfmessage,#zgfmessage .delete-theme').delay(3000).fadeOut();
	        	}); 	
	        }	
	   });	  
	};
})(jQuery);
