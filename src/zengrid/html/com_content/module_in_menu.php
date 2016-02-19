<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<span class="nav-header">
	<span class="<?php echo $item->params->get('zenmenu_icon');?> zen-menu-icon"></span>
	<?php echo $item->title; ?>
	<span class="mega-caption"><?php echo $item->params->get('zenmenu_subtitle');?></span>
</span>