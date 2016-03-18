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

$jinput = JFactory::getApplication()->input;
$admin = $jinput->get('admin');

if($admin) {
	// Define template name
	if (!defined('TEMPLATE')) {
		define( 'TEMPLATE', basename(dirname(dirname(dirname(__FILE__)))));
	}
	
	jimport('joomla.filesystem.path');
	jimport('joomla.filesystem.file');
	
	// Receive Data
	$jinput = JFactory::getApplication()->input;
	
	// Files from Assets.xml
	$style = $jinput->get('style', '', 'RAW');
	
	// Add path variable
	if (strpos($style,'settings-') !== false) {
	   $path = JPATH_SITE . '/templates/' . $this->template.'/settings/config/';
	   $style_file = $path .$style . '.json';
	} else {
		$path = JPATH_SITE . '/templates/' . $this->template.'/settings/config/sample/';
		$style_file = $path .$style . '.json';
	}
	
	$style_file = file_get_contents($style_file);
	print_r($style_file);
else {
	header("Location: ".JUri::base());
	die();
}