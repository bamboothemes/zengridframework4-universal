<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// This file is used when the page laods for the first time
// No Direct Access
defined('ZEN_ALLOW') or die(); 

// Instantiate $zgf
$zgf = new zen();

// Get available layouts stored in this theme
$files = $zgf->files(TEMPLATE_PATH.'/settings/layouts/','');
$master = $zgf->files(TEMPLATE_PATH.'/tpls','');
$config = $zgf->get_xml('settings/themer.xml');


// Read settings
$settings = $zgf->getsettings();

// Current layout
// Config of layout preset may be different to actual stored layout in the config
$current_layout = $settings->params->layout_preset;

// Items used in config
$used_items = $settings->layout; 


// Users can override the positions available by adding 
// customs/positions.json. Let's check to see if they have done that

if(file_exists(TEMPLATE_PATH . 'custom/positions.json')) {
	$default_layout = $zgf->get_json('custom/positions.json');
} else {
	if(isset($settings->params->layout_file)) {
		$positions = explode('.', $settings->params->layout_file);
		$positions = $positions[0];
		$default_layout = $zgf->get_json('settings/layouts/positions/'.$positions.'.json');
	} else {
		$default_layout = $zgf->get_json('settings/layouts/positions/default.json');
	}
}


// Items used in config
$used_items = $settings->layout;


$colors = array('row-background','container-background', 'text-color', 'heading-color', 'link-color','link-hover-color');
?>


