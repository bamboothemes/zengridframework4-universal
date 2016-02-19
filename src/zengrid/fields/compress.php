<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

include_once FRAMEWORK_PATH . '/helpers/helper.php'; 
$zgf = new zen();

$assets = 'settings/assets.xml';
$assets = $zgf->get_xml($assets);
$assets = $assets->js->file;
	
$files = '';
	
foreach ($assets as $key => $file) {
	$files .= $file;
	$files .= ',';	
} ?>
<p id="files_for_compressor" class="hidden"><?php echo $files;?></p>
<p>
	<a href="#" class="compresser uk-button-primary uk-button loader" id="compresser">
		<span class="loading-spinner loading-spinner-large">
			<span></span>
		</span>
		
		<span class="button-title">Compress Scripts</span>
	</a>
</p>
<p></p>
<p>Click the compress scripts button above to add any scripts you have added in the area above.</p>
