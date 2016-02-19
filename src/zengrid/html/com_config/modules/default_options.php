<?php
/**
 * @package     Joomla.site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$fieldSets = $this->form->getFieldsets('params');

echo JHtml::_('bootstrap.startAccordion', 'collapseTypes');
$i = 0;

foreach ($fieldSets as $name => $fieldSet) :

$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_MODULES_' . $name . '_FIELDSET_LABEL';
$class = isset($fieldSet->class) && !empty($fieldSet->class) ? $fieldSet->class : '';


if (isset($fieldSet->description) && trim($fieldSet->description)) :
echo '<p class="tip">' . $this->escape(JText::_($fieldSet->description)) . '</p>';
endif;
?>
<?php echo JHtml::_('bootstrap.addSlide', 'collapseTypes', JText::_($label), 'collapse' . ($i++)); ?>

<ul class="nav nav-tabs nav-stacked">
<?php foreach ($this->form->getFieldset($name) as $field) : ?>

	<li>
		<div class="control-group">
			<div class="control-label">
				<?php echo $field->label; ?>
			</div>
			<div class="controls">
				<?php
				// If multi-language site, make menu-type selection read-only
				if (JLanguageMultilang::isEnabled() && $this->item['module'] == 'mod_menu' && $field->getAttribute('name') == 'menutype')
				{
					$field->__set('readonly', true);
				}
				echo $field->input;
				?>
			</div>
		</div>
	</li>

<?php endforeach; ?>
</ul>

<?php echo JHtml::_('bootstrap.endSlide'); ?>
<?php endforeach; ?>
<?php echo JHtml::_('bootstrap.endAccordion'); ?>


<script>
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

(function($)
{
	$(document).ready(function()
	{
		$('*[rel=tooltip]').tooltip();
		
		// Create accordion
		$('.accordion-body').show();
		
		$(document).on('click', '.accordion-heading', function() {
			$(this).parent().find('.accordion-body').slideToggle().toggleClass('in');
			return false;
		});

		// Turn radios into btn-group
		$('.radio.btn-group label').addClass('btn');
		$(".btn-group label:not(.active)").click(function()
		{
			var label = $(this);
			var input = $('#' + label.attr('for'));

			if (!input.prop('checked')) {
				label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
				if (input.val() == '') {
					label.addClass('active btn-primary');
				} else if (input.val() == 0) {
					label.addClass('active btn-danger');
				} else {
					label.addClass('active btn-success');
				}
				input.prop('checked', true);
			}
		});
		$(".btn-group input[checked=checked]").each(function()
		{
			if ($(this).val() == '') {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
			} else if ($(this).val() == 0) {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
			} else {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
			}
		});
		
		// Destory Chosen for the framework
		if(jQuery().chosen) {
			$('#modules-form select').chosen('destroy');			
		}
	})
})(jQuery);
</script>

