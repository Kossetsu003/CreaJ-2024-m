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
 * Help view
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JSNPageBuilder4ViewHelp extends JViewLegacy
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
		// Add toolbars.
		JSNPageBuilder4Helper::addToolbars(JText::_('JSN_PAGEBUILDER4_PAGE_HELP_TEXT'), 'help', 'question');

		// Add assets
		JSNPageBuilder4Helper::addAssets();

		// Display the template
		parent::display($tpl);
	}
}
