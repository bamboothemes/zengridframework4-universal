<?php
/**
 * @package		##package##
 * @subpackage	##subpackage##
 * @author		##author##
 * @copyright 	##copyright##
 * @license		##license##
 * @version		##version##
 */
 
// no direct access
defined( 'ZEN_ALLOW' ) or die( 'Restricted access' );

// Get theme name
if(isset($_POST['theme'])) {
	
	if(!empty($_POST['theme'])){
		$theme = $_POST['theme'];
		
		if($theme !=="") {
			if(file_exists(TEMPLATE_PATH.'settings/config/config-'.$theme.'.json')) { unlink(TEMPLATE_PATH.'settings/config/config-'.$theme.'.json'); }
			
			return 'The '.$theme.' and assets have bene deleted';
			
		} else {
			return 'No theme to delete';
		}
	}
	else {
		return 'No theme to delete';
	}
}
else {
	return 'No theme to delete';
}