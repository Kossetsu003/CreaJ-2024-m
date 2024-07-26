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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Module selector screen.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwChooserModuleChooser extends JsnExtFwChooser
{
	/**
	 * Define target component.
	 *
	 * @var  string
	 */
	protected $option = 'com_modules';

	/**
	 * Define additional query parameters.
	 *
	 * @var  string
	 */
	protected $query_params = 'view=modules&tmpl=component&layout=modal';

	/**
	 * Define the CSS class of the link to edit an item.
	 *
	 * @var  string
	 */
	protected $edit_class = 'select-link';

	/**
	 * Define base edit link.
	 *
	 * @var  string
	 */
	protected $edit_link = 'index.php?option=com_modules&task=module.edit&id=';

	/**
	 * Process and set response content.
	 *
	 * @param   mixed  $content  Content will be sent to client.
	 *
	 * @return  void
	 */
	protected function setResponse($content)
	{
		// Create a DOMDocument object from the response.
		$dom = new DOMDocument();
		// Handle errors internally
		libxml_use_internal_errors(true);
		$dom->loadHTML($content);
		// Clear errors
		libxml_clear_errors();

		// Get the form that contains the list table.
		$forms = $dom->getElementsByTagName('form');

		foreach ($forms as $form)
		{
			if ($form->getAttribute('id') === 'adminForm')
			{
				break;
			}
		}

		// Alter the style of some columns on the list table body.
		$tbody = $form->getElementsByTagName('tbody');

		if ($tbody->length)
		{
			$links = $tbody->item(0)->getElementsByTagName('a');

			foreach ($links as $link)
			{
				if (strpos($link->getAttribute('class'), 'js-module-insert') !== false)
				{
					$link->setAttribute('class', 'select-link');
				}
				elseif (strpos($link->getAttribute('class'), 'js-position-insert') !== false)
				{
					$link->removeAttribute('href');
					$link->setAttribute('class', 'label');
				}
			}
		}

		// Let the parent class continue process the response.
		return parent::setResponse($dom->saveHTML());
	}
}
