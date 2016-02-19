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
		
		// Get the zgf version
		$zgfversion = $zgf->get_xml('zengrid/zen.xml');
		
		// list of assets to load
		$admin_assets = $zgf->get_xml('zengrid/assets.xml');
		
		if(JOOMLA) {
			// Get the document object
			$document = JFactory::getDocument();
			
			// Checks to see if com_ajax is installed and zgf ajax plugin is published
			include_once(FRAMEWORK_PATH . '/config/plugin_checks.php');
		}
		
		// I know we should enqueue this but doing that causes a FOUC
		echo "<link rel='stylesheet' href='".ADMIN_MEDIA_URI."/css/style.css' type='text/css' media='all' />";
		
		if(WP) {
			echo "<link rel='stylesheet' href='".ADMIN_MEDIA_URI."/css/style-wp.css' type='text/css' media='all' />";
		}
		
		echo "<link rel='stylesheet' href='".ADMIN_MEDIA_URI."/css/colpick.css' type='text/css' media='all' />";
		echo "<link rel='stylesheet' href='".ADMIN_MEDIA_URI."/css/font-awesome.min.css' type='text/css' media='all' />";
		
		
		foreach ($admin_assets as $type => $group) {
			foreach ($group as $file) {
				if($type =="js") {
					if(JOOMLA) {
						$document->addScript(ADMIN_MEDIA_URI.'js/'.$file.'?version='.$zgfversion->version ); 
					} else {
						wp_enqueue_script(basename($file), get_template_directory_uri()  . '/zengrid/admin/js/'.$file, array('jquery'),$zgfversion->version);
					}
				}
			}
		}
		
		if(JOOMLA) {
			// Jooml aneeds an extra js file
			$document->addScript(ADMIN_MEDIA_URI.'js/zengrid/framework-joomla.js?version='.$zgfversion->version ); 
		} 
		
		
		// Config XML
		$config = $zgf->get_xml('settings/settings.xml');
		$templateDetails = $zgf->get_xml('templateDetails.xml');
		$pages = $templateDetails->pages->page;
		$settings = $zgf->getsettings();  
		$configs = $zgf->get_files('settings/config/', '.json');
		$last_saved_state = $zgf->lastsaved();
		
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
				
				<?php if(WP) { 
						// Select box that lists styles in toolbar
						include(TEMPLATE_PATH.'/zengrid/fields/wp-page-selector.php'); 
					 } else { 
					 	// Select bar that displays other instances of the template
						include(TEMPLATE_PATH.'/zengrid/fields/styles.php');
					} ?>
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
				
				<?php if(JOOMLA) {?>
				var url = '<?php echo JURI::root();?>administrator/index.php?option=com_ajax&plugin=zengridramework2&format=raw';
				<?php } else { ?>
				var url = 'admin-ajax.php';
				<?php } ?>
				var time = '<?php echo date('Y-m-d-H-i-s');?>';
				
				// On page load set the current theme
				$('#cssfiles,#style-name').val('<?php echo $settings->params->theme;?>');
				
				
			
				$('#load-config').click(function() {
					var page_type = $('#page-type-selector').val();				
					$(document).set_config(template, time,'<?php echo TEMPLATE_PATH_RELATIVE;?>', page_type,url);
					$('#save-config-selector option[value="' + page_type + '"]').attr('selected', 'selected');
				});
				
				$('#save-config,#toolbar-apply button,#toolbar-save button').click(function() {
					
					var data = $(document).get_config();
					var page_type = get_page_type();
					
					$(this).addClass('zen-clicked');
					
					$(document).send_ajax(template, url, data, 'save', page_type, 'config', 'config');
					
						var config_exists = $("#delete-configs-selector option[value='"+page_type+"']").length;
					
					 	if(config_exists < 1) {
				    	 	// Append the new preset to the presetlist
				    	 	if(page_type !=="default") {
								$('#page-type-selector,#delete-configs-selector').append($('<option>', {
								    value: page_type,
								    text: page_type,
								    selected: 1
							}));
						}
					}
					
				});
				
				$('#save-theme').click(function() {
					// Get the data
					var data = $(document).get_theme();
					
					// Get the theme name
					var name = $('#style-name').val();
					
					// Add theme name to the data
					data.theme = name;
					$('#compile_required').val(1);
					$(document).send_ajax(template, url, data, 'save', '', 'themes', 'theme.' +name);
					
				});
				
				// Save Layout
				$('#save-layout').click(function() {
					var data = $(document).get_layout();
					var name = $('#layout-name').val();
					$(document).send_ajax(template, url, data, 'save','', 'layouts', name);
					return false;
				});
				
				
				// Load layout
				$('#load-layout').click(function() {
					// Data used for loading layouts from config
					var data = null;
					$(document).set_layout_data(data,url,template);
				});
				
				// Delete Theme
				$('#delete-theme').click(function() {
					$(document).delete_theme(url, template);
				});
				
				
				// Delete Config
				$('#delete-config').click(function() {
					$(document).delete_config(url);
				});
				
				
				// Compress JS
				$('#compresser').click(function() {
					var data = $(document).get_compress();
					var page_type = get_page_type();
					$(document).send_ajax(template, url, data, 'compress', page_type, 'compress', page_type);
					return false;
				});
				
				
				// Destory Chosen for the framework
				if(jQuery().chosen) {
					$('#zgf select').chosen('destroy');			
				}
				
				
				function get_page_type(){
					<?php if(WP) { ?>
						var page_type = $('#save-config-selector').val();
					<?php } else { ?>
						function getUrlParameters(name) {
						    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
						    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
						        results = regex.exec(location.search);
						    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
						}
						
						var page_type = getUrlParameters('id');
					<?php }?>
					
					return page_type;
				}
			});	
		</script>