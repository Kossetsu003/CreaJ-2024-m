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

// No direct access to this file.
defined('_JEXEC') or die('Restricted access');

/**
 * Page revision table.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class PageBuilder4TableRevision extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  $db  Database connector object
	 *
	 * @return  void
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__jsn_pagebuilder4_revisions', 'id', $db);
	}

	/**
	 * Method to store a row in the database from the Table instance properties.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean
	 */
	public function store($updateNulls = false)
	{
		if ($this->id)
		{
			// Store modified time and ID of the user who is modifying an existed revision record.
			$this->modified = JFactory::getDate()->toSql();
			$this->modified_by = JFactory::getUser()->id;
		}
		else
		{
			// Store created time and ID of the user who is creating a new revision record.
			$this->created = JFactory::getDate()->toSql();
			$this->created_by = JFactory::getUser()->id;
		}

		return parent::store($updateNulls);
	}
}
