<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// Check to ensure this file is within the rest of the framework
defined('ZEN_ALLOW') or die();


// A covering class to cover some instances of Joomla functions that may be 
// Dropped into updates for current Joomla themes
// New themes wont need this file.

if(!class_exists('JURI')) { 
	class JURI {
		public static function current($type = false) {	
			return get_permalink(); 
		}
		
		public static function base() {
			return get_site_url(); 
		}
	}
}