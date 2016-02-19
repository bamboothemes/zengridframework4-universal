<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<ul class="search-results<?php echo $this->pageclass_sfx; ?> zen-nav zen-menu-vertical zen-nav-lines">
	<?php foreach ($this->results as $result) : ?>
		<li>
			<h3>
				<?php echo $this->pagination->limitstart + $result->count . '. '; ?>
				<?php if ($result->href) : ?>
					
						<a href="<?php echo JRoute::_($result->href); ?>"
							<?php if ($result->browsernav == 1) : ?>
								target="_blank"
							<?php endif; ?>>
							<?php echo $this->escape($result->title); ?>
						</a>
					
				<?php else: ?>
					
						<?php echo $this->escape($result->title); ?>
					
				<?php endif; ?>
			</h3>
		<?php if ($result->section) : ?>
			<p class="result-category">
			<span class="small<?php echo $this->pageclass_sfx; ?>">
				(<?php echo $this->escape($result->section); ?>)
			</span>
			</p>
		<?php endif; ?>
		<p class="result-text">
			<?php echo $result->text; ?>
		</p>
		<?php if ($this->params->get('show_date')) : ?>
			<p class="result-created<?php echo $this->pageclass_sfx; ?>">
				<span class="small<?php echo $this->pageclass_sfx; ?>">
					<?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', '<strong>' . $result->created . '</strong>'); ?>
				</span>
			</p>
		<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>

<div class="pagination-wrap">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
