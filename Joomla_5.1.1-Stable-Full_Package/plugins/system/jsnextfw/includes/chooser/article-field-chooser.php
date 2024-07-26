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
 * Article selector screen.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwChooserArticleFieldChooser extends JsnExtFwChooser
{
	/**
	 * Define target component.
	 *
	 * @var  string
	 */
	protected $option = 'com_fields';

	/**
	 * Define additional query parameters.
	 *
	 * @var  string
	 */
	protected $query_params = '&view=fields&layout=modal&tmpl=component&context=com_content.article';

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
	protected $edit_link = 'index.php?option=com_fields&task=field.edit&context=com_content.article&id=';

	
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
	            if (strpos($link->getAttribute('onclick'), 'Joomla.fieldIns') !== false)
	            {
	                $link->setAttribute('class', 'select-link');
	                $link->removeAttribute('onclick');
	            }
	            elseif (strpos($link->getAttribute('onclick'), 'Joomla.fieldgroupIns') !== false)
	            {
	                $link->removeAttribute('href');
	                $link->removeAttribute('onclick');
	                $link->setAttribute('class', 'label');
	            }
	        }
	    }
	    
	    // Let the parent class continue process the response.
	    return parent::setResponse($dom->saveHTML());
	}
}
