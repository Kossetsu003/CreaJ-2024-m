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

/**
 * Config view
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JSNPageBuilder4ViewConfig extends JViewLegacy
{
	/**
	 * Display method
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return	void
	 */
	function display($tpl = null)
	{
		// Add a button for saving change.
		JToolbarHelper::apply();

		// Add toolbars.
		JSNPageBuilder4Helper::addToolbars(JText::_('JSN_PAGEBUILDER4_PAGE_CONFIG_TEXT'), 'config', 'cogs');

		// Add assets
		JSNPageBuilder4Helper::addAssets();

		// Get integration form.
		$this->integration_form = json_decode(
			file_get_contents(JPATH_COMPONENT_ADMINISTRATOR . '/config/integration.json'), true
		);

		$this->integration_form['groups'][0]['controls']['supported_components']['options'] = array_values(
			JSNPageBuilder4Helper::getInstalledSupportedExtensions(
				$this->integration_form['groups'][0]['controls']['supported_components']['options']
			)
		);

		// Display the template
		parent::display($tpl);
	}
}
