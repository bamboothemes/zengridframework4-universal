/*
*	
*	Returns a javascript array of data related to the layotu for this template.
*
*
 */

(function ($) {
		
	// Load Layout Function
	$.fn.get_layout = function () {

		layout = {};
		
		$('.module-row').each(function(i) {
	 		
	 		// Set the row we are lookign at
	 		row = $(this).attr('data-row');
	 	
	 		// Create the objects for that row
	 		layout[row] = {};
	 		layout[row]['positions']={};
	 		layout[row]['classes']={};
	 		
	 		$('#' + row +  ' div.resizable[data-active="1"]').each(function(i) {
	 	    	id = $(this).attr('id');
	 	    	width = $(this).attr('data-width');
	 	    	layout[row]['positions'][id] = width;
	 	 	});
	 	    
	 	    
	 	    // Get the row classes
	 	    var classes = "";
 		    
 		    $('#' + row +  ' .stack-position a.active').each(function() {
 		    	var row_class = $(this).attr('id');
 		    	classes += row_class+ ' ';
 		    });
 		    
 		    var effect = $('select#' + row +  '_animation').val();
 		   
 		    if(effect !=="inherit") {
	 			classes += effect+ ' zen-animate';
	 		}
	 		
	 		layout[row]['classes']['classes'] = classes;
	 		
	 	});
	console.log(layout);
		return layout;
	} 	
})(jQuery);