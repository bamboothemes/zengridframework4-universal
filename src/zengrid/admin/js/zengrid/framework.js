jQuery(document).ready(function ($) {
		
		
	/*
	*	
	*	Appends a new layout to the layout select box
	*	And makes it active
	*
	*/	
	
		
	$('#save-layout').click(function() {
		var layout = $('#layout-name').val();
		
		var layout_exists = $("#layout_preset option[value='"+layout+"']").length;
		
		if(layout_exists < 1) {
		 	// Append the new preset to the presetlist
		 	$('#layout_preset').append($('<option>', {
		   	 	    value: layout,
		   	 	    text: layout,
		   	 	    selected: 1
		   	}));
		 }
		 
		 $('select#layout_preset option[value="'+ layout+'"]').attr("selected","selected");
		
		
	});
	
	
	
	
	/*
	*	
	*	Checkboxes on page load
	*
	*/
	
	
	jQuery('#theme-settings input[type="checkbox"]').each(function () {
		var toggle = $(this).attr('id');
		jQuery('.' + toggle).hide().parent().hide();
		
		if($(this).prop('checked') ) {	
			jQuery('.' + toggle).fadeIn().parent().show();
		} 
		
	});
	
	
	
	/*
	*	
	*	Checkboxes on click
	*
	*/
	
	$('#theme-settings input[type="checkbox"]').click(function() {
		
		var toggle = $(this).attr('id');
		
		// Set value to 0
		$(this).val('');
		
		// Check if checked and set to 1
		if($(this).is(':checked')) {
			$(this).val(1);
			$('.' + toggle).fadeIn().parent().show();
		}
		else {
			$(this).val(0);
			$('.' + toggle).fadeOut().parent().hide();
			
		}
		
		console.log('yeah');
		$('#compile_required').val(1);
	});
	
	
	
	/*
	*	
	*	Select boxes on page load
	*
	*/
	
	$('#theme-settings .zen-select').each(function () {
		var toggle = $(this).attr('id');
		
		if($(this).val() === -1) {
			$('.' + toggle).fadeIn();	
		} else {
			$('.' + toggle).fadeOut();
		}
	});
	
	
	
	
	
	/*
	*	
	*	Select boxes on change on page load
	*
	*/
	
	
	$('#theme-settings .zen-select').change(function () {
		var toggle = $(this).attr('id');
		
		if($(this).val() === -1) {
			$('.' + toggle).fadeIn();	
		} else {
			$('.' + toggle).fadeOut();
		}
	});	
	
	
		
	
		
	/*
	*	
	*	Resizble elements on page load
	*
	*/
	
	
	$( ".resizable" ).each(function() {

		var width = Math.round($(this).width() / 50);
		$(this).attr('class','').addClass('resizable ui-widget-content ui-resizable');
		$(this).find('.ui-widget-header span.col-count').text();
		$(this).find('.ui-widget-header span.col-count').text(width).parent().parent().addClass('grid-'+ width).attr('data-width', width);
		
		var active = $(this).attr('data-active');
		
		if(!active) {
			$(this).fadeOut();
			var id = $(this).attr('id');
			$('.unused-modules div[data-id="' + id + '"]').fadeIn().addClass('active').parent().addClass('active');
		}
	});
	
	
	$( ".resizable" ).resizable({
	      grid: 40,
	      minWidth:40,
	      containment: "#resize-container",
	      handles: 'e',
	      
	      resize: function() {
	      	$(this).attr('class','').addClass('resizable ui-widget-content ui-resizable');
	      	
	      	var width = Math.round($(this).width() / 50);
	      	$(this).find('.ui-widget-header span.col-count').text();
	      	$(this).find('.ui-widget-header span.col-count').text(width).parent().parent().addClass('grid-'+ width).attr('data-width', width);
	      	
	      }
	 });
	 
	 
	
	
	/*
	*	
	*	Eye icon for removing items from layout
	*
	*/
	
	 $(document).on('click', '.module-row .icon-eye',function() {
	 
	 	var id = $(this).parent().parent().attr('id');
	 		
	 	// Hide the item
	 	$(this).parent().parent().hide().attr('data-active', 0);
	 	
	 	// Make the current row active
	 	$('div[data-id="' + id + '-row"]').show().addClass('active').parent().addClass('has-content');
	 	
	 	// Get the position so we can position the side-drawer here
	 	var top_position = $('#resize-container #' + id).parent().offset();
	 	top_position = top_position.top;
	 	console.log(top_position);
	 	
	 	// Fade Out the sidedarawer if it exists
	 	$('.side-drawer').fadeOut();
	 	
	 	// Remove all other active items
	 	$('.resize-row').removeClass('active');
	 	
	 	// Add active class to current item
	 	$(this).parent().addClass('active');
	 	
	 	// Active the sidebar settings for this row		
	 	var row = $(this).parent().parent().parent().attr('data-row');
	 		row = row.replace('-row', '');
	 	$('[data-id="' + row + '_settings"].side-drawer').css({"top":top_position - 300}).fadeIn();
	 	
	 	
	 	// Make the unused item appear in the unused area
	 	$('[data-id="' + id + '"]').show();
	 	
	 	// Is the row empty
	 	// Check to see if any items are active in the row
	 	var count = 0;
	 		console.log(row);
	 	$('[data-row="' + row + '-row"] [data-active="1"]').each(function(){
	 		count ++;
	 	});
	 		
	 	if(count === 0) {
	 		$('[data-row="' + row + '-row"]').addClass('empty-row');
	 	}
	 	
	 });
	 
	 
	
	/*
	*	
	*	Action for when unused items are reused
	*
	*/
	
	 $(document).on('click', '.unused-modules div', function() {
	  		var id = $(this).attr('data-id');
	  		var row = $(this).parent().attr('data-id');
	  		console.log(row);
	 		$(this).hide(); 		
	 		$('[data-row="' + row + '-row"] #' + id).show().attr('data-active', 1).parent().removeClass('empty-row');
	 		
	 });
	 
	 
	 
	 
	 /*
	 *	
	 *	Make items stack in the layout tool
	 *
	 */
	 
	 jQuery(document).on('click','.stack-positions', function() {
		$(this).toggleClass('active');
		return false;
	});
	
	
	
	
	
	/*
	*	
	*	See if origin value of a compile input has changed value
	* 	If it has then we trigger the compile required setting
	*/
	
	
	$(document).on('blur', '[data-compile="theme"],[data-compile="both"]', function() {
	
		var stored = $(this).attr('data-stored');
		var current = $(this).val();
		
		
		if(stored !== current ) {
			$('#compile_required').val(1);
			var name = $(this).attr('id');
			console.log(name + ' value changed and triggered compile required');
		}
	});
	
	
	$(document).on('change', '#theme-settings select', function() {
	
		var stored = $(this).attr('data-stored');
		var current = $(this).val();
		
		if(stored !== current ) {
			$('#compile_required').val(1);
			var name = $(this).attr('id');
			console.log(name + ' value changed and triggered compile required');
		}
	});
	
	
	
	/*
	*	
	*	Toggles for advanced settings
	*
	*/
	
	var advanced_settings = $('#advanced_setting').val();
	
	if(advanced_settings ==='1') {
		$('#framework-options').addClass('pro').removeClass('basic');
		$('.toggle-advanced').text('Hide Advanced Options');
	
	} else {
		
		$('#framework-options').removeClass('pro').addClass('basic');
		$('.toggle-advanced').text('Show Advanced Options');
	}
	
	
	
	$('.toggle-advanced').click(function() {
		
		var options = '#framework-options';
		
		if($(options).hasClass('basic')) {
			$(options).addClass('pro').removeClass('basic');
			$('.toggle-advanced').text('Hide Advanced Options');
			$('#advanced_setting').val('1');
		} else {
			$(options).removeClass('pro').addClass('basic');
			$('.toggle-advanced').text('Show Advanced Options');
			$('#advanced_setting').val('0');
		}
		return false;
	});
	
	
	
	var hide_value = $('input#hide_info').val();
	
	if(hide_value == 1) {
		$('.info,.checkbox-info,.textarea-info').hide();
	}
	else {
		$('.info,.checkbox-info,.textarea-info').show();
	}
	
	jQuery(document).on('#hide_info','click', function() {
		   			
		var hide_value = $('input#hide_info').val();
		
		if(hide_value == 1) {
			$('.info,.checkbox-info,.textarea-info').hide();
		}
		else {
			$('.info,.checkbox-info,.textarea-info').show();
		}
		
		
	});
	
	
	/*
	*	
	*	Checks color pickers to see if variables are being used
	*	On page load
	*
	*/
	
	
	$( ".zt-picker" ).each(function() {
		
		var value = $(this).val();
		var firstletter = value.charAt(0);
		
		if(firstletter === "@") {
			var other = value.substring(1, value.length)
			other = $('input#' + other).val();
				$(this).css({'border-right-color': '#' +other});
		}
	
	});
	
	
	
	/*
	*	
	*	Checks color pickers to see if variables are being used
	*	On Change
	*
	*/
	
	$( ".zt-picker" ).change(function() {
		
		var value = $(this).val();
		var firstletter = value.charAt(0);
		
		
		if(firstletter === "@") {
			var other = value.substring(1, value.length)
			other = $('input#' + other).val();
			
			var firstletter = other.charAt(0);
				
				if(firstletter === "@") {
					other = other.substring(1, value.length)
					other = $('input#' + other).val();
				}

				$(this).css({'border-right-color': '#' +other});
		}
	
	});
	
	
	
	/*
	*	
	*	Checks color pickers to see if lighten, darken etc
	*	On page load
	*
	*/
	
	
	$( ".zt-picker" ).each(function() {
		
		var val = $(this).val();
		
		var firstletter = val.substring(0, 3);
			
			if(firstletter === "dar" || firstletter === "lig") {
				
				
				if(firstletter === "dar") {
					var other = val.substring(8, val.length);
					other = other.split(',');
				}
				
				
				if(firstletter === "lig") {
					var other = val.substring(9, val.length);
					other = other.split(',');
				}
				
				
				// Change % into a decimal    				
				var percentage = other[1].slice(0,-2);
					percentage = parseFloat(percentage) / 100.0;
					
					if(firstletter === "dar") {
						percentage = '-' + percentage;
					}
				
					
					other = other[0];
					other = $('input#' + other).val();
					
					var newColor = $(document).ColorLuminance(other, percentage); 
					
					$(this).css({'border-right-color': newColor});
			}
	
	});
	
	
	
	/*
	*	
	*	Checks color pickers to see if lighten, darken etc
	*	On change
	*
	*/
	
	$( ".zt-picker" ).change(function() {
		var value = $(this).val();
		// Grab the 3rd letter because d and a are valid hex values
			// da - r- ken  and li - g -hten
			var firstletter = value.charAt(2);
			
			if(firstletter === "r") {
				
				var other = value.substring(8, value.length);
		
					other = other.split(',');
			}
			
			if(firstletter === "g") {
				
				var other = value.substring(9, value.length);
					other = other.split(',');
			}
			
			
			if(firstletter === "r" || firstletter === "g") {
				
				// Change % into a decimal    
							
				var percentage = other[1].slice(0,-2);
					
					
					if(firstletter === "r") {
						percentage = 1 / percentage;
						percentage = '-' + percentage;
					} else {
						percentage = 10 / percentage;
					}
				
					other = other[0];
					other = $('input#' + other).val();
					
					
				var newColor = $(document).ColorLuminance(other, percentage); 
				 
				$(this).css({'border-right-color': newColor});
			}
	});
	
	
	
	/*
	*	
	*	Side nav
	*	
	*
	*/
	$('#zen-sidebar li').click(function() {
		$('#active_tab').val('');
		var active_item = $(this).attr('data-id');
		$('#active_tab').val(active_item);
	});
	
	// Set the active sidebar item
	var active_item = $('#active_tab').val();
	
	if(active_item === "") {
		active_item ="overview";
	}
	
	
	$('#zen-sidebar li').removeClass('uk-active');
	$('#zen-sidebar li[data-id="' + active_item + '"]').addClass('uk-active');
	$('#theme-settings > li').removeClass('uk-active');
	$('#theme-settings > li#' + active_item).addClass('uk-active');
	
	

	
	/*
	*	
	*	Remove quotation marks
	*	
	*
	*/
	
	
	$('#theme-settings textarea,#theme-settings input').on('change', function () {
		
		var value = $(this).val();
			
		// replace #
		value = value.replace(/"/g, '\'');
			
		// replace new lines
		value = value.replace(/\n/g, '');
			
		$(this).val(value);
		
	});	
	
	
	/*
	*	
	*	Sets a default for the theme option if required
	*	Updates on change
	*
	*/
	
	// On load
	set_theme_name();
	
	
	// On theme save
	$('#save-theme').click(function() {
		
		var newtheme = $('input#style-name').val();
		
		var new_theme_exists = $("#cssfile option[value='"+newtheme +"']").length;
			
		if(new_theme_exists < 1) {

		  	// Append the new preset to the presetlist
		   	$('select#cssfile').append($('<option>', {
		   	 	    value: newtheme,
		   	 	    text: newtheme,
		   	 	    selected: 1
		   	}));
		}
	});
	
	
	
	function set_theme_name() {
		
		var theme = $('input#theme').val();
		
		// Just iun case the theme value is empty
		 if(theme ==="") {
		  	theme = $('#cssfile').val();
		 	$('input#theme').val(theme);
		}
		  
		$('select#cssfile option[value="'+ theme +'"]').attr("selected","selected");
		  
		$("#style-name").val(theme);
	}
	
	$('select#cssfile').change(function () {
		var theme  = $(this).val();
			theme = theme.replace('presets/theme.[example]-', '');
		$('input#theme').val(theme);
		
	});
	
	
	// Select states
	$('#theme-settings .zen-select').each(function () {
		
		
		var toggle = $(this).attr('id');
		
		if($(this).val() == -1) {
			$('.' + toggle).fadeIn();
			
		}
		
		else {
			$('.' + toggle).fadeOut();
		}
	});
	
	
	// Select states
	$('#theme-settings .zen-select').change(function () {
		
		var toggle = $(this).attr('id');
		
		if($(this).val() == -1) {
			$('.' + toggle).fadeIn();
			
		}
		
		else {
			$('.' + toggle).fadeOut();
		}
	});	
	
});
