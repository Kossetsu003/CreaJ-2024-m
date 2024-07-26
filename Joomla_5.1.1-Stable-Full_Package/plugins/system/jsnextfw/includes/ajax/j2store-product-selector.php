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
 * J2Store product selector screen.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwAjaxJ2storeProductSelector extends JsnExtFwAjaxSelector
{
	/**
	 * Define target component.
	 *
	 * @var  string
	 */
	protected $option = 'com_j2store';

	/**
	 * Define additional query parameters.
	 *
	 * @var  string
	 */
	protected $query_params = 'view=products&tmpl=component';

	/**
	 * Define the CSS class of the list table.
	 *
	 * @var  string
	 */
	protected $list_class = 'product-list';

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
	protected $edit_link = 'index.php?option=com_content&task=article.edit&id=';

	/**
	 * Define base view link.
	 *
	 * @var  string
	 */
	protected $view_link = 'index.php?option=com_easyblog&view=products&task=view&id=';

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

		// Remove the sidebar.
		if ($sidebar = $dom->getElementById('j-sidebar-container'))
		{
			$sidebar->parentNode->removeChild($sidebar);
		}

		// Remove the class of the main content container.
		if ($main = $dom->getElementById('j-main-container'))
		{
			$main->removeAttribute('class');

			// Remove notice and hint.
			$divs = $main->getElementsByTagName('div');

			for ($i = $divs->length - 1; $i >= 0; $i--)
			{
				if (strpos($divs[$i]->getAttribute('class'), 'alert') !== false
					|| strpos($divs[$i]->getAttribute('class'), 'panel') !== false)
				{
					$divs[$i]->parentNode->removeChild($divs[$i]);
				}
			}
		}

		// Remove the first 2 columns on the J2Store Products listing table.
		foreach ($dom->getElementsByTagName('table') as $table)
		{
			if (strpos($table->parentNode->getAttribute('class'), 'j2store-product-list') !== false)
			{
				foreach ($table->getElementsByTagName('tr') as $row)
				{
					$cols = $row->getElementsByTagName($row->parentNode->tagName === 'thead' ? 'th' : 'td');

					if ($cols->length > 2)
					{
						$row->removeChild($cols->item(1));
						$row->removeChild($cols->item(0));

						// Move product ID column to the last order.
						$row->appendChild($cols->item(0));
					}
				}

				// Alter select links on the list table body.
				$tbody = $table->getElementsByTagName('tbody')->item(0);
				$links = $tbody->getElementsByTagName('a');

				foreach ($links as $link)
				{
					if (strpos($link->getAttribute('href'), '&task=article.edit&') !== false)
					{
						$link->setAttribute('class', 'select-link');
					}
					else
					{
						$link->setAttribute('onclick', 'return false;');
					}
				}

				// Add necessary class to the list table.
				$table->setAttribute('class', $table->getAttribute('class') . ' product-list');
			}
		}

		// Let the parent class continue process the response.
		parent::setResponse($dom->saveHTML());
	}
}
