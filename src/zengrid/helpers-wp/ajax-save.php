<?php
/**
 * @package		Zen Grid Framework v5, 5.0
 * @subpackage	Updated: March 10 2016
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) Joomlabamboo, March 10 2016
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License version 2 or later;
 * @version		1.4.1
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