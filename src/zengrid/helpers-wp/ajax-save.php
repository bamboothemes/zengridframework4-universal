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

$template = $_POST['template'];


// id uses the template id or page type to append to the config.
// Other types just ahve this nulled.
$id = $_POST['id'];

if($id=="") {
	$id = "";
} else {
	$id = "-".$id;
}


$target = $_POST['target'];
$name = $_POST['name'];

// Process content
$content = $_POST['content'];
$content = json_encode($content, JSON_PRETTY_PRINT);


// Put the config files
file_put_contents('../wp-content/themes/'.$template.'/settings/'.$target.'/'.$name.$id.'.json', $content);

// Store the last saved state
if($target =="config") {	
	$id= str_replace('-', '', $id);
	$content = '{"lastsaved": "'.$id.'"}';
	file_put_contents('../wp-content/themes/'.$template.'/settings/settings.json', $content);
}