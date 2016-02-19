<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

$animations = zen::get_files('zengrid/libs/zengrid/less/animate', '.less'); 


?>


<p class="<?php echo $class;?>">
	<?php echo $label;?>
</p>

<select id="<?php echo $name;?>" data-animate="1" data-compile="<?php echo $compile;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
          
	<?php foreach ($animations as $key => $option) {
	
			$option = str_replace('.less', '', $option);
			
			if($option !=="animate-library" && $option !=="animate") {
			
				if($option == $value) {
					echo  '<option selected value="'.$option.'">'.$option.'</option>';
				} else {
					echo  '<option value="'.$option.'">'.$option.'</option>';
				}
			}
			
		
		} 	
		
	?>
	
</select>