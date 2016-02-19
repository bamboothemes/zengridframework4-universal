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
// This file creates the layout when a layout is loaded using the load-layout button int he admin

defined( 'ZEN_ALLOW' ) or die( 'Restricted access' );

	// Include Helpers
	include FRAMEWORK_PATH . '/helpers/helper.php'; 
	
	// Instantiate $zgf
	$zgf = new zen();
	
	// Template Path
	$template_path = TEMPLATE_PATH;
	$layoutpath		= TEMPLATE_PATH.'/settings/layouts/';
	
	// Files from Assets.xml
	$layout = $_POST['layout'];
	
	// Get Theme blocks
	// We may be dending a name of a layout to retrieve or sending the data from a config file.
	
	if(is_array($layout)) {
		$theme_layout = json_decode(json_encode($layout));
	} else {
		$theme_layout = $zgf->get_json('settings/layouts/'.$layout.'.json');
	}
	
	
	// Compare keys with default layout with used layouts
	if(file_exists(TEMPLATE_PATH . 'custom/positions.json')) {
		$default_layout = $zgf->get_json('custom/positions.json');
	} else {
		$default_layout = $zgf->get_json('settings/layouts/positions.json');
	}
	
	foreach ($default_layout as $key => $row) { 
		
		if($key !=="main") {
			echo '<div id="'.$key.'" data-row="'.$key.'" class="module-row">';
			echo '<div class="row-title"><span>'.$key.'</span>'.
			'<div class="stack-position">'.
			'<div><span class="icon-desktop"></span>'.
			'<a class="stack-positions" id="hidden-desktop" href="#">Hide</a></div>'. 
			'<div><span class="icon-tablet"></span>'.
			'<a class="stack-positions" id="stack-tablets" href="#">Stack</a>'.
			'<a class="stack-positions" id="hidden-tablets" href="#">Hide</a>'.
			'<a class="stack-positions" id="no-change-phones" href="#">No Change</a></div>'.
			'<div><span class="icon-mobile"></span>'.
			'<a href="#" class="stack-positions" id="stack-phones">Stack</a>'.
			'<a href="#" class="stack-positions" id="hidden-phones">Hide</a>'.
			'<a class="stack-positions" id="no-change-phones" href="#">No Change</a>'.
			'</div></div></div>';
			
			foreach ($row as $title => $width) {
				
				if(isset($theme_layout->$key->{'positions'}->{$title})) {
					$width = $theme_layout->$key->{'positions'}->{$title};
				}
				
				echo '<div id="'.$title.'" class="resizable ui-widget-content grid-'.$width.'" data-width="'.$width.'" style="display:none" data-active="0">';
				echo '<h3 class="ui-widget-header">';
				echo '<span class="icon-eye"></span>';
				echo '<span class="col-count"></span>'.ucfirst($title).' </h3>';
				echo '</div>';
				
			}
			
			echo '</div>';
			echo '<div data-id="'.$key.'" class="unused-modules has-content"><span class="icon-eye cancel"></span>';
				
				foreach ($row as $title => $width) {
					echo '<div data-id="'.$title.'" style="display:block">'.ucfirst($title).'</div>';
				}
				
			echo '</div>';	
		}
		
		else {
			
			echo '<div id="'.$key.'" data-row="'.$key.'" class="module-row">';
				echo '<div class="row-title"><span>'.$key.'</span><a class="main-content-toggle" href="#main-left-right" id="maincontent_sidebar1_sidebar2">Main Left Right</a> / <a class="main-content-toggle" href="#left-main-right" id="sidebar1_maincontent_sidebar2">Left Main Right</a> / <a class="main-content-toggle" href="#left-right-main" id="sidebar1_sidebar2_maincontent">Left Right Main</a>'.
				'<div class="stack-position">'.
				'<div><span class="icon-desktop"></span>'.
				'<a class="stack-positions" id="hidden-desktop" href="#">Hide</a></div>'. 
				'<div><span class="icon-tablet"></span>'.
				'<a class="stack-positions" id="stack-tablets" href="#">Stack</a>'.
				'<a class="stack-positions" id="hidden-tablets" href="#">Hide</a>'.
				'<a class="stack-positions" id="no-change-tablets" href="#">No Change</a></div>'.
				'<div><span class="icon-mobile"></span>'.
				'<a href="#" class="stack-positions" id="stack-phones">Stack</a>'.
				'<a href="#" class="stack-positions" id="hidden-phones">Hide</a>'.
				'<a class="stack-positions" id="no-change-phones" href="#">No Change</a>'.
				'</div></div></div>';
				
				// Default main positions
				$default_main = (array)$default_layout->main;
				
				// Used positions
				$mainlayout = 	(array)$theme_layout->main->positions;
				
				// Get any iotems not used but should be in array
				// Items in this will be nulled and in the hidden row.
				$diff = array_diff_key($default_main,$mainlayout);
				
				
				foreach ($mainlayout as $title => $width) {
					echo '<div id="'.$title.'" class="resizable ui-widget-content grid-'.$width.'" data-width="'.$width.'">';
					echo '<h3 class="ui-widget-header">';
					echo '<span class="icon-eye"></span>';
					echo '<span class="col-count"></span>'.ucfirst($title).' </h3>';
					echo '</div>';
				}
				
				foreach ($diff as $title => $width) {
					echo '<div id="'.$title.'" class="resizable ui-widget-content grid-'.$width.' hidden" data-width="'.$width.'">';
					echo '<h3 class="ui-widget-header">';
					echo '<span class="icon-eye"></span>';
					echo '<span class="col-count"></span>'.ucfirst($title).' </h3>';
					echo '</div>';
				}
				
				echo '</div>';
			
				
				echo '<div data-id="'.$key.'" class="unused-modules has-content"><span class="icon-eye cancel"></span>';
					
					foreach ($row as $title => $width) {
						echo '<div data-id="'.$title.'">'.ucfirst($title).'</div>';
					}
					
				echo '</div>';
				
		}
	}?>
	
	
	<script>
		
		jQuery(document).ready(function($) {

			<?php // Loads the layout on first page laod
				foreach ($theme_layout as $key => $row) { 
		
				// Get state for classes
				$classes = $row->classes;
				$classes = explode(' ', $classes->classes);
				
				foreach ($classes as $class) {
					if($class!=="") { ?>
						$("#resize-container #<?php echo $key;?> #<?php echo $class;?>").addClass("active");
					<?php }
				}
				
				// Get positions
				$positions= $row->positions;
				if(is_object($positions)) {
				
			
				foreach ($positions as $module => $item) { ?>		
					$("#resize-container #<?php echo $module;?>").attr("data-active", "1").show();
					$("#resize-container .unused-modules [data-id='<?php echo $module;?>']").hide();
				<?php } ?>
				
				var unused_modules = $('[data-id="<?php echo $key;?>"].unused-modules div:visible').length;
				
				if(unused_modules > 0) {
					$('[data-id="<?php echo $key;?>"].unused-modules').addClass('has-content');
				} else {
					$('[data-id="<?php echo $key;?>"].unused-modules').removeClass('has-content');
				}
				
				
				<?php } ?>
				
				
					
		<?php } ?>
		
		});
	</script>
