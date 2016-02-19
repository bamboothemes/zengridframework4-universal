<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

// Define template name
if (!defined('TEMPLATE')) {
	define( 'TEMPLATE', basename(dirname(dirname(dirname(__FILE__)))));
}

// Include Zen Class
if (!defined('TEMPLATE_PATH')) {
	define( 'TEMPLATE_PATH', ROOT_PATH.'/templates/'.TEMPLATE.'/');
}

if(file_exists(TEMPLATE_PATH . 'custom/template_info.php')) {
	include(TEMPLATE_PATH . 'custom/template_info.php');
} else {
	include(TEMPLATE_PATH . 'template_info.php');
}