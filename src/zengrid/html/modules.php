<?php
defined('_JEXEC') or die('Restricted access');

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * three arguments.
 */


/**
 * Custom module chrome, echos the whole module in a <div> and the header in <h{x}>. The level of
 * the header can be configured through a 'headerLevel' attribute of the <jdoc:include /> tag.
 * Defaults to <h3> if none given
 */
 
 
 function modChrome_simple($module, &$params, &$attribs)
 {
 	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx'))?"<span class=\"badge\">&nbsp;</span>\n":"";
 	
 	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));
 	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
 	$moduleClass    = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';
 		
 	// Temporarily store header class in variable
 	$headerClass	= $params->get('header_class');
 	$headerClass	= !empty($headerClass) ? ' class="zen-module-title title ' . htmlspecialchars($headerClass) . '"' : '';
      
 	if (!empty ($module->content)) : 
 	
 	 	if ($module->showtitle) : ?>
 		
 			<<?php echo $headerTag . $headerClass ?>><span><?php echo $module->title; ?></span></<?php echo $headerTag;?>>
 		
 			<?php endif; 
 			
 			 echo $module->content;  ?>
 			
 	<?php endif;  
 }
 
 
 
 

function modChrome_zendefault($module, &$params, &$attribs)
{
	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx'))?"<span class=\"badge\">&nbsp;</span>\n":"";
	
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));
	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
	$moduleClass    = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';
			
	// Temporarily store header class in variable
	$headerClass	= $params->get('header_class');
	$headerClass	= !empty($headerClass) ? ' class="zen-module-title title ' . htmlspecialchars($headerClass) . '"' : '';
     
	if (!empty ($module->content)) : ?>

		<div class="moduletable <?php echo $params->get('moduleclass_sfx'); ?>">
			<div class="module-inner">
				<?php echo $badge; 
			
				if ($module->showtitle) : ?>
			
					<div class="zen-module-title">
						<<?php echo $headerTag . $headerClass ?>><span><?php echo $module->title; ?></span></<?php echo $headerTag;?>>
					</div>
				<?php endif; ?>
			
				<div class="zen-module-body">
					<?php echo $module->content; ?>
				</div>
			</div>
		</div>
	<?php endif;  
}


function modChrome_zentabs($module, $params, $attribs)
{


	// Todo move this to nonbs option
	JHtml::_('bootstrap.framework');

	$area = isset($attribs['id']) ? (int) $attribs['id'] :'1';
		$area = 'area-'.$area;
	
		static $modulecount;
		static $modules;
	
		if ($modulecount < 1) {
			$modulecount = count(JModuleHelper::getModules($module->position));
			$modules = array();
		}
	
		if ($modulecount == 1) {
			$temp = new stdClass;
			$temp->content = $module->content;
			$temp->title = $module->title;
			$temp->params = $module->params;
			$temp->id = $module->id;
			$modules[] = $temp;
	
			// list of moduletitles
			echo '<ul class="nav nav-tabs" id="tab'.$temp->id .'">';
	
			foreach($modules as $rendermodule) {
				echo '<li><a data-toggle="tab" href="#module-'.$rendermodule->id.'" >'.$rendermodule->title.'</a></li>';
			}
			echo '</ul>';
			echo '<div class="tab-content">';
			$counter = 0;
			// modulecontent
			foreach($modules as $rendermodule) {
				$counter ++;
	
				echo '<div class="tab-pane fade in '.$params->get('moduleclass_sfx').'" id="module-'.$rendermodule->id.'">';
				echo $rendermodule->content;
				
				echo '</div>';
			}
			echo '</div>';
			echo '<script type="text/javascript">';
			echo 'jQuery(document).ready(function(){';
				echo 'jQuery("#tab'.$temp->id.' a:first").tab("show")';
				echo '});';
			echo '</script>';
			$modulecount--;
	
		} else {
			$temp = new stdClass;
			$temp->content = $module->content;
			$temp->params = $module->params;
			$temp->title = $module->title;
			$temp->id = $module->id;
			$modules[] = $temp;
			$modulecount--;
	}
}


function modChrome_zenslider($module, &$params, &$attribs)
{
	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx'))?"<span class=\"badge\">&nbsp;</span>\n":"";
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
?>
<div class="moduletable <?php echo $params->get('moduleclass_sfx'); ?> slidemodule">
<div class="moduleslide-<?php echo $module->id ?> zg-collapse-trigger zg-collapsed" data-toggle="collapse" data-target="#slidecontent-<?php echo $module->id ?>">
 	<h<?php echo $headerLevel; ?>><span class="fa fa-chevron-up zen-icon zen-icon-chevron-up"></span><span><?php echo $module->title; ?></span></h<?php echo $headerLevel; ?>>
</div>
 
<div id="slidecontent-<?php echo $module->id ?>" class="zg-collapse-<?php echo $module->id ?> zen-in slide-content"><?php echo $module->content; ?></div>

	 <script type="text/javascript">;
			jQuery(document).ready(function($){;
				jQuery(".moduleslide-<?php echo $module->id ?>").click(function() {
					
					$(this).next('.slide-content').slideToggle();
					$(this).find('.zen-icon').toggleClass('zen-icon-chevron-down fa-chevron-down');
					$('.moduleslide-<?php echo $module->id ?> .toggler').toggleClass('icon-chevron-down fa-chevron-down');
					return false;
				});
				
			});
	</script>
</div>
<?php } 