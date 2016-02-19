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

// Config XML
$config = $zgf->get_xml('settings/settings.xml');

// Get Params
$settings = $zgf->getsettings()->params;

// Check for admintools pro
$admintools = ROOT_PATH.'/components/com_admintools/views/blocks/tmpl/default.php';

// Template name
if (!defined('TEMPLATE')) {
	define( 'TEMPLATE', basename(dirname(dirname(dirname(__FILE__)))));
}

if(file_exists($admintools)) { ?>
	<p class="uk-alert uk-alert-warning">
		<strong>Admintools Pro Installed</strong><br />
		It looks like you have Admintools installed. Admintools has a feature which blocks access to php files using the <strong>template=mytemplate</strong> functionality. Enabling this option will prevent the template from being able to compile less to css or save changes. <br /><br />We advise disabling this function in the template during development. Once you have finished developing your site it is safe to re-enable this functionality.<br /><br/>However if you need to use the Admintool security functionality during development you can add an exception for your template in the following areas:<br/><br />
			1. Enter your template folder in the htaccess maker options under the "Allow direct access, including .php files, to these directories" option. The path required for this option will be:<br/><br/>
		templates/<?php echo TEMPLATE;?>/
		<br/><br />
		2. Allow access to the template=<?php echo TEMPLATE;?> parameter in the Web Application fire Wall settings. <br /><br />
		a. To access these settings navigate to Admintools in your Joomla admin via components > admintools. <br />
		b. Click on the Web Application Firewall options.<br />
		c. Click on the Configure WAF button.<br/>
		d. Navigate to the Visual fingerprinting protection tab.<br />
		e. Set the Block tmpl=foo system template switch to no.<br/>
		f. Set the Block template=foo site template switch to no.
		<br />
		<br />
		For more information please review the <a href="http://docs.joomlabamboo.com/zen-grid-framework-4/overview/Using-ZGFv4-themes-with-Admintools-pro.html">Zen Grid Framework v4 documentation</a>.
		</p>
<?php }
?>

<?php if(isset($settings->compile_required)) {
	if($settings->compile_required) {?>
		<p class="uk-alert uk-alert-warning">
			<strong>Compile less to css required - Theme panel</strong><br />
			Before you saved your theme settings you made some changes that will not display on the front end of your site unless you compile less to css. Click the compile less button in the toolbar to save your changes to the theme's css files.
		</p>
<?php } 
} ?>


<?php if(isset($settings->devmode)) {
		 	if($settings->devmode) {?>
		<p class="uk-alert uk-alert-warning">
			<strong>Dev mode enabled - Settings panel</strong><br />
			Development mode is enabled in your theme settings. When development mode is enabled the browser loads .less files directly in the browser. When this occurs the styling for the template is derived solely from the template less files and none of the settings in the template administrator apply to the display of the template.
		</p>
<?php } 

}
?>


<?php if(isset($settings->font_awesome_type)) {
	if($settings->font_awesome_type =="min") {?>
		<p class="uk-alert uk-alert-warning">
			<strong>Font Awesome library setting set to minimum - Theme panel</strong><br />
			This is just a notice to let you know that the Font Awesome type is set to include less than the full Font Awesome library. If you are not using any of the Zen Shortcode icons and just using the built in theme functionality there will not be any issues.
			<br />
			<br />
			Icons included in the minimum set are:<br/>
			<br />
			search, 
			envelope-o, 
			heart, 
			star,  
			user,  
			th-large,  
			th,  
			th-list,  
			remove,
			close,
			times,  
			cog,  
			home,  
			lock,  
			tag,  
			tags,  
			print,  
			camera,  
			edit,
			chevron-left,  
			chevron-right,  
			plus,  
			minus,  
			eye,  
			eye-slash,  
			chevron-up,  
			chevron-down,  
			bars  bars,  
			arrow-up,  
			tags,  
			print,
			mail,
			plus,
			minus</p>
		</p>
<?php } 
}?>



