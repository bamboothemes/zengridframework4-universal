<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

//include_once FRAMEWORK_PATH . '/helpers/helper.php'; 
//$zgf = new zen();

$configs = zen::get_files('settings/config/', '.json');

?>

<select id="delete-configs-selector">
<?php foreach ($configs as $page) { 

	$page = str_replace(array('config-','.json'), '', $page);
?>
		<option value="<?php echo $page;?>"><?php echo $page;?></option>
<?php } ?>
</select>

<a href="#" class="uk-button uk-button-primary uk-button-danger" id="delete-config">Load Settings</a>
