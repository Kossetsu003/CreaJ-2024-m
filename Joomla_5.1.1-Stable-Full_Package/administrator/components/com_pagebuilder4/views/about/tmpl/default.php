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
?>
<form
	id="adminForm"
	name="adminForm"
	method="post"
	action="<?php echo JRoute::_('index.php?option=com_pagebuilder4&view=about'); ?>"
>
	<?php if (method_exists('JsnExtFwHelper', 'isJoomla4') && JsnExtFwHelper::isJoomla4()) : ?>
	<div id="j-main-container" class="span12">
	<?php else : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php endif; ?>
		<?php
			JsnExtFwHtml::renderAboutPage(
				'com_pagebuilder4',
				JUri::root(true)
				. '/administrator/components/com_pagebuilder4/assets/images/logo-large.png',
                JsnExtFwText::translate(array(
                	'PAGEBUILDER4_TRY_PRO_TITLE',
	                'PAGEBUILDER4_TRY_PRO_MESSAGE'
                ))
			);
		?>
	</div>
</form>
<?php
// Render header.
JSNPageBuilder4Helper::renderHeader();

// Render footer.
JSNPageBuilder4Helper::renderFooter('About');
