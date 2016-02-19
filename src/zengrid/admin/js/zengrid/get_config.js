/*
*	
*	Returns an array that contains the config data for the theme.
*
*
 */

(function ($) {
		
	// Load Layout Function
	$.fn.get_config = function () {
		
		// Create the config array
		config = {};		
		
		// Create the params object
		config['params']={};	
			
		// Add any relevant settings to the params
		// Theme data is not stored here
		
		$('#theme-settings input,#theme-settings textarea,#theme-settings select').not('[data-compile="1"]').not('.zt-picker').not('.exclude').each(function(i) {
	    	
	    	id = $(this).attr('id');
	   
	    	if(typeof id !=="undefined") {
	    	
	    		if($(this).is('select')) {
	    			   	value = $('select#' + id).val(); 	    	
					} else {
	    	  	    	value = $(this).val();
	    	
	    	    	if(value=='on') {
	    	    		value="1";
	    	    	}			    	    	
	    	    }
	    	
	    		// Add the value to the params
	    		config['params'][id] = value;
	    	}
	    });
	    		
    	// Extra Socialicons
    	config['params']['socialicons']={};
    	
    	$('#extra-social-networks li').each(function(i) {
    		var link = $(this).find('input').val();	
    		var icon = $(this).find('select').val();
    		
    		if(link !== "") {
	    		config['params']['socialicons'][link] = icon; 
	    		settings += JSON.stringify(link ) + ':' + JSON.stringify(icon);
	    	}
    	});
    	
    	
 		config['layout']={};
 		var get_layout = $(document).get_layout();
 		
 		config['layout'] = get_layout;
	 		
	 	return config;
	} 
	
})(jQuery);