/*
Compile Data Function
 */
(function ($) {

	$.fn.compile_data = function (template, url, data, action,id, target, name) {

		$.ajax({
			
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
		      	 var name = $('#style-name').val();
		      	 name = name.replace('theme.','');
		      	       	  
		      	  // Check to see if we are compiling as well
		      	 jQuery('#zgfmessage span').text(name);
		      	 jQuery('#zgfmessage,#zgfmessage .compile').fadeIn();
		      	 	    	  
		    },
		    error: function (data) {
		    	console.log('Error:' + JSON.stringify(data));
		    	$('#log').append('Compile Data');
		    	$('#log').append('Error:' + JSON.stringify(data));
		    },
		    success: function (data) {	
		    	$('#compile_required').val('0');
		    	console.log('Finished compiling:' + data); 
		    	$('#log').append('Compile Data');
		    	$('#log').append('Error:' + JSON.stringify(data));   	
		    }
		 });
	}
})(jQuery);