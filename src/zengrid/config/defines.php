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