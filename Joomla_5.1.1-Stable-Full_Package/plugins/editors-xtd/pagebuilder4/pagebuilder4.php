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

defined('_JEXEC') or die;

// Register necessary helper classes.
JLoader::register(
	'JSNPageBuilder4Helper',
	JPATH_ADMINISTRATOR . '/components/com_pagebuilder4/helpers/pagebuilder4.php'
);

/**
 * Button plugin.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */

class PlgButtonPageBuilder4 extends JPlugin
{
	/**
	 * Affects constructor behavior. If true, language files will be loaded automatically.
	 *
	 * @var  boolean
	 */
	protected $autoloadLanguage = true;

	/**
	 * Display buttons to toggle between default editor and JSN PageBuilder.
	 *
	 * @param   string  $name  The name of the button to add
	 *
	 * @return  JObject  The button options as JObject
	 */
	public function onDisplay($name)
	{
		// Get Joomla application object.
		$app = JFactory::getApplication();

		// Get Joomla input object.
		$input = $app->input;

		// Get request variables.
		$option = $input->getCmd('option');

		if (!JSNPageBuilder4Helper::isComponentSupported($option))
		{
			return;
		}

		$view = $input->getCmd('view');
		$task = $input->getCmd('task');
		$layout = $input->getCmd('layout');
		$controller = $input->getCmd('controller');

		// Get JSN PageBuilder 4 config.
		$config = JSNPageBuilder4Helper::getConfig();

		// Get Joomla database object.
		$dbo = JFactory::getDbo();

		// Define container signatures.
		if ($option === 'com_content'
			&& in_array($layout, array('edit', 'modal')) && in_array($view, array('article', 'form')))
		{
			if ($view === 'article')
			{
				$pos = 'before';
				$elm = '#general .span9 .adminform';
			}
			else
			{
				$pos = 'after';
				$elm = '#editor .control-group';
			}

			// Create a query object to get content if editing an item.
			if (($id = $input->getInt('a_id')) || ($id = $input->getInt('id')))
			{
				$query = $dbo->getQuery(true)
					->select('CONCAT(' . $dbo->quoteName('introtext') . ', ' . $dbo->quoteName('fulltext') . ') AS content')
					->from('#__content')
					->where('id = ' . $id);
			}
		}
		elseif ($view === 'module' && $layout === 'edit'
			&& in_array($option, array('com_modules', 'com_advancedmodules')))
		{
			// Get module data.
			if ($id = $input->getInt('id'))
			{
				$module = $dbo->setQuery(
					$dbo->getQuery(true)
						->select('module')
						->from('#__modules')
						->where('id = ' . $id)
				)->loadResult();
			}
			elseif (($eid = $input->getInt('eid'))
				|| $app->getUserState('com_modules.add.module.extension_id')
				|| $app->getUserState('com_advancedmodules.add.module.extension_id'))
			{
				if (!$eid)
				{
					if ($app->getUserState('com_modules.add.module.extension_id'))
					{
						$eid = (int) $app->getUserState('com_modules.add.module.extension_id');
					}
					else
					{
						$eid = (int) $app->getUserState('com_advancedmodules.add.module.extension_id');
					}
				}

				$module = $dbo->setQuery(
					$dbo->getQuery(true)
						->select('element')
						->from('#__extensions')
						->where('extension_id = ' . $eid)
				)->loadResult();
			}

			if (isset($module) && $module === 'mod_custom')
			{
				$pos = 'after';
				$elm = '#general .span9 .info-labels + div';

				// Create a query object to get content if editing an item.
				if ($id)
				{
					$query = $dbo->getQuery(true)
						->select('content')
						->from('#__modules')
						->where('id = ' . $id);
				}
			}
		}
		elseif ($option === 'com_config'
			&& $controller === 'config.display.modules' && ($id = $input->getInt('id')))
		{
			// Get module data.
			$module = $dbo->setQuery(
				$dbo->getQuery(true)
					->select('module')
					->from('#__modules')
					->where('id = ' . $id)
			)->loadResult();

			if ($module === 'mod_custom')
			{
				$pos = 'before';
				$elm = '#custom > *:first-child';

				// Create a query object to get content if editing an item.
				$query = $dbo->getQuery(true)
					->select('content')
					->from('#__modules')
					->where('id = ' . $id);
			}
		}
		elseif ($option === 'com_advancedmodules'
			&& $view === 'edit' && $task === 'edit' && ($id = $input->getInt('id')))
		{
			// Get module data.
			$module = $dbo->setQuery(
				$dbo->getQuery(true)
					->select('module')
					->from('#__modules')
					->where('id = ' . $id)
			)->loadResult();

			if ($module === 'mod_custom')
			{
				$pos = 'before';
				$elm = '#jform_content';

				// Create a query object to get content if editing an item.
				$query = $dbo->getQuery(true)
					->select('content')
					->from('#__modules')
					->where('id = ' . $id);
			}
		}
		elseif ($option === 'com_k2' && $view === 'item')
		{
			$pos = 'before';
			$elm = '#k2Tabs .k2TabsContent .k2ItemFormEditor';

			// Create a query object to get content if editing an item.
			if ($id = $input->getInt('cid'))
			{
				$query = $dbo->getQuery(true)
					->select('CONCAT(' . $dbo->quoteName('introtext') . ', ' . $dbo->quoteName('fulltext') . ') AS content')
					->from('#__k2_items')
					->where('id = ' . $id);
			}
		}
		elseif ($option === 'com_falang' && in_array($task, array('translate.edit', 'translate.apply'))
			&& (in_array($input->getCmd('catid'), array('content', 'modules')) || $input->get('cid')))
		{
			if (in_array($input->getCmd('catid'), array('content', 'modules')))
			{
				if ($input->getCmd('catid') === 'content')
				{
					$pos = 'after';
					$elm = 'input[name="id_introtext"]';
				}
				else
				{
					$pos = 'after';
					$elm = 'input[name="id_content"]';
				}
			}

			// Create a query object to get content if editing an item.
			if ($id = current($input->get('cid', array(), 'array')))
			{
				list($trans_id, $ref_id, $lang_id) = explode('|', $id);

				if (!isset($elm))
				{
					$ref = $dbo->setQuery(
						$dbo->getQuery(true)
							->select('reference_table')
							->from('#__falang_content')
							->where('language_id = ' . $lang_id)
							->where('reference_id = ' . $ref_id)
							->where("reference_field IN ('introtext', 'fulltext', 'content')")
					)->loadResult();

					if ($ref === 'content')
					{
						$pos = 'after';
						$elm = 'input[name="id_introtext"]';
					}
					else
					{
						$pos = 'after';
						$elm = 'input[name="id_content"]';
					}

					$input->set('catid', $ref);
				}

				$query = $dbo->getQuery(true)
					->select($dbo->quoteName('value') . ' AS content')
					->from('#__falang_content')
					->where('language_id = ' . $lang_id)
					->where('reference_id = ' . $ref_id)
					->where("reference_field IN ('introtext', 'fulltext', 'content')");

				$faCatid =  $input->getCmd('catid','');

				if ($faCatid == 'content' || $faCatid == 'modules')
				{
					if ($faCatid == 'modules')
					{
						$tmpQuery = $dbo->getQuery(true)
							->select('*')
							->from('#__modules')
							->where('id = ' . $ref_id);
						$tmpResult = $dbo->setQuery($tmpQuery)->loadObject();
						if ($tmpResult)
						{
							if ($tmpResult->module == 'mod_custom')
							{
								if (preg_match('#<!-- Start_PF_Hash\|[^\|]+\|End_PF_Hash -->#', $tmpResult->content))
								{
									 $app->enqueueMessage(JText::_('PLG_EDITORSXTD_PAGEBUILDER4_YOUR_ORIGINAL_CONTENT_IS_BUILT_BY_JSN_PAGEBUILDER4_EDIT_IT_AT_MODULE_SETTINGS_PAGE'));
								}
							}

						}

					}

					if ($faCatid == 'content')
					{
						$tmpQuery = $dbo->getQuery(true)
							->select('*')
							->from('#__content')
							->where('id = ' . $ref_id);
						$tmpResult = $dbo->setQuery($tmpQuery)->loadObject();

						if ($tmpResult)
						{
							if (preg_match('#<!-- Start_PF_Hash\|[^\|]+\|End_PF_Hash -->#', $tmpResult->fulltext))
							{
								 $app->enqueueMessage(JText::_('PLG_EDITORSXTD_PAGEBUILDER4_YOUR_ORIGINAL_CONTENT_IS_BUILT_BY_JSN_PAGEBUILDER4_EDIT_IT_AT_CONTENT_SETTINGS_PAGE'));
							}


						}

					}
				}
			}
		}

		if (isset($pos) && isset($elm))
		{
			// Rebuild request link.
			$link = current(explode('#', JUri::getInstance()->toString()));

			if (strtolower($_SERVER['REQUEST_METHOD']) === 'post')
			{
				$post = $input->post->getArray();

				foreach (array_keys($post) as $k)
				{
					if (!preg_match('/(id|direct|return)$/', $k)
						&& !in_array($k, array('option', 'controller', 'view', 'task', 'layout', 'tmpl')))
					{
						unset($post[$k]);
					}
					elseif (preg_match("/[?&]{$k}=/", $link))
					{
						unset($post[$k]);
					}
				}

				$link .= (strpos($link, '?') === false ? '?' : '&') . http_build_query($post);
			}

			// Get user editor.
			$editor = JFactory::getUser()->getParam('editor', JFactory::getConfig()->get('editor'));

			if (!in_array($editor, array('pagebuilder3', 'pagebuilder4')))
			{
				// Get requested editor.
				$requested_editor = $input->get('editor', false);

				if ($requested_editor === false)
				{
					$redirect = false;

					// Check if content being edited was created with JSN PageBuilder 4.
					if (isset($query))
					{
						foreach ($dbo->setQuery($query)->loadColumn() as $content)
						{
							if (preg_match('#<!-- Start_PF_Hash\|[^\|]+\|End_PF_Hash -->#', $content))
							{
								$redirect = true;

								break;
							}
						}
					}

					// Check if user want to replace the default editor with JSN PageBuilder 4.
					elseif ((int) $config['replace_default_editor'])
					{
						$redirect = true;
					}

					if ($redirect)
					{
						$link .= (strpos($link, '?') === false ? '?' : '&') . 'editor=pagebuilder4';

						return $app->redirect($link);
					}
				}
			}

			JsnExtFwAssets::loadInlineStyle('
				#pb3-editor-switcher {
					display: none !important;
				}
				#pagebuilder4-editor-switcher {
					margin-bottom: 18px !important;
					padding-left: 0;
				}
				#k2Tabs .k2TabsContent #pagebuilder4-editor-switcher {
					margin-top: 18px !important;
				}
			');

