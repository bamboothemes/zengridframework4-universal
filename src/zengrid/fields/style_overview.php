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
<br />
<br />
<div class="compile-included">
	<p>Select a theme</p>
	<div id="cssfiles-wrap">
		<p class="<?php echo $class;?>"><strong><?php echo $label;?></strong></p>
		<select id="cssfile" class="exclude">
			<?php echo $available_css;?>
		</select>
	</div>
</div>
<br />
<br />
<?php $admintools = ROOT_PATH.'/components/com_admintools/views/blocks/tmpl/default.php';
if(file_exists($admintools)) { ?>
	<p class="uk-alert uk-alert-warning">
		<strong>Admintools Pro Installed</strong><br />
		Please review the warning on the overview panel in your template settings.</p>
<?php } ?>