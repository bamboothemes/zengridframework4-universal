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
defined( 'ZEN_ALLOW' ) or die( 'Restricted access' );


/**
 * Get settings sent from Admin
 *
 *
 */
 
 	// Content
 	$content = $_POST['content'];

	// Variables and Settings
 	$variables = $content['colors'];
 	$settings = $content['settings'];
 	$extra_files = $content['files'];
 	$framework_version = $settings['framework_version'];
 	$framework_enable = $settings['framework_enable'];
 	$framework_files = $settings['framework_files'];
	$enable_template_css = $settings['template_css'];
	$theme = $settings['theme'];
	$theme = strtolower(str_replace(' ', '-', $theme));
	$fontawesome_type = $settings['font_awesome_type'];
	$addtocompiler = $extra_files['custom_less'];
	$compressed = $settings['compresscss'];
	$animate = $settings['animate'];
	$animations = $extra_files['animations'];
	$rowstyles = $extra_files['rowstyles'];

	
	
	/**
	 * Import LESS PHP
	 *
	 *
	 */
	
		require_once __DIR__ . '/../libs/lessc/Less.php';
	
	
	
	/**
	 * Paths
	 *
	 *
	 */
		$sitepath = str_replace('\\', '/', ROOT_PATH);
		$lessBasePath = TEMPLATE_PATH . '/less';
		$relative_path = TEMPLATE_PATH_RELATIVE;
	
	
	/**
	 * 	When the load template.css is enabled we create the template.css based on the current settings
	 *	Lets just check to see if the template.css file exists early int he file
	 *	and return if it does to save some time.
	 */
	 	
	 	$write_css = 0;
	 	
		if($enable_template_css =="1") {
			if (file_exists(TEMPLATE_PATH . '/css/template.css')) {
			    echo 'Template.css is now enabled. Current theme styling will be bypassed.';
			    
			    return;
			    
			} else {
				$write_css = 1;
			}
		}
		
		
	
	// Only parse the admin settings if not creating css
	if(!$enable_template_css) {
	
	/**
	 * Variables
	 *
	 *
	 */
	 
	
		$variable_array = array();

		// Process Colour Variables
		foreach ($variables as $param =>$color) {
			
			
				if($color !=="") {
					// First three letters
					// Because Hex values like ddd and aaa
					// Also look like darken and auto
					$threeletters = substr($color, 0, 3);
					
					if($threeletters =="non") {
						
						$color = 'transparent';
					}
					
					$firstletter = substr($color, 0, 1);
									
					if (trim($color) !== '') {
						
						
						// Checks to see if using transparent, inherit, auto, lighten or darken
						if($firstletter =="@" || $firstletter =="l" || $firstletter =="t" || $firstletter =="i") {
							
							if($firstletter == "l") {
								
								// We can lighten # or variables so need to readd # if its a hex
								$variable = explode('(', $color);
								
								// Check for first letter of variable we are looking at
								$firstletter = substr($variable[1], 0, 1);
								
								// If its a variable just do the normal process
								if($firstletter == '@') {
									$color = $variable[0].'('.$variable[1];
								} else {
									//other wise it must be a colour so we add back the #
									$color = $variable[0].'(#'.$variable[1];
								}
							}
						
						} elseif($threeletters =="dar" || $threeletters =="aut") {
								
								// We can lighten # or variables so need to readd # if its a hex
								$variable = explode('(', $color);
								
								// Check for first letter of variable we are looking at
								$firstletter = substr($variable[1], 0, 1);
								
								// If its a variable just do the normal process
								if($firstletter == '@') {
									$color = $variable[0].'('.$variable[1];
								} else {
									//other wise it must be a colour so we add back the #
									$color = $variable[0].'(#'.$variable[1];
								}
								
								
						} elseif($threeletters =="rgb") {
						
							
						} else {
							$color = '#'.$color;
						}
						
					
						$variable_array[$param] = $color;
					}

				}		
		}
		
		
	
		// Process relevant settings
		foreach ($settings as $name => $setting) {
	
			if($setting!=="") {
				$variable_array[$name] = $setting;
			}
		}



		// Adds path variable for when including nested images in styles folder
		$variable_array['@path'] = "'../../'";

	
	/**
	 * Declare Files Array
	 *
	 *
	 */
	
	
		$files = array();
	
	
	
	
	/**
	 * Bootstrap
	 *
	 *
	 */
	
	 if($framework_enable) {
	
	 	// Get Bootstrap files to compile
	 	$framework_files = explode('_', $framework_files);
	
	 	$write_framework_file = "";
	 	$write_framework_file .= '@import "variables.less";'."\n";
	
	 	if($framework_version !=="uikit") {
	 		$write_framework_file .= '@import "mixins.less";'."\n";
	 	}
	
	 	foreach ($framework_files as $key => $file) {
	 		if($file !=="") {
	 			$write_framework_file .= '@import "'.$file.'.less";'."\n";
	 		}
	 	}
	
	 	file_put_contents(TEMPLATE_PATH.'/zengrid/libs/frameworks/'.$framework_version.'/less/'.$framework_version.'.less', $write_framework_file);
	
	 	$files[] =  '../zengrid/libs/frameworks/'.$framework_version.'/less/'.$framework_version.'.less';
	 }
	
	
	
		
	
	
	/**
	 * Main Template
	 *
	 *
	 */
	
	// Main Theme less File
	$files[] = 'template.less';
	
	
	/**
	 * Animate CSS
	 *
	 *
	 */
	
	// Animate css
	if($animate) {
		
		$files[] = '../zengrid/libs/zengrid/less/animate/animate.less';
		
		$animations = explode(',', $animations);
		$animations = array_unique($animations);
		
		foreach ($animations as $key => $animation) {
			if($animation !=="" && $animation !=="none") {
				$files[] =  '../zengrid/libs/zengrid/less/animate/'.$animation.'.less';
			}	
		}
	}	
	
	
	
	/**
	 * Font Awesome
	 *
	 *
	 */
	
		if($fontawesome_type) {
			$files[] =  '../zengrid/libs/zengrid/less/fontawesome/font-awesome-'.$fontawesome_type.'.less';
		}
			
	
	
	/**
	 * Row Styles CSS
	 *
	 *
	 */
	
		if(is_array($rowstyles)) {
			$rowstyles = array_filter($rowstyles);
			$row_styles = TEMPLATE_PATH . '/less/styles';
			$row_path = 'styles';
			if(is_dir($row_styles)) {
				
				foreach ($rowstyles as $key => $row_file) {
				
					$files[] = $row_path.'/'.$row_file.'.less';
						
				}
			}	
		
		}
		
		
	
	/**
	 * Extra Less files added
	 *
	 *
	 */
	
		
	
		if($addtocompiler !=="") {
			$addtocompiler = rtrim($addtocompiler, ",");
			$addtocompiler = explode(',', $addtocompiler);
			
			foreach ($addtocompiler as $key => $file) {
				$files[] = $file;
			}
			
		}
		
		
	
	/**
	 * Custom Less File
	 *
	 *
	 */
	
		$customless = TEMPLATE_PATH . '/less/custom.less';
		    
        if(file_exists($customless)) {
            $files[] = 'custom.less';
        }
	
	
	
	
	/**
	 * Create generated template.less file to parse
	 *
	 *
	 */
	
	$files_to_compile = '// This file is automatically generated by the Zen Grid Framework. Do not edit';
	$files_to_compile .= "\n";
	$files_to_compile .= "\n";
	
	foreach ($files as $key => $file) {
		if($file !=="") {
			$files_to_compile .= '@import "';
			$files_to_compile .= $file;
			$files_to_compile .= '";';
			$files_to_compile .= "\n";
		}
	}
	
	print_r($files);
	file_put_contents($lessBasePath.'/template-generated.less', $files_to_compile);
	
	
	/**
	 * Start Compression and Loop through the array
	 *
	 *
	 */

		$options = array(
		    'sourceMap'         => true,
		    'sourceMapWriteTo'  => TEMPLATE_PATH . 'css/theme.'.$theme.'.map',
		    'sourceMapURL'      => $relative_path.'/css/theme.'.$theme.'.map',
		   	'sourceMapRootpath'	=> '../',
		   	'sourceMapBasepath'   => str_replace('\\', '/', ROOT_PATH) . '/'.TEMPLATE_PATH_RELATIVE
		);
		
		if($compressed) {
			$options['compress'] = 'true';
		}
		
		$parser = new Less_Parser( $options );
		$parser->parseFile( TEMPLATE_PATH . 'less/template-generated.less', '');
		$parser->ModifyVars($variable_array);
		$css = $parser->getCss();
	

		file_put_contents(TEMPLATE_PATH . 'css/theme.'.$theme.'.css', $css);
		
		
		
		// Create gzipped version
			$gzip = '<?php ob_start ("ob_gzhandler");
			    header("Content-type: text/css; charset: UTF-8");
			    header("Cache-Control: must-revalidate");
			    $offset = 60 * 60 ;
			    $ExpStr = "Expires: " .
			    gmdate("D, d M Y H:i:s",
			    time() + $offset) . " GMT";
			    header($ExpStr);?>';
		
			$gzip .= $css;
		
			file_put_contents(TEMPLATE_PATH . 'css/theme.'.$theme.'.php', $gzip);
		
		echo 'compiled';
		
		
	}
		
		
		/**
		 * 	 
		 *	If creating template.css for first time
		 *
		 */
		 
		 
		if($enable_template_css =="1" && $write_css) {
		
			
			
				// Main Theme less File
				$files[] = $lessBasePath.'/template.less';
				
				
				/**
				 * Start Compression and Loop through the array
				 *
				 *
				 */
			
								
				$options = array(
				    'sourceMap'         => true,
				    'sourceMapWriteTo'  => TEMPLATE_PATH . 'css/theme.'.$theme.'.map'
				);
			
				if($compressed) {
					$options['compress'] = 'true';
				}
			
				$parser = new Less_Parser( $options );
			
				$css = "";
				foreach ($files as $key => $file) {
				
					
					$parser->parseFile( $file,'');
					$parser->ModifyVars($variable_array);
					$css .= $parser->getCss();
					$parser->reset();
				}
				
				
				
		    file_put_contents(TEMPLATE_PATH . 'css/template.css', $css);
		    
		   echo  'compiled';
		   
		} 
		
		