			JsnExtFwAssets::loadInlineScript(';
				document.addEventListener("DOMContentLoaded", function() {
					(function createEditorSwitcher() {
						// Find the reference element.
						var sign = document.querySelector("' . addslashes($elm) . '");

						if (sign) {
							// Check if there is an editor switcher of JSN PageBuilder 3.
							var hasPB3Switcher = document.getElementById("pb3-editor-switcher");

							if (hasPB3Switcher) {
								hasPB3Switcher.parentNode.parentNode.removeChild(hasPB3Switcher.parentNode);
							}

							// Create button group for switching editor.
							var toggler = document.createElement("div");

							toggler.className = "form-horizontal";
							toggler.lastEditor = "' . $editor . '";
							toggler.style.clear = "both";

							toggler.innerHTML = `
								<div
									id="pagebuilder4-editor-switcher"
									class="control-group btn-group btn-group-yesno radio"
								>
									<input
										type="radio"
										id="pagebuilder4-editor-switcher-default"
										name="pagebuilder4-editor-switcher"
										value="default"' . (
											strpos($editor, 'pagebuilder') === false ? ' checked' : ''
										) . '
									/>
									<label
										for="pagebuilder4-editor-switcher-default"
										class="btn' . (
											strpos($editor, 'pagebuilder') === false ? ' btn-success active' : ''
										) . '"
									>
										' . JText::_('JSN_PAGEBUILDER4_JOOMLA_EDITOR') . '
									</label>
									` + (hasPB3Switcher ? `
									<input
										type="radio"
										id="pagebuilder4-editor-switcher-pagebuilder3"
										name="pagebuilder4-editor-switcher"
										value="pagebuilder3"' . ($editor == 'pagebuilder3' ? ' checked' : '') . '
									/>
									<label
										for="pagebuilder4-editor-switcher-pagebuilder3"
										class="btn' . ($editor == 'pagebuilder3' ? ' btn-success active' : '') . '
									">
										' . JText::_('JSN_PAGEBUILDER4_PAGEBUILDER3_EDITOR') . '
									</label>
									` : "") + `
									<input
										type="radio"
										id="pagebuilder4-editor-switcher-pagebuilder4"
										name="pagebuilder4-editor-switcher"
										value="pagebuilder4"' . ($editor == 'pagebuilder4' ? ' checked' : '') . '
									/>
									<label
										for="pagebuilder4-editor-switcher-pagebuilder4"
										class="btn' . ($editor == 'pagebuilder4' ? ' btn-success active' : '') . '
									">
										' . JText::_('JSN_PAGEBUILDER4_PAGEBUILDER4_EDITOR') . '
									</label>
								</div>`;

							toggler.onclick = function(event) {
								if (
									event.target.nodeName == "LABEL"
									&&
									event.target.previousElementSibling.value != toggler.lastEditor
								) {
									var href = "' . $link . '";
									var editor = event.target.previousElementSibling.value;

									href = href.replace(/[?&]editor=[^&]+/, "").replace(/(#.*)?$/, "");
									href += (href.indexOf("?") < 0 ? "?" : "&") + "editor=" + editor;

									window.location.href = href;
								}
							};

							sign.parentNode.insertBefore(toggler, sign' . ($pos == 'after' ? '.nextSibling' : '') . ');
							' . ($option == 'com_modules' && strpos($editor, 'pagebuilder') === 0 ? '
							// Enable Prepare Content parameter when JSN PageBuilder 4 is used on a custom module.
							var enablePrepareContent = document.querySelector("#jform_params_prepare_content0 + label");

							if (enablePrepareContent) {
								enablePrepareContent.click();
							}' : '') . '
						}
						else if (!createEditorSwitcher.retry || createEditorSwitcher.retry < 100) {
							if (createEditorSwitcher.retry) {
								createEditorSwitcher.retry++;
							} else {
								createEditorSwitcher.retry = 1;
							}

							setTimeout(createEditorSwitcher, 100);
						}
					})();
				});'
			);
		}
	}
}
