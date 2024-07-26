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

// Register path to custom form fields.
JFormHelper::addFieldPath(dirname(__FILE__) . '/fields');

/**
 * Page Manager model.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JSNPageBuilder4ModelManage extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @return  void
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'extension', 'a.extension',
				'created', 'a.created',
				'modified', 'a.modified',
				'created_by', 'a.created_by',
				'modified_by', 'a.modified_by',
				'title', 'status', 'revisions',
				'author_name', 'editor_name'
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = 'a.id', $direction = 'desc')
	{
		$app = JFactory::getApplication();
		$formSubmitted = $app->input->post->get('form_submitted');

		if ($formSubmitted)
		{
			$extension = $app->input->post->get('extension');
			$this->setState('filter.extension', $extension);

			$authorId = $app->input->post->get('author_id');
			$this->setState('filter.author_id', $authorId);

			$editorId = $app->input->post->get('editor_id');
			$this->setState('filter.editor_id', $editorId);
		}

		// List state information.
		parent::populateState($ordering, $direction);
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . serialize($this->getState('filter.extension'));
		$id .= ':' . serialize($this->getState('filter.author_id'));
		$id .= ':' . serialize($this->getState('filter.editor_id'));

		return parent::getStoreId($id);
	}

	/**
	 * Method to get a \JDatabaseQuery object for retrieving the data set from a database.
	 *
	 * @return  \JDatabaseQuery  A \JDatabaseQuery object to retrieve the data set.
	 */
	protected function getListQuery()
	{
		// Get Joomla application object.
		$app = JFactory::getApplication();

		// Create a new query object.
		$db    = $this->getDbo();
		
		//Fix the issue when running a query that join data from large tables
		$db->setQuery(
			$db->getQuery(true)
				->setQuery('SET SQL_BIG_SELECTS=1')
		)->execute();

		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query
			->select(
				$this->getState(
					'list.select',
					'a.id, a.hash, a.extension, a.created, a.created_by, a.modified, a.modified_by'
				)
			)
			->from('#__jsn_pagebuilder4_pages AS a');

		// Join over the users for the author.
		$query
			->select('ua.name AS author_name')
			->join('LEFT', '#__users AS ua ON ua.id = a.created_by');

		// Join over the users for the editor.
		$query
			->select('ue.name AS editor_name')
			->join('LEFT', '#__users AS ue ON ue.id = a.modified_by');

		// Join over the revisions for the total number of revisions.
		$query
			->select('COUNT(r.id) AS revisions')
			->join('LEFT', '#__jsn_pagebuilder4_revisions AS r ON r.type = "normal" AND r.hash = a.hash');

		// Filter by extension.
		$extension = $this->getState('filter.extension');

		if (!is_array($extension))
		{
			$extension = array_filter(explode(',', $extension), 'trim');
		}

		if (count($extension = array_map(array($db, 'quote'), $extension)))
		{
			$extension = implode(',', $extension);

			$query->where('a.extension IN (' . $extension . ')');
		}

		// Filter by author.
		$authorId = $this->getState('filter.author_id');

		if (!is_array($authorId))
		{
			$authorId = is_numeric($authorId) ? array($authorId) : explode(',', $authorId);
		}

		if (count($authorId = array_filter($authorId, 'intval')))
		{
			$authorId = implode(',', $authorId);

			$query->where('a.created_by IN (' . $authorId . ')');
		}

		// Filter by editor.
		$editorId = $this->getState('filter.editor_id');

		if (!is_array($editorId))
		{
			$editorId = is_numeric($editorId) ? array($editorId) : explode(',', $editorId);
		}

		if (count($editorId = array_filter($editorId, 'intval')))
		{
			$editorId = implode(',', $editorId);

			$query->where('a.modified_by IN (' . $editorId . ')');
		}

		// Group results by ID.
		$query->group('a.id');

		// Trigger an event to allow 3rd-party extension altering the query
		// to get the original item's ID, title and publishing state.
		$app->triggerEvent('onPageBuilder4GetListQuery', array(&$query));

		// Trigger an event to allow 3rd-party extension to set custom list ordering.
		$orderCol = $db->escape($this->state->get('list.ordering', 'a.id'));
		$orderDir = $db->escape($this->state->get('list.direction', 'DESC'));

		$ordering = array_filter($app->triggerEvent(
			'onPageBuilder4GetListOrdering', array($orderCol, $orderDir)
		));

		// Add the list ordering clause.
		if (!count($ordering))
		{
			$ordering = "{$orderCol} {$orderDir}";
		}

		$query->order($ordering);

		return $query;
	}

	/**
	 * Method to publish a list of pages.
	 *
	 * @param   array    $cid    List of page ID to be published.
	 * @param   integer  $state  New publishing state to set.
	 *
	 * @return  integer  The number of pages that are successfully published.
	 */
	public function publish($cid, $state)
	{
		// Get Joomla application object.
		$app = JFactory::getApplication();

		// Loop thru pages to publish.
		$pages = $this->getPages($cid);
		$success = 0;

		foreach ($pages as $page)
		{
			// Trigger an event to let 3rd-party extension publish the page.
			$results = $app->triggerEvent('onPageBuilder4PublishPage', array($page, $state));

			if (count(array_filter($results)))
			{
				$success++;
			}
		}

		// Clear cached data.
		$this->cleanCache();

		return $success;
	}

	/**
	 * Method to delete a list of pages.
	 *
	 * @param   array  $cid  List of page ID to be removed.
	 *
	 * @return  boolean
	 */
	public function delete($cid)
	{
		// Get Joomla application object.
		$app = JFactory::getApplication();

		// Get Joomla database object.
		$db = $this->getDbo();

		// Loop thru pages to delete.
		$pages = $this->getPages($cid);
		$success = 0;

		foreach ($pages as $page)
		{
			// Trigger an event to let 3rd-party extension delete the page.
			$results = $app->triggerEvent('onPageBuilder4DeletePage', array($page));

			if (count(array_filter($results)))
			{
				$success++;

				// Remove data of the deleted page.
				$db->setQuery(
					$db->getQuery(true)
						->delete('#__jsn_pagebuilder4_pages')
						->where("id = {$page->id}")
				)->execute();

				// Remove all revisions of the deleted page.
				$db->setQuery(
					$db->getQuery(true)
						->delete('#__jsn_pagebuilder4_revisions')
						->where("hash = '{$page->hash}'")
				)->execute();
			}
		}

		return $success;
	}

	/**
	 * Method to get data for the specified page IDs.
	 *
	 * @param   array  $cid  List of page ID to get data for.
	 *
	 * @return  array
	 */
	protected function getPages($cid)
	{
		// Get data for the specified page IDs.
		$query = $this->getListQuery();

		$query->where(
			'a.id IN (' . implode(', ', array_filter($cid, 'intval')) . ')'
		);

		return $this->getDbo()->setQuery($query)->loadObjectList();
	}
}
