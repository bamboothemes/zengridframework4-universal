<?php
/**
 * @package		##package##
 * @subpackage	##subpackage##
 * @author		##author##
 * @copyright 	##copyright##
 * @license		##license##
 * @version		##version##
 */
 
defined( 'ZEN_ALLOW' ) or die( 'Restricted access' );


print_r($_POST);
$extrafiles = $_POST['content']['files'];
$settings = $_POST['content']['settings'];
$extrafiles = array_filter($extrafiles);

$template = $_POST['template'];
$page_type = $_POST['id'];
$animations = $settings['animations'];


// Import Compile Library
require_once FRAMEWORK_PATH. '/libs/jshrink/minifier.php';

// Import Zen
// Instantiate $zgf
include_once FRAMEWORK_PATH . '/zen.php'; 
$zen = new zen4();

// Create a single array combining the extra files
// And the assets.xml
// We added the extra files first so then users can add
// Any relevant scripts to the js.script.js file that gets loaded afterwards

$files = array();

foreach ($extrafiles as $key => $file) {
	$files[] = $file;
}

$assets = (array)$zen->getassets('../');

foreach ($assets as $key => $asset) {
	$files[] = $asset;
}

// Animations
if($animations) {
	$files[] = '../zengrid/libs/zengrid/js/wow.min.js';
}


$path = TEMPLATE_PATH.'/js/';

$buffer = "";

foreach ($files as $key => $file) {
	if($file !=="") {
		$buffer .= file_get_contents($path . $file) . "\n";	
	}
}


// Minify all the scripts
$minifiedCode = \JShrink\Minifier::minify($buffer, array('flaggedComments' => false));

// Write the js file
file_put_contents(TEMPLATE_PATH . 'js/template-'.$page_type.'.js', $minifiedCode);


// Create gzipped version
$gzip = '<?php ob_start ("ob_gzhandler");
    header("Content-type: application/js; charset: UTF-8");
    header("Cache-Control: must-revalidate");
    $offset = 60 * 60 ;
    $ExpStr = "Expires: " .
    gmdate("D, d M Y H:i:s",
    time() + $offset) . " GMT";
    header($ExpStr);?>';

$gzip .= $minifiedCode;

// Write the compressed file
file_put_contents(TEMPLATE_PATH . 'js/template-'.$page_type.'.php', $gzip);