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

/**
 * Editor plugin.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class PlgEditorPageBuilder4 extends JPlugin
{
	/**
	 * Affects constructor behavior. If true, language files will be loaded automatically.
	 *
	 * @var  boolean
	 */
	protected $autoloadLanguage = true;

	/**
	 * Initialize the editor.
	 *
	 * @return  void
	 */
	public function onInit()
	{
		static $initialized;

		// Initialize the editor only once.
		if (!$initialized)
		{
			// Get Joomla application object.
			$app = JFactory::getApplication();

			// Trigger an event to allow 3rd-party plugins do pre-init actions.
			$app->triggerEvent('onPageBuilder4PreInitEditor', array(&$this->params));

			// Trigger an event to allow 3rd-party plugins do post-init actions.
			$app->triggerEvent('onPageBuilder4PostInitEditor', array(&$this->params));

			// State that the editor is initialized.
			$initialized = true;
		}
	}

	/**
	 * Get the editor content.
	 *
	 * @param   string  $id  The id of the editor field.
	 *
	 * @return  string
	 */
	public function onGetContent($id)
	{
		return sprintf('document.getElementById(%1$s).value', json_encode((string) $id));
	}

	/**
	 * Display the editor area.
	 *
	 * @param   string   $name     The control name.
	 * @param   string   $content  The contents of the text area.
	 * @param   string   $width    The width of the text area (px or %).
	 * @param   string   $height   The height of the text area (px or %).
	 * @param   int      $col      The number of columns for the textarea.
	 * @param   int      $row      The number of rows for the textarea.
	 * @param   boolean  $buttons  True and the editor buttons will be displayed.
	 * @param   string   $id       An optional ID for the textarea (note: since 1.6). If not supplied the name is used.
	 * @param   string   $asset    Not used.
	 * @param   object   $author   Not used.
	 * @param   array    $params   Associative array of editor parameters.
	 *
	 * @return  string
	 */
	public function onDisplay(
		$name,
		$content,
		$width,
		$height,
		$col,
		$row,
		$buttons = true,
		$id = null,
		$asset = null,
		$author = null,
		$params = array()
	)
	{
		// Get Joomla application object.
		$app = JFactory::getApplication();
		$option = $app->input->getCmd('option', '');
		// Prepare ID.
		$id = empty($id) ? $name : $id;

		// Never render JSN PageBuilder4 editor for the original text field on FaLang translation screen.
        // Never render JSN PageBuilder4 editor for Editor Custom field on Joomla Artcile Settings Screen.
		if (($app->input->getCmd('option') === 'com_falang' && strpos($id, 'origText_') === 0) || ($app->input->getCmd('option') === 'com_content' && strpos($id, 'jform_com_fields') !== false))
		{
			$editor = JEditor::getInstance(defined('ORIGINAL_EDITOR') ? ORIGINAL_EDITOR : 'tinymce');

			return call_user_func_array(array($editor, 'display'), func_get_args());
		}

		// Render buttons.
		$this->displayButtons($id, $buttons, $asset, $author);

		// Trigger an event to allow 3rd-party plugins to customize display data.
		$results[] = implode(
			"\n", array_filter($app->triggerEvent('onPageBuilder4PreRenderEditor'))
		);

		// Render the editor.
		$results[] = '
			<textarea id="' . $id . '" name="' . $name . '" style="display: none;">' . $content . '</textarea>';

		// Trigger an event to allow 3rd-party plugins to add more display data.
		$results[] = implode(
			"\n", array_filter($app->triggerEvent('onPageBuilder4PostRenderEditor'))
		);

		// Keep session alive, for example, while editing or creating an article.
		JHtml::_('behavior.keepalive');

		// Load main script for JSN PageBuilder 4 editor.
		JHtml::script(JUri::root() . 'plugins/editors/pagebuilder4/assets/app/pagefly/main.js');

        // Check the global text filters for current user groups
        if (in_array($option, array('com_modules', 'com_advancedmodules', 'com_content')))
        {
            JSNPageBuilder4Helper::checkFilterText($app->input->getCmd('option'));
        }

		// Init data for the editor.
		JSNPageBuilder4Helper::initEditorData($id);

		return implode($results);
	}

	/**
	 * Displays the editor buttons.
	 *
	 * @param   string  $name     Button name.
	 * @param   mixed   $buttons  [array with button objects | boolean true to display buttons]
	 * @param   mixed   $asset    Unused.
	 * @param   mixed   $author   Unused.
	 *
	 * @return  string
	 */
	protected function displayButtons($name, $buttons, $asset, $author)
	{
		$return = '';
		$args = array(
			'name' => $name,
			'event' => 'onGetInsertMethod'
		);

		$results = (array) $this->update($args);

		if ($results)
		{
			foreach ($results as $result)
			{
				if (is_string($result) && trim($result))
				{
					$return .= $result;
				}
			}
		}

		if (is_array($buttons) || (is_bool($buttons) && $buttons))
		{
			$buttons = $this->_subject->getButtons($name, $buttons, $asset, $author);
			$return .= JLayoutHelper::render('joomla.editors.buttons', $buttons);
		}

		return $return;
	}
}
