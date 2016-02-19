<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); ?>


<div class="save-style-wrap create_new compile-included">
	<input class="uk-form uk-form-large exclude" id="style-name" value="New-Style">
	<a href="#" id="save-theme" class="compiler uk-button uk-button-primary loader">
		<span class="loading-spinner loading-spinner-large">
			<span></span>
		</span>
		<span class="button-title"><?php echo $label;?></span>
	</a>
	<a href="#" id="delete-theme" class="uk-button uk-button-danger loader">
		<span class="loading-spinner loading-spinner-large">
			<span></span>
		</span>
		<span class="button-title">Delete Theme</span>
	</a>
</div>