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
defined( '_JEXEC' ) or die( 'Restricted access' );

// Constant used to check for allow access in wordpress and J
define('ZEN_ALLOW', 1);

// Let the framework know we are in Joomla
// Define the framework we are in
define('WP', 0);
define('JOOMLA', 1);

// Set the Theme Name
if (!defined('TEMPLATE')) {
	define( 'TEMPLATE', basename(dirname(dirname(dirname(__FILE__)))));
}

// SET the site root
define( 'ROOT_PATH', JPATH_ROOT);
	
// Set the theme path
define( 'TEMPLATE_PATH', JPATH_ROOT.'/templates/'.TEMPLATE.'/');
define( 'TEMPLATE_PATH_RELATIVE', 'templates/'.TEMPLATE.'/');
define('FRAMEWORK_PATH', JPATH_SITE.'/templates/'.TEMPLATE.'/zengrid');
define('SITE_URL', JURI::BASE());
define('ADMIN_MEDIA_URI', JURI::BASE().'../templates/'.TEMPLATE.'/zengrid/admin/');