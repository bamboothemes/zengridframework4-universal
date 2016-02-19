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

// Read settings
$settings = $zgf->getsettings();

// Current layout
// Config of layout preset may be different to actual stored layout in the config
$current_layout = $settings->params->layout_preset;

// Items used in config
$used_items = $settings->layout; ?>


<!-- Layout actions -->
<ul>
	<li data-display="half" style="padding-left: 0 !important;">	
	        <div id="layout-preset-wrap">
	        	<select id="layout_preset" style="float: left;margin-bottom: 30px;;">
	        		<?php 
	        			// Populate select list of available layotus	
	        			foreach ($files as $key => $layout)
	        			{
	        				$file = str_replace('.json', '', $layout);
	        				
	        				if($layout !=="index.html" && $layout !=="positions.json" && $layout !=="") {
	        				
	        					echo '<option value="'.$file.'"';
	        					if($file == $current_layout) {
	        						echo 'selected';
	        					}
	        					echo '>'.$file.'</option>';
	        				}
	        			} ?>
	        	</select>
	       
	        	<a href="#none" class="uk-button-primary uk-button" id="load-layout">Load Layout</a>
	        </div>
	        						
	</li>
	<li data-display="half" style="padding-left: 0 !important">
		<input class="uk-form uk-form-large exclude advanced" id="layout-name" value="New Layout" style="display: inline;">
		<a href="#" class="uk-button-primary uk-button exclude advanced" id="save-layout">Save Layout</a>
	</li>
</ul>

<div class="clearfix"></div>
<p class="info not-advanced">Click the show advanced options button above to be able to view advanced layout options.</p>

<?php // Compare keys with default layout with used layouts

// Users can override the positions available by adding 
// customs/positions.json. Let's check to see if they have done that

if(file_exists(TEMPLATE_PATH . 'custom/positions.json')) {
	$default_layout = $zgf->get_json('custom/positions.json');
} else {
	$default_layout = $zgf->get_json('settings/layouts/positions.json');
}


echo '<div id="resize-container" class="advanced">';

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
		'<a class="stack-positions" id="no-change-tablets" href="#">No Change</a></div>'.
		'<div><span class="icon-mobile"></span>'.
		'<a href="#" class="stack-positions" id="stack-phones">Stack</a>'.
		'<a href="#" class="stack-positions" id="hidden-phones">Hide</a>'.
		'<a class="stack-positions" id="no-change-phones" href="#">No Change</a>'.
		'</div></div></div>';
		
		foreach ($row as $title => $width) {
			
			if(isset($used_items->$key->{'positions'}->{$title})) {
				$width = $used_items->$key->{'positions'}->{$title};
			}
			
			
			echo '<div id="'.$title.'" class="resizable ui-widget-content grid-'.$width.'" data-width="'.$width.'" data-active="0" style="display:none">';
			echo '<h3 class="ui-widget-header">';
			echo '<span class="icon-eye"></span>';
			echo '<span class="col-count"></span>'.ucfirst($title).' </h3>';
			echo '</div>';
			
		}
		
		echo '</div>';
	
		
		echo '<div data-id="'.$key.'" class="unused-modules"><span class="icon-eye cancel"></span>';
			
			foreach ($row as $title => $width) {
				echo '<div data-id="'.$title.'">'.ucfirst($title).'</div>';
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
				$mainlayout = 	(array)$used_items->main->positions;
				
				// Get any iotems not used but should be in array
				// Items in this will be nulled and in the hidden row.
				$diff = array_diff_key($default_main,$mainlayout);
				
				
				foreach ($mainlayout as $title => $width) {
					echo '<div id="'.$title.'" class="resizable ui-widget-content grid-'.$width.'" data-width="'.$width.'" data-active="0">';
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
			
			echo '<div data-id="'.$key.'" class="unused-modules"><span class="icon-eye cancel"></span>';
				
				foreach ($row as $title => $width) {
					echo '<div data-id="'.$title.'">'.ucfirst($title).'</div>';
				}
				
			echo '</div>';
			
	}
} ?>

</div>
	<script>
		
	jQuery(document).ready(function($) {
	
	// Sets the value of the save layout box with current layout 
	var layout = $('#layout_preset').val();
	
	// Set the save box with the current name
	$('#layout-name').val(layout);
	
	
	// Applies the layout
	$('#apply-layout').live('click', function() {
		
		$(document).set_layout_data('<?php echo TEMPLATE;?>');
		
		return false;
		
	});


	$('.main-content-toggle').live('click', function() {
		
		var main_layout = $(this).attr('id');
		main_layout = main_layout.split('_');
		
		// Remove existing unused blocks
		// So we can replace them with the current config.
		$('div[data-id="main"].unused-modules div').remove();
		
		$(main_layout).each(function(i, value) {
			
			$('#main div.resizable').eq(i).attr('id', value);
			var width = $('#'+this).attr('data-width');
			$('#main .ui-widget-header').eq(i).html('<span class="icon-eye"></span><span class="col-count">' + width + '</span>' + value);
			
			
			$('div[data-id="main"].unused-modules').append('<div data-id="' + value +'"">' + value +'</div>');
			
			
			var is_active = $('#' + value + '.resizable').attr('data-active');
			
			if(typeof is_active === "undefined") {
				$('div[data-id="main"].unused-modules [data-id="' + value + '"]').show();
			} else {
				$('div[data-id="main"].unused-modules [data-id="' + value + '"]').hide();
			}
					
			
		});
		
		return false;
		
	});
	
});
</script>


<script>
	
	jQuery(document).ready(function($) {

		<?php foreach ($used_items as $key => $row) { 
	
			// Get state for classes
			$classes = $row->classes;
			$classes = explode(' ', $classes->classes);
			
			foreach ($classes as $class) {
				if($class!=="") { ?>
					$("#resize-container #<?php echo $key;?> #<?php echo $class;?>").addClass("active");
				<?php }
			}
			
			// Get positions
			
			if(isset($row->positions)) {
				$row = $row->positions;
				
				if(is_object($row)) {
					foreach ($row as $module => $item) { ?>
						$("#resize-container #<?php echo $module;?>").attr("data-active", "1").fadeIn();
						$("#resize-container .unused-modules [data-id='<?php echo $module;?>']").hide();
					<?php } 
				}
			}
			
			
			?>
		
			
			setTimeout(function() {
				// Not 100% sure why this is needed
				// Some sort of racecondition
				
				var unused = $('[data-id="<?php echo $key;?>"].unused-modules div:visible').length;
				
				if(unused > 0) {
					$('[data-id="<?php echo $key;?>"].unused-modules').addClass('has-content');
				}
			
			},1000);
			
		<?php } ?>
	});
</script>