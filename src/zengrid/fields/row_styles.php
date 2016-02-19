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
	
$row_styles = $zgf->get_files('less/styles/', '.less');?>


<p class="<?php echo $class;?>">
	<?php echo $label;?>
</p>

<select id="<?php echo $name;?>" data-rowstyle="1" data-compile="<?php echo $compile;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
    <option value="">Inherit</option>
	<?php foreach ($row_styles as $key => $option) {
	
			$option = str_replace('.less', '', $option);
			
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			}
		} 	
	?>
</select>