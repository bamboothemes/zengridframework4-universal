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
	
$row_styles = $zgf->get_files('less/styles/', '.less');
//$padding = $zgf->get_files('less/styles/padding', '.less');
//$margin = $zgf->get_files('less/styles/margin', '.less');

$padding = array('all-padding', 'small-padding', 'no-padding', 'vertical-padding', 'small-vertical-padding');
$margin = array('all-margin', 'small-margin', 'no-margin', 'vertical-margin', 'small-vertical-margin');
$widths = array('fullwidth', 'container');
?>


<p class="<?php echo $class;?>">
	<?php echo $label;?>
</p>


<select id="<?php echo $name;?>_width" data-compile="1" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
   
	<?php foreach ($widths as $key => $option) {
	
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			}
		} 	
	?>
</select>


<select id="<?php echo $name;?>" data-rowstyle="1" data-compile="<?php echo $compile;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
    <option data-state="inherit" value="">Inherit</option>
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




<select id="<?php echo $name;?>_padding" data-compile="1" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
   
	<?php foreach ($padding as $key => $option) {
	
			if($option == "") {
				$value = "inherit";
			}
			
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			}
		} 	
	?>
</select>


<select id="<?php echo $name;?>_margin" data-compile="1" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
   
	<?php foreach ($margin as $key => $option) {
	
			if($option == "") {
				$value = "inherit";
			}
			 
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			}
		} 	
	?>
</select>