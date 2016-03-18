<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

if($value == "0") {
	$value = 'none';
}elseif($value == "transparent") {
	$value = 'transparent';
} else {
	$value = '#'.$value;
}

$options = array('solid', 'dashed','dotted','none');
?>

<div class="border-rule">
	<label><strong><?php echo $label;?></strong></label>
	<br />
	
	<div id="<?php echo $name;?>-widths-wrap" class="border-widths">
		<div data-key="0" data-id="top" class="bw north"></div>	
		<div data-key="1" data-id="right" class="bw east"></div>
		<div data-key="2" data-id="south" class="bw south"></div>
		<div data-key="3" data-id="west" class="bw west"></div>
	</div>
	
	<input type="text" data-stored="<?php echo $value;?>" data-compile="1" id="<?php echo $name;?>-widths" data-default="0px" value="<?php echo str_replace('#', '', $value);?>" class="hidden border-widths-value" ></input>
	
	
	<input type="text" data-stored="<?php echo $value;?>" data-compile="1" id="<?php echo $name;?>-width" data-default="0px" value="<?php echo str_replace('#', '', $value);?>"></input>
	
	<select data-compile="1" id="<?php echo $name;?>-style" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
	          
		<?php foreach ($options as $key => $option) {
			
			
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			} 	
			
		} ?>
		
	</select>
	
	<div id="<?php echo $name;?>-color-wrap" class="color-wrap compile <?php echo $class;?>">
		<input type="text" data-stored="<?php echo $value;?>" data-compile="1" class="zt-picker" id="<?php echo $name;?>-color" data-default="<?php echo str_replace('#', '', $value);?>" value="<?php echo str_replace('#', '', $value);?>" style="border-color:<?php echo $value;?>"></input>
	</div>
	
	
</div>
<script>
	jQuery(document).ready(function($) {
	
		$('input#<?php echo $name;?>-color.zt-picker').colpick({
		 		
		 		layout:'hex',
		 		submit:0,
		 		colorScheme:'dark',
		 		
		 		onChange:function(hsb,hex,rgb,el,bySetColor) {
		 		
		 		    id = $(el).attr('id');
		 		
		 		    $('#' + id + '-color-box').css('background','#'+hex);
		 		    $('.font-sample[data-target="' + id + '"]').css('color','#'+hex);
		 		
		 		    el = 'input#' + $(el).attr('id') + '.zt-picker';
		 		
		 		    $(el).css('border-color','#'+hex);
		 		
		 		    // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		 		    if(!bySetColor) $(el).val(hex);
		 		
		 		    // Copied from the livepreview.php
		 		   
		 		   <?php if($name =="body-bg") { ?>

					$('#resize-container').css({'background-color': '#' +hex});
		 		    <?php } ?>
		 		    
		 
		 		
		 		}
		 	}).keyup(function(){
		 		$(this).colpickSetColor(this.value);
		 	});
		 	
		 $('#<?php echo $name;?>-widths-wrap.border-widths .bw').click(function() {
		 	
		 	$(this).toggleClass('active');
		 	console.log('clicked');
		 	// Update widths
		 	var width = "";
		 	var pxwidth = $("#<?php echo $name;?>-width").val();
		 	
		 	if(pxwidth == ""){
		 		pxwidth = "1px";
		 	}
		 	
		 	if($(this).parent().find('.north').hasClass('active')) {
		 		width += pxwidth + " ";
		 	} else {
		 		width += "0" + " ";
		 	}
		 	
		 	if($(this).parent().find('.east').hasClass('active')) {
	 			width += pxwidth + " ";
	 		} else {
	 			width += "0" + " ";
	 		}
	 		
	 		if($(this).parent().find('.south').hasClass('active')) {
 				width += pxwidth + " ";
 			} else {
 				width += "0" + " ";
 			}
 			
 			if($(this).parent().find('.west').hasClass('active')) {
				width += pxwidth;
			} else {
				width += "0";
			}
			
			$("#<?php echo $name;?>-widths").val(width);
			
		 });
		 
		 
		 $("#<?php echo $name;?>-width").blur(function() {
		 	// Update widths
		 		var width = "";
		 		var pxwidth = $("#<?php echo $name;?>-width").val();
		 		
		 		if(pxwidth == ""){
		 			pxwidth = "1px";
		 		}
		 		
		 		if($(this).parent().find('.north').hasClass('active')) {
		 			width += pxwidth + " ";
		 		} else {
		 			width += "0" + " ";
		 		}
		 		
		 		if($(this).parent().find('.east').hasClass('active')) {
		 			width += pxwidth + " ";
		 		} else {
		 			width += "0" + " ";
		 		}
		 		
		 		if($(this).parent().find('.south').hasClass('active')) {
		 			width += pxwidth + " ";
		 		} else {
		 			width += "0" + " ";
		 		}
		 		
		 		if($(this).parent().find('.west').hasClass('active')) {
		 		width += pxwidth;
		 	} else {
		 		width += "0";
		 	}
		 	
		 	$("#<?php echo $name;?>-widths").val(width);
		 });
	});

</script>