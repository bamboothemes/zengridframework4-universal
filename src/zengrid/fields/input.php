<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

?>



<label class="<?php echo $class;?>">
	<?php echo $label;?>
</label>

<input class="<?php echo $class;?> uk-form uk-form-large uk-form-width-large" id="<?php echo $name;?>" data-compile="<?php echo $compile;?>" data-stored="<?php echo $value;?>" value="<?php echo $value;?>"/>
