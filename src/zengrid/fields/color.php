<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>


<div id="<?php echo $name;?>-color" class="color-wrap compile <?php echo $class;?>">
	<label><strong><?php echo $label;?></strong></label>
	<input type="text" class="zt-picker setting" id="<?php echo $name;?>" data-default="<?php echo str_replace('#', '', $value);?>" value="<?php echo str_replace('#', '', $value);?>" style="border-color:#<?php echo $value;?>"></input>
</div>
	
<script>
	jQuery(document).ready(function($) {
	
	
		$('input#<?php echo $name;?>').colpick({
		 		
		 		layout:'hex',
		 		submit:0,
		 		colorScheme:'dark',
		 		
		 		onChange:function(hsb,hex,rgb,el,bySetColor) {
		 		
		 		    id = $(el).attr('id');
		 		
		 		    $('#' + id + '-color-box').css('background','#'+hex);
		 		    $('.font-sample[data-target="' + id + '"]').css('color','#'+hex);
		 		
		 		    el = 'input#' + $(el).attr('id');
		 		
		 		    $(el).css('border-color','#'+hex);
		 		
		 		    // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		 		    if(!bySetColor) $(el).val(hex);
		 		
		 		    // Copied from the livepreview.php
		 		    $('iframe#preview').contents().find("#tester").val('#' + hex).change();
		 		    $('iframe#preview').contents().find("body").removeClass('live-preview').addClass('live-preview');
		 		
		 		}
		 	}).keyup(function(){
		 		$(this).colpickSetColor(this.value);
		 	});
	});

</script>