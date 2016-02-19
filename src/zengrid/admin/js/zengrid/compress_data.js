/*
colpick Color Picker
Copyright 2013 Jose Vargas. Licensed under GPL license. Based on Stefan Petre's Color Picker www.eyecon.ro, dual licensed under the MIT and GPL licenses

For usage and examples: colpick.com/plugin
 */

(function ($) {
		
	$.fn.compress_data = function (template,url) {
			
		var custom = $('#add_to_compressor').val();
		
		
		// Get Template id
		function getUrlParameters(name) {
		    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		        results = regex.exec(location.search);
		    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}
		
		var template_id = getUrlParameters('id');
		
		// Files loaded from Asset.xml
		var files = $('#files_for_compressor').text();
		
		var wowjs = $('#enable_animations').val();
		
		$.ajax({
		    url : url,
		    method: 'post',
		    context: document.body,
		    data: {
		    	'option' : 'com_ajax',
		    	'plugin' : 'zengridframework',
		    	files: 	 files,
		    	custom:	custom,
		    	id: template_id,
		    	wowjs: wowjs,
		    	admin:'1'
		    },
		    beforeSend: function () {
		      	  $('#compresser').addClass('active');	  
		      	            	                    
		    },
		    success: function (data) {
		    	$('#compresser').removeClass('active');	
		    	
		    	jQuery('#zgfmessage').html('<div class="alert alert-success"><h4 class="alert-heading">Message</h4><p>' + data +  'Javascript has been updated.</p></div>').fadeIn('normal', function() {
		    			jQuery('#zgfmessage').delay(3000).fadeOut();
		    		});
		    		
		    	$('.compresser').find('.button-title').text('Compress Scripts');
		    
		    }
		});	  
	};
		
})(jQuery);
