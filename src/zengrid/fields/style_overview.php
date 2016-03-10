<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

// List CSS Files
$cssfiles = zen::get_files('settings/themes/', '.json');
$presets = zen::get_files('settings/themes/presets/', '.json');
$available_css ='';


foreach ($presets as $key => $css)
{
	$css = str_replace('.json', '', $css);
	$css = str_replace('theme.', '', $css);
	
	if($css !=="index.html") {
		if($css !=="custom_rename_to_custom") {
			if($css !=="offline") {
				$available_css .= '<option value="presets/theme.'.$css.'">'.$css.'</option>';
			}
		}
	}
}


foreach ($cssfiles as $key => $css)
{
	$css = str_replace('.json', '', $css);
	$css = str_replace('theme.', '', $css);
	
	if($css !=="index.html") {
		if($css !=="custom_rename_to_custom") {
			if($css !=="offline") {
				$available_css .= '<option value="'.$css.'">'.$css.'</option>';
			}
		}
	}
} ?>	

<select id="cssfile" class="exclude">
			<?php echo $available_css;?>
</select>




<input class="uk-form uk-form-large exclude" id="style-name" value="New-Style">
	<a href="#" id="save-theme" class="compiler uk-button uk-button-primary loader">
		<span class="loading-spinner loading-spinner-large">
			<span></span>
		</span>
		<span class="button-title">Save Theme</span>
	</a>
<a href="#" id="delete-theme" class="uk-button uk-button-danger loader uk-align-right uk-button-mini">
	<span class="loading-spinner loading-spinner-large">
		<span></span>
	</span>
	<span class="button-title">Delete Theme</span>
</a>