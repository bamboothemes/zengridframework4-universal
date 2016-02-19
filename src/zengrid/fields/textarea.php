<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>

<?php if($label !=="") { ?>
	<label><strong><?php echo $label;?></strong></label>
<?php } ?>

<?php if ($description !=="") { ?>
<p class="textarea-info"><?php echo $description;?></p>
<?php } ?>
<textarea data-compile="<?php echo $compile;?>" class="uk-form uk-form-large <?php echo $class;?>" id="<?php echo $name;?>"><?php echo $value;?></textarea>