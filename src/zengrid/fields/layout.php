<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// This file is used when the page laods for the first time
// No Direct Access
defined('ZEN_ALLOW') or die(); 

?>


	<script>
		
	jQuery(document).ready(function($) {
	
	// Sets the value of the save layout box with current layout 
	var layout = $('#layout_preset').val();
	
	// Set the save box with the current name
	$('#layout-name').val(layout);
	
	
	
});
</script>