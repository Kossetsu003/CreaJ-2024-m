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

JFormHelper::loadFieldClass('list');

/**
 * Form field to load a list of JSN PageBuilder 4 editors.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JFormFieldEditors extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var   string
	 */
	public $type = 'Editors';

	/**
	 * Cached array of the category items.
	 *
	 * @var   array
	 */
	protected static $options = array();

	/**
	 * Method to get the options to populate list.
	 *
	 * @return  array  The field option objects.
	 */
	protected function getOptions()
	{
		// Accepted modifiers.
		$hash = md5($this->element);

		if (!isset(static::$options[$hash]))
		{
			static::$options[$hash] = parent::getOptions();

			$db = JFactory::getDbo();

			// Construct the query.
			$query = $db->getQuery(true)
				->select('u.id AS value, u.name AS text')
				->from('#__users AS u')
				->join('INNER', '#__jsn_pagebuilder4_pages AS c ON c.modified_by = u.id')
				->group('u.id, u.name')
				->order('u.name');

			// Setup the query.
			$db->setQuery($query);

			// Return the result.
			if ($options = $db->loadObjectList())
			{
				static::$options[$hash] = array_merge(static::$options[$hash], $options);
			}
		}

		return static::$options[$hash];
	}
}
