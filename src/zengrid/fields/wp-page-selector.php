<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>

	<select id="page-type-selector">
		<?php foreach ($configs as $page) { 
	
		$page = str_replace(array('config-','.json'), '', $page);
		if($page == $last_saved_state) { ?>
			<option selected value="<?php echo $page;?>"><?php echo $page;?></option>
		<?php } else { ?>
			<option value="<?php echo $page;?>"><?php echo $page;?></option>
	<?php } 
	
	}?>
	</select>

	<a href="#" class="uk-button-primary uk-button" id="save-config" style="float: right;">Save Settings</a>
	<a href="#" class="uk-button-primary uk-button" id="load-config">Load Settings</a>
	
	<select id="save-config-selector" style="float: right;">
	<?php foreach ($pages as $page) {
		$page = str_replace(array('config-','.json'), '', $page);
			if($page == $last_saved_state) { ?>
				<option selected value="<?php echo $page;?>"><?php echo $page;?></option>
			<?php } else { ?>
				<option value="<?php echo $page;?>"><?php echo $page;?></option>
		<?php } 
		}?>
	</select>