<div class="layout-container">
		<div class="browser-toolbar">		
			<div class="buttons clearfix">
				<span class="left white"></span>
				<span class="left white"></span>
				<span class="left white"></span>
				<span class="title">
					
				</span>
			</div>
		</div>
		
		<div id="general-settings" data-id="general-settings" class="side-drawer" style="display: block;">
				<div class="settings-title">General Settings</div>
				<div class="settings-options">
					<ul>
						<?php foreach ($config->children() as $section =>$fields) { 
							 
								 	$name = $fields['name'];
								 	if($name !="row_styles") {
								 	?><li <?php if($name=="style") {?>class="active"<?php } ?> data-id="<?php echo $name;?>"><a href="#<?php echo $name;?>"><?php echo ucfirst($name);?></a></li><?php } 
						 	} ?>
					</ul>
				</div>
				<div class="settings-params">
					<?php foreach ($config->children() as $section =>$fields) { 
					
					 $name = $fields['name'];
					
					 if($name !="row_styles") {
					 ?>
						
					<div data-target="<?php echo $name; ?>" class="tab-panel <?php if($name=="style") {?>active<?php } ?>">
					<?php foreach ($fields as $key => $group) { ?>
								
								<div class="zen-toggle <?php echo $group['class'];?>">
									<h3><?php echo $group['label'];?></h3>
								</div>
								
								<div class="zen-toggle-content">
										<?php foreach ($group as $field) { 
								
											$type = (string)$field['type'];
											$description = $field['description'];
											$label = $field['label'];
											$name = $field['name'];
											$class = $field['class'];
											$tag = $field['tag'];
											$compile = $field['compile'];
											$target = $field['target'];
											$folder = $field['folder'];
											$show_empty = $field['show_empty'];
											
											
											if(isset($field['hide_label'])) {
												$hide_label = $field['hide_label'];
											} else {
												$hide_label = 0;
											}
											
											
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
											echo $zgf->render($type,$description,$label,$options, $name,$class, $value, $tag, $compile,$target, $folder,$show_empty, $hide_label);
										}	?>
									</div>	
																
									<?php	}
										 ?>
								</div>
						<?php 	} 
						
						} ?>
				
					</div>
				</div> 
	
		
		<?php foreach ($default_layout as $key => $row) { ?>
		<div data-id="<?php echo $key;?>_settings" class="side-drawer">
		<div class="settings-title"><?php echo ucfirst($key);?> Row Settings</div>
		<div class="settings-close">x close</div>
		<div class="settings-options">
			<ul>
				<li class="active" data-id="display"><a href="#display">Display</a><li data-id="style"><a href="#style">Row Style</a></li></li>
			</ul>
		</div>
		<div class="settings-params">
			<div data-target="style" class="tab-panel">
			
				<?php foreach ($config->children() as $section =>$fields) {
						
						$name = $fields['name'];
						
						if($name == "row_styles") {
							
							foreach ($fields as $group) { 
								echo '<div class="zen-toggle '.$group['class'].'">';
								echo '<h3>'.$group['label'].'</h3>';
								echo '</div>';
								echo '<div class="zen-toggle-content '.$group['class'].'">';
								foreach ($group as $block) {
									
									$name = $key.'-'.$block['name'];
									$type = (string)$block['type'];
									$description = $block['description'];
									$label = '@'.$name;
									$class = $block['class'];
									$tag = $block['tag'];
									$compile = $block['compile'];
									$target = $block['target'];
									$folder = $block['folder'];
									$show_empty = $block['show_empty'];
									
									if(isset($field['hide_label'])) {
												$hide_label = $field['hide_label'];
											} else {
												$hide_label = 0;
											}
											
											
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
									
											foreach ($block->children() as $child) {
												$options[] = $child;
											}
										
											// Determine the field typr and render the appropriate field
											echo $zgf->render($type,$description,$label,$options, $name,$class, $value, $tag, $compile,$target, $folder,$show_empty, $hide_label);
									
									}
									
									echo '</div>';
								
								
								
							}
						}
					
				} ?>
    			
    			
    		</div>
    		
    		<div data-target="display"  class="tab-panel active">
    			<div class="zen-toggle first"><h3>Available modules</h3></div>
    			<div class="zen-toggle-content">
    			<?php echo '<div data-id="'.$key.'" class="unused-modules connectedSortable">';
    				
    				foreach ($row as $title => $width) {
    					echo '<div data-id="'.$title.'">'.ucfirst($title).'</div>';
    				}
    				
    			echo '</div>';	?>
    			</div>
    			<div class="zen-toggle first"><h3 class="first">Responsive Control</h3></div>
    				<div class="zen-toggle-content">
	    				<div class="stack-position">
	    					<div>
	    						<span class="icon-desktop"></span>
	    						<a class="stack-positions" data-id="hidden-desktop" href="#">Hide</a>
	    					</div>
	    					<div>
	    						<span class="icon-tablet"></span>
	    						<a class="stack-positions" data-id="stack-tablets" href="#">Stack</a>
	    						<a class="stack-positions" data-id="hidden-tablets" href="#">Hide</a>
	    						<a class="stack-positions" data-id="no-change-tablets" href="#">No Change</a>
	    					</div>
	    					<div>
	    						<span class="icon-mobile"></span>
	    						<a href="#" class="stack-positions" data-id="stack-phones">Stack</a>
	    						<a href="#" class="stack-positions" data-id="hidden-phones">Hide</a>
	    						<a href="#" class="stack-positions" data-id="no-change-phones">No Change</a>
	    					</div>
	    				</div>
    				</div>
    			</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function($) {
				
				$('[data-id="<?php echo $key;?>_settings"] .settings-options li').click(function() {
					$('[data-id="<?php echo $key;?>_settings"] .settings-options li').removeClass('active');
					$(this).addClass('active');
					var target = $(this).attr('data-id');
					$('[data-id="<?php echo $key;?>_settings"] .tab-panel').removeClass('active');
					$('[data-id="<?php echo $key;?>_settings"] [data-target="' + target + '"]').addClass('active');
					return false;
				});
				
			
				setTimeout( 
				
					function() {
					
						// USed unused modules
						$('[data-row="<?php echo $key;?>-row"] .resizable').each(function() {
							var active = $(this).attr('data-active');
							if(active =="1") {
								
								var id = $(this).attr('id');
								$('[data-id="<?php echo $key;?>_settings"].side-drawer .unused-modules [data-id="'+id+'"]').hide();
							}
						});
				
					}, 2000);
				
				
				
				$(document).on('click', '.<?php echo $key;?>_edit-row', function() {
					// Position
					var top_position = $(this).offset();
					top_position = top_position.top;
					
					$('.side-drawer').fadeOut();
					$('.resize-row').removeClass('active');
					$(this).parent().addClass('active');	
					$('[data-id="<?php echo $key;?>_settings"].side-drawer').css({"top":top_position - 300}).fadeIn();	
				});
			});
		
		</script>
		
		<?php } ?>
	
	
	<?php // Compare keys with default layout with used layouts
	
	// Users can override the positions available by adding 
	// customs/positions.json. Let's check to see if they have done that
	
	if(file_exists(TEMPLATE_PATH . 'custom/positions.json')) {
		$default_layout = $zgf->get_json('custom/positions.json');
	} else {
		if(isset($settings->params->layout_file)) {
			$positions = explode('.', $settings->params->layout_file);
			$positions = $positions[0];
			$default_layout = $zgf->get_json('settings/layouts/positions/'.$positions.'.json');
		} else {
			$default_layout = $zgf->get_json('settings/layouts/positions/default.json');
		}
	}
	
	
	echo '<div id="resize-container" class="advanced"></div>';
	
	?>

 <script>
 	jQuery(document).ready(function($) {
 		
 		 
 		 $('.zen-toggle.first').next('.zen-toggle-content').slideDown();
 		 
 		$('.zen-toggle').click(function() {
 			$(this).next('.zen-toggle-content').slideToggle();
 		});
 		
 		$('.settings-close').click(function() {
 			$(this).parent().fadeOut();
 			$('[data-id="general-settings"].side-drawer').fadeIn();
 		});
 		

 		
 		$('[data-id="general-settings"] .settings-options li').click(function() {
 			$('[data-id="general-settings"] .settings-options li').removeClass('active');
 			$(this).addClass('active');
 			var target = $(this).attr('data-id');
 			$('[data-id="general-settings"] .tab-panel').removeClass('active');
 			$('[data-id="general-settings"] [data-target="' + target + '"]').addClass('active');
 			return false;
 		});
 		
});
 
 </script>
 
