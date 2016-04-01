/*
*	
*	Returns a javascript array of data related to the layotu for this template.
*
*
 */

(function ($) {
		
	// Load Layout Function
	$.fn.get_theme = function () {

		// Establish variables
		var theme = {};
		var colors = {};
		var settings = {};
		var files = {};
		
		// Get all colour items
		$('.zt-picker').each(function() {
			
			// Get colour of picker
			var value = $(this).val();
				value = value.replace('#', '');
		
			// Get id of picker
			var id = $(this).attr('id'); 

			// Create delimited list of variables
			if(value !=="") {
				colors[id] = value;
			} 
		});
		
		
		// Get all params that need to be sent through the compiler
		$('[data-compile="theme"],[data-compile="both"],[data-compile="layout"]').not('.zt-picker').not('.exclude').each(function() {
			
				// Get the value
				var value = $(this).val();
				
				// Get the id
				var id = $(this).attr('id'); 
		
				// Create delimited list of variables
				if(value !=="") {
					if($(this).hasClass('image-name')) {
						if(value !== null) {
							if(value !== "inherit") {
								settings[id] = "'../../.." + value + "'";
							} else {
								settings[id] = "";
							}
						}
					} else {
						settings[id] = value;
					}
				}	else {
					settings[id] = "";
				} 
			    		
		});
		
		
		// Which files are included
		var framework_files = "";
			$('.framework_list.active input.framework_files').each(function() {
				
				if($(this).val() == '1') {
					var filename = $(this).attr('data-id');
					framework_files += filename;
					framework_files += '_';	
				}
			});
			
		
		files.framework_files = framework_files;
		
		// are there any custom less files to add to the compiler
		var custom_less = $('#add_to_compiler').val();
		files.custom_less = custom_less;
		
	
		// Any animations being used
		settings.animate = $('#enable_animations').val();
		
		settings.animations = "";
		// If animations
		if(settings.animate) {
			
			var animations = "";
			
			// Loop through animation list to see which ones to include
			$('select[data-animate="1"]').each(function() {
				var animation = $(this).val();
				animations += animation;
				animations += ",";
			});
			
			files.animations = animations;
		}
		
		// Some things we need to manually add to the settings
		// load template css
		settings.template_css = $('#load_template_css').val();
		settings.fontawesome_type = $('#fontawesome_type').val();
		settings.framework_version = $('#framework_version').val();
		settings.theme = $('#style-name').val();
		
		theme.settings = settings;
		theme.colors = colors;
		theme.files = files;


		return theme;
	};
})(jQuery);