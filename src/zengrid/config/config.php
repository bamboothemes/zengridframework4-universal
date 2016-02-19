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
defined('ZEN_ALLOW') or die('Restricted access');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		ZGF4
 * @subpackage	Form
 * @since		1.6
 */

		// Instantiate $zgf
		include_once FRAMEWORK_PATH . '/helpers/helper.php'; 
		$zgf = new zen();
		
		$zgfversion = $zgf->get_xml('zengrid/zen.xml');
		$admin_assets = $zgf->get_xml('zengrid/assets.xml');
		
		// I know we should enqueue this but doing that causes a FOUC
		
		echo "<link rel='stylesheet' href='".get_template_directory_uri()."/zengrid/admin/css/style.css' type='text/css' media='all' />";
		echo "<link rel='stylesheet' href='".get_template_directory_uri()."/zengrid/admin/css/style-wp.css' type='text/css' media='all' />";
		echo "<link rel='stylesheet' href='".get_template_directory_uri()."/zengrid/admin/css/colpick.css' type='text/css' media='all' />";
		echo "<link rel='stylesheet' href='".get_template_directory_uri()."/zengrid/admin/css/font-awesome.min.css' type='text/css' media='all' />";
		
		
		foreach ($admin_assets as $type => $group) {
			foreach ($group as $file) {
				if($type =="js") {
					 wp_enqueue_script(basename($file), get_template_directory_uri()  . '/zengrid/admin/js/'.$file, array('jquery'),$zgfversion->version);
				}
			}
		}
		
		// Config XML
		$config = $zgf->get_xml('settings/settings.xml');
		$templateDetails = $zgf->get_xml('templateDetails.xml');
		$pages = $templateDetails->pages->page;
		$settings = $zgf->getsettings();  
		$configs = zen::get_files('settings/config/', '.json');
		
		?>
		<div id="zgf">
			<a id="top-page" name="top-page"></a>
			<div id="zgfmessage" class="message-box">
				<div class="config" style="display: none;">Settings for <span></span> configuration have been updated.</div>
				<div class="layouts" style="display: none;">The <span></span> layout has been saved.</div>
				<div class="themes" style="display: none;">The <span></span> theme has been saved.</div>
				<div class="compile" style="display: none;">Updating css for the <span></span> theme.</div>
				<div class="delete-theme" style="display: none;">The <span></span> theme and it's assets have been deleted.</div>
				<div class="compress" style="display: none;">Javascript for the <span></span> configuration have been compressed.</div>
				<div class="settings" style="display: none;">Loading stored settings from <span></span> configuration.</div>
			</div>
			
			<div id="template-toolbar" data-theme="<?php echo TEMPLATE;?>">
				<h3 class="inline-heading"><?php echo $templateDetails->name;?> Template</h3>		
				
				<select id="page-type-selector">
				<?php foreach ($configs as $page) { 
				
					$page = str_replace(array('config-','.json'), '', $page);
				?>
						<option value="<?php echo $page;?>"><?php echo $page;?></option>
				<?php } ?>
				</select>
				<a href="#" class="uk-button-primary uk-button" id="load-config">Load Settings</a>
				
				<a href="#" class="uk-button-primary uk-button" id="save-config" style="float: right;">Save Settings</a>
				<select id="save-configs" style="float: right;">
				<?php foreach ($pages as $page) { ?>
						<option value="<?php echo $page;?>"><?php echo $page;?></option>
				<?php } ?>
				</select>
			</div>
			
			
			<div id="framework-options" class="basic">
				<div class="uk-grid">
				    <div id="zen-sidebar" class="uk-width-medium-1-5">
					 <ul class="uk-nav" data-uk-tab="{connect:'#theme-settings'}">
			
			        		<?php // Sidebar Nav
			
			        			  foreach($config as $items) { 
			        			  
			        			  	$safename = strtolower(str_replace(' ', '-', $items['name']));?>
			        			  	
			        			  	<li id="<?php echo $safename; ?>" data-id="<?php echo $safename; ?>">
			
			        					<a name="<?php echo $safename; ?>" href="#<?php echo $safename; ?>"><span class="<?php echo $items['icon'];?>"></span><?php echo $items['name']; ?></a>
			
			        				</li>
			
			        		<?php }	?>
						</ul>
				    </div>
					<div class="uk-width-medium-5-5">
				   	<ul id="theme-settings" class="uk-switcher">
				        <?php 	// Options container			
				        	
				        	foreach($config->children() as $fields) { 
				        		$safename = strtolower(str_replace(' ', '-', $fields['name'])); ?>
				        	
				        	<li id="<?php echo $safename; ?>">	
				        		<ul>	
				        			<?php foreach ($fields as $key => $field) { 
				        				
			        					$advanced = (string)$field['advanced']; ?>
			        				
			        					<li data-display="<?php echo $field['display'];?>" data-name="<?php echo $field['name'];?>" <?php if($advanced) { ?>class="advanced"<?php } ?>>	
	        								<?php $type = (string)$field['type'];
	        									$description = $field['description'];
	        									$label = $field['label'];
	        									$name = $field['name'];
	        									$class = $field['class'];
	        									$tag = $field['tag'];
	        									$compile = $field['compile'];
	        									$target = $field['target'];
	        									$folder = $field['folder'];
	        									$show_empty = $field['show_empty'];
	        									
	        									if(isset($settings->params->{$name})) {
	        										if($settings->params->{$name} !=="") {
	        											$value = $settings->params->{$name};
	        										}
	        										else {
	        											$value = $field['default'];
	        										}
	        									} else {
	        										$value = $field['default'];
	        									}
	        									
	        									$options = array();
	        							
	        									foreach ($field->children() as $child) {
	        										$options[] = $child;
	        									}
	        								
	        									// Determine the field typr and render the appropriate field
	        									echo $zgf->render($type,$description,$label,$options, $name,$class, $value, $tag, $compile,$target, $folder,$show_empty); ?>
			        					</li>	
				        			<?php } ?>
				        		</ul>
				        	</li>
				        <?php } ?>
				        </ul>
				     
				    </div>
				</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function ($) {
			
				// Get functions get current state
				// Load functions load from previously saved state
				// Save functions save state - uses get functions to get the data to save
				
				var template = $('#template-toolbar').attr('data-theme');
				var page_type = $('#page-type-selector').val();
				var url = 'admin-ajax.php';
				var time = '<?php echo date('Y-m-d-H-i-s');?>';
				
				// On page load set the current theme
				$('#cssfiles,#style-name').val('<?php echo $settings->params->theme;?>');
				
				
				$('#load-config').click(function() {
					var page_type = $('#page-type-selector').val(); 				
					$(document).set_config(template, time,'<?php echo TEMPLATE_PATH_RELATIVE;?>', page_type);
					$('#save-configs option[value="' + page_type + '"]').attr('selected', 'selected');
				});
				
				
				$('#save-config').click(function() {
					var data = $(document).get_config();
					var page_type = $('#save-configs').val();  
					//console.log(data);
					$(document).send_ajax(template, url, data, 'save', page_type, 'config', 'config');
				});
				
				$('#save-theme').click(function() {
					// Get the data
					var data = $(document).get_theme();
					
					// Get the theme name
					var name = $('#style-name').val();
					
					// Add theme name to the data
					data.theme = name;
					
					$(document).send_ajax(template, url, data, 'save', '', 'themes', 'theme.' +name);
					
				});
				
				// Save Layout
				$('#save-layout').click(function() {
					var data = $(document).get_layout();
					var name = $('#layout-name').val();
					$(document).send_ajax(template, url, data, 'save','', 'layouts', name);
				});
				
				
				// Load layout
				$('#load-layout').click(function() {
					$(document).set_layout_data(template);
				});
				
				// Delete Theme
				$('#delete-theme').click(function() {
					$(document).delete_theme();
				});
				
				
				// Delete Config
				$('#delete-config').click(function() {
					$(document).delete_config();
				});
				
				
				
				// Compress JS
				$('#compresser').click(function() {
					var data = $(document).get_compress();
					console.log(data);
					var page_type = $('#page-type-selector').val();  
					//console.log(data);
					$(document).send_ajax(template, url, data, 'compress', page_type, 'compress', page_type);
				});
				
			});	
		</script>