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
	 		var row = $(this).attr('data-row');
	 		var modulerow = row.replace('-row', '');
	 		// Create the objects for that row
	 		layout[modulerow] = {};
	 		layout[modulerow]['positions']={};
	 		layout[modulerow]['classes']={};
	 		
	 		var count = 0;
	 		
	 		$('#' + row +  ' div.resizable[data-active="1"]').each(function(i) {
	 	    	id = $(this).attr('id');
	 	    	width = $(this).attr('data-width');
	 	    	layout[modulerow]['positions'][id] = width;
	 	    	
	 	    	count ++;
	 	 	});
	 	    
	 	    if(count == 0) {
	 	    	layout[modulerow]['positions']["null"] = "";
	 	    }
	 	  
	 	    // Get the row classes
	 	    var classes = "";
 		    
 		    $('[data-id="' + modulerow +  '_settings"] .stack-position a.active').each(function() {
 		    	var row_class = $(this).attr('data-id');
 		    	
 		    	//console.log(row_class);
 		    	classes += row_class+ ' ';
 		    });
 		    
 		    
 		    var effect = $('select#' + modulerow +  '-animation').val();
 		   
 		   if(typeof effect !=="undefined") {
	 			 if(effect !=="none") {
	 			 		classes += effect+ ' zen-animate';
	 			}
	 		}
	 		
	 		// Padding & Margins
	 		
	 		var row_padding = $('select#' + modulerow +  '-row_padding').val();
	 		
	 		if(typeof row_padding !=="undefined") {
	 			if(row_padding !=="inherit") {
	 				classes += ' ' + $('select#'+modulerow + '-row_padding').val();
	 			}
	 		}
	 		
	 		
	 		var row_margin = $('select#' + modulerow +  '-row_margin').val();
	 			
	 		if(typeof row_margin !=="undefined") {
	 			 if(row_margin !=="inherit") {
	 			 	classes += ' ' + $('select#'+modulerow + '-row_margin').val();
	 			}
	 		}
	 		
	 		var container_padding = $('select#' + modulerow +  '-container_padding').val();
	 				
 			if(typeof container_padding !=="undefined") {
 				 if(container_padding !=="inherit") {
 				 	classes += ' ' + $('select#'+modulerow + '-container_padding').val();
 				}
 			}
 			
 			var container_margin = $('select#' + modulerow +  '-container_margin').val();
 					
			if(typeof container_margin !=="undefined") {
				 if(container_margin !=="inherit") {
				 	classes += ' ' + $('select#'+modulerow + '-container_margin').val();
				}
			}
			
			// Fullwidth
			var row_fullwidth = $('#' + modulerow +  '-container-fullwidth').val();
	 		if(row_fullwidth =="1") {
	 			classes += ' zg-fullwidth';
	 		}
	 		layout[modulerow]['classes']['classes'] = classes;
	 			 		
	 	});

		return layout;
	} 	
})(jQuery);