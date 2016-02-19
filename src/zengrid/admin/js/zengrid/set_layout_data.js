/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
		// Load Layout Function
		$.fn.set_layout_data = function (template) {

			
			
			
			// Empty the resize container
			$('#resize-container').empty();
			
			var type = $.type(template);
			
			if(type =="string") {
				// Get the layout to use
				layout = $('#layout_preset').val();
				
				// Set the save box with the current name
				$('#layout-name').val(layout);
			} else {
				layout = template;
			}

			$.ajax({
			 	url : "admin-ajax.php",
			 	method: 'post',
			 	context: document.body,
			 	data: {
			 		admin:'1',
			 		action: 'set_layout',
			 		template: template,
			 		layout: layout
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
