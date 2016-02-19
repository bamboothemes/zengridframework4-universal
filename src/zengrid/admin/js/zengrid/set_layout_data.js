/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
		// Load Layout Function
		$.fn.set_layout_data = function (data,url,template) {

			// Empty the resize container
			$('#resize-container').empty();
			
			
			// If we are loading the layout from a  config file then we already have the object
			// Whereas if it's from a layout file it's just the name
			
			var type = $.type(data);
			
			if(type =="string") {
				// Get the layout to use
				layout = $('#layout_preset').val();
				
				// Set the save box with the current name
				$('#layout-name').val(layout);
				
				$('#log pre').append('Loading ' + layout + ' layout from file\n');
				
			} else {
				layout = data;
				
				$('#log pre').append('Loading layout from config\n');
			}
			
			console.log('template' + template);
			console.log('data' + data);
			$.ajax({
			 	url : url,
			 	method: 'post',
			 	context: document.body,
			 	data: {
			 		'option' : 'com_ajax',
			 		'plugin' : 'zengridframework',
			 		admin:'1',
			 		action: 'set_layout',
			 		template: template,
			 		layout: data,
			 		content: data
			 	},
			
			 error: function (data) {
			 		console.log(data);
			 },
			 	success: function (data) {
			 		$('#resize-container').append(data);
			
			 		$( ".resizable" ).each(function() {
			 			var width = Math.round($(this).width() / 50);
			 			$(this).attr('class','').addClass('resizable ui-widget-content ui-resizable');
			 			$(this).find('.ui-widget-header span.col-count').text();
			 			$(this).find('.ui-widget-header span.col-count').text(width).parent().parent().addClass('grid-'+ width).attr('data-width', width);
			 			
			 			if($(this).attr('data-active')) {
			 				
			 			} else {
			 				var id = $(this).attr('id');
			 				$('.unused-modules div[data-id="' + id + '"]').fadeIn().addClass('active').parent().addClass('active');
			 			}
			 		});
			 		
			 		
			 		$( ".resizable" ).resizable({
			 		      grid: 40,
			 		      minWidth:40,
			 		      containment: "#resize-container",
			 		      handles: 'e',
			 		      
			 		      resize: function( event, ui ) {
			 		      	$(this).attr('class','').addClass('resizable ui-widget-content ui-resizable');
			 		      	
			 		      	var width = Math.round($(this).width() / 50);
			 		      	$(this).find('.ui-widget-header span.col-count').text();
			 		      	$(this).find('.ui-widget-header span.col-count').text(width).parent().parent().addClass('grid-'+ width).attr('data-width', width);
			 		      	
			 		      }
			 		 });
			 	}
			});
		} 
		
		
})(jQuery);
