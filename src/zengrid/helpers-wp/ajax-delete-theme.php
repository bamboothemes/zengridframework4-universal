<?php
/**
 * @package		Zen Grid Framework v4, 1.4.1
 * @subpackage	Updated: March 10 2016
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) Joomlabamboo, March 10 2016
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License version 2 or later;
 * @version		1.4.1
 */
 
// no direct access
defined( 'ZEN_ALLOW' ) or die( 'Restricted access' );

// Get theme name
if(isset($_POST['theme'])) {
	
	if(!empty($_POST['theme'])){
		$theme = $_POST['theme'];
		
		if($theme !=="") {
			$base = TEMPLATE_PATH.'css/theme.'.$theme;
			if(file_exists($base.'.css')) { unlink($base.'.css'); }
			if(file_exists($base.'.php')) { unlink($base.'.php'); }
			if(file_exists($base.'.map')) { unlink($base.'.map'); }
			if(file_exists(TEMPLATE_PATH.'settings/themes/theme.'.$theme.'.json')) { unlink(TEMPLATE_PATH.'settings/themes/theme.'.$theme.'.json'); }
			
			return 'The '.$theme.' and assets have been deleted';
			
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