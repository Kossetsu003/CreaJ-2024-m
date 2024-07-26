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

// No direct access to this file.
defined('_JEXEC') or die('Restricted access');

/**
 * Class for requesting feedback.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwAjaxFeedback extends JsnExtFwAjax
{
	/**
	 * Get feedback options from JoomlaShine.
	 *
	 * @return  void
	 */
	public function getPredefinedAnswersAction()
	{
		throw new Exception("This feature has been removed", 410);
		return;
		/*
		// Get current settings.
		$params = JsnExtFwHelper::getSettings($this->component, true);

		if (empty($params) || empty($params['token']))
		{
			throw new Exception(JText::_('JSN_EXTFW_MISSING_TOKEN_KEY'));
		}

		// Build URL for retrieving feedback options.
		$link = JSN_GET_FEEDBACK_OPTIONS_URL . "&token={$params['token']}";

		// Get feedback options.
		$this->setResponse(JsnExtFwHttp::get($link, 60 * 60));
		*/
	}

	/**
	 * Send feedback then uninstall the specified component.
	 *
	 * @param   boolean  $doNotUninstall  Whether to just send feedback but don't uninstall the component.
	 *
	 * @return  void
	 */
	public function sendUninstallFeedbackAction($doNotUninstall = false)
	{
		throw new Exception("This feature has been removed", 410);
		return;
		
		// Prevent recursion call.
		/*static $uninstalling;

		if (isset($uninstalling) && $uninstalling === $this->component)
		{
			return;
		}

		if (JFactory::getUser()->authorise('core.delete', 'com_installer'))
		{
			// Get current settings.
			$params = JsnExtFwHelper::getSettings($this->component, true);

			if ($params && !empty($params['token']))
			{
				// Get feedback data.
				$feedback_option  = $this->input->getString('reason');
				$feedback_content = $this->input->getString('experience');

				// Build URL for posting uninstall feedback.
				$link = JSN_POST_CUSTOMER_FEEDBACK_URL;
				$link .= '&identified_name=' . JsnExtFwHelper::getConstant('IDENTIFIED_NAME', $this->component);
				$link .= '&domain=' . JUri::getInstance()->toString(array('host'));
				$link .= "&token={$params['token']}";

				// Send uninstall feedback.
				try
				{
					JsnExtFwHttp::post($link, compact('feedback_option', 'feedback_content'));
				}
				catch (\Exception $e)
				{
					// Do nothing.
				}
			}

			// Get the extension ID of the component being uninstalled.
			if (!$doNotUninstall)
			{
				$eid = $this->dbo->setQuery(
					$this->dbo->getQuery(true)
						->select('extension_id')
						->from('#__extensions')
						->where("type = 'component'")
						->where("element = '{$this->component}'")
				)->loadResult();

				// Uninstall the component.
				$uninstalling = $this->component;

				JInstaller::getInstance()->uninstall('component', $eid);

				unset($uninstalling);
			}
		}
		else
		{
			throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
		}
		*/
	}
}
