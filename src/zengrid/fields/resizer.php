<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>

<p class="<?php echo $class;?>">
	<a href="#" id="resize-images" class="resize-images uk-button uk-button-primary loader <?php echo $class;?>">
		<span class="loading-spinner loading-spinner-large">
			<span></span>
		</span>
	
		<span class="button-title"><?php echo $label;?></span>
	</a>
</p>
<p><?php echo $description;?></p>
<br />

<script>
	
	jQuery(document).ready(function($) {
	
		$('#resize-images').click(function() {
			
			var folder = $('#slideshowimages').val();
			var width = $('#thumbwidth').val();
			var height = $('#thumbheight').val();
			
			var template = '<?php echo TEMPLATE;?>';
			
			url = '../index.php?template=' + template + '&tmpl=ajax&function=ajax-image-resize';
					
			$.ajax({
			      url: url,
			      method: 'post',
			      context: document.body,
			      data: {
			      	folder: folder,
			      	width: width,
			      	height: height,
			       	admin: '1'
			      },
			       
			      beforeSend: function () {
			         $('#resize-images').addClass('active').find('.button-title').text('Resizing Images ... please wait.'); 
			          	            	                    
			      },
			      success: function (data) {
			      	 $('#resize-images').removeClass('active').find('.button-title').text('<?php echo $label;?>'); 
			 
			      }
			});
		});
	});
</script>