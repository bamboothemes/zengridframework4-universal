<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 


$zgf = new zen();
$folders = $zgf->expandDirectories(ROOT_PATH.'/images');

$foldernames = array();

foreach ($folders as $key => $folder) {
	$search = array(ROOT_PATH, '\\');
	$replace = array('', '/');
	$foldernames[] = str_replace($search, $replace, $folder);
}

?>


<p class="uk-article-lead <?php echo $class;?>">
	<?php echo $label;?>
</p>
<p class="checkbox-info <?php echo $class;?>">
	<?php echo $description;?>
</p>

<select id="<?php echo $name;?>" data-compile="<?php echo $compile;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
<option value="none">None</option>
          
	<?php foreach ($foldernames as $key => $option) {

		if($option == $value) {
			echo  '<option selected value="'.$option.'">'.$option.'</option>';
		} else {
			echo  '<option value="'.$option.'">'.$option.'</option>';
		} 	
		
	} ?>
	
</select>
<p></p><p></p>