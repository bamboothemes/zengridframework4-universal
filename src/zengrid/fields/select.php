<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>


<p class="uk-article-lead <?php echo $class;?>">
	<?php echo $label;?>
</p>
<p class="checkbox-info <?php echo $class;?>">
	<?php echo $description;?>
</p>

<select id="<?php echo $name;?>" data-compile="<?php echo $compile;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
          
	<?php foreach ($options as $key => $option) {
		
		if($options[$key]['value'] == $value) {
			echo  '<option selected value="'.$options[$key]['value'].'">'.$options[$key][0].'</option>';
		} else {
			echo  '<option value="'.$options[$key]['value'].'">'.$options[$key][0].'</option>';
		} 	
		
	} ?>
	
</select>
<p></p><p></p>