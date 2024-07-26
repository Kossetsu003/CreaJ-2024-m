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

// Register necessary helper classes.
JLoader::register(
	'JSNPageBuilder4Helper',
	JPATH_ADMINISTRATOR . '/components/com_pagebuilder4/helpers/pagebuilder4.php'
);

// Import necessary Joomla libraries
jimport('joomla.application.component.model');
jimport('joomla.filesystem.archive');
jimport('joomla.filesystem.file');
jimport('joomla.installer.installer');

// Define product version caching expiration time
defined('CHECK_UPDATE_PERIOD') || define('CHECK_UPDATE_PERIOD', 86400);

/**
 * Model class of JSN Installer library.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JSNInstallerModel extends JModelLegacy
{

	/**
	 * Base download link.
	 *
	 * @var  string
	 */
	protected $downloadLink = '';

	/**
	 * Check version link.
	 *
	 * @var  string
	 */
	protected $checkLink = '';

	/**
	 * Parsed check update URL.
	 *
	 * @var	array
	 */
	protected static $versions;

	/**
	 * Constructor
	 *
	 * @param   array  $config  An array of configuration options.
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Load language manually
		$lang = JFactory::getLanguage();
		$lang->load('jsn_installer', JPATH_COMPONENT_ADMINISTRATOR . '/libraries/joomlashine/installer');

		// Get application object
		$this->app = JFactory::getApplication();

		// Get input object
		$this->input = $this->app->input;

		// Get Joomla config
		$this->config = JFactory::getConfig();
	}

	/**
	 * Download dependency package.
	 *
	 * @return  string  Package name.
	 */
	/*public function download()
	{
		// Get dependency declaration
		$extension = (object) $_GET;

		// Get product edition
		$edition = $this->getEdition();

		// Get Joomla version
		$jv = JSNPageBuilder4Helper::getJoomlaVersion(2);

		// Store username/password
		$this->app->setUserState('jsn.installer.customer.username', $this->input->getUsername('customer_username'));
		$this->app->setUserState('jsn.installer.customer.password', $this->input->getString('customer_password'));

		// Get download link
		$url = $this->getLink($extension, $jv);

		// Generate file name for depdendency package
		$name[] = 'jsn';
		$name[] = $extension->identified_name;

		if ($edition)
		{
			$name[] = strtolower(str_replace(' ', '-', isset($extension->edition) ? $extension->edition : $edition));
		}

		$name[] = 'j' . $jv;
		$name[] = 'install.zip';
		$name = implode('_', $name);

		// Try to download the update package
		try
		{
			// Check if temporary directory exists
			if (!$this->config->get('ftp_enable') &&
				 ( !is_dir($this->config->get('tmp_path')) || !is_writable($this->config->get('tmp_path')) ))
			{
				throw new Exception('FAIL:' . JText::_('JSN_EXTFW_INSTALLER_TEMPORARY_DIRECTORY_NOT_WRITABLE') . '|' . $url);
			}

			// Set maximum execution time
			ini_set('max_execution_time', 300);

			// Get package data
			$result = $this->fetchHttp($url);

			// Validate downloaded data
			if (strlen($result) < 10)
			{
				// Get LightCart error code
				throw new Exception(JText::_('JSN_EXTFW_LIGHTCART_ERROR_' . $result));
			}

			// Store downloaded package data to temporary directory
			if (!JFile::write($this->config->get('tmp_path') . '/' . $name, $result))
			{
				throw new Exception('FAIL:' . JText::_('JSN_EXTFW_INSTALLER_PACKAGE_SAVING_FAILED') . '|' . $url);
			}
		}
		catch (Exception $e)
		{
			throw $e;
		}

		return $name;
	}*/

	/**
	 * Install dependency package.
	 *
	 * @return  string
	 */
	/*public function install()
	{
		// Get dependency declaration
		$extension = (object) $_GET;

		// Get product edition
		$edition = $this->getEdition();

		// Get Joomla version
		$jv = JSNPageBuilder4Helper::getJoomlaVersion(2);

		// Get download link
		$url = $this->getLink($extension, $jv);

		// Finalize upload
		if (isset($_FILES['package']))
		{
			if (!JFile::upload($_FILES['package']['tmp_name'], $this->config->get('tmp_path') . '/' . $_FILES['package']['name']))
			{
				throw new Exception('FAIL:' . JText::_('JSN_EXTFW_INSTALLER_PACKAGE_SAVING_FAILED') . '|' . $url);
			}

			$this->input->set('package', $_FILES['package']['name']);
		}

		if ($this->input->getString('package'))
		{
			// Initialize dependency package path
			$file = $this->config->get('tmp_path') . '/' . $this->input->getString('package');
			$path = substr($file, 0, -4);

			if (!is_file($file))
			{
				// Check temporary directory existen
				if (!$this->config->get('ftp_enable') && ( !is_dir($this->config->get('tmp_path')) || !is_writable($this->config->get('tmp_path')) ))
				{
					throw new Exception('FAIL:' . JText::_('JSN_EXTFW_INSTALLER_TEMPORARY_DIRECTORY_NOT_WRITABLE') . '|' . $url);
				}
				else
				{
					throw new Exception(
						'FAIL:' . JText::sprintf('JSN_EXTFW_INSTALLER_PACKAGE_NOT_FOUND', $this->input->getString('package')) . '|' . $url);
				}
			}

			$extension->source = $path;

			// Extract dependency package
			if (class_exists('JArchive'))
			{
				if (!JArchive::extract($file, $path))
				{
					throw new Exception('FAIL:' . JText::_('JSN_EXTFW_INSTALLER_EXTRACT_PACKAGE_FAIL') . '|' . $url);
				}
			}
			else
			{
				$archive = new Joomla\Archive\Archive(array('tmp_path' => $this->config->get('tmp_path')));

				if (!$archive->extract($file, $path))
				{
					throw new Exception('FAIL:' . JText::_('JSN_EXTFW_INSTALLER_EXTRACT_PACKAGE_FAIL') . '|' . $url);
				}
			}

			// Switch off debug mode to catch JInstaller error message manually
			$config = JFactory::getConfig();
			$debug = $config->get('debug');

			$config->set('debug', version_compare($jv, '3.0', '<') ? false : true);

			// Get JSN Installer
			require_once JPATH_COMPONENT_ADMINISTRATOR . '/subinstall.php';

			$installer = $this->input->getCmd('option') . 'InstallerScript';
			$installer = new $installer();

			try
			{
				$installer->installExtension($extension);
			}
			catch (Exception $e)
			{
				throw $e;
			}

			// Clean-up temporary folder and file
			JFolder::delete($extension->source);
			JFile::delete("{$extension->source}.zip");

			// Restore debug settings
			$config->set('debug', $debug);

			// Check if installation success
			$messages = JFactory::getApplication()->getMessageQueue();

			foreach ($messages as $message)
			{
				if (( is_array($message) && @$message['type'] == 'error' ) ||
					 ( is_object($message) && ( !method_exists($message, 'get') || $message->get('level') == E_ERROR ) ))
				{
					$errors[is_array($message) ? $message['message'] : $message->getMessage()] = 1;
				}
			}

			if (@count((array) $errors))
			{
				throw new Exception('<ul><li>' . implode('</li><li>', array_keys($errors)) . '</li></ul>');
			}
		}
		else
		{
			throw new Exception('FAIL:' . JText::_('JSN_EXTFW_INSTALLER_MISSING_PACKAGE_NAME') . '|' . $url);
		}

		return 'SUCCESS';
	}*/

	/**
	 * Finalize dependency installation.
	 *
	 * @return  void
	 */
	/*public function finalize()
	{
		try
		{
			// Save live update notification setting.
			if (class_exists('JsnExtFwHelper'))
			{
				$input = JFactory::getApplication()->input;

				JsnExtFwHelper::saveSettings($input->getCmd('option'),
					array(
						'live_update_notification' => (int) $input->get('live_update_notification')
					), true);
			}

			if (class_exists('JsnExtFwClient'))
			{
				JsnExtFwClient::postInfo();
			}
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}*/

	/**
	 * Check dependency.
	 *
	 * @param   array  &$dependencies  An array of dependency package.
	 * @param   bool   $checkUpdate    Whether to check for dependency update or not?
	 *
	 * @return  mixed
	 */
	/*public function check(&$dependencies, $checkUpdate = true)
	{
		// Initialize variables
		$missingDependency = 0;
		$authenticationRequired = false;

		// Get product edition
		$edition = $this->getEdition();

		// Get object for working with extension table
		$extension = JTable::getInstance('Extension');

		// Get installed Joomla version
		$jv = JSNPageBuilder4Helper::getJoomlaVersion(2);

		// Check dependency
		foreach ($dependencies as & $dependency)
		{
			if ($dependency instanceof SimpleXMLElement)
			{
				$tmp = (array) $dependency;
				$tmp = (object) $tmp['@attributes'];
				$tmp->title = trim(
					(string) $dependency != '' ? (string) $dependency : ( $dependency['title'] ? (string) $dependency['title'] : $tmp->name ));

				$dependency = $tmp;
			}

			// Skip dependency that is being removed
			if (isset($dependency->remove) && $dependency->remove)
			{
				continue;
			}

			// Build dependency path
			switch ($dependency->type = strtolower($dependency->type))
			{
				case 'component':
				case 'module':
					$path = ( ( !isset($dependency->client) || $dependency->client != 'site' ) ? JPATH_BASE : JPATH_ROOT ) .
						 "/{$dependency->type}s";
				break;

				case 'plugin':
					$path = JPATH_ROOT . '/plugins/' . $dependency->folder;
				break;

				case 'template':
					$path = JPATH_ROOT . '/templates';
				break;
			}

			$path .= '/' . $dependency->name;

			// Check if dependency is installed
			$installed = file_exists($path) ? true : false;

			if (!$checkUpdate)
			{
				$installed ? ( $dependency->upToDate = true ) : $missingDependency++;

				// Continue immediately because checking for dependency update is disabled
				continue;
			}

			// Check if dependency has newer version
			if ($installed)
			{
				// Load dependency details
				$extension->load(
					array(
						'type' => $dependency->type,
						'element' => $dependency->name,
						'folder' => isset($dependency->folder) ? $dependency->folder : ''
					));

				// Get currently installed dependency version
				$current = json_decode($extension->manifest_cache);
				$current = ( is_object($current) && isset($current->version) ) ? $current->version : '0.0.0';
			}
			else
			{
				$current = '0.0.0';
			}

			// Get latest version for dependency
			if (!isset($dependency->identified_name) ||
				 !( $result = $this->hasUpdate($dependency->identified_name, $current, $jv) ) ||
				 ( $hasError = $result instanceof Exception ))
			{
				// Store errors
				!isset($result) || !$result || !$hasError || $errors[] = $result->getMessage();

				// Skip listing if dependency is up-to-date
				( version_compare($current, '0.0.0', 'gt') || !isset($dependency->identified_name) ) ? ( $dependency->upToDate = true ) : $missingDependency++;
			}
			else
			{
				$missingDependency++;

				// Is authentication required?
				$authentication = false;

				if (isset($result->authentication) && $result->authentication)
				{
					$authentication = true;
				}
				elseif (isset($result->editions))
				{
					foreach ($result->editions as $item)
					{
						if (strcasecmp($item->edition, $edition) == 0 && $item->authentication)
						{
							$authentication = true;
						}
					}
				}

				// Prepare for authentication
				if ($authentication)
				{
					$authenticationRequired = true;
					$dependency->edition = str_replace(' ', '+', trim(isset($result->edition) ? $result->edition : $edition));
				}
			}
		}

		if ($missingDependency == 0)
		{
			$this->saveDependency($dependencies);

			return -1;
		}

		return isset($errors) ? $errors : $authenticationRequired;
	}*/

	/**
	 * Get product edition.
	 *
	 * @return  string
	 */
	/*public function getEdition()
	{
		$edition = 'JSN_' . strtoupper(substr($this->input->getCmd('option'), 4)) . '_EDITION';

		if (defined($edition))
		{
			eval('$edition = ' . $edition . ';');
		}
		else
		{
			$edition = null;
		}

		return $edition;
	}*/

	/**
	 * Method to get latest dependency version.
	 *
	 * @param   string  $identified_name        Dependency's identified name.
	 * @param   string  $current_version        Current dependency version.
	 * @param   string  $requiredJoomlaVersion  Joomla version required by extension, e.g. 2.5, 3.0, etc.
	 * @param   object  $version                Latest version object used for recursive calls.
	 *
	 * @return  mixed  Object containing update information if dependency is outdated, FALSE otherwise.
	 */
	/*protected function hasUpdate($identified_name, $current_version, $requiredJoomlaVersion = JSN_PAGEBUILDER4_REQUIRED_JOOMLA_VER, $version = '')
	{
		static $result;

		// Only communicate with server if check update URLs is not load before
		if (empty($version))
		{
			if (!isset(self::$versions))
			{
				try
				{
					// Get Joomla config
					$config = JFactory::getConfig();

					// Generate cache file path
					$cache = $config->get('tmp_path') . '/JoomlaShineUpdates.json';

					// Get latest version from local file if not timed out
					if (is_readable($cache) && time() - filemtime($cache) < CHECK_UPDATE_PERIOD)
					{
						// Decode JSON encoded update details
						self::$versions = json_decode(file_get_contents($cache));
					}
					else
					{
						// Always update cache file modification time
						is_readable($cache) && touch($cache, time());

						try
						{
							self::$versions = $this->fetchHttp($this->checkLink);

							// Cache latest version to local file system
							JFile::write($cache, self::$versions);

							// Decode JSON encoded update details
							self::$versions = json_decode(self::$versions);
						}
						catch (Exception $e)
						{
							throw $e;
						}
					}
				}
				catch (Exception $e)
				{
					return $e;
				}
			}

			$version = self::$versions;
			$result = false;
		}

		// Get installed Joomla version
		$jv = JSNPageBuilder4Helper::getJoomlaVersion(2);

		// Get latest dependency version
		if (!$result)
		{
			foreach ($version->items as $item)
			{
				if (isset($item->items))
				{
					$this->hasUpdate($identified_name, $current_version, $requiredJoomlaVersion, $item);
					continue;
				}

				if (isset($item->identified_name) && $item->identified_name == $identified_name)
				{
					$result = $item;
					break;
				}
			}

			if (is_object($result))
			{
				// Does product support installed Joomla version?
				$tags = explode(';', $result->tags);

				if (!in_array($jv, $tags))
				{
					$result = false;
				}

				// Does product upgradable?
				if ($result && !empty($requiredJoomlaVersion) && strpos($jv, $requiredJoomlaVersion) === false &&
					 !version_compare($result->version, $current_version, '>='))
				{
					$result = false;
				}

				// Does product have newer version?
				if ($result && ( empty($requiredJoomlaVersion) || strpos($jv, $requiredJoomlaVersion) !== false ) &&
					 !version_compare($result->version, $current_version, '>'))
				{
					$result = false;
				}
			}
		}

		return $result;
	}*/

	/**
	 * Generate link to download dependency package.
	 *
	 * @param   object  $extension  Extension details.
	 * @param   object  $jv   Joomla version object.
	 *
	 * @return  string  Link to download dependency package.
	 */
	/*protected function getLink($extension, $jv)
	{
		// Build query string
		$query[] = 'joomla_version=' . $jv;
		$query[] = 'username=' . $this->app->getUserState('jsn.installer.customer.username');
		$query[] = 'password=' . $this->app->getUserState('jsn.installer.customer.password');
		$query[] = 'identified_name=' . $extension->identified_name;

		// Build final download link
		$url = $this->downloadLink . implode('&', $query);

		return $url;
	}*/

	/**
	 * Save dependency declaration to a constant.
	 *
	 * @param   array  &$dependencies  An array of dependency package.
	 *
	 * @return  void
	 */
	/*public function saveDependency(&$dependencies)
	{
		// Get component name
		$component = substr($this->input->getCmd('option'), 4);

		if (!defined('JSN_' . strtoupper($component) . '_DEPENDENCY'))
		{
			// Get Joomla config
			$config = JFactory::getConfig();

			// Unset some unnecessary properties
			foreach ($dependencies as & $dependency)
			{
				unset($dependency->source);
				unset($dependency->upToDate);
			}

			$dependencies = json_encode($dependencies);

			// Store dependency declaration
			file_exists($defines = JPATH_COMPONENT_ADMINISTRATOR . '/defines.php') ||
				 file_exists($defines = JPATH_COMPONENT_ADMINISTRATOR . '/' . $component . '.defines.php') ||
				 $defines = JPATH_COMPONENT_ADMINISTRATOR . '/' . $component . '.php';

			if ($config->get('ftp_enable') || is_writable($defines))
			{
				$buffer = preg_replace('/(defined\s*\(\s*._JEXEC.\s*\)[^\n]+\n)/',
					'\1' . "\ndefine('JSN_" . strtoupper($component) . "_DEPENDENCY', '" . $dependencies . "');\n", file_get_contents($defines));

				JFile::write($defines, $buffer);
			}
		}
	}*/

	/**
	 * Get remote content via http client.
	 *
	 * @param   string  $url  URL to fetch content.
	 *
	 * @return  string  Fetched content.
	 */
	/*protected function fetchHttp($url)
	{
		$client = new JHttp();

		if ($result = $client->get($url))
		{
			$result = $result->body;
		}

		return $result;
	}*/
}
