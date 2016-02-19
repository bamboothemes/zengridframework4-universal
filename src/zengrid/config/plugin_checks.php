<?php
/**
 * @package		##package##
 * @subpackage	##subpackage##
 * @author		##author##
 * @copyright 	##copyright##
 * @license		##license##
 * @version		##version##
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
	<p class="alert alert-danger"><strong>Zentools2 Ajax plugin is not published.</strong><br /> This plugin is required for some of the functionality of this module. <br />Visit the <a href="index.php?option=com_plugins&view=plugins&filter.search=zengridframework">plugin manager</a> to publish this plugin now.</p>
	<p></p><br />
<?php }  