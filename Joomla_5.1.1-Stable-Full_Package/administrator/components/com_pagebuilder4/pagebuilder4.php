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

// Get application object
$app = JFactory::getApplication();

// Get input object
$input = $app->input;

// Access check
$task = $input->getCmd('task');
$view = $input->getCmd('view', ( $pos = strpos($task, '.') ) !== false ? substr($task, 0, $pos) : 'manage');
$auth = false;

if (in_array($view, array(
	'ajax',
	'about',
	'help'
)))
{
	if ($input->getMethod() == 'GET' || JFactory::getUser()->authorise('core.manage', $input->getCmd('option')))
	{
		$auth = true;
	}
}
elseif (JFactory::getUser()->authorise('core.admin', $input->getCmd('option')))
{
	$auth = true;
}

if (!$auth)
{
	JFactory::getApplication()->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'warning');
	return;
}

// Initialize common assets
require_once JPATH_COMPONENT_ADMINISTRATOR . '/bootstrap.php';

// Check if all dependency is installed
require_once JPATH_COMPONENT_ADMINISTRATOR . '/dependency.php';

// Get the appropriate controller
$controller = JControllerLegacy::getInstance('JSNPageBuilder4');

// Perform the request task
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
