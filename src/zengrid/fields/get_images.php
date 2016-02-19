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
$images = $zgf->get_files($folder, $target);?>

<p class="<?php echo $class;?>">
	<?php echo $label;?>
</p>

<select id="<?php echo $name;?>" data-compile="<?php echo $compile;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
    <option value="inherit">Inherit</option>
	<?php foreach ($images as $key => $option) {
	
			$option = str_replace($target, '', $option);
			
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			}
		} 	
	?>
</select>