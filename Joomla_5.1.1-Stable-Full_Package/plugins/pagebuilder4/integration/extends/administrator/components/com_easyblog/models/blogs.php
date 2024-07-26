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

// Load EB, EasyBlogAdminModel and EasyBlogModelBlogs class.
JLoader::register(
	'EB', JPATH_ROOT . '/administrator/components/com_easyblog/includes/easyblog.php'
);
JLoader::register(
	'EasyBlogAdminModel', JPATH_ROOT . '/administrator/components/com_easyblog/models/model.php'
);
JLoader::register(
	'EasyBlogModelBlogs', JPATH_ADMINISTRATOR . '/components/com_easyblog/models/blogs.php'
);

// Make sure EasyBlog is installed.
if (!class_exists('EB')
	|| !class_exists('EasyBlogAdminModel')
	|| !class_exists('EasyBlogModelBlogs'))
{
	return;
}

/**
 * Extend K2ModelItems class to support some features of JSN PageBuilder 4.
 */
class PB4_EasyBlogModelBlogs extends EasyBlogModelBlogs
{
	public function _buildDataQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where = $this->_buildDataQueryWhere();

		// Get the db
		$db = EB::db();

		$query	= 'SELECT DISTINCT a.*, cat.category_id AS category_id, cat_info.title AS category_title, ua.name AS author, l.sef AS lang_sef, cl.sef AS cat_lang_sef';
		$query	.= ' FROM ' . $db->quoteName( '#__easyblog_post' ) . ' AS a ';

		// Get the current state
		$state = $this->app->input->getWord( 'filter_state', '' );

		if ($state == 'F') {
			$query 	.= ' INNER JOIN #__easyblog_featured AS ' . $db->quoteName('featured');
			$query	.= ' ON a.' . $db->quoteName('id') . ' = featured.' . $db->quoteName('content_id') . ' AND featured.' . $db->quoteName('type') . ' = "post"';
		}

		// Always join with the category table
		$query .= ' LEFT JOIN ' . $db->quoteName('#__easyblog_post_category') . ' AS cat';
		$query .= ' ON a.' . $db->quoteName('id') . ' = cat.' . $db->quoteName('post_id');
		$query .= ' LEFT JOIN #__easyblog_category AS cat_info ON cat_info.id = cat.category_id';

		// Join with languages table to get language SEF code.
		$query .= " LEFT JOIN #__languages AS l ON l.lang_code = a.language";
		$query .= " LEFT JOIN #__languages AS cl ON cl.lang_code = cat_info.language";

		$query .= ' LEFT JOIN #__users AS ua ON ua.id = a.created_by';

		// Filter by tags
		$tag = array_filter($this->input->get('filter_tag', array(), 'array'), 'intval');

		if (count($tag)) {
			$query	.= ' INNER JOIN #__easyblog_post_tag AS b ON a.' . $db->quoteName('id') . '= b.' . $db->quoteName('post_id');
			$where  .= ' AND b.' . $db->quoteName('tag_id') . ' IN (' . implode(',', $tag) . ')';
		}

		$query	.= ' LEFT JOIN #__easyblog_featured AS f ';
		$query	.= ' ON a.' . $db->quoteName('id') . ' = f.' . $db->quoteName('content_id') . ' AND f.' . $db->quoteName('type') . '="post"';

		$query	.= $where;

		$ordering = $this->app->input->getCmd('filter_order', 'a.id');
		$direction = $this->app->input->getWord('filter_order_Dir',	'DESC');

		$query .= ' ORDER BY '. $ordering .' ' . $direction .', ordering';

