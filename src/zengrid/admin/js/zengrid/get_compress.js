/*
*	
*	Returns an array that contains the compress data for the theme.
*	I know this probably seems like overkill but created a function for this to keep the config dry and in case we add more here later
*
 */

(function ($) {
		
	// Load Layout Function
	$.fn.get_compress = function () {
		
		// Create the compress array
		compress = {};		
		compress['files'] = {};
		compress['settings'] = {};
		
		// Add any relevant settings to the params
		// Theme data is not stored here
		var extrafiles = $('#add_to_compressor').val();
			extrafiles = extrafiles.split(',');
			compress['files'] = extrafiles;
			
		var wowjs = $('#enable_animations').val();
			compress['settings']['animations'] = wowjs;
			
		return compress;
	} 
	
})(jQuery);