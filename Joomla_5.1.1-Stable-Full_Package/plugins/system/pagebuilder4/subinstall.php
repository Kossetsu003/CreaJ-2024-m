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
defined( '_JEXEC' ) OR die( 'Restricted access' );

/**
 * Installer script
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class PlgSystemPageBuilder4InstallerScript
{
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
					->where("folder = 'system'")
			)->execute();
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}
}
