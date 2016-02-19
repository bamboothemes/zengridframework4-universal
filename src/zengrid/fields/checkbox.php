<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>

<label class="zen-checkbox <?php echo$class;?>">
	<input class="<?php echo$class;?>" data-compile="<?php echo $compile;?>" id="<?php echo$name;?>" type="checkbox" value="<?php echo$value;?>"
	<?php if($value == '1') { echo 'checked';}?>>
	<?php echo $label; ?>
</label>

<?php if($description !=="" && isset($description)) { ?>
	<p class="checkbox-info <?php echo$class;?>"><?php echo$description;?></p>
<?php } ?>