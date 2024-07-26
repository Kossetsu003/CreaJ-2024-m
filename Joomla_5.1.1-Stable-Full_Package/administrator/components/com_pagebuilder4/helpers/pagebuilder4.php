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

// Register necessary include paths.
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_pagebuilder4/tables');

/**
 * Component helper.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JSNPageBuilder4Helper
{
	/**
	 * Add toolbars.
	 *
	 * @param   string  $title     Page title.
	 * @param   string  $screen    The current screen.
	 * @param   string  $icon      Icon on title bar.
	 * @param   string  $tutorial  Tutorial link.
	 *
	 * @return  void
	 */
	public static function addToolbars($title, $screen = '', $icon = '', $tutorial = '')
	{
		// Set the toolbar.
		JToolbarHelper::title($title, $icon);

		// Add help button.
		JToolbarHelper::link(
			'index.php?option=com_pagebuilder4&view=help',
			JText::_('JTOOLBAR_HELP'),
			'help'
		);

		// Add tutorial link if has.
		if (!empty($tutorial))
		{
			$toolbar = JToolbar::getInstance('toolbar');

			$toolbar->appendButton('Link', 'see-tutorial', JText::_('JSN_PAGEBUILDER4_SEE_TUTORIAL'), $tutorial);

			// Load inline script to track click event on the 'See Tutorial' button.
			$event_categories = array(
				'config' => 'Settings',
				'about' => 'About',
				'help' => 'Help'
			);

			if (array_key_exists($screen, $event_categories))
			{
				JsnExtFwAssets::loadInlineScript(
					';(function(api) {
						api.Event.add(document, "DOMContentLoaded", function() {
							var elm = document.querySelector(\'#toolbar-see-tutorial button\');

							if (elm) {
								elm.removeAttribute("onclick");

								api.Event.add(elm, "click", function() {
									api.Tracking.postEvent("'
										. $event_categories[$screen]
										. '", "Get Help", "See Video Tutorial");
								});

								elm.onclick = function() {
									window.open("' . $tutorial . '");
								};
							}
						});
					})( (JSN = window.JSN || {}) );'
				);
			}
		}

		// Register sidebar links.
		foreach (array(
			'manage' => array(
				'name' => JText::_('JSN_PAGEBUILDER4_MENU_MANAGE_TEXT'),
				'link' => JRoute::_('index.php?option=com_pagebuilder4&view=manage')
			),
			'config' => array(
				'name' => JText::_('JSN_PAGEBUILDER4_MENU_SETTINGS_TEXT'),
				'link' => JRoute::_('index.php?option=com_pagebuilder4&view=config')
			),
			'about' => array(
				'name' => JText::_('JSN_PAGEBUILDER4_MENU_ABOUT_TEXT'),
				'link' => JRoute::_('index.php?option=com_pagebuilder4&view=about')
			),
			'help' => array(
				'name' => JText::_('JSN_PAGEBUILDER4_MENU_HELP_TEXT'),
				'link' => JRoute::_('index.php?option=com_pagebuilder4&view=help')
			)
		) as $slug => $item)
		{
			JHtmlSidebar::addEntry($item['name'], $item['link'], $slug === $screen);
		}
	}

	/**
	 * Add assets
	 *
	 * @return	void
	 */
	public static function addAssets()
	{
		// Make sure JSN Extension Framework 2 is installed.
		if (!class_exists('JsnExtFwAssets'))
		{
			JFactory::getApplication()->redirect('index.php?option=com_pagebuilder4&view=installer');
		}

		// Load required libraries.
		JsnExtFwAssets::loadJsnElements();
		JsnExtFwAssets::loadInlineScript(';
			(function(api) {
				api.Text.setData(' . json_encode(array(
					'enable' => JText::_('JSN_PAGEBUILDER4_ENABLE'),
					'disable' => JText::_('JSN_PAGEBUILDER4_DISABLE')
				)) . ');
			})( (JSN = window.JSN || {}) );'
		);

		// Generate base URL to assets folder.
		$base_url = JUri::root(true) . '/administrator/components/com_pagebuilder4/assets';

		// Load stylesheet of JSN PageBuilder 4.
		JsnExtFwAssets::loadStylesheet("{$base_url}/css/style.css");
		JsnExtFwAssets::loadScript("{$base_url}/js/script.js");
	}

	/**
	 * Get configuration for JSN PageBuilder 4.
	 *
	 * @return  array
	 */
	public static function getConfig()
	{
		static $config;

		if (!isset($config) && class_exists('JsnExtFwHelper'))
		{
			$config = JsnExtFwHelper::getSettings('com_pagebuilder4');

			if (!array_key_exists('supported_components', $config))
			{
				$config['supported_components'] = array();
			}
		}

		return ( isset($config) ? $config : array() );
	}

	/**
	 * Initialize Google Analytics for event tracking.
	 *
	 * @return  void
	 */
	public static function initEventTracking()
	{
		static $loaded;

		if (!isset($loaded))
		{
			// Get JSN PageBuilder 4's config.
			$config = self::getConfig();

			// Initialize the Tracking object.
			JsnExtFwAssets::loadInlineScript(
				';(function(api) {
					api.Tracking.initGA({
						extension: "com_pagebuilder4",
						enabled: ' . (isset($config['allow_tracking']) ? (int) $config['allow_tracking'] : 0) . ',
						profile: "UA-2665952-8",
						set: {
							dimension1: "JSN PageBuilder 4",
							dimension2: "edition",
							dimension3: "' . JsnExtFwHelper::getConstant(
								'VERSION', 'com_pagebuilder4'
							) . '",
							dimension4: "' . JsnExtFwHelper::getConstant(
								'VERSION', 'jsnextfw'
							) . '",
							dimension5: "width"
						},
						debug: false
					});
				})( (JSN = window.JSN || {}) );'
			);

			$loaded = true;
		}
	}

	/**
	 * Method to init edition manager.
	 *
	 * @return  string
	 */
	public static function initEditionManager()
	{
		JsnExtFwAssets::loadEditionManager(null, 'com_pagebuilder4', array(
			'hasTrialLicense' => false,
			'skipVerifyingUser' => JFactory::getApplication()->input->getCmd('option') !== 'com_pagebuilder4'
		));
	}

	/**
	 * Method to generate necessary data required by JSN PageBuilder 4 editor app.
	 *
	 * @param   string   $id    The ID of the textarea that contains HTML output generated by the editor app.
	 * @param   boolean  $load  Whether to load the editor data inline?
	 *
	 * @return  string
	 */
	public static function initEditorData($id = '', $load = true)
	{
		static $loaded;

		// Get Joomla application object.
		$app = JFactory::getApplication();

		// Get the requested component.
		$component = $app->input->getCmd('option');

		// Get the total number of page created with JSN PageBuilder 4.
		$numPageCreated = (int) self::getNumPagesCreated();

		// Generate data required to render HTML output generated by the editor app correctly.
		$editorData = array(
			'token' => JSession::getFormToken(),
			'isSite' => JsnExtFwHelper::isSite(),
			'baseURL' => JUri::root(),
			'version' => JsnExtFwHelper::getConstant('VERSION', 'com_pagebuilder4'),
			'language' => substr(JFactory::getLanguage()->getTag(), 0, 2),
			'component' => self::getComponent($component),
			'numPageCreated' => $numPageCreated
		);

		if (!empty($id))
		{
			// Trigger an event to get config data from 3rd-party component.
			$componentParams = array();

			$app->triggerEvent('onPageBuilder4GetEditorConfigData', array($component, &$componentParams));

			// Get JSN PageBuilder 4 parameters.
			$pb4Config = self::getConfig();

			// Get JSN Extension Framework 2 parameters.
			$fwConfig = JsnExtFwHelper::getSettings('jsnextfw');

			// Generate additional data required by the editor app.
			$editorData = array_merge($editorData, $componentParams, array(
				'textareaId' => $id,
				'autoSaveInterval' => (int) $pb4Config['auto_save_interval'],
				'maxSavedRevision' => (int) $pb4Config['max_saved_revision'],
				'enableMediaSelector' => $fwConfig['enable_media_selector'] ? true : false,
				'reviewURL' => JsnExtFwHelper::getConstant('REVIEW_LINK', 'com_pagebuilder4'),
				'contactURL' => JsnExtFwHelper::getConstant('CONTACT_LINK', 'com_pagebuilder4'),
				'supportForumURL' => JsnExtFwHelper::getConstant('FORUM_LINK', 'com_pagebuilder4'),
				'manageLicenseURL' => JsnExtFwHelper::getConstant('LICENSE_LINK', 'com_pagebuilder4'),
				'documentationURL' => JsnExtFwHelper::getConstant('DOC_LINK', 'com_pagebuilder4'),
				'videoTutorialsURL' => JsnExtFwHelper::getConstant('VIDEO_LINK', 'com_pagebuilder4'),
				'upgradeLicenseURL' => JsnExtFwHelper::getConstant('BUY_LINK', 'com_pagebuilder4'),
				'instagramGetTokenURL' => JsnExtFwHelper::getConstant(
					'INSTAGRAM_GET_TOKEN_LINK', 'com_pagebuilder4'
				),
				'howToActivateDomainURL' => JsnExtFwHelper::getConstant(
					'HOW_TO_ACTIVATE_DOMAIN_LINK', 'com_pagebuilder4'
				),
				'elementDocumentation' => json_decode(
					JsnExtFwHelper::getConstant('ELEMENT_DOCUMENTATION', 'com_pagebuilder4')
				)
			));
		}

		// Generate code to pass the editor data to client side.
		$editorData = ';window.__jsn_pagebuilder4_data__ = ' . json_encode($editorData) . ';';

		if ($load && !isset($loaded))
		{
			JsnExtFwAssets::loadInlineScript($editorData);

			$loaded = true;
		}

		return $editorData;
	}

	/**
	 * Print header component.
	 *
	 * @return  void
	 */
	public static function renderHeader()
	{
		JsnExtFwHtml::renderHeaderComponent('com_pagebuilder4', array(
			'header-cta-message-for-free-user' => false,
			'header-cta-message-for-trial-user' => false,
			'header-cta-message-for-expired-trial-user' => false,
			'header-cta-message-for-pro-user' => JText::_('JSN_PAGEBUILDER4_LICENSE_EXPIRING_SOON'),
			'header-cta-message-for-expired-pro-user' => JText::_('JSN_PAGEBUILDER4_LICENSE_EXPIRED'),
			'header-cta-button-for-free-user' => false,
			'header-cta-button-for-trial-user' => false,
			'header-cta-button-for-pro-user' => JText::_('JSN_PAGEBUILDER4_RENEW_LICENSE')
		));
	}

	/**
	 * Print footer component.
	 *
	 * @param   string  $screen  Current screen.
	 *
	 * @return  void
	 */
	public static function renderFooter($screen = '')
	{
		JsnExtFwHtml::renderFooterComponent('com_pagebuilder4', null, $screen);
	}

	/**
	 * Method for saving a custom editor section.
	 *
	 * @param   string  $name   Section name.
	 * @param   string  $image  Section thumbnail.
	 * @param   string  $data   Section data.
	 *
	 * @return  array
	 */
	public static function saveEditorSection($name, $image, $data)
	{
		// Make sure section name is provided.
		if (empty($name))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_SECTION_NAME'));
		}

		// Make sure section thumbnail is provided.
		if (empty($image))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_SECTION_THUMBNAIL'));
		}

		// Store image to local file system.
		if (strpos($image, ';base64,') !== false)
		{
			$path = JPATH_ROOT . '/media/com_pagebuilder4/images/sections';

			if (JFolder::create($path))
			{
				$path .= '/' . preg_replace('/[^a-zA-Z0-9]+/', '-', $name) . '_' . time() . '.jpg';
				$parts = explode(';base64,', $image);

				if (file_put_contents($path, base64_decode($parts[1])))
				{
					$image = str_replace(JPATH_ROOT . '/', '{{base_url}}', $path);
				}
			}
		}

		// Make sure section data is provided.
		if (empty($data))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_SECTION_DATA'));
		}

		// Convert raw data to JSON.
		if (is_array($data))
		{
			$data = json_encode($data);
		}

		// Instantiate a table object to save editor section.
		$table = JTable::getInstance('Section', 'PageBuilder4Table');

		// Save editor section.
		if (!$table->save(compact('name', 'image', 'data')))
		{
			throw new Exception(sprintf(JText::_('JSN_PAGEBUILDER4_SAVING_SECTION_FAILED'), $table->getError()));
		}

		return $table->getProperties();
	}

	/**
	 * Method for renaming a saved editor section.
	 *
	 * @param   integer  $id    Record ID of section saved in database.
	 * @param   string   $name  New section name.
	 *
	 * @return  array
	 */
	public static function renameEditorSection($id, $name)
	{
		// Make sure section name is provided.
		if (empty($name))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_SECTION_NAME'));
		}

		// Instantiate a table object to update editor section.
		$table = JTable::getInstance('Section', 'PageBuilder4Table');

		// Save editor section.
		if (!$table->load($id) || !$table->save(compact('name')))
		{
			throw new Exception(sprintf(JText::_('JSN_PAGEBUILDER4_UPDATING_SECTION_FAILED'), $table->getError()));
		}

		return $table->getProperties();
	}

	/**
	 * Method for removing a saved editor section.
	 *
	 * @param   string  $id  Record ID of the section saved in database.
	 *
	 * @return  boolean
	 */
	public static function removeEditorSection($id)
	{
		// Make sure section ID is provided.
		if (empty($id))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_SECTION_ID'));
		}

		// Instantiate a table object to remove editor section.
		$table = JTable::getInstance('Section', 'PageBuilder4Table');
		$table->load($id);

		$image = str_replace('{{base_url}}', JPATH_ROOT . '/', $table->image);
		$result = $table->delete();

		if ($result)
		{
			// Delete section thumbnail.
			if (is_file($image))
			{
				JFile::delete($image);
			}
		}

		return $result;
	}

	/**
	 * Method for retrieving editor sections.
	 *
	 * @return  array
	 */
	public static function getEditorSections()
	{
		// Build query to get all saved editor sections.
		$db = JFactory::getDbo();
		$db->setQuery(
			$db->getQuery(true)
				->select('*')
				->from('#__jsn_pagebuilder4_sections')
		);

		return $db->loadAssocList();
	}

	/**
	 * Method for saving page data.
	 *
	 * @param   string  $extension  Extension of the content item that is being saved.
	 *                              E.g. com_content when saving a Joomla article, com_k2 if saving a K2 item, etc.
	 * @param   string  $hash       Hash of the page which data is being saved.
	 * @param   string  $data       Page data.
	 * @param   string  $html       Generated HTML markups.
	 *
	 * @return  int  Record ID in database
	 */
	public static function savePageData($extension, $hash, $data, $html)
	{
		// Make sure the current user is allowed to save data for the specified extension.
		if (empty($extension) || !JFactory::getUser()->authorise('core.edit', $extension))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_UNAUTHORIZED_USER'));
		}

		// Make sure page hash is provided.
		if (empty($hash))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_PAGE_HASH'));
		}

		// Make sure page data is provided.
		if (empty($data))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_PAGE_DATA'));
		}

		// Instantiate a table object to save page data.
		$table = JTable::getInstance('Page', 'PageBuilder4Table');
		$table->load(array('hash' => $hash));

		// Save page revision if necessary.
		if (empty($table->id) || $table->data !== $data)
		{
			self::savePageRevision($hash, $data, $html);
		}

		// Save page data.
		if (!$table->save(compact('hash', 'extension', 'data')))
		{
			throw new Exception(sprintf(JText::_('JSN_PAGEBUILDER4_SAVING_PAGE_DATA_FAILED'), $table->getError()));
		}

		return $table->id ? $table->id : $table->getDbo()->insertid();
	}

	/**
	 * Method for retrieving page data.
	 *
	 * @param   string  $hash  Hash of page to get data for. If a number is provided,
	 *                         database record with ID equivalent to that number will be returned.
	 *
	 * @return  array
	 */
	public static function getPageData($hash)
	{
		// Instantiate a table object to get page data.
		$table = JTable::getInstance('Page', 'PageBuilder4Table');

		// Get page data by ID.
		if (is_numeric($hash) && $table->load($hash) && (int) $table->id === (int) $hash)
		{
			return $table->getProperties();
		}

		// Get page data by hash.
		$table->load(array('hash' => $hash));

		return $table->getProperties();
	}

	/**
	 * Method for saving page revision.
	 *
	 * @param   string  $hash  Hash of the page which data is being saved.
	 * @param   string  $data  Revision data.
	 * @param   string  $html  Generated HTML markups.
	 * @param   string  $type  Revision type, either 'normal' or 'current'.
	 *
	 * @return  int  Record ID in database
	 */
	public static function savePageRevision($hash, $data, $html, $type = 'normal')
	{
		// Make sure page hash is provided.
		if (empty($hash))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_PAGE_HASH'));
		}

		// Make sure page data is provided.
		if (empty($data))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_PAGE_DATA'));
		}

		// Prepare revision type.
		if (!in_array($type, array('normal', 'current')))
		{
			$type = 'normal';
		}

		// Instantiate a table object to save page revision.
		$table = JTable::getInstance('Revision', 'PageBuilder4Table');

		// Load auto-save revision if has.
		$table->load(array('hash' => $hash, 'type' => 'current'));

		// Render dynamic content embedded in HTML markups.
		JFactory::getApplication()->triggerEvent('onPageBuilder4RenderDynamicContent', array(&$html));

		// Replace base site URL with {{base_url}} placeholder.
		$html = str_replace(array(JUri::root(), JUri::root(true) . '/'), '{{base_url}}', $html);

		// Save page revision.
		if (!$table->save(compact('hash', 'type', 'data', 'html')))
		{
			throw new Exception(sprintf(JText::_('JSN_PAGEBUILDER4_SAVING_PAGE_REVISION_FAILED'), $table->getError()));
		}

		return $table->id ? $table->id : $table->getDbo()->insertid();
	}

	/**
	 * Method for removing a saved page revision.
	 *
	 * @param   string  $id  Record ID of the page revision saved in database.
	 *
	 * @return  boolean
	 */
	public static function removePageRevision($id)
	{
		// Make sure revision ID is provided.
		if (empty($id))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_PAGE_REVISION_ID'));
		}

		// Instantiate a table object to remove page revision.
		$table = JTable::getInstance('Revision', 'PageBuilder4Table');

		return $table->load($id) && $table->delete();
	}

	/**
	 * Method for retrieving page revisions.
	 *
	 * @param   string  $hash  Hash of page to get data for. If a number is provided,
	 *                         database record with ID equivalent to that number will
	 *                         be returned. Otherwise, all database record associated
	 *                         with the provided page hash will be returned.
	 *
	 * @return  array
	 */
	public static function getPageRevisions($hash)
	{
		// Instantiate a table object to get page revision.
		$table = JTable::getInstance('Revision', 'PageBuilder4Table');

		// Get a page revision by ID.
		if (is_numeric($hash) && $table->load($hash) && (int) $table->id === (int) $hash)
		{
			// Return page revision.
			return $table->getProperties();
		}

		// Get page revisions by hash.
		$db = JFactory::getDbo();
		$db->setQuery(
			$db->getQuery(true)
				->select('*')
				->from('#__jsn_pagebuilder4_revisions')
				->where('hash = ' . $db->quote($hash))
				->order('created DESC')
		);

		return $db->loadAssocList();
	}

	/**
	 * Method for retrieving supported content items.
	 *
	 * @param   string   $type     Supported content types are:
	 *                             - articles: Get Joomla articles.
	 *                             - authors: Get Joomla authors.
	 *                             - categories: Get Joomla categories.
	 *                             - modules: Get Joomla modules.
	 *                             - tags: Get Joomla tags.
	 *                             - k2_authors: Get K2 authors.
	 *                             - k2_categories: Get K2 categories.
	 *                             - k2_items: Get K2 items.
	 *                             - k2_tags: Get K2 tags.
	 *                             - easyblog_authors: Get EasyBlog authors.
	 *                             - easyblog_categories: Get EasyBlog categories.
	 *                             - easyblog_posts: Get EasyBlog items.
	 *                             - easyblog_tags: Get EasyBlog tags.
	 *                             - jsn_uniform_forms: Get JSN UniForm form list.
	 * @param   integer  $limit    How many content items to retrieve?
	 * @param   integer  $start    Retrieve content items from this start index.
	 * @param   string   $sort     Get sort options from the original component's items list page.
	 * @param   array    $filters  articles, k2_items and easyblog_posts support the following filters:
	 *                             - author_id: Filter by an author ID or list of author ID separated by comma.
	 *                             - category_id: Filter by a category ID or list of category ID separated by comma.
	 *                             - tag: Filter by a tag ID or list of tag ID separated by comma.
	 *                             - search: Filter by a keyword.
	 *
	 * @return  array
	 */
	public static function getContentItems($type, $limit = 10, $start = 0, $sort = '', $filters = array())
	{
		// Get Joomla application object.
		$app = JFactory::getApplication();

		// Get current user state.
		$session = JFactory::getSession();
		$registry = $session->get('registry');

		// Clear user state.
		$session->set('registry', null);

		// Get Joomla input object.
		$input = $app->input;
		$backup = $app->input->getArray();

		// Set limit and start if specified.
		if ($limit)
		{
			$input->set('limit', $limit);
		}

		if ($start)
		{
			$input->set('limitstart', $start);
		}

		// Set ordering if specified.
		$sort = array_filter(explode(' ', $sort), 'trim');

		if (!empty($sort[0]))
		{
			$input->set('filter_order', $sort[0]);
		}

		if (!empty($sort[1]))
		{
			$input->set('filter_order_Dir', $sort[1]);
		}

		// Set filters.
		foreach ((array) $filters as $k => $v)
		{
			$backup["filter_{$k}"] = $input->getString("filter_{$k}");

			$input->set("filter_{$k}", $v);
		}

		// Trigger an event to get appropriated model.
		$name = implode(array_map('ucfirst', explode('_', $type)));
		$model = current(array_filter(
			$app->triggerEvent("onPageBuilder4GetModel{$name}", array($limit, $start, &$sort, &$filters))
		));

		// Verify the model.
		$method = '';

		if (is_array($model) && is_object($model[0]) && is_string($model[1]))
		{
			$method = $model[1];
			$model = $model[0];
		}

		if (!$model)
		{
			if ($model === false)
			{
				error_log(
					sprintf('Failed to get the model to retrieve content items of type %s', $type)
				);
			}

			$items = array();
		}
		elseif (is_array($model))
		{
			$items =& $model;
		}
		else
		{
			// Set limit and start to model state if specified.
			if ($limit)
			{
				$model->setState('list.limit', $limit);
			}

			if ($start)
			{
				$model->setState('list.start', $start);
			}

			// Set ordering to model state if specified.
			if (!empty($sort[0]))
			{
				$model->getState('list.ordering');
				$model->setState('list.ordering', $sort[0]);
			}

			if (!empty($sort[1]))
			{
				$model->getState('list.direction');
				$model->setState('list.direction', $sort[1]);
			}

			// Set filters to model state.
			foreach ((array) $filters as $k => $v)
			{
				$model->setState($k, $v);
				$model->setState("filter.{$k}", $v);
			}

			// Get content items.
			if (!empty($method) && method_exists($model, $method))
			{
				$items = call_user_func(array($model, $method));
			}
			elseif (method_exists($model, 'getData'))
			{
				$items = $model->getData();
			}
			elseif (method_exists($model, 'getItems'))
			{
				$items = $model->getItems();
			}
		}

		// Refine return results.
		if ($items)
		{
			foreach ($items as $i => $item)
			{
				$item = (array) $item;

				foreach ($item as $k => $v)
				{
					if (gettype($v) == 'string')
					{
						if (preg_match('/^[\{\[].*[\]\}]$/', $v))
						{
							$item[$k] = ($p = json_decode($v, true)) !== null ? $p : $v;
						}
					}
				}

				// Trigger an event to allow 3rd-party refine result also.
				$app->triggerEvent('onPageBuilder4RefineContentItem', array($type, &$item));

				$items[$i] = $item;
			}
		}

		// Restore input variables.
		foreach (array_keys($input->getArray()) as $k)
		{
			$input->set($k, null);
		}

		foreach ($backup as $k => $v)
		{
			$input->set($k, $v);
		}

		// Restore current user state.
		$session->set('registry', $registry);

		return $items ?: array();
	}

	/**
	 * Method to add support for some special components and some limited cases.
	 *
	 * @param   string  $component  Requested component.
	 *
	 * @return  string
	 */
	public static function getComponent($component = '')
	{
		// Get Joomla input object.
		$input = JFactory::getApplication()->input;

		// Get component if not provided.
		if (empty($component))
		{
			$component = $input->getCmd('option');
		}

		// Add support for Advanced Modules component.
		if ($component === 'com_advancedmodules')
		{
			$component = 'com_modules';
		}

		// Add support for editing a module instance at frontend.
		elseif ($component === 'com_config' && $input->getCmd('controller') === 'config.display.modules')
		{
			$component = 'com_modules';
		}

		return $component;
	}

	/**
	 * Method to check if requested component is supported.
	 *
	 * @param   string  $component  Requested component.
	 *
	 * @return  boolean
	 */
	public static function isComponentSupported($component = '')
	{
		// Get JSN PageBuilder 4 config.
		$config = self::getConfig();

		return in_array(self::getComponent($component), (array) $config['supported_components']) ? true : false;
	}

	/**
	 * Method to get installed supported extensions.
	 *
	 * @param   array  $extensions  Supported extensions.
	 *
	 * @return  array
	 */
	public static function getInstalledSupportedExtensions($extensions = null)
	{
		$installed_components = $extensions;
		if (empty($installed_components))
		{
			$extensions = json_decode(
				file_get_contents(JPATH_COMPONENT_ADMINISTRATOR . '/config/integration.json'), true
			);

			$installed_components = $extensions['groups'][0]['controls']['supported_components']['options'];
		}

		// Trigger an event to allow 3rd-party extensions register their supports.
		JFactory::getApplication()->triggerEvent(
			'onPageBuilder4GetSupportedComponents', array(&$installed_components)
		);

		foreach ($installed_components as $k => $v)
		{
			// Make sure component is installed.
			if (!is_dir(JPATH_ADMINISTRATOR . "/components/{$v['value']}"))
			{
				unset($installed_components[$k]);
			}
		}

		return $installed_components;
	}

	/**
	 * Detect a content built by JSN PageBuilder 3 or not
	 *
	 * @param   string  $content Page Content.
	 *
	 * @return  bool
	 */
	public static function isJSNPageBuilder3Content($content)
	{
		$startHTML = '<!-- Start PageFly HTML -->';
		$endHTML = '<!-- End PageFly HTML -->';

		if (strpos($content, $startHTML) !== false || strpos($content, $endHTML) !== false)
		{
			return true;
		}

		return false;
	}

	/**
	 * Helper method to get current Joomla version.
	 *
	 * @return  string
	 */
	public static function getJoomlaVersion($size = null, $includeDot = true)
	{
		if (
			class_exists('JsnExtFwHelper')
			&&
			method_exists('JsnExtFwHelper', 'getJoomlaVersion')
		)
		{
			return JsnExtFwHelper::getJoomlaVersion($size, $includeDot);
		}

		// Get Joomla version once.
		static $version;

		if (!isset($version))
		{

			$joomlaVersion = new JVersion();
			$versionPieces = explode('.', $joomlaVersion->getShortVersion());

			if (is_numeric($size) && $size > 0 && $size < count($versionPieces))
			{
				$versionPieces = array_slice($versionPieces, 0, $size);
			}

			$version = implode($includeDot === true ? '.' : '', $versionPieces);
		}

		return $version;
	}

	/**
	 * Get the total number of page created with JSN PageBuilder 4.
	 *
	 * @return  string
	 */
	public static function getNumPagesCreated()
	{
		$dbo = JFactory::getDBO();
		$qry = $dbo->getQuery(true);

		$qry->select('COUNT(*)')->from('#__jsn_pagebuilder4_pages');
		$dbo->setQuery($qry);

		return $dbo->loadResult();
	}

	/**
	 * Detect a content built by JSN PageBuilder 4 or not
	 *
	 * @param   string  $content Page Content.
	 *
	 * @return  bool
	 */
	public static function isJSNPageBuilder4Content($content)
	{
	    $signPattern = '/<!-- Start_PF_Hash\|([^\|]+)\|End_PF_Hash -->/';
	    preg_match_all($signPattern, $content, $matches, PREG_SET_ORDER);

	    if (count($matches)) return true;

        return false;
	}


	/**
	 * Method to replace all {{base_url}} placeholder with real site URL.
	 *
	 * @param   string  $html  Currently generated HTML code.
	 *
	 * @return  $html
	 */

	public function replaceBaseUrl($html)
	{
		$app = JFactory::getApplication();

		// Refine all {{base_url}} placeholders.
		$html = str_replace(array(JUri::root() . '{{', JUri::root(true) . '/{{'), '{{', $html);

		// Replace all {{base_url}} placeholders with real site URL.
		$pattern = '#(["\'(=]){{base_url}}([^)\'"}]+)([)\'"}])#';
		$base = JUri::root();

		if (preg_match_all($pattern, $html, $matches, PREG_SET_ORDER))
		{
			foreach ($matches as $match)
			{
				// Refine link.
				$link = str_replace('&amp;', '&', $match[2]);

				if (strpos($link, 'index.php') !== false)
				{
					// Trigger an event to get SEF link.
					$app->triggerEvent('onPageBuilder4GetSefLink', array(&$link));
				}

				if (substr($link, 0, 1) === '/')
				{
					$link = JUri::getInstance()->toString(array('scheme', 'user', 'pass', 'host', 'port')) . $link;
				}
				elseif (!preg_match('/^https?:/', $link))
				{
					$link = "{$base}{$link}";
				}

				// Replace the {{base_url}} placeholder in the current link with real site URL.
				$html = str_replace($match[0], "{$match[1]}{$link}{$match[3]}", $html);
			}
		}

		return $html;
	}

	/**
	 * Method to get full html for building page template.
	 *
	 * @param   string  $html  Currently generated HTML code.
	 *
	 * @return  $html
	 */
	public static function getFullHtml($hash, $html)
	{
		// Make sure page hash is provided.
		if (empty($hash))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_MISSING_PAGE_HASH'));
		}

		// Render dynamic content embedded in HTML markups.
		JFactory::getApplication()->triggerEvent('onPageBuilder4RenderDynamicContent', array(&$html));

		// Replace base site URL with {{base_url}} placeholder.
		$html = str_replace(array(JUri::root(), JUri::root(true) . '/'), '{{base_url}}', $html);

		return $html;
	}

	/**
	 * Generate a page hash.
	 *
	 * @return  string
	 */
	public static function generatePageHash()
	{
		$length = 8;
		$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$chars_length = (strlen($chars) - 1);
		$string = $chars[rand(0, $chars_length)];

		for ($i = 1; $i < $length; $i = strlen($string))
		{
			$r = $chars[rand(0, $chars_length)];

			if ($r != $string[$i - 1])
			{
				$string .= $r;
			}
		}

		return $string;
	}

	/**
	 * Get a value from an object/array based on the provided key path.
	 *
	 * @param   mixed   $data     Either an object or associative array of data.
	 * @param   string  $path     Key path to get value for.
	 * @param   mixed   $default  Default value to return.
	 *
	 * @return  mixed
	 */
	public static function getKeyPathValue($data, $path, $default = '')
	{
		$value = $data;

		foreach (explode('.', $path) as $key)
		{
			if (is_object($value) && isset($value->{$key}))
			{
				$value = $value->{$key};
			}
			elseif (is_array($value) && isset($value[$key]))
			{
				$value = $value[$key];
			}
			else
			{
				$value = $default;
			}
		}

		return $value;
	}

    /**
     * check the global text filters for current user groups
     *
     * @param    string  $context  The name of the extension
     *
     * @return bool
     *
     */
    public static function checkFilterText($context)
    {
        // Filter settings
        $config     = \JComponentHelper::getParams('com_config');
        $user       = \JFactory::getUser();
        $userGroups = \JAccess::getGroupsByUser($user->get('id'));
        $filters    = $config->get('filters');
        $app        = \JFactory::getApplication();

        $unfiltered = false;
        // Cycle through each of the user groups the user is in.
        // Remember they are included in the Public group as well.
        foreach ($userGroups as $groupId)
        {
            // May have added a group by not saved the filters.
            if (!isset($filters->$groupId))
            {
                continue;
            }

            // Each group the user is in could have different filtering properties.
            $filterData = $filters->$groupId;
            $filterType = strtoupper($filterData->filter_type);

            if ($filterType === 'NONE')
            {
                // No HTML filtering.
                $unfiltered = true;
            }
        }

        if (!$unfiltered)
        {
            $app->enqueueMessage(
                JText::_(
                    'JSN_PAGEBUILDER4_TEXT_FILTER_SETTING_IS_ENABLE'));
        }

        return $unfiltered;
    }
}
