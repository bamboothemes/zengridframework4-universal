<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

?>


	<script>
		jQuery(document).ready(function ($) {
		
		     // Loads the saved styles based on user interaction with dropdown list
		     
	        // Set the value for the inherit theme css dropdown
	        var cssfile = $('input#theme').val();
	        
	        if(cssfile =="") {
	        	cssfile = $('#cssfile').val();
	        	$('input#theme').val(cssfile);
	        }
	        
	        $('select#cssfile option[value="'+ cssfile+'"]').attr("selected","selected");
	        
	        $("#style-name").val(cssfile);
	        
	        $('select#cssfile').change(function () {
	        	var cssfile = $(this).val();
	        	$('input#theme').val(cssfile);
	        	
	        });
	        
	       var template = '<?php echo TEMPLATE;?>';
	       
	       var time = '<?php echo date('Y-m-d-H-i-s');?>';
	       
	       // Set Theme Data
	        $(document).set_theme_data(template, time, '<?php echo TEMPLATE_PATH_RELATIVE;?>');
	        
	        $(document).on('change', '#cssfile', function() {	
	        
	        	// set_theme_data: template, time, theme path
	    		$('#compile_required').val('1');
	        	$(document).set_theme_data(template, time,'<?php echo TEMPLATE_PATH_RELATIVE;?>');
	        });
	        
	        
	        
	        $(document).on('click', '.compiler,#compile,#toolbar-apply button,#toolbar-save button,#save-theme', function() {
	        	
	        	var framework_version = $('#framework_version').val();
	        	
	        	var preset = "{";
	        	
	        		preset += "\n";
	  
	        		
        		$('[data-compile="1"],[data-compile="both"],.zt-picker').each(function(i) {
        			
        			var id = $(this).attr('id'); 
        			
        			if(typeof id !=="undefined") {
        				
        				var value = $(this).val();
        				
        				// Special case for when select boxes are null
        				if(value =="null") {
        				
        				} else {
	        				value = value.replace('#', '');
	        				
		        			preset += "\t";
		        			preset += '"' + id + '":';
		        			preset += '"' + value + '",';
		        			preset += "\n";
						}
	        		}
        			      		
        		});
        		
     			preset += "\t";
     			preset += '"framework_version": "' + framework_version +'",';
     			preset += "\n";
        		preset += "\t";
        		preset += '"framework_files":';
        		preset += '"';
        		
        			$('.framework_list.active input.framework_files').each(function() {
        					
        				if($(this).val() == '1') {
        				
        					var filename = $(this).attr('data-id');
        				
        					preset += filename;
        					preset += ' ';	
        				}
        			});
        			
        		preset += '"';
        		
        		preset += "}";
	        		
	        	save_preset(preset);
	        	
	        	return false;
	        
	       	 });	
	    	
	    	
	    	
	    	var template = '<?php echo TEMPLATE;?>';
	    	
	    	<?php if(JOOMLA) {?>
	    	var url = '<?php echo JURI::base();?>?option=com_ajax&plugin=zengridramework2&format=raw';
	    	<?php } else { ?>
	    	var url = 'admin-ajax.php';
	    	<?php } ?>
	    	
	    		
	    	 var save_preset = function (content) {
	    	 	 
	    	 	var name = $('#style-name').val();
	    	 		name = name.replace(/\s+/g, '-').toLowerCase();
	    	 	
	    	 	var theme_exists = $("#cssfile option[value='"+name+"']").length;
	    
	    	 	if(theme_exists < 1) {
		    	 	// Append the new preset to the presetlist
		    	 	$('#cssfile').append($('<option>', {
		    	 	    value: name,
		    	 	    text: name,
		    	 	    selected: 1
		    	 	}));
	    	 	}	
	    
	    	 	$('select#cssfile option[value="theme.'+ name+'"]').attr("selected","selected");
	    	 	
	    	 	$('input#theme').val(name);
	    	 	 
	    	 		
	    			$.ajax({
	    	         url : url,
	    	         method: 'post',
	    	         context: document.body,
	    	         data: {
	    	         	content: content,
	    	         	admin: '1'
	    	         },
	    	         
	    	         beforeSend: function () {
	    	           		    	            	                    
	    	         },
	    	         success: function (data) {
	    	         	
	    	         }
	    	     });
	    	  }; 
	    	  

	    	
	    	    
	    });
	    </script>