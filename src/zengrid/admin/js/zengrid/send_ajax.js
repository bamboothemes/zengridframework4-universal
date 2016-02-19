/*
*	
*	Returns a javascript array of data related to the layotu for this template.
*
*
 */

(function ($) {
		
	// Load Layout Function
	// template: Template we are targetting
	// url:  the url for the request
	// target: the helper function we are targetting eg compress, compile, save, delete, load
	// target also needs to be added as a class so we can add the trigger the message and button states
	// Target needs to match WP criteria 'wp_ajax_' . target; eg only taregt is specified
	// Page_type: Wordpress specific that tells us what page this function is goign to rendera file for. Joomla can use template id for this.// Target refers to type of thing we are saving: theme, preset, layout, config
	// Name: file name; config files get prefixed with 'config-$page_type'
	
	$.fn.send_ajax = function (template, url, data, action,id, target, name) {

				
		$.ajax({
			'option': 'com_ajax',
			'plugin': 'zentools2',
		    url : url,
		    method: 'post',
		    context: document.body,
		    dataType: 'text',
		    data: {
		    	'option' : 'com_ajax',
		    	'plugin' : 'zengridframework',
		    	content: data,
		    	action: action,
		    	template: template,
		    	target: target,
		    	name: name,
		    	id: id
		    },
		    
		    beforeSend: function () {
		    
		      	 console.log(target + ' action triggered');
		      	 $('#log pre').append('Save Action -- \n');
		      	 $('#log pre').append(target + ' action triggered \n');
		      	 
		      	 
		      	 if((target !=="layouts") && (target !=="compress")) {   	  
			
			      	  console.log('Check if compile required');
			      	       	  
			      	 // Check to see if we are compiling as well
			      	 if($('#compile_required').val() == "1") {
			      	 
			      	    if(name !== "config") {
							jQuery('#zgfmessage span').text(name);
		      	 	 	}
		      	 	 	
		      	 	 	var theme_data = $(document).get_theme();
		      	 	 	$(document).compile_data(template, url, theme_data, 'compile', '', 'themes', 'theme.' +name);
		      	 	 	
		      	 	 	jQuery('#zgfmessage,#zgfmessage .compile').fadeIn();
		      	 	 	
		      	 	 	console.log('Currently compiling less to css');
			      	 	 
			      	 } else {
			      	 
			      	 	console.log('Compiling not required for this save');
			      	 	$('#log pre').append('Compile not required \n');
			      	 	
			      	 	if(id==""){
			      	 	
			      	 	  	jQuery('#zgfmessage span').text(name);
			      	 	
			      	 	  } else {
			      	 	
			      	 	  	jQuery('#zgfmessage span').text(id);
			      	 	
			      	 	  }
			      	 	  
			      	 	  jQuery('#zgfmessage,#zgfmessage .' + target).fadeIn();
			      	}
		      	 }	      	  
		    },
		    error: function (data) {
		    	console.log(data);
		    	console.log('Error:' + JSON.stringify(data) + '\n');
		    	$('#log pre').append('Error:' + JSON.stringify(data) + '\n');
		    },
		    success: function (data) {
		    	
		    	if((target !=="layouts") && (target !=="compress")) { 
		    	 
			    	 if($('#compile_required').val() == "1") {
			    	
			    		console.log('Checking to see if compiler has finished running');
				    	$('#log pre').append('Checking to see if compiler has finished running. \n');
				    	
				    	// Display success message only if compiling of css has finished
				    	var interval = setInterval(function(){
				    		
				    		if($('#compile_required').val() == "1") {
				    					
				    			// Do nothing
				    			// Wait for compile to finish
				    					
				    		}
				    				
				    		else {
				    			
				    			// Fade out the comoile message
				    			$('#zgfmessage .compile').hide();
				    			
				    			// Reste the compiel required value
				    			$('#compile_required').val('0');
				    			
				    			// Finished compiler
				    			console.log('Compiler has finished running');
				    			$('#log pre').append('Compiler has finished running. \n');
				    			
				    			// Success message
				    			console.log('Successfully saved ' + target + ':' + data); 
				    			$('#log pre').append('Successfully saved ' + target + ':' + data + '\n');
				    			
				    			// Since we updated the css and the theme settings have changed
				    			// We need to save the theme again
				    			var data = $(document).get_theme();
				    			
				    			// Get the theme name
				    			var name = $('#style-name').val();
				    			
				    			// Add theme name to the data
				    			data.theme = name;
				    			
				    			// Save the theme details
				    			$(document).send_ajax(template, url, data, 'save', '', 'themes', 'theme.' +name);
				    			
				    			// Set stored value of all inputs that have a stored value
				    			$('#zgf input').each(function() {
				    				
				    				var newvalue = $(this).val();
				    				$(this).attr('data-stored', newvalue);
				    				console.log('Set the stored value for all items');
				    				
				    				
				    			});
				    			$('#log pre').append('Set the stored value for all items.\n');
				    			jQuery('#zgfmessage .' + target).fadeIn('normal', function() {
				    				jQuery('#zgfmessage,#zgfmessage .' + target).delay(3000).fadeOut();
				    			});	    
				    								
				    				// Clear interval
				    			clearInterval(interval);
				    			
				    			// Check the Joomla toolbar
				    			var clicked = $('button.zen-clicked').parent().attr('id');
				    			
				    			if(clicked == 'toolbar-save') {
				    				// Clean intrval
				    				clearInterval(interval);
				    				
				    				// if save and close
				    				Joomla.submitbutton('style.save');
				    			} else if(clicked == 'toolbar-apply')  {
				    					
				    				// Clear interval
				    				clearInterval(interval);
				    				
				    				// if save
				    				Joomla.submitbutton('style.apply');
				    			}
				    		
				    		}
				    				 	
				    	}, 1000);
			    	}
			    	else {
			    		// Success message
			    		jQuery('#zgfmessage .' + target).fadeIn('normal', function() {
			    			jQuery('#zgfmessage,#zgfmessage .' + target).delay(3000).fadeOut();
			    		});
			    		
			    		// Check the Joomla toolbar
			    		var clicked = $('button.zen-clicked').parent().attr('id');
			    		
			    		if(clicked == 'toolbar-save') {
			    			// Clean intrval
			    			clearInterval(interval);
			    			
			    			// if save and close
			    			Joomla.submitbutton('style.save');
			    		} else if(clicked == 'toolbar-apply')  {
			    				
			    			// Clear interval
			    			clearInterval(interval);
			    			
			    			// if save
			    			Joomla.submitbutton('style.apply');
			    		}
			    	}
			    } else {
			    	// Success message
			    	console.log('Successfully saved ' + target + ':' + data); 
			    	$('#log pre').append('Successfully saved ' + target + ':' + data + '\n');
			    	jQuery('#zgfmessage, #zgfmessage .' + target).fadeIn('normal', function() {
			    		jQuery('#zgfmessage,#zgfmessage .' + target).delay(3000).fadeOut();
			    	});
			    	
			    	// Check the Joomla toolbar
			    	var clicked = $('button.zen-clicked').parent().attr('id');
			    	
			    	if(clicked == 'toolbar-save') {
			    		// Clean intrval
			    		clearInterval(interval);
			    		
			    		// if save and close
			    		Joomla.submitbutton('style.save');
			    	} else if(clicked == 'toolbar-apply')  {
			    			
			    		// Clear interval
			    		clearInterval(interval);
			    		
			    		// if save
			    		Joomla.submitbutton('style.apply');
			    	}
			    	
			    				    	
			    }
		     	
		    }
		});	  
	};
})(jQuery);