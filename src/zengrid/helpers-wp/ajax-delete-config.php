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

// Get config name
print_r($_POST);
if(isset($_POST['config'])) {
	
	if(!empty($_POST['config'])){
		$config = $_POST['config'];
		
		if($config !=="") {
			if(file_exists(TEMPLATE_PATH.'settings/config/config-'.$config.'.json')) { 
				unlink(TEMPLATE_PATH.'settings/config/config-'.$config.'.json'); 
				
				$base = TEMPLATE_PATH.'js/';
				if(file_exists($base.'template-'.$config.'.php')) { unlink($base.'template-'.$config.'.php'); }
				if(file_exists($base.'template-'.$config.'.js')) { unlink($base.'template-'.$config.'.js'); }
			}
			
			return 'The '.$config.' and assets have been deleted';
			
		} else {
			return 'No config to delete';
		}
	}
	else {
		return 'No config to delete';
	}
}
else {
	return 'No config to delete';
}