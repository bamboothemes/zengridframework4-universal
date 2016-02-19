<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 

$styles = $zgf->get_files('settings/themes', '.json');

if(JOOMLA) {
	// Get a db connection.
	$db = JFactory::getDbo();
	 
	// Create a new query object.
	$query = $db->getQuery(true);
	 
	// Select all records from the user profile table where key begins with "custom.".
	// Order it by the ordering field.
	$query->select($db->quoteName(array('id', 'title', 'template')));
	$query->from($db->quoteName('#__template_styles'));
	$db->setQuery($query);
	$results = $db->loadObjectList();
	
	
	// Get list of default styles that shipped with the theme
	$default_styles = $zgf->get_files('settings/config/sample', '.json');
	$options ="<option value='none'>Select saved settings to apply</option>";
	
	foreach ($default_styles as $key => $file) {
	
		$file = str_replace('.json', '', $file);
		$options .= '<option value="sample/'.$file.'">'.ucfirst($file).'</option>';
		
	}
	
	
	foreach ($results as $key => $template) {
	
		if($template->template == TEMPLATE) {
			$options .= '<option value="'.$template->id.'">'.$template->title.'</option>';
		}
	}
	
	?>
		
		<a href="#" class="uk-button-primary uk-button" id="load-config">Load Saved Settings</a>
		
		<select id="page-type-selector">
			<?php echo $options;?>
		</select>
<?php } ?>