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