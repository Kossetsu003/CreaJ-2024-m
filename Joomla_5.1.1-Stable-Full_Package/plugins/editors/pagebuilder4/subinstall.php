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
defined('_JEXEC') OR die('Restricted access');

jimport('joomla.filesystem.folder');

/**
 * Installer script.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class PlgEditorsPageBuilder4InstallerScript
{
	/**
	 * Handle preflight hook.
	 *
	 * @param   string      $route      Route type: install or update.
	 * @param   JInstaller  $installer  JInstaller object.
	 *
	 * @return  boolean
	 */
	public function preflight($route, $installer)
	{
		// Clear old build files.
		if (JFolder::exists(JPATH_ROOT . '/plugins/editors/pagebuilder4/assets/app'))
		{
			JFolder::delete(JPATH_ROOT . '/plugins/editors/pagebuilder4/assets/app');
		}

		return true;
	}

	/**
	 * Handle postflight hook.
	 *
	 * @param   string  $route      Route type: install, update or uninstall.
	 * @param   object  $installer  The installer object.
	 *
	 * @return  boolean
	 */
	public function postflight($route, $installer)
	{
		// Get a database connector object.
		$db = JFactory::getDbo();

		try
		{
			// Enable plugin by default.
			$db->setQuery(
				$db->getQuery(true)
					->update('#__extensions')
					->set(array('enabled = 1', 'client_id = 0', 'state = 0'))
					->where("element = 'pagebuilder4'")
					->where("type = 'plugin'")
					->where("folder = 'editors'")
			)->execute();
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}
}
