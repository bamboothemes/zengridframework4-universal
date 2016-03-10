<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// This file is used when the page laods for the first time
// No Direct Access
defined('ZEN_ALLOW') or die(); 

// Instantiate $zgf
$zgf = new zen();

// Get available layouts stored in this theme
$files = $zgf->files(TEMPLATE_PATH.'/settings/layouts/','');

// Read settings
$settings = $zgf->getsettings();

// Current layout
// Config of layout preset may be different to actual stored layout in the config
$current_layout = $settings->params->layout_preset;

?>
<h2>Stored Layout</h2>
<select id="layout_preset" style="float: left;margin-bottom: 30px;;">
	<?php 
		// Populate select list of available layotus	
		foreach ($files as $key => $layout)
		{
			$file = str_replace('.json', '', $layout);
			
			if($layout !=="index.html" && $layout !=="positions.json" && $layout !=="") {
			
				echo '<option value="'.$file.'"';
				if($file == $current_layout) {
					echo 'selected';
				}
				echo '>'.$file.'</option>';
			}
		} ?>
</select>