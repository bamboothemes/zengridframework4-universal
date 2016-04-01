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
<select id="layout_preset" data-compile="config" style="float: left;width: 60%;margin-right: 10px;margin-bottom: 30px;">
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

<a href="#none" class="uk-button-primary uk-button" id="apply-layout">Load Layout</a>
<div class="clearfix"></div>
<h3>Save layout settings</h3>
<p>
<input class="uk-form uk-form-large exclude advanced" id="layout-name" value="New Layout">
<a href="#" class="uk-button-primary uk-button exclude advanced" id="save-layout">Save Layout</a>
</p>