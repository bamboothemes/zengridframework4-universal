<?php
/**
 * @package		Zen Grid Framework v5, 5.0
 * @subpackage	Updated: March 10 2016
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) Joomlabamboo, March 10 2016
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License version 2 or later;
 * @version		1.4.1
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// See if plugins are enabled
$plugin = JPluginHelper::getPlugin('ajax', 'zengridframework');
			
if(!$zgf->com_ajax()) { ?>
	
	<p></p>
	<br />
	<p class="alert alert-danger"><strong>Joomla's Ajax component is not installed.</strong><br /> This template uses functionality provided by the core Joomla component Ajax Interface. However, it appears that the Ajax interface is not installed. Please ensure you are using the  latest version of Joomla and then try to <a href="index.php?option=com_installer&view=discover">discover</a> it in the Joomla extension manager.<br /><br />For more information on using the discover tool see <a href="http://www.joomlabamboo.com/blog/how-to-joomla/how-to-use-the-discover-tool-in-joomla-3">this blog post</a>.</p>
<?php }

if(empty($plugin)) { ?>
	
	<p></p>
	<p class="alert alert-danger"><strong>The Zen Grid Framework Ajax plugin is not published.</strong><br /> This plugin is required for some of the functionality of this module. <br /><a href="http://www.joomlabamboo.com/download-document/717-zen-grid-framework-ajax-plugin">Download the Zen Grid Framework Ajax plugin</a>.<br />Visit the <a href="index.php?option=com_plugins&view=plugins&filter.search=zengridframework">plugin manager</a> to publish this plugin now.</p>
	<p></p><br />
<?php }  