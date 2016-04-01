<?php
/**
 * @package     Zen Grid Framework v5, 5.0
 * @subpackage  Updated: March 10 2016
 * @author      Joomlabamboo http://www.joomlabamboo.com
 * @copyright   Copyright (C) Joomlabamboo, March 10 2016
 * @license     http://www.gnu.org/licenses/gpl.html GNU General Public License version 2 or later;
 * @version     1.4.1
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