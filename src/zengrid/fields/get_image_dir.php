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
$images = $zgf->get_image_dir_files();

$value = str_replace('\"..\/..\/..\/', '', $value);
$value = str_replace('"', '', $value);

?>

<p class="<?php echo $class;?>">
	<strong><?php echo $label;?></strong>
</p>

<select id="<?php echo $name;?>" data-compile="<?php echo $compile;?>" class="image-name zen-select <?php echo $class;?>" value="<?php echo $value;?>">
    <option value="inherit">Inherit</option>
	<?php foreach ($images as $key => $option) {
			
			
			//$option = str_replace($target, '', $option);
			$option = str_replace(ROOT_PATH, '', $option);
			
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			}
		} 	
	?>
</select>