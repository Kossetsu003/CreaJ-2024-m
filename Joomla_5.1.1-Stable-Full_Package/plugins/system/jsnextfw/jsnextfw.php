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

// Import necessary libraries.
jimport('joomla.filesystem.file');

// Define neccessary constants.
require_once dirname(__FILE__) . '/jsnextfw.defines.php';

/**
 * Plugin class.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class PlgSystemJsnExtFw extends JPlugin
{
	/**
	 * Joomla application instance.
	 *
	 * @var  JApplicationCms
	 */
	protected $app;

	/**
	 * Joomla user instance.
	 *
	 * @var  JUser
	 */
	protected $user;

	/**
	 * Joomla input instance.
	 *
	 * @var  JInput
	 */
	protected $input;

	/**
	 * The currently requested component.
	 *
	 * @var  string
	 */
	protected $option;

	/**
	 * The currently requested view.
	 *
	 * @var  string
	 */
	protected $view;

	/**
	 * The currently requested task.
	 *
	 * @var  string
	 */
	protected $task;

	/**
	 * Define prefix for all classes of our framework.
	 *
	 * @var  string
	 */
	protected static $prefix = 'JsnExtFw';

	/**
	 * Affects constructor behavior. If true, language files will be loaded automatically.
	 *
	 * @var  boolean
	 */
	protected $autoloadLanguage = true;

	/**
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe
	 * @param   array   $option    An optional associative array of configuration settings.
	 *                             Recognized key values include 'name', 'group', 'params', 'language'
	 *                             (this list is not meant to be comprehensive).
	 *
	 * @return  void
	 */
	public function __construct($subject, $option = array())
	{
		parent::__construct($subject, $option);

		// Simply return if Joomla is updating itself.
		if (!empty($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '?option=com_joomlaupdate&task=update.') !== false)
		{
			return;
		}

		// Register class auto-loader.
		spl_autoload_register(array(__CLASS__, 'autoload'));

		// Get Joomla's application instance.
		$this->app = JFactory::getApplication();

		// Get Joomla's user object.
		$this->user = JFactory::getUser();

		// Get Joomla's input object.
		$this->input = $this->app->input;

		// Get common request variables.
		$this->option = $this->input->getCmd('option');
		$this->view = $this->input->getCmd('view');
		$this->task = $this->input->getCmd('task');
		$this->tmpl = $this->input->getCmd('tmpl');

		// Get ID of field to set value for and callback function.
		$this->handler = $this->app->input->getString('handler');
		$this->fieldid = $this->app->input->getString('fieldid');
		
        $isAdmin = method_exists($this->app, 'isClient') ? $this->app->isClient('administrator') : $this->app->isAdmin();
        $ndJSNExtensions = array('com_pagebuilder3', 'com_pagebuilder4', 'com_poweradmin2');
        if ($isAdmin && in_array((string) $this->option, $ndJSNExtensions))
        {
            $this->updateClientIDStatus();
        }
	}

	/**
	 * Implement onAfterInitialise event handler.
	 *
	 * @return  void
	 */
	public function onAfterInitialise()
	{
		// Get plugin parameters.
		$config = class_exists('JsnExtFwHelper') ? JsnExtFwHelper::getSettings('jsnextfw') : null;

		// Check if Joomla's built-in media manager is requested?
		if (empty($config) || ! (int) $config['enable_media_selector'])
		{
			return;
		}

		if ($this->option != 'com_media' || $this->view != 'images' || $this->tmpl != 'component')
		{
			return;
		}

		// Support only Joomla built-in component.
		parse_str(Juri::getInstance()->toString(array(
			'query'
		)), $params);

		$component = isset($params['asset']) ? $params['asset'] : ( isset($params['option']) ? $params['option'] : null );

		if ($component && in_array($component,
			array(
				'com_admin',
				'com_ajax',
				'com_associations',
				'com_banners',
				'com_cache',
				'com_categories',
				'com_checkin',
				'com_config',
				'com_contact',
				'com_content',
				'com_contenthistory',
				'com_cpanel',
				'com_fields',
				'com_finder',
				'com_mailto',
				'com_installer',
				'com_joomlaupdate',
				'com_languages',
				'com_login',
				'com_media',
				'com_menus',
				'com_messages',
				'com_modules',
				'com_newsfeeds',
				'com_plugins',
				'com_postinstall',
				'com_redirect',
				'com_search',
				'com_tags',
				'com_templates',
				'com_users',
				'com_wrapper'
			)))
		{
			// Build redirect link.
			$link = 'index.php?option=com_ajax&format=html&group=system&plugin=jsnextfw&context=media-selector&type=image&folder=images&' .
				 JSession::getFormToken() . '=1&editor=' . $this->app->input->get('e_name');

			if (!empty($this->handler))
			{
				$link .= "&handler={$this->handler}";
			}

			if (!empty($this->fieldid))
			{
				$link .= "&fieldid={$this->fieldid}";
			}

			if (!empty($this->tmpl))
			{
				$link .= "&tmpl={$this->tmpl}";
			}

			$this->app->redirect($link);
		}
	}

	/**
	 * Implement onBeforeRender event handler.
	 *
	 * @return  void
	 */
	public function onBeforeRender()
	{
		// Get plugin parameters.
		$config = class_exists('JsnExtFwHelper') ? JsnExtFwHelper::getSettings('jsnextfw') : null;

		// Check if media selector is enabled?
		if (!empty($config) && (int) $config['enable_media_selector'])
		{
			JFactory::getDocument()->addStyleDeclaration(
				'.mce-window.mce-in {
					padding: 0 !important;
				}
				.mce-foot .btn {
					float: left;
					margin: 10px;
					padding: 6px;
				}');
		}

		// Check if we should ask user feedback for why they want to uninstall our product.
		$this->user = isset($this->user) ? $this->user : JFactory::getUser();
		$this->input = isset($this->input) ? $this->input : JFactory::getApplication()->input;
		if ($this->user->id && ($request = $this->input->get('jsn', null, 'array'))) {
			if ($request['action'] === 'feedback' && $request['type'] === 'uninstall' && !empty($request['component']))
			{
				$this->input->set('jsn', null);
			}
		}
		/*if ($this->user->id && ($request = $this->input->get('jsn', null, 'array')))
		{
			if ($request['action'] === 'feedback' && $request['type'] === 'uninstall' && !empty($request['component']))
			{
				// Make sure component is not uninstalled.
				$dbo = JFactory::getDbo();
				$eid = $dbo->setQuery(
					$dbo->getQuery(true)
						->select('extension_id')
						->from('#__extensions')
						->where("type = 'component'")
						->where('element = ' . $dbo->quote($request['component']))
				)->loadResult();

				if (! (int) $eid)
				{
					$this->input->set('jsn', null);
				}
				else
				{
					JsnExtFwAssets::loadJsnElements();
				}
			}
		}*/

		// Register event to prepare assets being loaded.
		$this->app->registerEvent('onAfterRender', array(
			&$this,
			'onAfterRender'
		));
	}

	/**
	 * Implement onAfterRender event handler.
	 *
	 * @return  void
	 */
	public function onAfterRender()
	{
		if (!isset($this->onAfterRenderPassed))
		{
			$this->onAfterRenderPassed = true;

			return;
		}

		// Get response body.
		$html = $this->app->getBody();

		// Add the current component name to the body tag's class attribute.
		if (preg_match('/<body[^>]*>/i', $html, $match)
			&& !empty($this->option) && strpos($match[0], $this->option) === false)
		{
			if (strpos($match[0], 'class=') === false)
			{
				$match[1] = substr($match[0], 0, -1) . ' class="' . $this->option . '">';
			}
			else
			{
				$match[1] = str_replace('class="', 'class="' . $this->option . ' ', $match[0]);
			}

			$html = str_replace($match[0], $match[1], $html);
		}

		// Add the Joomla major release and the current template name to the body tag's class attribute.
		$tmpl = 'tmpl-' . $this->app->getTemplate();
		
		if (method_exists('JsnExtFwHelper', 'getJoomlaVersion'))
		{
			$tmpl = 'joomla-' . JsnExtFwHelper::getJoomlaVersion(1) . ' ' . $tmpl;
		}

		if (preg_match('/<body[^>]*>/i', $html, $match) && strpos($match[0], $tmpl) === false)
		{
			if (strpos($match[0], 'class=') === false)
			{
				$match[1] = substr($match[0], 0, -1) . ' class="' . $tmpl . '">';
			}
			else
			{
				$match[1] = str_replace('class="', 'class="' . $tmpl . ' ', $match[0]);
			}

			$html = str_replace($match[0], $match[1], $html);
		}

		// If MooTools is loaded, fix compatibility problem with it.
		if (strpos($html, '/media/system/js/mootools-core.js') !== false && strpos($html, 'com_fabrik') === false)
		{
			$html = str_replace('</body>',
				'<script type="text/javascript">if (window.MooTools !== undefined) {
					Element.implement({
						hide: function() {
							return this;
						},
						show: function(v) {
							return this;
						},
						slide: function(v) {
							return this;
						}
					});
				}</script></body>', $html);
		}

		// Check if we should ask user feedback for why they want to uninstall our product.
		/*if ($this->user->id && ($request = $this->input->get('jsn', null, 'array')))
		{
			if ($request['action'] === 'feedback' && $request['type'] === 'uninstall' && !empty($request['component']))
			{
				// Start output buffering to capture HTML code that renders feedback modal.
				ob_start();

				JsnExtFwHtml::renderFeedbackModal($request['component']);

				$html = str_replace('</body>', ob_get_contents() . '</body>', $html);

				ob_end_clean();
			}
		}*/

        // Get common request variables.
        $type       = $this->input->getString('type', '');
        $plugin     = $this->input->getString('plugin', '');
        $provider   = $this->input->getString('provider', '');
        $document   = JFactory::getDocument();

        // Check and replace the result on the chooser layout
        if ($type == 'chooser' && $plugin =='jsnextfw' && $provider == 'joomlashine' && $document instanceOf JDocumentHTML)
        {
            $html = JsnExtFwChooser::execute($html);
        }


		// Set response body.
		$this->app->setBody($html);
	}

	/**
	 * Handle onContentChangeState event to prevent this plugin from being unpublished.
	 *
	 * @param   string   $context  The current context.
	 * @param   integer  $ids      An array of item IDs that state are changed.
	 * @param   integer  $state    The new item state.
	 *
	 * @return  boolean
	 */
	public function onContentChangeState($context, $ids, $state)
	{
		if ($context === 'com_plugins.plugin' && $state == 0)
		{
			// Get Joomla database object.
			$dbo = JFactory::getDbo();

			foreach ($ids as $id)
			{
				// Get plugin details.
				$plugin = $dbo->setQuery("SELECT * FROM #__extensions WHERE extension_id = {$id}")->loadObject();

				// Prevent unpublishing JSN Ext. Framework 2 plugin.
				if ($plugin->element === 'jsnextfw')
				{
					$dbo->setQuery("UPDATE #__extensions SET enabled = 1 WHERE extension_id = {$id}")->execute();

					// Load necessary language files.
					JFactory::getLanguage()->load("plg_{$plugin->folder}_jsnextfw", JPATH_ADMINISTRATOR);

					// Set a message to let the user know that this system plugin is required.
					$this->app->enqueueMessage(JText::sprintf('JSN_EXTFW_CANNOT_UNPUBLISH_A_REQUIRED_PLUGIN', JText::_($plugin->name)),
						'info');

					return false;
				}
			}
		}
	}

	/**
	 * Handle onExtensionBeforeSave event to prevent this plugin from being unpublished.
	 *
	 * @param   string   $context  The current context.
	 * @param   object   $table    The current table data.
	 * @param   boolean  $new      Whether this is a new item?
	 *
	 * @return  boolean
	 */
	public function onExtensionBeforeSave($context, $table, $new)
	{
		if ($context === 'com_plugins.plugin' && $table->element === 'jsnextfw' && $table->enabled == 0)
		{
			// Load necessary language files.
			JFactory::getLanguage()->load("plg_{$table->folder}_jsnextfw", JPATH_ADMINISTRATOR);

			// Set a message to let the user know that the system plugin of JSN PowerAdmin is required.
			$table->setError(JText::sprintf('JSN_EXTFW_CANNOT_UNPUBLISH_A_REQUIRED_PLUGIN', JText::_($table->name)), 'warning');

			return false;
		}
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
		// Simply return if the current screen is the default screen of Joomla for installing extension.
		if ($this->option === 'com_installer'
			&& ($this->view === 'install' || $this->task === 'install.ajax_upload'))
		{
			return;
		}

		$this->onExtensionBeforeUpdate($type, $manifest, 'install');
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
		return;
		/*
		// Simply return if the extension type is not 'component'.
		if ((string) $type !== 'component')
		{
			return;
		}

		// Generate path to the installed component's manifest file.
		$ext = strtolower(\JFilterInput::getInstance()->clean((string) $manifest->name, 'string'));

		if (strpos($ext, 'com_') === 0)
		{
			$ext = substr($ext, 4);
		}

		$xml = JPATH_ADMINISTRATOR . "/components/com_{$ext}/{$ext}.xml";

		// Simply return if the manifest file does not exists.
		if (!is_file($xml) || !($xml = simplexml_load_file($xml)))
		{
			return;
		}

		// Simply return if the component being updated does not depend on JSN Ext. Framework gen. 2.
		if (!isset($xml->group) || (string) $xml->group !== 'jsnextfw')
		{
			return;
		}

		// Simply return if the current update process is handled by JSN Ext. Framework 2.
		if ($this->option === 'com_ajax' && $this->input->getCmd('plugin') === 'jsnextfw' && $this->input->getCmd('context') === 'update')
		{
			return;
		}

		// Download the real update package from JoomlaShine server.
		try
		{
			// Check if a valid token is set.
			$settings = JsnExtFwHelper::getSettings("com_{$ext}", true);

			if (empty($settings) || empty($settings['token']))
			{
				throw new Exception(JText::sprintf(
					'JSN_EXTFW_PRODUCT_UPDATE_LICENSE_NOT_VERIFIED',
					JText::_($ext),
					"index.php?option=com_{$ext}&view=configuration"
				));
			}

			// Get the identified string of the component being updated.
			$id = JsnExtFwHelper::getConstant('IDENTIFIED_NAME', "com_{$ext}");

			// Generate path for storing the update package.
			$path = JFactory::getConfig()->get('tmp_path') . '/' . "jsn_{$ext}_install.zip";

			// Download the update package.
			$updater = new JsnExtFwAjaxUpdate("com_{$ext}");

			$updater->downloadAction('download', $id, $path);
			$updater->downloadAction('verify', $id, $path);

			// Skip redirection after updating if this is a multi-update session.
			if ($this->option !== "com_{$ext}")
			{
				$this->app->input->set('tool_redirect', 0);
			}

			// Get the current Joomla's installer object.
			$installer = JInstaller::getInstance();

			// Extract the update package to the target installer folder.
			JArchive::extract($path, $installer->getPath('source'));

			// Then, remove it immediately.
			JFile::delete($path);

			// Re-setup the installation process.
			$installer->setupInstall($method);
		}
		catch (\Exception $e)
		{
			// Set an error message.
			$this->app->enqueueMessage($e->getMessage(), 'error');

			if ($this->option === 'com_watchfulli' && $this->task === 'doUpdate')
			{
				throw $e;
			}
			elseif (get_class($this->app) === 'JApplicationMyjoomla')
			{
				die(strip_tags($e->getMessage()));
			}
		}*/
	}

	/**
	 * Handle onExtensionAfterInstall event.
	 *
	 * @param   JInstaller  $installer  Joomla installer object.
	 * @param   int         $eid        ID of the extension being installed.
	 *
	 * @return  void
	 */
	public function onExtensionAfterInstall($installer, $eid)
	{
		// Verify extension ID.
		if (empty($eid))
		{
			return;
		}

		// Get extension data.
		$dbo = JFactory::getDbo();
		$ext = $dbo->setQuery($dbo->getQuery(true)
			->select('*')
			->from('#__extensions')
			->where("extension_id = '{$eid}'"))
			->loadObject();

		if (empty($ext))
		{
			return;
		}

		if ($ext->type === 'plugin' && $ext->folder === 'system' && $ext->element === 'jsnframework')
		{
			// Reorder the JSN Ext. Framework gen. 1 to run before JSN Ext. Framework gen. 2.
			$ordering = $dbo->setQuery(
				$dbo->getQuery(true)
					->select('ordering')
					->from('#__extensions')
					->where("type = 'plugin'")
					->where("folder = 'system'")
					->where("element = 'jsnextfw'"))
				->loadResult();

			$dbo->setQuery(
				$dbo->getQuery(true)
					->update('#__extensions')
					->set('ordering = ' . ( (int) $ordering - 1 ))
					->where("extension_id = '{$eid}'"))
				->execute();
		}
	}

	/**
	 * Handle onExtensionBeforeUninstall event.
	 *
	 * @param   int  $eid  ID of the extension just uninstalled.
	 *
	 * @return  void
	 */
	public function onExtensionBeforeUninstall($eid)
	{
		// Get extension data.
		$dbo = JFactory::getDbo();
		$ext = $dbo->setQuery("SELECT * FROM #__extensions WHERE extension_id = {$eid};")->loadObject();

		// If JSN Ext. Framework 2 is being uninstalled, make sure the uninstallation is safe.
		if ($ext && $ext->type === 'plugin' && $ext->element === 'jsnextfw')
		{
			// Get all remaining components.
			$exts = $dbo->setQuery("SELECT element FROM #__extensions WHERE type = 'component';")->loadColumn();

			// Loop thru components to find one that depends on JSN Ext. Framework 2.
			foreach ($exts as $ext)
			{
				// Read manifest file.
				$xml = JPATH_ADMINISTRATOR . "/components/{$ext}/" . substr($ext, 4) . '.xml';

				if (JFile::exists($xml) && ($xml = simplexml_load_file($xml))
					&& isset($xml->group) && (string) $xml->group == 'jsnextfw')
				{
					// Found a component that depends on JSN Ext. Framework 2, break the uninstallation.
					throw new Exception(JText::_('JSN_EXTFW_CANNOT_UNINSTALL_EXTENSION_FRAMEWORK'));
				}
			}
		}

		// Otherwise, check if a JSN component that depends on JSN Ext. Framework 2 is being uninstalled.
		/*elseif ($ext && $ext->type === 'component')
		{
			// Parse the component's manifest cache.
			$info = json_decode($ext->manifest_cache);

			if (stripos($info->author, 'JoomlaShine') !== false
				&& stripos($info->copyright, 'JoomlaShine') !== false)
			{
				// Found a JSN component that is being uninstalled, check if it depends on JSN Ext. Framework 2.
				$xml = JPATH_ADMINISTRATOR . "/components/{$ext->element}/" . substr($ext->element, 4) . '.xml';

				if (JFile::exists($xml) && ($xml = simplexml_load_file($xml))
					&& isset($xml->group) && (string) $xml->group === 'jsnextfw')
				{
					// Check if the component that is being uninstalled has a valid token.
					$params = JsnExtFwHelper::getSettings($ext->element, true);

					if ($params && !empty($params['token']))
					{
						// Check if the current screen is extension manager.
						if ($this->option === 'com_installer' && $this->view === 'manage' && $this->task === 'manage.remove')
						{

							// Make sure this is not an Ajax request.
							if (!array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER)
								|| strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
							{
								// If there is only 1 component being uninstalled, ask for feedback.
								$dbo->setQuery(
									$dbo->getQuery(true)
										->select('COUNT(*)')
										->from('#__extensions')
										->where("type = 'component'")
										->where('extension_id IN (' . implode(',', $this->input->get('cid', array(), 'array')) . ')')
								);

								if ((int) $dbo->loadResult() === 1)
								{
									$url = isset($_SERVER['HTTP_REFERER'])
										? $_SERVER['HTTP_REFERER']
										: JRoute::_('index.php?option=com_installer&view=manage');

									$url .= (strpos($url, '?') === false ? '?' : '&')
										. "jsn[action]=feedback&jsn[type]=uninstall&jsn[component]={$ext->element}";

									$this->app->redirect($url);
								}
							}
						}

						// Let JoomlaShine know there is a component uninstalled.
						$client = new JsnExtFwAjaxFeedback($ext->element);

						$client->sendUninstallFeedbackAction(true);

						unset($client);
					}
				}
			}
		}*/
	}

	/**
	 * Handle Ajax requests.
	 *
	 * @return  void
	 */
	public function onAjaxJsnextfw()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		JsnExtFwAjax::execute();

		// Exit immediately to prevent Joomla from processing further.
		exit();
	}

	/**
	 * Class auto-loader.
	 *
	 * @param   string $class_name Name of class to load declaration file for.
	 *
	 * @return  mixed
	 */
	public static function autoload($class_name)
	{
		// Verify class prefix.
		if (0 !== strpos($class_name, self::$prefix))
		{
			return false;
		}

		// Generate file path from class name.
		$base = dirname(__FILE__) . '/includes';
		$path = strtolower(preg_replace('/([A-Z])/', '/\\1', substr($class_name, strlen(self::$prefix))));

		// Find class declaration file.
		$p1 = $path . '.php';
		$p2 = $path . '/' . basename($path) . '.php';

		while (true)
		{
			// Check if file exists in standard path.
			if (@JFile::exists($base . $p1))
			{
				$exists = $p1;

				break;
			}

			// Check if file exists in alternative path.
			if (@JFile::exists($base . $p2))
			{
				$exists = $p2;

				break;
			}

			// If there is no more alternative path, quit the loop.
			if (false === strrpos($p1, '/') || 0 === strrpos($p1, '/'))
			{
				break;
			}

			// Generate more alternative path.
			$p1 = preg_replace('#/([^/]+)$#', '-\\1', $p1);
			$p2 = dirname($p1) . '/' . substr(basename($p1), 0, -4) . '/' . basename($p1);
		}

		// If class declaration file is found, include it.
		if (isset($exists))
		{
			return include_once $base . $exists;
		}

		return false;
	}


    /**
     * Update jsnextfw client id plugin to Site
     * @return  bool
     */

    protected function updateClientIDStatus()
    {
        $plugin = JTable::getInstance('Extension');
        $plugin->load(array(
            'element' => 'jsnextfw',
            'type' => 'plugin',
            'folder' => 'system'
        ));
        if ($plugin->extension_id && $plugin->client_id)
        {
            try
            {
                // update Client ID JSN Extension Framework 2.
                $plugin->client_id = 0;
                $plugin->store();
                return true;
            }
            catch (Exception $e)
            {
                return false;
            }
        }
    }
}
