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

// Generate link to get config for admin bar settings.
$link = JSession::getFormToken();
$link = JRoute::_(
	sprintf('index.php?option=com_pagebuilder4&task=ajax.getAdminBarSettingsConfig&%1$s=1', $link), false
);
?>
<form
	id="adminForm"
	name="adminForm"
	method="post"
	action="<?php echo JRoute::_('index.php?option=com_pagebuilder4&view=config'); ?>"
>
	<?php if (method_exists('JsnExtFwHelper', 'isJoomla4') && JsnExtFwHelper::isJoomla4()) : ?>
	<div id="j-main-container" class="span12">
	<?php else : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php endif; ?>
		<div class="jsn-bootstrap4">
			<div class="jsn-content-main jsn-settings">
				<div class="horizontal-form">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item active">
							<a
                                class="nav-link"
                                id="general-tab"
                                data-toggle="tab"
                                href="#general-pane"
                                role="tab"
                            >
								<?php echo JText::_('JSN_PAGEBUILDER4_CONFIG_GENERAL'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a
                                class="nav-link"
                                id="integration-tab"
                                data-toggle="tab"
                                href="#integration-pane"
                                role="tab"
                            >
								<?php echo JText::_('JSN_PAGEBUILDER4_CONFIG_INTEGRATION'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a
                                class="nav-link"
                                id="languages-tab"
                                data-toggle="tab"
                                href="#languages-pane"
                                role="tab"
                            >
								<?php echo JText::_('JSN_EXTFW_CONFIGURATION_LANGUAGE'); ?>
							</a>
						</li>
				
						
						<li class="nav-item">
							<a
                                class="nav-link"
                                id="global-params-tab"
                                data-toggle="tab"
                                href="#global-params-pane"
                                role="tab"
                            >
								<?php echo JText::_('JSN_EXTFW_CONFIGURATION_GLOBAL_PARAMETERS'); ?>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="general-pane" role="tabpanel">
							<?php
                            JsnExtFwHtml::renderSettingsForm(
                                'com_pagebuilder4',
                                '#toolbar-apply a, #toolbar-apply .button-apply, #toolbar-apply .btn-success',
                                null,
                                'config/general.json'
                            );
                            ?>
						</div>
						<div class="tab-pane fade" id="integration-pane" role="tabpanel">
							<?php
                            JsnExtFwHtml::renderSettingsForm(
                                'com_pagebuilder4',
                                '#toolbar-apply a, #toolbar-apply .button-apply, #toolbar-apply .btn-success',
                                null,
	                            $this->integration_form
                            );
                            ?>
						</div>
						<div class="tab-pane fade" id="languages-pane" role="tabpanel">
							<?php
                            JsnExtFwHtml::renderLanguageForm('com_pagebuilder4', '#save-languages');
                            ?>

							<hr />

							<button id="save-languages" type="button" class="btn btn-primary d-block mx-auto">
								<?php echo JText::_('JSN_EXTFW_INSTALL_SELECTED_LANGUAGES'); ?>
							</button>
						</div>
					
						
						<div class="tab-pane fade" id="global-params-pane" role="tabpanel">
							<?php JsnExtFwHtml::renderSettingsForm(
                                'jsnextfw',
                                '#toolbar-apply a, #toolbar-apply .button-apply, #toolbar-apply .btn-success',
                                null,
                                'config/framework.json'
                            );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php
// Render header.
JSNPageBuilder4Helper::renderHeader();

// Render footer.
JSNPageBuilder4Helper::renderFooter('Settings');
