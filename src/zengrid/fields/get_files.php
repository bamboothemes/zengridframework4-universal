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

$layouts = $zgf->get_files($folder, $target); 

$display = 1;

if($show_empty =="0") {
	$file_count = count($layouts);
	
	if($file_count < 2) {
		$display = 0;
	}
}

if($display) {
?>


<p class="<?php echo $class;?>">
	<?php echo $label;?>
</p>

<select id="<?php echo $name;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">
	<?php foreach ($layouts as $key => $option) {
	
			$option = str_replace('.less', '', $option);
			
			if($option == $value) {
				echo  '<option selected value="'.$option.'">'.$option.'</option>';
			} else {
				echo  '<option value="'.$option.'">'.$option.'</option>';
			}
		} 	
	?>
</select>
<?php } ?>