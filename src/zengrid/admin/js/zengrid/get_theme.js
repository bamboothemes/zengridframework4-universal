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
		$('input[data-compile="1"],input[data-compile="both"],select[data-compile="both"],select[data-compile="1"]').each(function() {
			
			// Get the value
			var value = $(this).val();
			
			// Get the id
			var id = $(this).attr('id'); 
	
			// Create delimited list of variables
			if(value !=="") {
				settings[id] = value;
			} 
			    		
		});
		
		
		// Which files are included
		var framework_files = $('li[data-name="framework_files_group"] input').val();
			framework_files = framework_files.slice(0,-1);
		
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
		
		var framework_files = $('li[data-name="framework_files_group"] input').val();
		settings.framework_files = framework_files.slice(0,-1);
			
		// Get rows styles
		var rowstyles = {};
		
		// Loop through row style settings to see what's being used
		$('[data-rowstyle="1"]').each(function() {
			var value = $(this).val();
			var id = $(this).parent().attr('data-name');
			rowstyles[id] = value;
		});
		
		files.rowstyles = rowstyles;
			
		theme.settings = settings;
		theme.colors = colors;
		theme.files = files;

	
		return theme;
	} 	
})(jQuery);