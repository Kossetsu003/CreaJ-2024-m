<?php
/**
 * @version    $Id$
 * @package    JSN_PageBuilder_4
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleExtensions', null, array(
	'placeholder_text_multiple' => JText::_('JSN_PAGEBUILDER4_SELECT_EXTENSION')
));
JHtml::_('formbehavior.chosen', '.multipleAuthors', null, array(
	'placeholder_text_multiple' => JText::_('JSN_PAGEBUILDER4_SELECT_AUTHOR')
));
JHtml::_('formbehavior.chosen', '.multipleEditors', null, array(
	'placeholder_text_multiple' => JText::_('JSN_PAGEBUILDER4_SELECT_EDITOR')
));
JHtml::_('formbehavior.chosen', 'select');

$app       = JFactory::getApplication();
$ordering  = $this->escape($this->state->get('list.ordering'));
$direction = $this->escape($this->state->get('list.direction'));
$columns   = 10;
?>
<form
	action="<?php echo JRoute::_('index.php?option=com_pagebuilder4&view=manage'); ?>"
	method="post"
	name="adminForm"
	id="adminForm"
>
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php
		// Search tools bar
		echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		?>
		<?php if (empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
		<?php else : ?>
		<table class="table table-striped" id="pageList">
			<thead>
				<tr>
					<th width="1%" class="center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
                    <th width="1%" class="nowrap center">
						<?php echo JHtml::_('searchtools.sort', 'JSN_PAGEBUILDER4_HEADING_STATUS', 'state', $direction, $ordering); ?>
                    </th>
					<th width="20%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort',  'JSN_PAGEBUILDER4_HEADING_TITLE', 'title', $direction, $ordering); ?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort',  'JSN_PAGEBUILDER4_HEADING_EXTENSION', 'a.extension', $direction, $ordering); ?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort',  'JSN_PAGEBUILDER4_HEADING_CREATED_BY', 'author_name', $direction, $ordering); ?>
					</th>
					<th width="10%" class="center nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'JSN_PAGEBUILDER4_HEADING_CREATED_DATE', 'a.created', $direction, $ordering); ?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort',  'JSN_PAGEBUILDER4_HEADING_MODIFIED_BY', 'editor_name', $direction, $ordering); ?>
					</th>
					<th width="10%" class="center nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'JSN_PAGEBUILDER4_HEADING_MODIFIED_DATE', 'a.modified', $direction, $ordering); ?>
					</th>
					<th width="1%" class="center nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'JSN_PAGEBUILDER4_HEADING_REVISIONS', 'revisions', $direction, $ordering); ?>
					</th>
					<th width="1%" class="center nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $direction, $ordering); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="<?php echo $columns; ?>">
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($this->items as $i => $item) : ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
                    <td class="center">
                        <div class="btn-group">
							<?php
                            // Get item state.
                            $state = current(array_filter(
	                            $app->triggerEvent('onPageBuilder4GetItemState', array($item)),
                                'is_numeric'
                            ));
                            echo JHtml::_('jgrid.published', $state, $i, 'manage.', true, 'cb');
                            ?>
                        </div>
                    </td>
					<td>
						<?php
						// Get edit link.
						$link = current(array_filter(
							$app->triggerEvent('onPageBuilder4GetEditLink', array($item))
                        ));
						?>
						<a class="hasTooltip" href="<?php echo $link; ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
							<?php
							// Get item title.
							$title = current(array_filter(
								$app->triggerEvent('onPageBuilder4GetItemTitle', array($item))
							));
							echo $this->escape($title);
							?>
                        </a>
					</td>
					<td class="small hidden-phone">
						<?php
						// Load extension language file.
						JFactory::getLanguage()->load("{$item->extension}.sys");
						echo JText::_(strtoupper($item->extension));
						?>
					</td>
					<td class="small hidden-phone">
						<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id=' . (int) $item->created_by); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
						    <?php echo $this->escape($item->author_name); ?>
                        </a>
					</td>
					<td class="center nowrap small hidden-phone">
						<?php
						$date = $item->created;
						echo $date > 0 ? JHtml::_('date', $date, JText::_('DATE_FORMAT_LC4')) : '-';
						?>
					</td>
					<td class="small hidden-phone">
						<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id=' . (int) $item->modified_by); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
							<?php echo $this->escape($item->editor_name); ?>
                        </a>
					</td>
					<td class="center nowrap small hidden-phone">
						<?php
						$date = $item->modified;
						echo $date > 0 ? JHtml::_('date', $date, JText::_('DATE_FORMAT_LC4')) : '-';
						?>
					</td>
					<td class="center hidden-phone">
						<?php echo (int) $item->revisions; ?>
					</td>
					<td class="center hidden-phone">
						<?php echo (int) $item->id; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php endif; ?>

		<?php echo $this->pagination->getListFooter(); ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<?php
// Render header.
JSNPageBuilder4Helper::renderHeader();

// Render footer.
JSNPageBuilder4Helper::renderFooter('Page Manager');
