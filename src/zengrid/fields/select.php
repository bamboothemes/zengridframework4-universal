<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>

<?php if($class !=="") {?>
<div class="<?php echo $class;?>">
<?php } ?>
<?php if(!$hide_label) { ?>
<p>
	<strong><?php echo $label;?></strong>
</p>
<?php } ?>
<?php if($description !=="") {?>
<p class="checkbox-info <?php echo $class;?>">
	<?php echo $description;?>
</p>
<?php } ?>
<select id="<?php echo $name;?>" data-compile="<?php echo $compile;?>" data-stored="<?php echo $value;?>" class="zen-select" value="<?php echo $value;?>">
          
	<?php foreach ($options as $key => $option) {
		
		
		if($options[$key]['value'] == $value) {
			echo  '<option selected value="'.$options[$key]['value'].'">'.$options[$key][0].'</option>';
		} else {
			echo  '<option value="'.$options[$key]['value'].'">'.$options[$key][0].'</option>';
		} 	
		
	} ?>
	
</select>
<p></p><p></p>
<?php if($class !=="") {?>
</div>
<?php } ?>