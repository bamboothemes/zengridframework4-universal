<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>

<div id="<?php echo $name;?>-subnav" class="subnavlinks"><ul></ul></div>

<script>
	jQuery(document).ready(function($) {
		
		$("#<?php echo $name;?> .uk-article-title").each(function() {
	
			var item = $(this).text();
			var id = $(this).attr('id');
			var advanced = '';
			
			if($(this).parent().parent().hasClass('advanced')) {
				advanced = ' advanced';
			}
			
			if(id !=="") {
				item = '<li><a class="subnavlink-item' + advanced + '" href="#' + id + '">' + item +'</a>';
				$("#<?php echo $name;?>-subnav ul").append(item);
			}
		});
	});
</script>