		return $query;
	}

	public function _buildDataQueryWhere()
	{
		$db = EB::db();

		$filter_state = $this->app->input->getWord( 'filter_state', '' );
		$filter_category = $this->app->input->get('filter_category_id', array(), 'array');
		$filter_nested_categories = $this->app->input->getInt('filter_nested_categories', 1);
		$filter_blogger = $this->app->input->get('filter_author_id' , array(), 'array');
		$filter_language = $this->app->input->getString( 'filter_language' , '' );

		$search = $this->app->input->getString('filter_search', '', 'string');
		$search = JString::strtolower($search);
		$search = $db->escape($search);

		// Filter by source
		$source = $this->input->get('filter_source', '-1', 'default');

		$where = array();

		switch($filter_state) {
			case 'U':
				// Unpublished posts
				$where[] = 'a.' . $db->quoteName('published') . '=' . $db->Quote(EASYBLOG_POST_UNPUBLISHED);
				$where[] = 'a.' . $db->qn('state') . '=' . $db->Quote(EASYBLOG_POST_NORMAL);
				break;

			case 'S':
				// Scheduled posts
				$where[] = 'a.' . $db->quoteName('published') . '=' . $db->Quote(EASYBLOG_POST_SCHEDULED);
				$where[] = 'a.' . $db->qn('state') . '=' . $db->Quote(EASYBLOG_POST_NORMAL);
				break;

			case 'T':
				// trashed posts
				$where[] = 'a.' . $db->qn('state') . '=' . $db->Quote(EASYBLOG_POST_TRASHED);
				break;

			case 'A':
				// archived posts
				$where[] = 'a.' . $db->qn('state') . '=' . $db->Quote(EASYBLOG_POST_ARCHIVED);
				break;

			case 'P':
				// Published posts only
				$where[] = 'a.' . $db->quoteName('published') . '=' . $db->Quote(EASYBLOG_POST_PUBLISHED);
				$where[] = 'a.' . $db->qn('state') . '=' . $db->Quote(EASYBLOG_POST_NORMAL);
				break;

			default:
				$where[] = 'a.' . $db->qn('published') . ' IN (' . $db->Quote(EASYBLOG_POST_PUBLISHED) . ',' . $db->Quote(EASYBLOG_POST_UNPUBLISHED) . ',' . $db->Quote(EASYBLOG_POST_SCHEDULED) . ')';
				$where[] = 'a.' . $db->qn('state') . '=' . $db->Quote(EASYBLOG_POST_NORMAL);
				break;
		}

		if ($source != '-1') {
			$where[]	= 'a.' . $db->quoteName( 'source' ) . '=' . $db->Quote( $source );
		}

		if (count($filter_category = array_filter($filter_category, 'intval')))
		{
			if ($filter_nested_categories)
			{
				$catIds = array();

				foreach ($filter_category as $catId)
				{
					// Try to load the category.
					$category = EB::table('Category');
					$category->load($catId);

					if (!$catId || !$category->id) {
						continue;
					}

					// Get the nested categories.
					$category->childs = null;
					$catIds[] = $category->id;

					// Build nested child sets
					EB::buildNestedCategories($category->id, $category, false, true);
					EB::accessNestedCategoriesId($category, $catIds);
				}

				$where[] = ' cat.' . $db->quoteName('category_id') . ' IN (' . implode(',', $catIds) . ')';
			}
			else
			{
				$where[] = ' cat.' . $db->quoteName('category_id') . ' IN (' . implode(',', $filter_category) . ')';
			}
		}

		if (count($filter_blogger = array_filter($filter_blogger, 'intval')))
		{
			$where[] = ' a.' . $db->quoteName('created_by') . ' IN (' . implode(',', $filter_blogger) . ')';
		}

		if ((method_exists($this->app, 'isClient') && $this->app->isClient('site'))
			|| $this->app->isSite())
		{
			if (method_exists($this->app, 'getLanguageFilter') && $this->app->getLanguageFilter())
			{
				$language = JFactory::getLanguage()->getTag();
				$where[] = " a.language IN ('', '*', " . $db->quote($language) . ')';
			}
		}
		elseif ( $filter_language && $filter_language != '*')
		{
			$where[]	= ' a.' . $db->quoteName('language') . '=' . $db->Quote( $filter_language );
		}

		if ($search)
		{
			if (substr($search, 0, 3) === 'id:')
			{
				$where[] = ' a.id = ' . (int) substr($search, 3) . ' ';
			}
			else
			{
				$where[] = ' LOWER( a.title ) LIKE \'%' . $search . '%\' ';
			}
		}

		$where 		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' ;

		return $where;
	}
}
