<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

$zgf = new zen();

// Template Id
$settings = $zgf->getsettings()->params;


?>

	<div class="bevel <?php echo $class;?>"></div>
	
	<div class="section-heading">
		<a name="<?php echo $name;?>"></a>
		<h2 id="<?php echo $name;?>" class="uk-article-title <?php echo $class;?>"><?php echo $label;?></h2></div>

	<?php if($description !=="" && isset($description)) { ?>
 		<p class="info"><?php echo $description;?></p>
	<?php } ?>
	
	<?php if($name =="Theme-options") {?>
		<?php if(isset($settings->load_template_css)) {
				if($settings->load_template_css) {?>
				<p id="template_css_warning" class="uk-alert uk-alert-warning">
					<strong>Load Template css enabled.</strong><br />
					Load Template css is enabled in your template settings.<br />
					The load template css option bypasses the theme options built into this template.<br /> Disable this option to be able to edit and create themes.</p>
		<?php } 
		}?>
		
		
		<?php if($name =="Theme-options") {?>
			<?php if(isset($settings->devmode)) {
				if($settings->devmode) {?>
				<p id="devmode_warning" class="uk-alert uk-alert-warning">
					<strong>Dev mode enabled</strong><br />
					Development mode is enabled in your theme settings. <br />The dev mode option bypasses the theme options built into this template.<br /> Disable this option to be able to edit and create themes.
				</p>
				<div class="clearfix"></div>
			<?php } 
			
			}?>
		<?php } ?>
	<?php } ?>