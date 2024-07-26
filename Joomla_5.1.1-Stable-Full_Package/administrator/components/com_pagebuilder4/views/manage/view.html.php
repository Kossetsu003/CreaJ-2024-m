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
 * Page Manager view.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JSNPageBuilder4ViewManage extends JViewLegacy
{
	/**
	 * An array of items.
	 *
	 * @var  array
	 */
	protected $items;

	/**
	 * The pagination object.
	 *
	 * @var  JPagination
	 */
	protected $pagination;

	/**
	 * The model state.
	 *
	 * @var  object
	 */
	protected $state;

	/**
	 * The item authors
	 *
	 * @var  array
	 */
	protected $authors;

	/**
	 * Form object for search filters.
	 *
	 * @var  JForm
	 */
	public $filterForm;

	/**
	 * The active search filters.
	 *
	 * @var  array
	 */
	public $activeFilters;

	/**
	 * Display the view.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->authors       = $this->get('Authors');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		// Add toolbars.
		JSNPageBuilder4Helper::addToolbars(JText::_('JSN_PAGEBUILDER4_PAGE_MANAGE_TEXT'), 'manage', 'list');

		JToolbarHelper::publish('manage.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('manage.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'manage.delete');

		// Add assets
		JSNPageBuilder4Helper::addAssets();

		return parent::display($tpl);
	}
}
