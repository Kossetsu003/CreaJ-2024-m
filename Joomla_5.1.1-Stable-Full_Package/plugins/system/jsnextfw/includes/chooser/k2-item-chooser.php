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
 * K2 item selector screen.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwChooserK2ItemChooser extends JsnExtFwChooser
{
	/**
	 * Define target component.
	 *
	 * @var  string
	 */
	protected $option = 'com_k2';

	/**
	 * Define additional query parameters.
	 *
	 * @var  string
	 */
	protected $query_params = 'view=items&tmpl=component&layout=modal';

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
	protected $edit_link = 'index.php?option=com_k2&view=item&cid=';

	/**
	 * Define base view link.
	 *
	 * @var  string
	 */
	protected $view_link = 'index.php?option=com_k2&view=item&id=';

	/**
	 * Process and set response content.
	 *
	 * @param   mixed  $content  Content will be sent to client.
	 *
	 * @return  void
	 */
	protected function setResponse($content)
	{
        // Throw a error if not is admin area
	    if (class_exists('JsnExtFwHelper'))
        {
            if(!JsnExtFwHelper::isAdmin())
            {
                throw new Exception(JText::_('JSN_EXTFW_THIS_FEATURE_ONLY_AVAILABLE_TO_JOOMLA_BACKEND'));
            }
        }

		// Create a DOMDocument object from the response.
		$dom = new DOMDocument();
		// Handle errors internally
		libxml_use_internal_errors(true);
		$dom->loadHTML($content);
		// Clear errors
		libxml_clear_errors();

		// Remove the left sidebar on the K2 Items listing screen.
		$sidebar = $dom->getElementById('k2Sidebar');
        // Get the admin form.
        $form = $dom->getElementById('adminForm');

		$container = $sidebar->parentNode;

		$filters = $container->getElementsByTagName('table')->item(1);

		$cols = $filters->getElementsByTagName('td');
		$row = $dom->createElement('tr');

		$container->setAttribute('style', 'display: block;');
		$container->removeChild($sidebar);

		$filters->appendChild($row);
		$filters->setAttribute('class', 'table');
		$filters->setAttribute('style', 'margin-bottom: 0;');

		$cols->item(0)->setAttribute('style', 'border: 0;');

		$cols->item(1)->setAttribute(
			'style', 'border: 0; padding: 10px; display: flex; justify-content: space-between;'
		);

		$row->appendChild($cols->item(1));

		// Remove the mobile menu on the K2 Items listing screen.
		if ($mobileMenu = $dom->getElementById('k2AdminMobileMenu'))
		{
			$mobileMenu->parentNode->removeChild($mobileMenu);
		}

        // Remove the modal header on the K2 Items listing screen.
        if ($modalHeader = $dom->getElementById('k2ModalHeader'))
        {
            $modalHeader->parentNode->removeChild($modalHeader);
        }

		// Remove body padding on the K2 Items listing screen.
		$dom->getElementsByTagName('body')->item(0)->setAttribute('style', 'padding: 0;');

		// Alter the filter select boxes.
		foreach ($filters->getElementsByTagName('select') as $select)
		{
			$select->setAttribute('onchange', 'this.form.submit();');
		}

		// Remove the first 2 columns on the K2 Items listing table.
		$table = $filters->nextSibling;

		if (strtolower(get_class($table)) != 'DOMElement')
        {
            $table = $dom->getElementById('k2ItemsList');
        }

		$table->setAttribute('style', 'padding-top: 0;');

		foreach ($table->getElementsByTagName('tr') as $row)
		{
			$cols = $row->getElementsByTagName($row->parentNode->tagName === 'thead' ? 'th' : 'td');

			if ($cols->length > 1)
			{
				$row->removeChild($cols->item(1));
				$row->removeChild($cols->item(0));
			}
		}

		// Alter select links on the list table body.
		$tbody = $table->getElementsByTagName('tbody')->item(0);
		$links = $tbody->getElementsByTagName('a');

		foreach ($links as $link)
		{
			if ($link->parentNode->getAttribute('class') === 'k2ui-list-title')
			{
				$link->setAttribute('class', 'select-link');
			}
			else
			{
				$link->setAttribute('onclick', 'return false;');
			}
		}

        // Get the admin form.
        if ($form)
        {
            $form->setAttribute('style', 'margin-top: 0;');
        }

		// Let the parent class continue process the response.
		return parent::setResponse($dom->saveHTML());
	}
}
