<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

// Module
$display_module = $item->params->get('zenmenu_display_module');

if(isset($display_module[0])) {
	$display_module = $display_module[0];
}


if ($item->menu_image)
	{
		$item->params->get('menu_text', 1) ?
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = $item->title;
}

$flink = $item->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

// Menu icon
$icon = $item->params->get('zenmenu_icon');

if(isset($icon) && $icon !=="-1") {
	$icon = '<span class="fa fa-'. $item->params->get('zenmenu_icon').' zen-icon zen-icon-'. $item->params->get('zenmenu_icon').'"></span>';
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


switch ($item->browserNav) :
	default:
	case 0:
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" <?php echo $title; ?>><?php echo $icon; ?><?php echo $linktype; ?><?php echo $subtitle; ?></a><?php if( isset($display_module)) {?><div class="zen-menu-module"><?php echo zen4::module($display_module[0]);?></div>
<?php } 
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $icon; ?><?php echo $linktype; ?><?php echo $subtitle; ?></a><?php if( isset($display_module)) {?>
<div class="zen-menu-module">
	<?php echo zen4::module($display_module[0]);?>
</div>
<?php }
		break;
	case 2:
		// window.open
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $class; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $title; ?>><?php 
			echo $icon; 
			echo $linktype; 
			echo $subtitle; 
		?></a>
			<?php if( isset($display_module[0])) {?><div class="zen-menu-module"><?php echo zen4::module($display_module);?></div>
			<?php } 
		break;
endswitch;