<?php if(isset($settings->mobile_detect)) {
	
	if($settings->mobile_detect) {
		
		jimport( 'joomla.plugin.helper' );
				
		if(JPluginHelper::isEnabled('system', 'cache')) { ?>
		<p class="uk-alert uk-alert-warning">
			<strong>Mobile Detect and system cache enabled - Settings panel</strong><br />
			This option is not compatible with the Joomla System - Cache plugin which saves copies of pages to be reused for different visitors on different devices. The Mobile detect library is not able to use cached pages to determine the users device.
		</p>
	<?php } 
	
	}
}?>


<?php if(isset($settings->font_awesome_type)) {
	
	 if(!$settings->font_awesome_type) {?>
	<p class="uk-alert uk-alert-warning">
		<strong>Font Awesome library setting to none - Theme panel</strong><br />
		This is just a notice to let you know that the Font Awesome library is disabled in your theme template settings. The template requires this icon library for some parts of its styling. Functionality that require icons include the hidden panel, social icons and accordion. If you require this functionality in your theme set this option to at least minimum or include the icon library via another method.
	</p>
<?php } 

}?>


<?php if(isset($settings->load_template_css)) {
	if($settings->load_template_css) {?>
		<p class="uk-alert uk-alert-warning">
			<strong>Load Template css enabled - Settings panel</strong><br />
			While this setting is enabled the theme options will not take any effect. This setting loads the css/template.css file instead of the css file specified in the Theme tab. This setting is useful for developers who want to work with an external compiler to compile the less/template.less file directly.</p>
	<?php } 
	
	}
?>


<?php if(isset($settings->enable_cdn)) {
	 if($settings->enable_cdn) {?>
		<p class="uk-alert uk-alert-warning">
			<strong>CDN urls enabled - Settings panel</strong><br />
			The CDN option of the template is currently enabled which means that the theme will look for it's asset files at the url specified in the cdn url setting. In order for this option to work correctly you must ensure that the assets required by the template have been uploaded to the url specified in the cdn url setting. For help using this option please consult the Zen Grid Framework documentation.
		</p>
	<?php }
} ?>

<?php if(isset($settings->hidefrontpage)) {
		 if($settings->hidefrontpage) {?>
		<p class="uk-alert uk-alert-warning">
			<strong>The main content is hidden on the front page - Layout panel</strong><br />
			This setting hides all content assigned to the main content, sidebar1, sidebar2, abovecontent and belowcontent positions on the home page of your website. In some cases this option will hide content on other pages if that content item or component does not have a menu item specified for it. It may appear that you are viewing the front page of your website however it is more likely that you are viewing the settings for your front page. Please read <a target="_blank" href="http://www.joomlabamboo.com/blog/how-to-joomla/implementing-a-fix-for-menu-item-ids-in-joomla">this blog post</a> for further information on how to solve this issue.
		</p>
	<?php } 
	
	}?>

<?php if(isset($settings->onepage)) {
		 if($settings->onepage) {?>
	<p class="uk-alert uk-alert-warning">
		<strong>One Page mode is enabled - Menu panel</strong><br />
		When the one page option is enabled the main menu is transformed into a static menu that refers the user to links on the current page. None of the standard Joomla menu settings will apply here and the names of the menu items can be added under the menus > one page template settings.
	</p>
<?php } }?>



<p></p><p></p>
<div class="bevel"></div>
<div class="clearfix"></div>
<br />
<br />
<h3>Settings with empty values</h3>
<p>The following settings have empty values which may or may not impact the running of your template.<br /> Check the items below to see if you need to set values for these settings.</p>
<p class="uk-alert uk-alert-warning">
<?php foreach ($settings as $key => $setting) {
	if($setting =="") {
		echo '<strong>'.$key.'</strong>';
		echo $setting;
		echo '<br />';
	}
}
?>
</p>
	