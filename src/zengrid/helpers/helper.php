<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// No Direct Access
defined('ZEN_ALLOW') or die();


/**
 * Defines the various classes and fields used in the config.xml 
 * Called from the admin/fields/options.php
 * 
 *
 *
 *
 */
 
 
if(!class_exists('zen')) {
class zen
{

		/**
	     *  Render fields specified in template config.xml
	     *
	     */
	     
	     public function __construct()
	     {


	     }

	    public function render($type,$description,$label,$options, $name,$class, $value, $tag, $compile,$target,$folder,$show_empty)
	    {
	       	$path = TEMPLATE_PATH . 'zengrid/fields/'.$type.'.php';
			
			if(file_exists($path)) {
	       		include($path);
	       	}
	    }
	    
	    
	    /**
	     *  Returns contents of xml
	     *
	     */
	     
	    public function get_xml($path) {
	    	$path = TEMPLATE_PATH.$path;
	    	return simplexml_load_file($path);
	    }
	    
	    
	    
	    /**
	     * Returns a json decoded object
	     *
	     * 
	     */
	    
	    
	    public function get_json($path) {
	    	$file = TEMPLATE_PATH .$path;
	    	$settings = file_get_contents($file);
	    	$settings = json_decode($settings);
	    	return $settings;
	    }
	    
	        
	    
	    
	   /**
	    *  List files in a folder
	    *
	    */
	    
	   public function get_files($folder, $filter) {
		   	$folder = TEMPLATE_PATH.$folder;
		   	
		   	if(is_dir($folder)) {
		   		$files = self::files($folder, $filter = $filter);
		   		return $files;
		   	} else {
		   		return null;
		   	}
	   }
	   
	   
	   
	   /**
	    *  List files in Images folder
	    *
	    */
	    
	   public function get_image_dir_files() {
	   	   	$folder = ROOT_PATH.'/images/';
	   	  
	   	   	if(is_dir($folder)) {
	   	   		$files = self::files($folder, '.', false, false,array('.svn', 'CVS','.DS_Store','__MACOSX','index.html'));
	   	   		return $files;
	   	   	} else {
	   	   		return null;
	   	   	}
	   }
	   
	   
	   
	   /**
	   	 * Utility function to read the files in a folder.
	   	 *
	   	 * @param	string	The path of the folder to read.
	   	 * @param	string	A filter for file names.
	   	 * @param	mixed	True to recursively search into sub-folders, or an
	   	 * integer to specify the maximum depth.
	   	 * @param	boolean	True to return the full path to the file.
	   	 * @param	array	Array with names of files which should not be shown in
	   	 * the result.
	   	 * @return	array	Files in the given folder.
	   	 * @since 1.5
	   	 */
	   	function files($path, $filter = '.', $recurse = false, $fullpath = false, $exclude = array('.svn', 'CVS','.DS_Store'))
	   	{
	   		// Initialize variables
	   		$arr = array();
	   
	   		// Check to make sure the path valid and clean
	   		
	   
	   		// Is the path a folder?
	   		if (!is_dir($path)) {
	   			echo 'Warning: Path is not a folder. Path: ' . $path;
	   			return false;
	   		}
	   
	   		// read the source directory
	   		$handle = opendir($path);
	   		while (($file = readdir($handle)) !== false)
	   		{
	   			if (($file != '.') && ($file != '..') && (!in_array($file, $exclude))) {
	   				$dir = $path . '/' . $file;
	   				$isDir = is_dir($dir);
	   				if ($isDir) {
	   					if ($recurse) {
	   						if (is_integer($recurse)) {
	   							$arr2 = self::files($dir, $filter, $recurse - 1, $fullpath);
	   						} else {
	   							$arr2 = self::files($dir, $filter, $recurse, $fullpath);
	   						}
	   						
	   						$arr = array_merge($arr, $arr2);
	   					}
	   				} else {
	   					if (preg_match("/$filter/", $file)) {
	   						if ($fullpath) {
	   							$arr[] = $path . '/' . $file;
	   						} else {
	   							$arr[] = $file;
	   						}
	   					}
	   				}
	   			}
	   		}
	   		closedir($handle);
	   
	   		asort($arr);
	   		return $arr;
	   	}
	   	
	   	
	   	
	   	/**
	   	 *  Last saved config
	   	 *
	   	 */
	   	 
	   	 public function lastsaved() {
	   	 	if(JOOMLA) {
	   	 		return null;
	    	} else {
	    		$last_saved_state = self::get_json('settings/settings.json');
	    		return $last_saved_state->lastsaved;
	    	}
		}
		
		
		/**
		 *  Joomla function to get the template id
		 *
		 */
			 
		public function template_id() {
			$templateId = explode('&id=', $_SERVER["REQUEST_URI"]);
			$templateId = $templateId[1];
			$templateId = explode('&', $templateId);
			$templateId = $templateId[0];
			return $templateId;
		}
		
		
    
	    /**
	     *  Get saved settings
	     *
	     */
	     
	    public function getsettings() {
	    
	    	if(WP) {
	    		$id = self::lastsaved();
	    	} else {
	    		$id = self::template_id();
	    	}
	    	
	    	$settings = TEMPLATE_PATH .'settings/config/config-'.$id.'.json';
	    	$default = TEMPLATE_PATH .'settings/config/config-default.json';
	    	
	    	if(file_exists($settings)) {
	    	
	    		$settings = self::get_json('settings/config/config-'.$id.'.json');
	    			
	    		// Check to see if params have become corrupted
	    		// Sometimes the details arent saved properly  		
	    		if(!empty($settings->params)) {
	    			
	    			// Adds a message if params are emoty
	    			//	JFactory::getApplication()->enqueueMessage('Stored settings corrupt. Reverting to default settings. Please check your settings.');
	    			
	    			// Load the default params
	    			return self::get_json('settings/config/config-'.$id.'.json');
	    			
	    		}
	    		
	    		elseif(file_exists($default)) {
	    		
	    			$settings = self::get_json('settings/config/config-default.json');
	    			
	    			if(!empty($settings->params)) {
	    				
	    				// Adds a message if params are emoty
	    				//	JFactory::getApplication()->enqueueMessage('Stored settings corrupt. Reverting to default settings. Please check your settings.');
	    				
	    				// Load the default params
	    				return self::get_json('settings/config/config-default.json');
	    				
	    			}
	    			
	    			else {
	    				return self::get_json('settings/default-config.json');
	    			}
	    		}
	    		
	    	} elseif(file_exists($default)) {
	    	
	    		$settings = self::get_json('settings/config/config-default.json');
	    		
	    		if(!empty($settings->params)) {
	    			
	    			// Adds a message if params are emoty
	    			//	JFactory::getApplication()->enqueueMessage('Stored settings corrupt. Reverting to default settings. Please check your settings.');
	    			
	    			// Load the default params
	    			return self::get_json('settings/config/config-default.json');
	    			
	    		}
	    		
	    		else {
	    			return self::get_json('settings/default-config.json');
	    		}
	    	} else {
	    		return self::get_json('settings/default-config.json');
	    	}

		}	
		
		
		
		/**
		* 	Checks if Com Ajax is installed
		*	Required for the module admin
		* 	
		*/
		
		public static function com_ajax()
			{
				jimport( 'joomla.filesystem.file' );
		
				if(JFile::exists(JPATH_ADMINISTRATOR . '/components/com_ajax/ajax.php')) {
					return 1;
				} else {
					return 0;
				}
		}
		
		
		
		

		
		
		
		// Get folder list
		public function expandDirectories($base_dir) {
		      $directories = array();
		      foreach(scandir($base_dir) as $file) {
		            if($file == '.' || $file == '..') continue;
		            $dir = $base_dir.DIRECTORY_SEPARATOR.$file;
		            if(is_dir($dir)) {
		                $directories []= $dir;
		                $directories = array_merge($directories, self::expandDirectories($dir));
		            }
		      }
		      return $directories;
		}	
}
}