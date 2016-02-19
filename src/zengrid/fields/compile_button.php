<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>

<p>
	<a href="#" id="compile-toolbar" class="compiler uk-button uk-button-primary loader <?php echo $class;?>">
		<span class="loading-spinner loading-spinner-large">
			<span></span>
		</span>
	
		<span class="button-title"><?php echo $label;?></span>
	</a>
</p>
<p>This action is performed each time compile is required and the save button is clicked in the top toolbar. If you wish to trigger this function manually click the button above.</p>
<br />