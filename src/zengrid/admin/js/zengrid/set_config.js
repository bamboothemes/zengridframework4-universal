/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
		$.fn.set_config = function (template, time, theme_path, page_type) {
	
			
			// Retrieve the appropriate json file	        	
	     	$.getJSON( '../' + theme_path + '/settings/config/config-' + page_type + '.json?v=' + time, function( data ) {
	     	 
	     	 
	     	 // Check to see if the preset being used uses the new nested objects of colors and settings
	     	 // We have to revert it back to the old way because there is no way to update old themes to the new format until the user saves them.
	     	 
	     	// Check if we have valid data
	     	if (typeof(data)) {
	     	
	     		// Set the theme
	     		var template =  data.params.theme;
	     		
	     		$('#zgfmessage .settings span').text(page_type);
	     		
	     		// Check to see if the layout isn't using the same theme
	     		// Current theme
	     		var cssfile = $('input#theme').val();
	     		
	     		if(template!==cssfile) {
		     		// Make sure a css file exists for this theme
		     		// By compiling it.
		     		console.log('theme has changed to ' + template);
		     		$('input#style-name').val(template);
		     		$('select#cssfile option[value="'+ template+'"]').attr("selected","selected");
		     		 
		     		//$('#compile_required').val('1');
		     		$(document).set_theme_data(template, time,theme_path);
		     	}
		     	
		     	
				// Set the layout for this config
		     	$(document).set_layout_data(data.layout);
	     	 	
	     	 	
	     	 	// Parse through the json object and populate fields
	     	 	// We set a small delay here to account for any load delay with loading theme values
	     	 	// Config for the template gets higher priority over
	     	 	// Theme 
	     	 	
     	 		setTimeout(function() {
     	 			$.each( data.params, function( key, val ) {
     	 			
     	 				// Inputs
     	 				$('input#' + key).val(val).attr('data-stored', val);	  
     	 				
     	 				
     	 				// Checkboxes
     	 				// Check if checked and set to 1
     	 				if($('input#' + key).is(':checkbox')) {
     	 						console.log(key + val);
     	 						var toggle = $('#' + key).attr('id');
     	 						
     	 						// Set value to 0
     	 						$('#' + key).val('');
     	 						
     	 						// Check if checked and set to 1
     	 						if(val == 1) {
     	 							$('.' + toggle).fadeIn().parent().fadeIn();
     	 							$('input#' + key).prop('checked', 'true').val(1);
     	 						}
     	 						
     	 						if(val == "" || val == 0) {
     	 							$('.' + toggle).fadeOut().parent().fadeOut();
     	 							$('input#' + key).prop('checked', false).val(0);
     	 						}
     	 					}
     	 				
     	 							
     	 				// Selects
     	 				$('select#' + key + ' option[value="'+ val +'"]').attr("selected","selected"); 
     	 				
     	 			});	
     	 		}, 1500);
     	 		
     	 		jQuery('#zgfmessage,#zgfmessage .settings').fadeIn('normal', function() {
     	 			jQuery('#zgfmessage,#zgfmessage .settings').delay(2000).fadeOut();
     	 		});
	     	 			 
		     	 		 
		     }
	     });
	};			
})(jQuery);