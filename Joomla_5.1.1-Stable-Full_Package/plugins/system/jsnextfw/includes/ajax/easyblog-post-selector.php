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
 * EasyBlog post selector screen.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwAjaxEasyBlogPostSelector extends JsnExtFwAjaxSelector
{
	/**
	 * Define target component.
	 *
	 * @var  string
	 */
	protected $option = 'com_easyblog';

	/**
	 * Define additional query parameters.
	 *
	 * @var  string
	 */
	protected $query_params = 'view=blogs&tmpl=component&layout=modal';

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
	protected $edit_link = 'index.php?option=com_easyblog&view=composer&tmpl=component&uid=';

	/**
	 * Define base view link.
	 *
	 * @var  string
	 */
	protected $view_link = 'index.php?option=com_easyblog&view=entry&id=';

	/**
	 * Process and set response content.
	 *
	 * @param   mixed  $content  Content will be sent to client.
	 *
	 * @return  void
	 */
	protected function setResponse($content)
	{
		// Clean up the HTML markups.
		if (strpos($content, ' versionUpdateExists =') !== false)
		{
			list($pre, $post) = explode(' versionUpdateExists =', $content, 2);
			$pre = substr($pre, 0, strrpos($pre, '<script '));
			$post = substr($post, strpos($post, '</script>') + 9);
			$content = $pre . $post;
		}

		// Create a DOMDocument object from the response.
		$dom = new DOMDocument();
		// Handle errors internally
		libxml_use_internal_errors(true);
		$dom->loadHTML($content);
		// Clear errors
		libxml_clear_errors();

		// Remove the toolbar actions.
		if ($toolbar = $dom->getElementById('toolbar-actions'))
		{
			$toolbar->parentNode->removeChild($toolbar);
		}

		// Remove the Plus icon on the EasyBlog Posts listing screen.
		foreach ($dom->getElementsByTagName('a') as $link)
		{
			if ($link->getAttribute('class') === 'btn-float-new')
			{
				$link->parentNode->removeChild($link);
			}
		}

		// Remove the first column on the EasyBlog Posts listing table.
		foreach ($dom->getElementsByTagName('table') as $table)
		{
			if (strpos($table->getAttribute('class'), 'app-table') !== false)
			{
				foreach ($table->getElementsByTagName('tr') as $row)
				{
					$cols = $row->getElementsByTagName($row->parentNode->tagName === 'thead' ? 'th' : 'td');

					if ($cols->length > 1)
					{
						$row->removeChild($cols->item(0));
					}
				}

				// Alter select links on the list table body.
				$tbody = $table->getElementsByTagName('tbody')->item(0);
				$links = $tbody->getElementsByTagName('a');

				foreach ($links as $link)
				{
					if ($link->hasAttribute('data-eb-composer')
						|| strpos($link->getAttribute('href'), '&view=composer&') !== false)
					{
						$link->setAttribute('class', 'select-link');
					}
					else
					{
						$link->setAttribute('onclick', 'return false;');
					}
				}
			}
		}

		// Let the parent class continue process the response.
		parent::setResponse($dom->saveHTML());
	}
}
