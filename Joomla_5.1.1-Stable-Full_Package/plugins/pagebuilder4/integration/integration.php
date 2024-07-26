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

// No direct access to this file.
defined('_JEXEC') or die('Restricted access');

// Register necessary helper classes.
JLoader::register(
	'JSNPageBuilder4Helper',
	JPATH_ADMINISTRATOR . '/components/com_pagebuilder4/helpers/pagebuilder4.php'
);

/**
 * JSN PageBuilder 4 integration plugin.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class plgPageBuilder4Integration extends JPlugin
{
	/**
	 * Affects constructor behavior. If true, language files will be loaded automatically.
	 *
	 * @var  boolean
	 */
	protected $autoloadLanguage = true;

	/**
	 * Joomla application object.
	 *
	 * @var  JApplicationCms
	 */
	protected $app;

	/**
	 * Joomla database object.
	 *
	 * @var  JDatabaseDriver
	 */
	protected $dbo;

	/**
	 * JSN PageBuilder 4 config object.
	 *
	 * @var  array
	 */
	protected $config;

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

		// Get Joomla application object.
		$this->app = $this->app;

		// Get Joomla database object.
		$this->dbo = JFactory::getDbo();

		// Get JSN PageBuilder 4 config.
		$this->config = JSNPageBuilder4Helper::getConfig();
	}

	/**
	 * Register supported components.
	 *
	 * @param   array  &$components  Current array of supported components.
	 *
	 * @return  void
	 */
	public function onPageBuilder4GetSupportedComponents(&$components)
	{
		$components = array_merge($components, array(
			array(
				'label' => 'JSN_PAGEBUILDER4_FALANG_TRANSLATION_SUPPORT',
				'value' => 'com_falang',
				'image' => 'components/com_pagebuilder4/assets/images/falang-logo.svg',
				'hint' => 'JSN_PAGEBUILDER4_FALANG_TRANSLATION_SUPPORT_DESC'
			),
			array(
				'label' => 'JSN_PAGEBUILDER4_K2_ITEM_SUPPORT',
				'value' => 'com_k2',
				'image' => 'components/com_pagebuilder4/assets/images/k2-logo.svg',
				'hint' => 'JSN_PAGEBUILDER4_K2_ITEM_SUPPORT_DESC'
			)
		));
	}

	/**
	 * Handle the event onPageBuilder4GetEditorConfigData.
	 *
	 * @param   string  $component  Requested component.
	 * @param   array   &$params    Current array of parameters.
	 *
	 * @return  void
	 */
	public function onPageBuilder4GetEditorConfigData($component, &$params)
	{
		// Simply return if request component is not supported.
		if (!JSNPageBuilder4Helper::isComponentSupported($component))
		{
			return;
		}

		// Check if page has intro text?
		$pageHasIntro = false;

		if (in_array($component, array('com_content', 'com_k2')))
		{
			$pageHasIntro = true;
		}
		elseif ($component === 'com_falang')
		{
			if ($this->app->input->getCmd('catid') === 'content')
			{
				$pageHasIntro = true;
			}
		}

		// Only Joomla article and K2 item can be viewable.
		$pageViewable = false;
		$frontendLink = 'index.php?';

		if (in_array($component, array('com_content', 'com_k2')))
		{
			if ($component === 'com_content')
			{
				if ($id = $this->app->input->getInt(JsnExtFwHelper::isAdmin() ? 'id' : 'a_id'))
				{
					$pageViewable = true;
					$frontendLink .= "option=com_content&view=article&id={$id}";
				}
			}
			else
			{
				if ($id = $this->app->input->getInt('cid'))
				{
					$pageViewable = true;
					$frontendLink .= "option=com_k2&view=item&id={$id}";
				}
			}
		}

		// Check if Joomla site is offline or not?
		$config = JFactory::getConfig();

		if ((int) $config->get('offline'))
		{
			$frontendLink .= '&pb4preview=1&token=' . md5($config->get('secret'));
		}

		// Define save task for supported components.
		$applyTasks = array(
			'com_content' => 'article.apply',
			'com_modules' => 'module.apply',
			'com_config' => 'config.save.modules.apply',
			'com_advancedmodules' => 'module.apply',
			'com_falang' => 'translate.apply',
			'com_k2' => 'apply'
		);

		// Define save and close task for supported components.
		$saveTasks = array(
			'com_content' => 'article.save',
			'com_modules' => 'module.save',
			'com_config' => 'config.save.modules.save',
			'com_advancedmodules' => 'module.save',
			'com_falang' => 'translate.save',
			'com_k2' => 'save'
		);

		// If J2Store is installed, get currency settings.
		if (JsnExtFwHelper::isInstalled('com_j2store'))
		{
			$params['j2store_currency'] = $this->getJ2storeCurrency();
		}

		// Set necessary parameters for the editor app.
		$params = array_merge($params, array(
			// ID of title input field.
			'titleInputId' => $component === 'com_falang' ? '' : ($component === 'com_k2' ? 'title' : 'jform_title'),
			// Only Joomla article and K2 item have intro text.
			'pageHasIntro' => $pageHasIntro,
			// Only Joomla article and K2 item can be viewable.
			'pageViewable' => $pageViewable,
			'frontendLink' => $frontendLink,
			// Name of task for saving page.
			'saveTaskName' => array_key_exists($component, $applyTasks) ? $applyTasks[$component] : '',
			// Name of task for saving page then close.
			'saveAndCloseTaskName' => array_key_exists($component, $saveTasks) ? $saveTasks[$component] : '',
			// ID of all required input fields.
			'requiredInputIds' => $component === 'com_k2' ? array('catid') : array()
		));
	}

	/**
	 * Handle the event onPageBuilder4GetListQuery.
	 *
	 * @param   JDatabaseQuery  &$query  Current query object.
	 *
	 * @return  void
	 */
	public function onPageBuilder4GetListQuery(&$query)
	{
		// Define an array to hold all title columns.
		$titleCols = array();

		// Join over the content for the article ID, title and publishing state.
		$titleCols[] = 'c.title';
		$query
			->select('c.id as article_id, c.title AS article_title, c.state AS article_state')
			->join(
				'LEFT',
				'#__content AS c ON ' .
				'c.fulltext LIKE CONCAT("%", a.hash, "%")'
			)
			->group('c.id');

		// Join over the modules for the module ID, title and publishing state.
		$titleCols[] = 'm.title';
		$query
			->select('m.id as module_id, m.title AS module_title, m.published AS module_state')
			->join(
				'LEFT',
				'#__modules AS m ON ' .
				'm.module = "mod_custom" AND m.content LIKE CONCAT("%", a.hash, "%")'
			)
			->group('m.id');

		// Join over the K2 items for the K2 item ID, title and publishing state.
		if (JsnExtFwHelper::isInstalled('com_k2'))
		{
			$titleCols[] = 'k2.title';
			$query
				->select('k2.id as k2_item_id, k2.title AS k2_item_title, k2.published AS k2_item_state')
				->join(
					'LEFT',
					'#__k2_items AS k2 ON ' .
					'k2.fulltext LIKE CONCAT("%", a.hash, "%")'
				)
				->group('k2.id');
		}

		// Join over the FaLang translation for the translation ID, title and publishing state.
		if (JsnExtFwHelper::isInstalled('com_falang'))
		{
			$titleCols[] = 'ft.value';
			$query
				->select(
					'ft.id AS fl_trans_id, ft.language_id AS fl_lang_id, ft.reference_id AS fl_ref_id, ' .
					'ft.reference_table AS fl_ref_table, ft.value AS fl_trans_title, ft.published AS fl_trans_state'
				)
				->join(
					'LEFT',
					'#__falang_content AS fc ON fc.value LIKE CONCAT("%", a.hash, "%")'
				)
				->join(
					'LEFT',
					'#__falang_content AS ft ON ft.reference_field = "title" ' .
					'AND ft.language_id = fc.language_id AND ft.reference_id = fc.reference_id'
				)
				->group('ft.id');
		}

		// Make sure associated content found by checking title columns.
		$query->where('(' . implode(" != '' OR ", $titleCols) . " != '')");
	}

	/**
	 * Handle the event onPageBuilder4GetListOrdering.
	 *
	 * @param   string  $order_by   Current order by.
	 * @param   string  $order_dir  Current order direction.
	 *
	 * @return  string
	 */
	public function onPageBuilder4GetListOrdering($order_by, $order_dir)
	{
		if ($order_by === 'state')
		{
			// Sort by article title.
			$ordering[] = "article_state {$order_dir}";

			// Sort by module title.
			$ordering[] = "module_state {$order_dir}";

			// Sort by K2 item title.
			if (JsnExtFwHelper::isInstalled('com_k2'))
			{
				$ordering[] = "k2_item_state {$order_dir}";
			}

			// Sort by FaLang translation title.
			if (JsnExtFwHelper::isInstalled('com_falang'))
			{
				$ordering[] = "fl_trans_state {$order_dir}";
			}
		}
		elseif ($order_by === 'title')
		{
			// Sort by article title.
			$ordering[] = "article_title {$order_dir}";

			// Sort by module title.
			$ordering[] = "module_title {$order_dir}";

			// Sort by K2 item title.
			if (JsnExtFwHelper::isInstalled('com_k2'))
			{
				$ordering[] = "k2_item_title {$order_dir}";
			}

			// Sort by FaLang translation title.
			if (JsnExtFwHelper::isInstalled('com_falang'))
			{
				$ordering[] = "fl_trans_title {$order_dir}";
			}
		}

		return isset($ordering) ? implode(', ', $ordering) : false;
	}

	/**
	 * Handle the event onPageBuilder4GetEditLink.
	 *
	 * @param   object  $item  Item object.
	 *
	 * @return  mixed
	 */
	public function onPageBuilder4GetEditLink($item)
	{
		if ($item->extension === 'com_content')
		{
			return JRoute::_("index.php?option=com_content&task=article.edit&id={$item->article_id}");
		}
		elseif ($item->extension === 'com_modules')
		{
			return JRoute::_("index.php?option=com_modules&task=module.edit&id={$item->module_id}");
		}
		elseif ($item->extension === 'com_k2' && JsnExtFwHelper::isInstalled('com_k2'))
		{
			return JRoute::_("index.php?option=com_k2&view=item&cid={$item->k2_item_id}");
		}
		elseif ($item->extension === 'com_falang' && JsnExtFwHelper::isInstalled('com_falang'))
		{
			return JRoute::_(
				'index.php?option=com_falang&task=translate.edit' .
				"&cid[]={$item->fl_trans_id}|{$item->fl_ref_id}|{$item->fl_lang_id}"
			);
		}

		return false;
	}

	/**
	 * Handle the event onPageBuilder4GetItemState.
	 *
	 * @param   object  $item  Item object.
	 *
	 * @return  mixed
	 */
	public function onPageBuilder4GetItemState($item)
	{
		if ($item->extension === 'com_content')
		{
			return $item->article_state;
		}
		elseif ($item->extension === 'com_modules')
		{
			return $item->module_state;
		}
		elseif ($item->extension === 'com_k2' && JsnExtFwHelper::isInstalled('com_k2'))
		{
			return $item->k2_item_state;
		}
		elseif ($item->extension === 'com_falang' && JsnExtFwHelper::isInstalled('com_falang'))
		{
			return $item->fl_trans_state;
		}

		return false;
	}

	/**
	 * Handle the event onPageBuilder4GetItemTitle.
	 *
	 * @param   object  $item  Item object.
	 *
	 * @return  mixed
	 */
	public function onPageBuilder4GetItemTitle($item)
	{
		if ($item->extension === 'com_content')
		{
			return $item->article_title;
		}
		elseif ($item->extension === 'com_modules')
		{
			return $item->module_title;
		}
		elseif ($item->extension === 'com_k2' && JsnExtFwHelper::isInstalled('com_k2'))
		{
			return $item->k2_item_title;
		}
		elseif ($item->extension === 'com_falang' && JsnExtFwHelper::isInstalled('com_falang'))
		{
			return $item->fl_trans_title;
		}

		return false;
	}

	/**
	 * Handle the event onPageBuilder4PublishPage.
	 *
	 * @param   object   $item   Item object.
	 * @param   integer  $state  New publishing state to set.
	 *
	 * @return  boolean
	 */
	public function onPageBuilder4PublishPage($item, $state)
	{
		// Get Joomla application object.
		$app = $this->app;

		// Get model to publish the item.
		if ($item->extension === 'com_content')
		{
			JLoader::register(
				'ContentModelArticle', JPATH_ADMINISTRATOR . '/components/com_content/models/article.php'
			);

			$cid = $item->article_id;
			$title = $item->article_title;
			$model = new ContentModelArticle();
		}
		elseif ($item->extension === 'com_modules')
		{
			JLoader::register(
				'ModulesModelModule', JPATH_ADMINISTRATOR . '/components/com_modules/models/module.php'
			);

			$cid = $item->module_id;
			$title = $item->module_title;
			$model = new ModulesModelModule();
		}
		elseif ($item->extension === 'com_k2' && JsnExtFwHelper::isInstalled('com_k2'))
		{
			JLoader::register(
				'PB4_K2ModelItems',
				dirname(__FILE__) . '/extends/administrator/components/com_k2/models/items.php'
			);

			$cid = $item->k2_item_id;
			$title = $item->k2_item_title;
			$model = new PB4_K2ModelItems();

			$app->input->set('cid', (array) $cid);
		}

		// Publish the item.
		if (isset($cid) && isset($title) && isset($model))
		{
			try
			{
				if ($item->extension === 'com_k2')
				{
					$state ? $model->publish() : $model->unpublish();
				}
				elseif (!$model->publish($cid, $state))
				{
					throw new Exception($this->getError());
				}

				return true;
			}
			catch (Exception $e)
			{
				$app->enqueueMessage(
					sprintf(
						$state
							? JText::_('JSN_PAGEBUILDER4_PUBLISH_' . strtoupper($item->extension) . '_ITEM_FAILED')
							: JText::_('JSN_PAGEBUILDER4_UNPUBLISH_' . strtoupper($item->extension) . '_ITEM_FAILED'),
						$title,
						$e->getMessage()
					),
					'error'
				);
			}
		}
		elseif ($item->extension === 'com_falang' && JsnExtFwHelper::isInstalled('com_falang'))
		{
			// Generate necessary cookies.
			$cookies = '';

			foreach ($_COOKIE as $k => $v)
			{
				$cookies .= urlencode($k) . '=' . urlencode($v) . '; ';
			}

			// Publish FaLang translation via HTTP request.
			try
			{
				$http = new JHttp();
				$http = $http->post(
					JUri::base() . 'index.php?option=com_falang',
					array(
						'cid' => array("{$item->fl_trans_id}|{$item->fl_ref_id}|{$item->fl_lang_id}"),
						'task' => $state ? 'translate.publish' : 'translate.unpublish',
						'catid' => $item->fl_ref_table,
						JSession::getFormToken() => '1'
					),
					array(
						'cookie' => substr($cookies, 0, -2)
					)
				);

				// Verify response.
				return $this->verifyJoomlaResponse($http);
			}
			catch (Exception $e)
			{
				$app->enqueueMessage(
					sprintf(
						$state
							? JText::_('JSN_PAGEBUILDER4_PUBLISH_COM_FALANG_ITEM_FAILED')
							: JText::_('JSN_PAGEBUILDER4_UNPUBLISH_COM_FALANG_ITEM_FAILED'),
						$item->fl_trans_title,
						$e->getMessage()
					),
					'error'
				);
			}
		}

		return false;
	}

	/**
	 * Handle the event onPageBuilder4DeletePage.
	 *
	 * @param   object   $item   Item object.
	 *
	 * @return  boolean
	 */
	public function onPageBuilder4DeletePage($item)
	{
		// Get Joomla application object.
		$app = $this->app;

		// Get model to delete the item.
		if ($item->extension === 'com_content')
		{
			JLoader::register(
				'ContentModelArticle', JPATH_ADMINISTRATOR . '/components/com_content/models/article.php'
			);

			$cid = $item->article_id;
			$title = $item->article_title;
			$model = new ContentModelArticle();
		}
		elseif ($item->extension === 'com_modules')
		{
			JLoader::register(
				'ModulesModelModule', JPATH_ADMINISTRATOR . '/components/com_modules/models/module.php'
			);

			$cid = $item->module_id;
			$title = $item->module_title;
			$model = new ModulesModelModule();
		}
		elseif ($item->extension === 'com_k2' && JsnExtFwHelper::isInstalled('com_k2'))
		{
			JLoader::register(
				'PB4_K2ModelItems',
				dirname(__FILE__) . '/extends/administrator/components/com_k2/models/items.php'
			);

			$cid = $item->k2_item_id;
			$title = $item->k2_item_title;
			$model = new PB4_K2ModelItems();

			$app->input->set('cid', (array) $cid);
		}

		// Delete the item.
		if (isset($cid) && isset($title) && isset($model))
		{
			try
			{
				if ($item->extension === 'com_k2')
				{
					$model->remove();
				}
				else
				{
					$model->publish($cid, -2);

					if (!$model->delete($cid))
					{
						throw new Exception($this->getError());
					}
				}

				return true;
			}
			catch (Exception $e)
			{
				$app->enqueueMessage(
					sprintf(
						JText::_('JSN_PAGEBUILDER4_REMOVE_' . strtoupper($item->extension) . '_ITEM_FAILED'),
						$title,
						$e->getMessage()
					),
					'error'
				);
			}
		}
		elseif ($item->extension === 'com_falang' && JsnExtFwHelper::isInstalled('com_falang'))
		{
			// Generate necessary cookies.
			$cookies = '';

			foreach ($_COOKIE as $k => $v)
			{
				$cookies .= urlencode($k) . '=' . urlencode($v) . '; ';
			}

			// Publish FaLang translation via HTTP request.
			try
			{
				$http = new JHttp();
				$http = $http->post(
					JUri::base() . 'index.php?option=com_falang',
					array(
						'cid' => array("{$item->fl_trans_id}|{$item->fl_ref_id}|{$item->fl_lang_id}"),
						'task' => 'translate.remove',
						'catid' => $item->fl_ref_table,
						JSession::getFormToken() => '1'
					),
					array(
						'cookie' => substr($cookies, 0, -2)
					)
				);

				// Verify response.
				return $this->verifyJoomlaResponse($http);
			}
			catch (Exception $e)
			{
				$app->enqueueMessage(
					sprintf(
						JText::_('JSN_PAGEBUILDER4_PUBLISH_COM_FALANG_ITEM_FAILED'),
						$item->fl_trans_title,
						$e->getMessage()
					),
					'error'
				);
			}
		}

		return false;
	}

	/**
	 * Get SEF link for the specified URL.
	 *
	 * @param   string  &$link  Raw URL.
	 *
	 * @return  void
	 */
	public function onPageBuilder4GetSefLink(&$link)
	{
		// Check if current link is for viewing an article.
		$pattern = '/^index\.php\?option=com_content&view=article&id=(\d+)/';

		if (preg_match($pattern, $link, $match) && strpos($link, '&catid=') === false)
		{
			// Get article category.
			$item = $this->dbo->setQuery(
				$this->dbo->getQuery(true)
					->select('a.catid, l.sef')
					->from('#__content AS a')
					->join('left', '#__languages AS l ON l.lang_code = a.language')
					->where('a.id = ' . (int) $match[1])
			)->loadObject();

			// Append category ID to current link.
			$link .= "&catid={$item->catid}";

			// Append language SEF code to current link if needed.
			if (!empty($item->sef) && strpos($link, '&lang=') === false)
			{
				$link .= "&lang={$item->sef}";
			}
		}

		$link = JRoute::_($link);
	}

	/**
	 * Get Joomla articles.
	 *
	 * @param   integer  $limit    How many articles to retrieve?
	 * @param   integer  $start    Retrieve articles from this start index.
	 * @param   string   $sort     Get sort options from Content / Articles screen on Joomla admin dashboard.
	 * @param   array    $filters  Supported filters are:
	 *                             - author_id: Filter by an author ID or list of author ID separated by comma.
	 *                             - category_id: Filter by a category ID or list of category ID separated by comma.
	 *                             - tag: Filter by a tag ID or list of tag ID separated by comma.
	 *                             - search: Filter by a keyword.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelArticles($limit, $start, &$sort, &$filters)
	{
		// Load PB4_ContentModelArticles class.
		JLoader::register(
			'PB4_ContentModelArticles',
			JPATH_ADMINISTRATOR . '/components/com_pagebuilder4/helpers/extends' .
			'/administrator/components/com_content/models/articles.php'
		);

		// Load FieldsHelper class.
		JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

		// Instantiate PB4_ContentModelArticles then return.
		if (!class_exists('PB4_ContentModelArticles'))
		{
			return false;
		}

		// Refine filters.
		$filters['published'] = 1;
		$filters['level'    ] = 0;

		// Register event to refine article data.
		$this->app->registerEvent(
			'onPageBuilder4RefineContentItem',
			function($type, &$item)
			{
				if ($type === 'articles')
				{
					// Load content helper route.
					if (!class_exists('ContentHelperRoute'))
					{
						require_once JPATH_ROOT . '/components/com_content/helpers/route.php';
					}

					$item['read_more_url'] = JRoute::_(
						ContentHelperRoute::getArticleRoute($item['id'], $item['catid'], $item['lang_sef']),
						false
					);

					$item['category_url'] = JRoute::_(
						ContentHelperRoute::getCategoryRoute($item['catid'], $item['cat_lang_sef']),
						false
					);

					$item['alt_attr'] = $item['title_attr'] = htmlspecialchars(
						$item['title'], ENT_COMPAT, 'UTF-8'
					);

					if (JSNPageBuilder4Helper::isJSNPageBuilder3Content($item['introtext']))
					{
						$item['introtext'] = '';
					}
					else
					{
					    $item['introtext'] = strip_tags($item['introtext']);
					}

					if (!class_exists('FieldsHelper'))
					{
					    JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
					}

					$fields = FieldsHelper::getFields('com_content.article', $item, true);

					if ($fields)
					{
					    $app = JFactory::getApplication();

					    if ($app->isClient('site') && JLanguageMultilang::isEnabled() && isset($item["language"]) && $item["language"] == '*')
					    {
					        $lang = $app->getLanguage()->getTag();

					        foreach ($fields as $key => $field)
					        {
					            if ($field->language == '*' || $field->language == $lang)
					            {
					                continue;
					            }

					            unset($fields[$key]);
					        }
					    }
					}

					if ($fields)
					{
					    $tmpFields = array();
					    foreach ($fields as $key => $field)
					    {
					    	$output = FieldsHelper::render(
								'com_pagebuilder4.layouts',
								'field.render',
								array(
									'item'    => $item,
									'context' => 'com_content.article',
									'field'   => $field
								)
							);
					        $tmpFields [] = array('id' => (int) $field->id, 'value' => $output);
					    }

					    $item['field'] = $tmpFields;
					}
				}
			}
		);

		return new PB4_ContentModelArticles();
	}

	/**
	 * Get Joomla authors.
	 *
	 * @param   integer  $limit    How many authors to retrieve?
	 * @param   integer  $start    Retrieve authors from this start index.
	 * @param   string   $sort     Get sort options from Users / Manage screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelAuthors($limit, $start, &$sort, &$filters)
	{
		// Build query to get list of Joomla authors.
		$query = $this->dbo->getQuery(true)
			->select('a.*')
			->from('#__users as a')
			->innerJoin('#__content as c ON c.created_by = a.id')
			->where('a.block = 0')
			->group('a.id');

		// Apply ordering if specified.
		if( !is_array($sort))
		{
			$sort = array_filter(explode(' ', $sort), 'trim');
		}

		if (!empty($sort[0]))
		{
			$query->order($sort[0] . (empty($sort[1]) ? '' : " {$sort[1]}"));
		}

		// Execute query then return results.
		return $this->dbo->setQuery($query, $start, $limit)->loadObjectList();
	}

	/**
	 * Get Joomla categories.
	 *
	 * @param   integer  $limit    How many categories to retrieve?
	 * @param   integer  $start    Retrieve categories from this start index.
	 * @param   string   $sort     Get sort options from Content / Categories screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelCategories($limit, $start, &$sort, &$filters)
	{
		// Load CategoriesModelCategories class.
		JLoader::register(
			'CategoriesModelCategories',
			JPATH_ADMINISTRATOR . '/components/com_categories/models/categories.php'
		);

		// Instantiate CategoriesModelCategories then return.
		if (!class_exists('CategoriesModelCategories'))
		{
			return false;
		}

		// Emulate a required input variable.
		$this->app->input->set('extension', 'com_content');

		return new CategoriesModelCategories();
	}

	/**
	 * Get Joomla modules.
	 *
	 * @param   integer  $limit    How many modules to retrieve?
	 * @param   integer  $start    Retrieve modules from this start index.
	 * @param   string   $sort     Get sort options from Extensions / Modules screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelModules($limit, $start, &$sort, &$filters)
	{
		// Load ModulesModelModules class.
		JLoader::register(
			'ModulesModelModules', JPATH_ADMINISTRATOR . '/components/com_modules/models/modules.php'
		);

		// Retrieve only site modules.
		$this->app->input->set('client_id', 0);

		// Instantiate ModulesModelModules then return.
		if (!class_exists('ModulesModelModules'))
		{
			return false;
		}

		return new ModulesModelModules();
	}

	/**
	 * Get Joomla tags.
	 *
	 * @param   integer  $limit    How many tags to retrieve?
	 * @param   integer  $start    Retrieve tags from this start index.
	 * @param   string   $sort     Get sort options from Component / Tags screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelTags($limit, $start, &$sort, &$filters)
	{
		// Load TagsModelTags class.
		JLoader::register('TagsModelTags', JPATH_ADMINISTRATOR . '/components/com_tags/models/tags.php');

		// Instantiate TagsModelTags then return.
		if (!class_exists('TagsModelTags'))
		{
			return false;
		}

		return new TagsModelTags();
	}

	/**
	 * Get K2 authors.
	 *
	 * @param   integer  $limit    How many K2 authors to retrieve?
	 * @param   integer  $start    Retrieve K2 authors from this start index.
	 * @param   string   $sort     Get sort options from Components / K2 / Users screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelK2Authors($limit, $start, &$sort, &$filters)
	{
		// Make sure K2 is installed.
		if (JsnExtFwHelper::isInstalled('com_k2'))
		{
			// Build query to get list of K2 authors.
			$query = $this->dbo->getQuery(true)
				->select('a.*')
				->from('#__users as a')
				->innerJoin('#__k2_items as i ON i.created_by = a.id')
				->where('a.block = 0')
				->group('a.id');

			// Apply ordering if specified.
			if( !is_array($sort))
			{
				$sort = array_filter(explode(' ', $sort), 'trim');
			}

			if (!empty($sort[0]))
			{
				$query->order($sort[0] . (empty($sort[1]) ? '' : " {$sort[1]}"));
			}

			// Execute query then return results.
			return $this->dbo->setQuery($query, $start, $limit)->loadObjectList();
		}
	}

	/**
	 * Get K2 categories.
	 *
	 * @param   integer  $limit    How many K2 categories to retrieve?
	 * @param   integer  $start    Retrieve K2 categories from this start index.
	 * @param   string   $sort     Get sort options from Components / K2 / Categories screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelK2Categories($limit, $start, &$sort, &$filters)
	{
		// Make sure K2 is installed.
		if (JsnExtFwHelper::isInstalled('com_k2'))
		{
			// Load K2Model and K2ModelCategories class.
			JLoader::register(
				'K2Model', JPATH_ADMINISTRATOR . '/components/com_k2/models/model.php'
			);
			JLoader::register(
				'K2ModelCategories', JPATH_ADMINISTRATOR . '/components/com_k2/models/categories.php'
			);

			// Instantiate K2ModelCategories then return.
			if (!class_exists('K2ModelCategories'))
			{
				return false;
			}

			return new K2ModelCategories();
		}
	}

	/**
	 * Get K2 items.
	 *
	 * @param   integer  $limit    How many K2 items to retrieve?
	 * @param   integer  $start    Retrieve K2 items from this start index.
	 * @param   string   $sort     Get sort options from Components / K2 / Items screen on Joomla admin dashboard.
	 * @param   array    $filters  Supported filters are:
	 *                             - author_id: Filter by an author ID or list of author ID separated by comma.
	 *                             - category_id: Filter by a category ID or list of category ID separated by comma.
	 *                             - tag: Filter by a tag ID or list of tag ID separated by comma.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelK2Items($limit, $start, &$sort, &$filters)
	{
		// Make sure K2 is installed.
		if (JsnExtFwHelper::isInstalled('com_k2'))
		{
			// Load PB4_K2ModelItems class.
			JLoader::register(
				'PB4_K2ModelItems',
				dirname(__FILE__) . '/extends/administrator/components/com_k2/models/items.php'
			);

			// Instantiate PB4_K2ModelItems then return.
			if (!class_exists('PB4_K2ModelItems'))
			{
				return false;
			}

			// Register event to refine article data.
			$this->app->registerEvent(
				'onPageBuilder4RefineContentItem',
				function($type, &$item)
				{
					if ($type === 'k2_items')
					{
						// Load K2 helper route.
						if (!class_exists('K2HelperRoute'))
						{
							require_once JPATH_ROOT . '/components/com_k2/helpers/route.php';
						}

						$item['read_more_url'] = JRoute::_(
							K2HelperRoute::getItemRoute($item['id'], $item['catid'])
							. ($item['lang_sef'] ? "&lang={$item['lang_sef']}" : ''),
							false
						);

						$item['category_url'] = JRoute::_(
							K2HelperRoute::getCategoryRoute($item['catid'])
							. ($item['cat_lang_sef'] ? "&lang={$item['cat_lang_sef']}" : ''),
							false
						);

						$item['alt_attr'] = $item['title_attr'] = htmlspecialchars(
							$item['title'], ENT_COMPAT, 'UTF-8'
						);

						// Check if intro image exists.
						$image = JPATH_SITE . '/media/k2/items/cache/' . md5("Image{$item['id']}") . '_XL.jpg';

						if (is_file($image))
						{
							$item['image_intro'] = str_replace(JPATH_SITE . '/', '', $image);
						}

						if (JSNPageBuilder4Helper::isJSNPageBuilder3Content($item['introtext']))
						{
							$item['introtext'] = '';
						}
						else
						{
						    $item['introtext'] = strip_tags($item['introtext']);
						}
					}
				}
			);

			return new PB4_K2ModelItems();
		}
	}

	/**
	 * Get K2 tags.
	 *
	 * @param   integer  $limit    How many K2 tags to retrieve?
	 * @param   integer  $start    Retrieve K2 tags from this start index.
	 * @param   string   $sort     Get sort options from Components / K2 / Tags screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelK2Tags($limit, $start, &$sort, &$filters)
	{
		// Make sure K2 is installed.
		if (JsnExtFwHelper::isInstalled('com_k2'))
		{
			// Load K2Model and K2ModelTags class.
			JLoader::register(
				'K2Model', JPATH_ADMINISTRATOR . '/components/com_k2/models/model.php'
			);
			JLoader::register(
				'K2ModelTags', JPATH_ADMINISTRATOR . '/components/com_k2/models/tags.php'
			);

			// Instantiate K2ModelTags then return.
			if (!class_exists('K2ModelTags'))
			{
				return false;
			}

			return new K2ModelTags();
		}
	}

	/**
	 * Get EasyBlog authors.
	 *
	 * @param   integer  $limit    How many EasyBlog authors to retrieve?
	 * @param   integer  $start    Retrieve EasyBlog authors from this start index.
	 * @param   string   $sort     Get sort options from Components / EasyBlog / Authors
	 *                             screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelEasyBlogAuthors($limit, $start, &$sort, &$filters)
	{
		// Make sure EasyBlog is installed.
		if (JsnExtFwHelper::isInstalled('com_easyblog'))
		{
			// Build query to get list of EasyBlog authors.
			$query = $this->dbo->getQuery(true)
				->select('a.*')
				->from('#__users as a')
				->innerJoin('#__easyblog_post as p ON p.created_by = a.id')
				->where('a.block = 0')
				->group('a.id');

			// Apply ordering if specified.
			if( !is_array($sort))
			{
				$sort = array_filter(explode(' ', $sort), 'trim');
			}

			if (!empty($sort[0]))
			{
				$query->order($sort[0] . (empty($sort[1]) ? '' : " {$sort[1]}"));
			}

			// Execute query then return results.
			return $this->dbo->setQuery($query, $start, $limit)->loadObjectList();
		}
	}

	/**
	 * Get EasyBlog categories.
	 *
	 * @param   integer  $limit    How many EasyBlog categories to retrieve?
	 * @param   integer  $start    Retrieve EasyBlog categories from this start index.
	 * @param   string   $sort     Get sort options from Components / EasyBlog / Categories
	 *                             screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelEasyBlogCategories($limit, $start, &$sort, &$filters)
	{
		// Make sure EasyBlog is installed.
		if (JsnExtFwHelper::isInstalled('com_easyblog'))
		{
			// Load EB, EasyBlogAdminModel and EasyBlogModelCategories class.
			JLoader::register(
				'EB', JPATH_ADMINISTRATOR . '/components/com_easyblog/includes/easyblog.php'
			);

			// Get EasyBlog categories then return.
			$model = EB::model('Category');

			// Get the list of categories
			$categories = $model->getData(false);

			foreach ($categories as &$category)
			{
				$category->level = (int) $category->depth + 1;
			}

			return $categories;
		}
	}

	/**
	 * Get EasyBlog posts.
	 *
	 * @param   integer  $limit    How many EasyBlog posts to retrieve?
	 * @param   integer  $start    Retrieve EasyBlog posts from this start index.
	 * @param   string   $sort     Get sort options from Components / EasyBlog / Posts screen.
	 * @param   array    $filters  Supported filters are:
	 *                             - author_id: Filter by an author ID or list of author ID separated by comma.
	 *                             - category_id: Filter by a category ID or list of category ID separated by comma.
	 *                             - tag: Filter by a tag ID or list of tag ID separated by comma.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelEasyBlogPosts($limit, $start, &$sort, &$filters)
	{
		// Make sure EasyBlog is installed.
		if (JsnExtFwHelper::isInstalled('com_easyblog'))
		{
			// Load PB4_EasyBlogModelBlogs class.
			JLoader::register(
				'PB4_EasyBlogModelBlogs',
				dirname(__FILE__) . '/extends/administrator/components/com_easyblog/models/blogs.php'
			);

			// Instantiate PB4_EasyBlogModelBlogs then return.
			if (!class_exists('PB4_EasyBlogModelBlogs'))
			{
				return false;
			}

			// Set filters.
			$this->app->input->set('filter_state', 'P');

			// Register event to refine article data.
			$this->app->registerEvent(
				'onPageBuilder4RefineContentItem',
				function($type, &$item)
				{
					if ($type === 'easyblog_posts')
					{
						// Reset filters.
						$this->app->input->set('filter_state', null);

						// Load EasyBlog helper route.
						if (!class_exists('EBR'))
						{
							require_once JPATH_ROOT . '/administrator/components/com_easyblog/includes/router.php';
						}

						$item['read_more_url'] = EBR::_(
							"index.php?option=com_easyblog&view=entry&id={$item['id']}"
							. (@ $item['lang_sef'] ? "&lang={$item['lang_sef']}" : ''),
							false
						);

						$item['category_url'] = EBR::_(
							'index.php?option=com_easyblog&view=categories&layout=listings'
							. "&id={$item['category_id']}"
							. (@ $item['cat_lang_sef'] ? "&lang={$item['cat_lang_sef']}" : ''),
							false
						);

						$item['alt_attr'] = $item['title_attr'] = htmlspecialchars(
							$item['title'], ENT_COMPAT, 'UTF-8'
						);

						if (!isset($item['author']) || !isset($item['category_title']))
						{
						    if (class_exists('EB'))
						    {
								$post = EB::post($item['id']);
						        $category = $post->getPrimaryCategory();
						        $item['author'] = $post->getAuthorName();
						        $item['category_title'] = $category->getTitle();
						    }
						}

						$item['intro'] = strip_tags($item['intro']);

						// Check if intro image exists.
						if (!empty($item['image']))
						{
							if (!class_exists('EBMM'))
							{
								require_once JPATH_ADMINISTRATOR
									. '/components/com_easyblog/includes/mediamanager/mediamanager.php';
							}

							// Fix EasyBlog Image issue at front-end
							preg_match('/\/easyblog_articles\/(.*)\/(.*)/', $item['image'], $output_array);

							if (count($output_array))
							{
							    $item['image'] = 'post:' . (int) $output_array[1] . '/' . $output_array[2];
							}

							$item['image'] = ltrim(str_replace(
								JUri::root(), '', EBMM::getPath($item['image'], '')
							), '/');
						}
					}
				}
			);

			return new PB4_EasyBlogModelBlogs();
		}
	}

	/**
	 * Get EasyBlog tags.
	 *
	 * @param   integer  $limit    How many EasyBlog tags to retrieve?
	 * @param   integer  $start    Retrieve EasyBlog tags from this start index.
	 * @param   string   $sort     Get sort options from Components / EasyBlog / Tags screen on Joomla admin dashboard.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelEasyBlogTags($limit, $start, &$sort, &$filters)
	{
		// Make sure EasyBlog is installed.
		if (JsnExtFwHelper::isInstalled('com_easyblog'))
		{
			// Load EB, EasyBlogAdminModel and EasyBlogModelTags class.
			JLoader::register(
				'EB', JPATH_ADMINISTRATOR . '/components/com_easyblog/includes/easyblog.php'
			);
			JLoader::register(
				'EasyBlogAdminModel', JPATH_ADMINISTRATOR . '/components/com_easyblog/models/model.php'
			);
			JLoader::register(
				'EasyBlogModelTags', JPATH_ADMINISTRATOR . '/components/com_easyblog/models/tags.php'
			);

			// Instantiate EasyBlogModelTags then return.
			if (!class_exists('EasyBlogModelTags'))
			{
				return false;
			}

			return new EasyBlogModelTags();
		}
	}

	/**
	 * Handle event to get JSN UniForm form list.
	 *
	 * @param   integer  $limit    How many forms to retrieve?
	 * @param   integer  $start    Retrieve forms from this start index.
	 * @param   string   $sort     Not support any sort option.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelJsnUniformForms($limit, $start, &$sort, &$filters)
	{
		// Make sure JSN UniForm is installed.
		if (JsnExtFwHelper::isInstalled('com_uniform'))
		{
			// Build query to get list of JSN UniForm forms.
			$query = $this->dbo->getQuery(true)
				->select('form_id as ' . $this->dbo->quoteName('value') . ', form_title as ' . $this->dbo->quoteName('label'))
				->from('#__jsn_uniform_forms')
				->where('form_state = 1');

			// Execute query then return results.
			return $this->dbo->setQuery($query)->loadObjectList();
		}
	}

	/**
	 * Handle event to get JSN ImageShow showlists.
	 *
	 * @param   integer  $limit    How many showlists to retrieve?
	 * @param   integer  $start    Retrieve showlists from this start index.
	 * @param   string   $sort     Not support any sort option.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelJsnImageshowShowlists($limit, $start, &$sort, &$filters)
	{
		// Make sure JSN ImageShow is installed.
		if (JsnExtFwHelper::isInstalled('com_imageshow'))
		{
			// Build query to get list of JSN ImageShow showlists.
			$query = $this->dbo->getQuery(true)
				->select('showlist_id as ' . $this->dbo->quoteName('value') . ', showlist_title as ' . $this->dbo->quoteName('label'))
				->from('#__imageshow_showlist')
				->where('published = 1');

			// Execute query then return results.
			return $this->dbo->setQuery($query)->loadObjectList();
		}
	}

	/**
	 * Handle event to get JSN ImageShow showcases.
	 *
	 * @param   integer  $limit    How many showcases to retrieve?
	 * @param   integer  $start    Retrieve showcases from this start index.
	 * @param   string   $sort     Not support any sort option.
	 * @param   array    $filters  Not support any filter.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelJsnImageshowShowcases($limit, $start, &$sort, &$filters)
	{
		// Make sure JSN ImageShow is installed.
		if (JsnExtFwHelper::isInstalled('com_imageshow'))
		{
			// Build query to get list of JSN ImageShow showcases.
			$query = $this->dbo->getQuery(true)
				->select('showcase_id as  ' . $this->dbo->quoteName('value') . ', showcase_title as  ' . $this->dbo->quoteName('label'))
				->from('#__imageshow_showcase')
				->where('published = 1');

			// Execute query then return results.
			return $this->dbo->setQuery($query)->loadObjectList();
		}
	}

	/**
	 * Get J2Store products.
	 *
	 * @param   integer  $limit    How many J2Store products to retrieve?
	 * @param   integer  $start    Retrieve J2Store products from this start index.
	 * @param   string   $sort     Get sort options from Components / J2Store / Products screen on Joomla admin dashboard.
	 * @param   array    $filters  Supported filters are:
	 *                             - category_id: Filter by a category ID or list of category ID separated by comma.
	 *                             - tag: Filter by a tag ID or list of tag ID separated by comma.
	 *
	 * @return  array
	 */
	public function onPageBuilder4GetModelJ2storeProducts($limit, $start, &$sort, &$filters)
	{
		// Make sure J2Store is installed.
		if (JsnExtFwHelper::isInstalled('com_j2store'))
		{
			// Load PB4_J2StoreModelProducts class.
			JLoader::register(
				'PB4_J2StoreModelProducts',
				dirname(__FILE__) . '/extends/administrator/components/com_j2store/models/products.php'
			);

			// Instantiate PB4_J2StoreModelProducts then return.
			if (!class_exists('PB4_J2StoreModelProducts'))
			{
				return false;
			}

			if (!empty($filters['category_id']))
			{
				$filters['catids'] = $filters['category_id'];
				unset($filters['category_id']);

				if (isset($filters['nested_categories']) && $filters['nested_categories']) {
					$filters['subcategories'] = true;
					unset($filters['nested_categories']);
                }
			}

			// Register event to refine article data.
			$this->app->registerEvent(
				'onPageBuilder4RefineContentItem',
				function($type, &$item)
				{
					if ($type === 'j2store_products')
					{
					    // Get a temporary model.
                        $model = F0FModel::getTmpInstance('Products', 'J2StoreModel');


					    // Temporary convert the item to object.
						$item = (object) $item;

						if (is_null($item->price))
						{
							$item->price = number_format(0, 5, '.', '');
						}

						$item->introtext = strip_tags($item->introtext);
						// Run content plugins on current item.
						$model->executePlugins($item, null, 'com_content.category.productlist');
						
						// Refine raw item as product.
						$productTitle = $item->title;
						if (JsnExtFwHelper::isSite())
						{
							$productTitle = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8');
						}
						$item->product_name = $productTitle;
						$item->product_long_desc = $item->fulltext;
						$item->product_short_desc = $item->introtext;
						$item->params = json_encode($item->params);

						$model->runMyBehaviorFlag(true)->getProduct($item);

						// Create an array of product images.
						$item->image_url = array();

						if (isset($item->main_image))
						{
							$item->image_url[] = $item->main_image;
						}

						if (isset($item->additional_images))
						{
							$item->image_url = array_merge($item->image_url, array_filter($item->additional_images));
						}

						// Get link to view product.
                        $item->product_view_url = "index.php?option=com_j2store&view=products&task=view&id={$item->j2store_product_id}";
                        $menus = $this->app->getMenu()->getMenu();

						foreach ($menus as $menu)
						{
						    if (strpos($menu->link, 'index.php?option=com_j2store&view=products') === 0)
						    {
						        if (preg_match_all("/&catid\[\d+\]=(\d+)/", $menu->link, $matches, PREG_SET_ORDER))
                                {
                                    foreach ($matches as $match)
                                    {
                                        if ($match[1] == $item->catid || $match[1] == $item->parent_id)
                                        {
	                                        $item->product_view_url .= "&Itemid={$menu->id}";
	                                        break;
                                        }
                                    }
                                }
                            }
                        }

						// Convert the item back to array.
						$item = (array) $item;
					}
				}
			);

			return array(new PB4_J2StoreModelProducts(), 'getSFProducts');
		}
	}

	/**
	 * Method to process template tags.
	 *
	 * @param   string  $type   Current list type.
	 * @param   array   $tag    Current tag data.
	 * @param   string  &$data  Current replacement data.
	 * @param   string  &$out   Current HTML output.
	 * @param   array   $opts   Current tag options.
	 * @param   mixed   $item   Current dynamic content item.
	 *
	 * @return  void
	 */
	public function onPageBuilder4ProcessTemplateTag($type, $tag, &$data, &$out, $opts = array(), $item = array())
	{
		// Process tags for J2Store product list.
		if ($type === 'j2store_products')
		{
			// Process price related tag.
			if (strpos($tag[0], 'price') !== false)
			{
				if (JsnExtFwHelper::isInstalled('com_j2store') && file_exists(JPATH_ADMINISTRATOR.'/components/com_j2store/helpers/j2store.php'))
				{
					require_once (JPATH_ADMINISTRATOR.'/components/com_j2store/helpers/j2store.php');
					$j2helper 	= J2Store::product();
					$j2params 	= J2Store::config();
					//$j2currency	= J2Store::currency();
					$cloneItem 	= (object) $item;	
					$data = J2Store::product()->displayPrice($cloneItem->pricing->base_price, $cloneItem, $j2params);
					$data = str_replace('$', '&dollar;', $data);
				}
				else
				{
				
					// Get J2Store currency.
					$j2store_currency = $this->getJ2storeCurrency();

					// Format price.
					$data = $this->formatPrice($data, array(
						'num_decimals' => $j2store_currency->currency_num_decimals,
						'decimal_separator' => $j2store_currency->currency_decimal,
						'thousands_separator' => $j2store_currency->currency_thousands,
						'currency_symbol' => $j2store_currency->currency_symbol,
						'currency_position' => $j2store_currency->currency_position
					));
				}
			}

			// Process {{add_to_cart_form}} tag.
			else if ($tag[1] === 'add_to_cart_form') {
				ob_start();
				$product = (object) $item;
				$uniqid = uniqid('-jsnpb4-');
				?>
				<form
					action="<?php echo JRoute::_('index.php?option=com_j2store&view=carts&task=addItem'); ?>"
					method="post" class="j2store-addtocart-form"
					id="j2store-addtocart-form-<?php echo $product->j2store_product_id . $uniqid; ?>"
					name="j2store-addtocart-form-<?php echo $product->j2store_product_id . $uniqid; ?>"
					data-product_id="<?php echo $product->j2store_product_id; ?>"
					data-product_type="<?php echo $product->product_type; ?>"
					<?php if (isset($product->variant_json)): ?>data-product_variants="<?php echo htmlspecialchars($product->variant_json);?>"<?php endif; ?>
					enctype="multipart/form-data"
                    style="margin:0!important;border:0!important;padding:0!important;display:none!important;"
				>
					<?php
					if ( $product->product_type == 'configurable' || @count($product->options) )
					{
						?>
						<!-- we have options so we just redirect -->
                        <script>
                            window.addEventListener('load', function() {
	                            document.getElementById('j2store-addtocart-form-<?php echo $product->j2store_product_id . $uniqid; ?>')
                                    .addEventListener('submit', function(e) {
                                    	e.preventDefault()
                                        window.location.href = '<?php echo $product->product_link; ?>'
                                        return false
                                    })
                            })
                        </script>
						<?php
                    }
                    ?>
                    <input type="hidden" name="product_qty" value="<?php echo (int) $product->quantity; ?>" />
                    <input type="hidden" name="product_id" value="<?php echo $product->j2store_product_id; ?>" />
                    <input type="hidden" name="option" value="com_j2store" />
                    <input type="hidden" name="view" value="carts" />
                    <input type="hidden" name="task" value="addItem" />
                    <input type="hidden" name="ajax" value="0" />
                    <?php echo JHTML::_( 'form.token' ); ?>
                    <input type="hidden" name="return" value="<?php echo base64_encode( JUri::getInstance()->toString() ); ?>" />
                    <div class="j2store-notifications"></div>
                    <?php if ($product->product_type == 'variable') { ?>
                    <input type="hidden" name="variant_id" value="<?php echo $product->variant->j2store_variant_id; ?>" />
                    <?php
					}
					?>
				</form>
				<?php
				$data = ob_get_contents();
				ob_end_clean();
			}
		}
	}

	/**
	 * Method to verify HTTP response of some task execution.
	 *
	 * @param   JHttpResponse  $res  Joomla's HTTP response object.
	 *
	 * @return  boolean
	 */
	protected function verifyJoomlaResponse($res)
	{
		if (strpos($res->body, 'alert alert-') !== false
			&& strpos($res->body, 'alert alert-success') === false)
		{
			// Get error message.
			$res = preg_split('/alert alert-/', $res->body);
			$res = str_replace(array("\r", "\n"), ' ', $res[1]);

			if (preg_match('#<div class="alert-message">([^<]+)</div>#', $res, $match))
			{
				throw new Exception($match[1]);
			}

			throw new Exception(JText::_('JSN_PAGEBUILDER4_UNKNOWN_ERROR'));
		}

		return true;
	}

	/**
	 * Helper method to get J2Store currency settings.
	 *
	 * @return  object
	 */
	protected function getJ2storeCurrency()
	{
		static $currency;

		if (!isset($currency))
		{
			$currency = $this->dbo->setQuery(
				$this->dbo->getQuery(true)
					->select('*')
					->from('#__j2store_currencies')
					->where('currency_value = 1.00000000')
			)->loadObject();
		}

		return $currency;
	}

	/**
	 * Helper method to format price.
	 *
	 * @param   string  $price  Price to be formatted.
	 * @param   array   $opts   Currency settings.
	 *
	 * @return  string
	 */
	protected function formatPrice($price, $opts)
	{
		$price = number_format($price, $opts['num_decimals'], $opts['decimal_separator'], $opts['thousands_separator']);
		$format = $opts['currency_position'] === 'pre' ? '%2$s %1$s' : '%1$s %2$s';

		return sprintf($format, $price, $opts['currency_symbol']);
	}

}
