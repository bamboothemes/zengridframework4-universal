<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Module
$display_module = $item->params->get('zenmenu_display_module');

if(isset($display_module[0])) {
	$display_module = $display_module[0];
}
// Menu icon
$icon = $item->params->get('zenmenu_icon');

if(isset($icon) && $icon !=="-1") {
	$icon = '<span class="fa fa-'. $item->params->get('zenmenu_icon').' zen-icon-'. $item->params->get('zenmenu_icon').' zen-icon"></span>';
} else {
	$icon = "";
}


// Subtitle
$subtitle = $item->params->get('zenmenu_subtitle');

if(isset($subtitle)) {
	$subtitle = '<span class="zen-menu-caption">'.$item->params->get('zenmenu_subtitle').'</span>';
} else {
	$subtitle = "";
}

if($item->params->get('zenmenu_item_title', '1')) {
?><span class="zen-menu-heading"><?php echo $icon; ?><?php echo $item->title; ?><?php echo $subtitle; ?></span>
<?php } 
if( isset($display_module[0])) { ?><div class="zen-menu-module"><?php echo zen4::module($display_module);?></div><?php } ?>