<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

	
	$path = FRAMEWORK_PATH.'/libs/frameworks/';
	$dir = array_filter(glob($path.'*'), 'is_dir');
	
	
	// Read settings
	// Instantiate $zgf
	$zgf = new zen();
	
	$current_framework = $zgf->getsettings()->params->framework_version;
	
	
	// This is a seelct box that we may use later on that can be used to change the framework.
	// For the time being we will just hide this and re-enable if necessary.
	
	
	echo '<select id="framework_version" data-compile="both" class="'.$class.' zen-select framework_enable" aria-invalid="false">';
	
	foreach ($dir as $key => $framework) {
		
		$framework = ucfirst(str_replace(FRAMEWORK_PATH .'/libs/frameworks/', '', $framework));
		echo '<option value="'.strtolower($framework).'"';
		if(strtolower($framework) == $current_framework) {
			echo 'selected';
		}
		echo '>'.$framework.'</option>';
	}
	echo '</select>';

	
	if($description !=="" && isset($description)) {
		echo '<p class="'.$class.'">'.$description.'</p>';
	}
	echo '<p class="framework_enable '.$class.'"><a class="compile" id="select-all" href="#">Select All</a> | <a class="compile" id="deselect-all" href="#">Deselect All</a>';
	
	foreach ($dir as $key => $framework) {
		
		$framework = str_replace(FRAMEWORK_PATH .'/libs/frameworks/', '', $framework);	
		
		if(file_exists($path .'/'.$framework.'-imports.json')) {
			$framework_list = $zgf->get_json('/zengrid/libs/frameworks/'.$framework.'-imports.json');
			
			echo '<div id="'.$framework.'" class="framework_list framework_enable" style="display:none">';
			echo '<h3 class="'.$framework.' framework_enable '.$class.'">'.ucfirst($framework).' Files</h3>';
			
			foreach ($framework_list as $key => $file) {
					$name = str_replace('.less', '', $file);
					echo '<label class="zen-checkbox '.$class.'">';
					echo '<input class="'.$class.' framework_files" data-id="'.$name.'" type="checkbox" value="'.$value.'"';
					if($value == '1') { echo 'checked';}
					echo '/>';
					echo $name;
					echo '</label><br class="'.$class.'"/>';
			}
			echo '</div>';
		}
	}

	
	 ?>
	
	<script>
		jQuery(document).ready(function($) {
			
			// Get current bootstrap option
			var framework = $('#framework_version').val();
	
			// Hide the items and reset
			//$('.framework_list').hide().removeClass('active');
			
			// Show the relavent list of options and make them active
			$('#' + framework).show().addClass('active');
			
			// Displays the bootstrap files on change
			$('#framework_version').change(function() {
				
				// Null the file list so we dont load files that are not relevant for this version of Bootstrap
				$('#framework_file_list').val('');
				
				// Get current bootstrap option
				var framework = $(this).val();
				
				// Hide the items and reset
				$('.framework_list').hide().removeClass('active');
				
				// Show the relavent list of options and make them active
				$('#' + framework).show().addClass('active');
				
				
				// Populate the list of files to compile if any of the new list are already active
				var framework_files = "";
					
				$('.framework_file_list.active input.framework_files').each(function() {
						
					if($(this).val() == '1') {
						var filename = $(this).attr('data-id');
						framework_files += filename;
						framework_files += '_';	
					}
				});
					
				
				$('#framework_files_group').val(framework_files);
				
			});
			
			
			// Set active items
			var setfiles = $('#framework_files_group').val();
				setfiles = setfiles.split('_');
				
			$(setfiles).each(function(i, value) {
				$('.active input[data-id="' + value +'"]').prop('checked', true).val(1);
			});
			
			
			$('#select-all').click(function() {
			
				var framework_files = "";
				$('.framework_list.active input').each(function(i, value) {
					$(this).prop('checked', true).val(1);
					var filename = $(this).attr('data-id');
					framework_files += filename;
					framework_files += '_';	
					
				});
				
				$('#framework_files_group').val(framework_files);
				
				return false;
			
			});
			
			
			$('#deselect-all').click(function() {
				$('.framework_list.active input').each(function(i, value) {
					$(this).prop('checked', false).val(0);
					$('#framework_files_group').val('');
				});
				
				return false;
			});
			
			
			// Get active Items
			$('input.framework_files').click(function() {
				
				if($(this).prop('checked') ) {	
					$(this).val('1');
				} else {
					$(this).val('0');
				}
				
				var framework_files = "";
				
				$('.framework_list.active input.framework_files').each(function() {
					
					if($(this).val() == '1') {
						var filename = $(this).attr('data-id');
						framework_files += filename;
						framework_files += '_';	
					}
				});
				
			
				$('#framework_files_group').val(framework_files);
				
			});
			
		});		
	</script>