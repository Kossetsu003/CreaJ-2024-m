<?php
/**
 * @version    $Id$
 * @package    JSN Extension Framework 2
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// @formatter:off
?>
<div
	class="jsn-bootstrap4"
	data-render="api.ElementFeedback"
	data-modal-title="<?php echo $params['modalTitle']; ?>"
	data-modal-message="<?php echo $params['modalMessage']; ?>"
	data-form-title="<?php echo $params['formTitle']; ?>"
	data-question="<?php echo $params['question']; ?>"
	data-answers="<?php echo $params['answers']; ?>"
	data-custom-answer-text-label="<?php echo $params['customAnswerTextLabel']; ?>"
	data-cancel-button-text-label="<?php echo $params['cancelButtonTextLabel']; ?>"
	data-cancel-button-class-name="<?php echo $params['cancelButtonClassName']; ?>"
	data-submit-button-text-label="<?php echo $params['submitButtonTextLabel']; ?>"
	data-submit-button-class-name="<?php echo $params['submitButtonClassName']; ?>"
	data-feedback-receiver="<?php echo $params['feedbackReceiver']; ?>"
	data-reload-page-when-finish="<?php echo $params['reloadPageWhenFinish'] ? 'true' : 'false'; ?>"
></div>
