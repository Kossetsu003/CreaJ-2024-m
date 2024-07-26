<?php
/**
 * @version    $Id$
 * @package    JSN_Framework
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import necessary Joomla libraries
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

/**
 * Plugin for hooking into Joomla Update.
 *
 * @package  JSN_Framework
 * @since    1.0.0
 */
class PlgExtensionJsnExtFw extends JPlugin
{
	/**
	 * An instance of JSN Ext. Framework gen. 2 class.
	 *
	 * @var  PlgSystemJsnExtFw
	 */
	protected static $framework;

	protected function getFramework()
	{
		if (!isset(self::$framework))
		{
			// Initialize JSN Ext. Framework gen. 1.
			require_once dirname(dirname(dirname(__FILE__))) . '/system/jsnextfw/jsnextfw.php';

			self::$framework = new PlgSystemJsnExtFw(
				\JEventDispatcher::getInstance(),
				(array) \JPluginHelper::getPlugin('system', 'jsnextfw')
			);
		}

		return self::$framework;
	}

	/**
	 * Handle onExtensionBeforeInstall event.
	 *
	 * @param   string            $method     Installation method.
	 * @param   string            $type       Extension type.
	 * @param   SimpleXMLElement  $manifest   The extension's manifest object.
	 * @param   integer           $extension  Installed extension ID.
	 *
	 * @return  void
	 */
	public function onExtensionBeforeInstall($method, $type, $manifest, $extension)
	{
		// Check if the method is triggered within MyJoomla process?
		if (get_class(JFactory::getApplication()) === 'JApplicationMyjoomla')
		{
			return $this->getFramework()->onExtensionBeforeInstall($method, $type, $manifest, $extension);
		}
	}

	/**
	 * Handle onExtensionBeforeUpdate event.
	 *
	 * @param   string            $type      Extension type.
	 * @param   SimpleXMLElement  $manifest  The extension's manifest object.
	 * @param   string            $method    The current installation method.
	 *
	 * @return  void
	 */
	public function onExtensionBeforeUpdate($type, $manifest, $method = 'update')
	{
		// Check if the method is triggered within MyJoomla process?
		if (get_class(JFactory::getApplication()) === 'JApplicationMyjoomla')
		{
			return $this->getFramework()->onExtensionBeforeUpdate($type, $manifest, $method);
		}
	}

	/**
	 * Handle onExtensionAfterUninstall event.
	 *
	 * @param   JInstaller  $installer  Joomla installer object.
	 * @param   int         $eid        ID of the extension just uninstalled.
	 * @param   boolean     $result     Whether the uninstallation is success or not?
	 *
	 * @return  void
	 */
	public function onExtensionAfterUninstall($installer, $eid, $result)
	{
		// Get Joomla database object.
		$dbo = JFactory::getDbo();

		// Get all remaining components.
		$exts = $dbo->setQuery("SELECT element FROM #__extensions WHERE type = 'component';")->loadColumn();

		// Loop thru components to find the first one that depends on JSN Ext. Framework 2.
		foreach ($exts as $ext)
		{
			// Read manifest file.
			$xml = JPATH_ADMINISTRATOR . "/components/{$ext}/" . substr($ext, 4) . '.xml';

			if (JFile::exists($xml) && $xml = simplexml_load_file($xml))
			{
				if (isset($xml->group) && (string) $xml->group == 'jsnextfw')
				{
					return;
				}
			}
		}

		// Not found any component that depends on JSN Ext. Framework 2, uninstall it.
		$ids = $dbo->setQuery(
			$dbo->getQuery(true)
				->select('extension_id')
				->from('#__extensions')
				->where("type = 'plugin'")
				->where("element = 'jsnextfw'")
		)->loadColumn();

		if (empty($ids))
		{
			return;
		}

		foreach ($ids as $id)
		{
			// Unprotect the JSN Ext. Framework 2 plugin first.
			if ($dbo->setQuery("UPDATE #__extensions SET protected = 0 WHERE extension_id = {$id}")->execute())
			{
				// Uninstall the JSN Ext. Framework 2 plugin.
				JInstaller::getInstance()->uninstall('plugin', $id);
			}
		}
	}
}
