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
<div class="jsn-bootstrap">
	<div class="jsn-installer-container">
		<form id="jsn-installer" name="JSNInstaller" method="POST" class="form-horizontal" action="<?php echo JRoute::_('index.php'); ?>">
			<div id="jsn-installer-finalization">
				<div class="control-group">
					<label class="checkbox" for="jsn-installer-live-update-notification">
						<input type="checkbox" value="1" name="live_update_notification" id="jsn-installer-live-update-notification" />
						<strong><?php echo JText::sprintf('JSN_EXTFW_INSTALLER_LIVE_UPDATE_NOTIFICATION_LABEL', preg_replace('/^JSN\s*/i', '', JText::_((string) $this->xml->name))); ?></strong>
					</label>
					<p><?php echo str_replace('__PRODUCT__', JText::_((string) $this->xml->name), JText::_('JSN_EXTFW_INSTALLER_LIVE_UPDATE_NOTIFICATION_DESC')); ?></p>
				</div>
				<div class="button-holder">
					<button class="btn btn-primary" type="submit">
						<?php echo JText::_('JSN_EXTFW_INSTALLER_CLICK_TO_FINALIZE'); ?>
					</button>
				</div>
				<div class="clr"></div>
			</div>

			<input type="hidden" name="option" value="<?php echo $this->input->getCmd('option'); ?>" />
			<input type="hidden" name="view" value="<?php echo $this->input->getCmd('view'); ?>" />
			<input type="hidden" name="task" value="finalize" />
		</form>
		<?php if (isset($this->script)) : ?>
		<script src="<?php echo $this->script; ?>" type="text/javascript"></script>
		<?php endif; ?>
	</div>
</div>
