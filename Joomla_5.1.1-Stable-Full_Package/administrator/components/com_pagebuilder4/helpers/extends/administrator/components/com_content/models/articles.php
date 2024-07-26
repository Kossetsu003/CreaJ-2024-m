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
defined('_JEXEC') or die;

// Load ContentModelArticles class.
JLoader::register(
	'ContentModelArticles', JPATH_ADMINISTRATOR . '/components/com_content/models/articles.php'
);

/**
 * Extend ContentModelArticles class to support some features of JSN PageBuilder 4.
 */
class PB4_ContentModelArticles extends ContentModelArticles
{
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		$app   = JFactory::getApplication();
		$user  = JFactory::getUser();

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'DISTINCT a.id, a.catid, a.title, a.alias, a.introtext, a.fulltext, a.images'
				. ', a.state, a.access, a.created, a.modified, a.ordering, a.featured, a.language, a.hits'
				. ', a.publish_up, a.publish_down, a.created_by, a.created_by_alias, a.modified_by, a.attribs'
			)
		)
			->from('#__content AS a');

		// Refine modified date.
		$query->select(
			'CASE WHEN a.modified != "0000-00-00 00:00:00" THEN a.modified ELSE a.created END'
			. ' AS modified_date'
		);

		// Refine published date.
		$query->select(
			'CASE WHEN a.publish_up != "0000-00-00 00:00:00" THEN a.publish_up ELSE a.created END'
			. ' AS published_date'
		);

		// Join over the language
		$query->select('l.title AS language_title, l.image AS language_image, l.sef AS lang_sef')
			->join('LEFT', $db->quoteName('#__languages') . ' AS l ON l.lang_code = a.language');

		// Join over the users for the checked out user.
		$query->select('uc.name AS editor')
			->join('LEFT', '#__users AS uc ON uc.id = a.checked_out');

		// Join over the asset groups.
		$query->select('ag.title AS access_level')
			->join('LEFT', '#__viewlevels AS ag ON ag.id = a.access');

		// Join over the categories.
		$query->select(
			'c.title AS category_title, c.created_user_id AS category_uid, c.level AS category_level'
		)
			->join('LEFT', '#__categories AS c ON c.id = a.catid');

		$query->select('cl.sef AS cat_lang_sef')
			->join('LEFT', '#__languages AS cl ON cl.lang_code = c.language');

		// Join over the parent categories.
		$query->select(
			'parent.title AS parent_category_title, parent.id AS parent_category_id'
			. ', parent.created_user_id AS parent_category_uid, parent.level AS parent_category_level'
		)
			->join('LEFT', '#__categories AS parent ON parent.id = c.parent_id');

		// Join over the users for the author.
		$query->select(
			'CASE WHEN a.created_by_alias != "" THEN a.created_by_alias ELSE ua.name END AS author'
		)
			->join('LEFT', '#__users AS ua ON ua.id = a.created_by');

		// Join over the users for the editor.
		$query->select(
			'CASE WHEN ue.name != "" THEN ue.name '
			. 'WHEN a.created_by_alias != "" THEN a.created_by_alias ELSE ua.name END AS editor'
		)
			->join('LEFT', '#__users AS ue ON ue.id = a.modified_by');

		// Join on voting table
		$assogroup = 'a.id, l.title, l.image, uc.name, ag.title, c.title'
			. ', ua.name, c.created_user_id, c.level, parent.id';

		if (JPluginHelper::isEnabled('content', 'vote'))
		{
			$assogroup .= ', v.rating_sum, v.rating_count';
			$query->select(
				'COALESCE(NULLIF(ROUND(v.rating_sum  / v.rating_count, 0), 0), 0) AS rating'
				. ', COALESCE(NULLIF(v.rating_count, 0), 0) as rating_count'
			)
				->join('LEFT', '#__content_rating AS v ON a.id = v.content_id');
		}

		// Join over the associations.
		if (JLanguageAssociations::isEnabled())
		{
			$query->select('CASE WHEN COUNT(asso2.id)>1 THEN 1 ELSE 0 END as association')
				->join(
					'LEFT',
					'#__associations AS asso ON asso.id = a.id'
					. ' AND asso.context=' . $db->quote('com_content.item')
				)
				->join(
					'LEFT',
					'#__associations AS asso2'
					. ' ON ' . $db->quoteName('asso2.key') . ' = ' . $db->quoteName('asso.key')
				)
				->group($assogroup);
		}

		// Filter by access level.
		$access = $this->getState('filter.access');

		if (is_numeric($access))
		{
			$query->where('a.access = ' . (int) $access);
		}
		elseif (is_array($access))
		{
			$access = array_filter($access, 'intval');
			$access = implode(',', $access);
			$query->where('a.access IN (' . $access . ')');
		}

		// Filter by access level on categories.
		if (!$user->authorise('core.admin'))
		{
			$groups = implode(',', $user->getAuthorisedViewLevels());
			$query->where('a.access IN (' . $groups . ')');
			$query->where('c.access IN (' . $groups . ')');
		}

		// Filter by published state
		//$published = $this->getState('filter.published', 1);
		$published = 1;

		if (is_numeric($published))
		{
			$extra = '';

			if ($published) {
				if ((!$user->authorise('core.edit.state', 'com_content')) && (!$user->authorise('core.edit', 'com_content')))
				{
					$nullDate = $db->getNullDate();
					$nowDate  = JFactory::getDate()->toSql();
					$extra = " AND (a.publish_up = '{$nullDate}' OR a.publish_up <= '{$nowDate}') AND (a.publish_down = '{$nullDate}' OR a.publish_down >= '{$nowDate}')";
				}
			}

			$query->where('a.state = ' . (int) $published . $extra);
		}
		elseif ($published === '')
		{
			$query->where('(a.state = 0 OR a.state = 1)');
		}

		// Filter by categories and by level
		$categoryId = $this->getState('filter.category_id', array());
		$nestedCategories = $this->getState('filter.nested_categories', 1);
		//$level = $this->getState('filter.level', 0);
		$level = 0;

		if (!is_array($categoryId))
		{
			$categoryId = $categoryId ? array($categoryId) : array();
		}

		// Case: Using both categories filter and by level filter
		if (count($categoryId))
		{
			$categoryId = array_filter($categoryId, 'intval');

			if ($nestedCategories)
			{
				$categoryTable    = JTable::getInstance('Category', 'JTable');
				$subCatItemsWhere = array();

				foreach ($categoryId as $filter_catid)
				{
					$categoryTable->load($filter_catid);
					$subCatItemsWhere[] = '('
						. ($level ? 'c.level <= ' . ((int) $level + (int) $categoryTable->level - 1) . ' AND ' : '')
						. 'c.lft >= ' . (int) $categoryTable->lft . ' AND c.rgt <= ' . (int) $categoryTable->rgt . ')';
				}

				$query->where('(' . implode(' OR ', $subCatItemsWhere) . ')');
			}
			else
			{
				$query->where('c.id IN (' . implode(', ', $categoryId) . ')');
			}
		}

		// Case: Using only the by level filter
		elseif ($level)
		{
			$query->where('c.level <= ' . (int) $level);
		}

		// Filter by author
		$authorId = $this->getState('filter.author_id');

		if (is_numeric($authorId))
		{
			$type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
			$query->where('a.created_by ' . $type . (int) $authorId);
		}
		elseif (is_array($authorId))
		{
			$authorId = array_filter($authorId, 'intval');
			$authorId = implode(',', $authorId);
			$query->where('a.created_by IN (' . $authorId . ')');
		}

		// Filter by search in title.
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			elseif (stripos($search, 'author:') === 0)
			{
				$search = $db->quote('%' . $db->escape(substr($search, 7), true) . '%');
				$query->where('(ua.name LIKE ' . $search . ' OR ua.username LIKE ' . $search . ')');
			}
			elseif (stripos($search, 'content:') === 0)
			{
				$search = $db->quote('%' . $db->escape(substr($search, 8), true) . '%');
				$query->where('(a.introtext LIKE ' . $search . ' OR a.fulltext LIKE ' . $search . ')');
			}
			else
			{
				$search = $db->quote('%' . str_replace(
					' ', '%', $db->escape(trim($search), true) . '%'
				));
				$query->where("(a.title LIKE {$search} OR a.alias LIKE {$search} OR a.note LIKE {$search})");
			}
		}

		// Filter on the language.
		if ((method_exists($app, 'isClient') && $app->isClient('site')) || $app->isSite())
		{
			if (method_exists($app, 'getLanguageFilter') && $app->getLanguageFilter())
			{
				$language = JFactory::getLanguage()->getTag();
				$query->where("a.language IN ('*', " . $db->quote($language) . ')');
			}
		}
		elseif ($language = $this->getState('filter.language'))
		{
			$query->where('a.language = ' . $db->quote($language));
		}

		// Filter by a single or group of tags.
		$hasTag = false;
		$tagId  = $this->getState('filter.tag');

		if (is_numeric($tagId) && $tagId)
		{
			$hasTag = true;

			$query->where($db->quoteName('tagmap.tag_id') . ' = ' . (int) $tagId);
		}
		elseif (is_array($tagId))
		{
			$tagId = array_filter($tagId, 'intval');
			$tagId = implode(',', $tagId);

			if (!empty($tagId))
			{
				$hasTag = true;

				$query->where($db->quoteName('tagmap.tag_id') . ' IN (' . $tagId . ')');
			}
		}

		if ($hasTag)
		{
			$query->join(
				'LEFT',
				$db->quoteName('#__contentitem_tag_map', 'tagmap')
				. ' ON ' . $db->quoteName('tagmap.content_item_id') . ' = ' . $db->quoteName('a.id')
				. ' AND ' . $db->quoteName('tagmap.type_alias') . ' = ' . $db->quote('com_content.article')
			);
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering', 'a.id');
		$orderDirn = $this->state->get('list.direction', 'DESC');

		if ($orderCol == 'a.ordering' || $orderCol == 'category_title')
		{
			$orderCol = $db->quoteName('c.title') . " {$orderDirn}, " . $db->quoteName('a.ordering');
		}

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}
