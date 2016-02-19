/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
		$.fn.set_theme_data = function (template, time, theme_path) {
	
			var theme = $('#cssfile').val();
				theme = 'theme.' + theme;
				
				// Check to see if using a preset
				var is_preset = theme.indexOf('[example]');
				
				if(is_preset > 1) {
					// Replace the first instacne of theme
					// So we get the correct path to the file.
					theme = theme.replace('theme.', '');
				}
				
		
				
			var clean_theme = theme.replace('presets/theme.[example]-', '');
				clean_theme = clean_theme.replace('theme.','');
				
			// Set the name of the save style input
			$('#style-name').val(clean_theme);
			$('input#theme').val(clean_theme);
		
			// Retrieve the appropriate json file	        	
	     	$.getJSON( '../' + theme_path + '/settings/themes/' + theme + '.json?v=' + time, function( data ) {
	     	 
	     	 
	     	 // Check to see if the preset being used uses the new nested objects of colors and settings
	     	 // We have to revert it back to the old way because there is no way to update old themes to the new format until the user saves them.
	     	 
	     	 
	     	 if(data.settings) {
	     	 
	     	 	var flattenObject = function(ob) {
	     	 	 	var toReturn = {};
	     	 	 	
	     	 	 	for (var i in ob) {
	     	 	 		if (!ob.hasOwnProperty(i)) continue;
	     	 	 		
	     	 	 		if ((typeof ob[i]) == 'object') {
	     	 	 			var flatObject = flattenObject(ob[i]);
	     	 	 			for (var x in flatObject) {
	     	 	 				if (!flatObject.hasOwnProperty(x)) continue;
	     	 	 				
	     	 	 				toReturn[x] = flatObject[x];
	     	 	 			}
	     	 	 		} else {
	     	 	 			toReturn[i] = ob[i];
	     	 	 		}
	     	 	 	}
	     	 	 	return toReturn;
	     	 	 };
	     	 		
	     	 	
	     	 	
	     	 	// Set data object
	     	 	data = flattenObject(data);
	     	 	console.log(data);
	     	 }
	     	// Parse through the json object and populate fields
			$.each( data, function( key, val ) {
	     	    	
	     	    	var target = '#' + key;
	     	    	
	     	    	// Remove leading #
	     	    	val = val.replace('#', '');
	     	    	
	     	    	// Set the value if its not null
	     	    	if(val!=="") {
	     	    		$(target).val(val).attr('data-stored', val);
	     	    		
	     	    	}
	     	    	
	     	    	if($(target).hasClass('zt-picker')) {
	     	    	
	     	    		if(val == "") {
	     	    			val= $(target).attr('data-default')
	     	    		}
	     	    		
	     	    		$(target).css({'border-color': '#' + val});
	     	    		
	     	    		var firstletter = val.charAt(0);
	     	    		
	     	    		if(firstletter == "@") {
	     	    			var other = val.substring(1, val.length);
	     	    			
	     	    			other = $('input#' + other).val();
	     	    			
	     	    				$(target).css({'border-right-color': '#' + other});
	     	    		}
	     	    		
	     	    		
	     	    		var firstletter = val.substring(0, 3);
	     	    		
	     	    		if(firstletter == "dar" || firstletter == "lig") {
	     	    			
	     	    			
	     	    			if(firstletter == "dar") {
	     	    				var other = val.substring(8, val.length);
	     	    				other = other.split(',');
	     	    			}
	     	    			
	     	    			
	     	    			if(firstletter == "lig") {
	     	    				var other = val.substring(9, val.length);
	     	    				other = other.split(',');
	     	    			}
	     	    			
	     	    			
	     	    			// Change % into a decimal    				
	     	    			var percentage = other[1].slice(0,-2);
	     	    				percentage = parseFloat(percentage) / 100.0;
	     	    				
	     	    				if(firstletter == "dar") {
	     	    					percentage = '-' + percentage;
	     	    				}
	     	    			
	     	    				
	     	    				other = other[0];
	     	    				other = $('input#' + other).val();
	     	    				
	     	    				var newColor = $(document).ColorLuminance(other, percentage); 
	     	    				$(target).css({'border-right-color': newColor});
	     	    		}
	     	    	}
	     	    	
	     	    	if($(target).is(':checkbox')) {
	     	    			
	 	    			var toggle = $(target).attr('id');
	 	    			
	 	    			// Set value to 0
	 	    			$(target).val('');
	 	    			
	 	    			// Check if checked and set to 1
	 	    			if(val == 1) {
	 	    				$('.' + toggle).fadeIn().parent().fadeIn();
	 	    				$(target).prop('checked', 'true').val(1);
	 	    			}
	 	    			
	 	    			if(val == "" || val == 0) {
	 	    				$('.' + toggle).fadeOut().parent().fadeOut();
	 	    				$(target).prop('checked', false).val(0);
	 	    			}
	     	    	}

	     	    	if(key == "framework_version") {
	     	    		$('#framework_version').val(val);
	     	    		$('.framework_list').removeClass('active');
	     	    		$('#'+val).addClass('active')
	     	    	}
	     	    	
	     	    	if(key == "framework_files") {
	     	    		
	     	    		// Reset Framework files
	     	    		$('input.framework_files').removeAttr('checked').val(0);
	     	    		
	     	    		var files = val.split(' ');
	     	    		
	     	    		$(files).each(function() {
	     	    			
	     	    			$('.active input[data-id="' + this + '"]').prop('checked', 'true').val(1);
	     	    		
	     	    		});	    		
	     	    	}
	     	  });
	     });
	};			
})(jQuery);