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

// Emulate JPATH_COMPONENT constant.
defined('JPATH_COMPONENT') || define('JPATH_COMPONENT', JPATH_ADMINISTRATOR . '/components/com_k2');

// Load K2Model and K2ModelItems class.
JLoader::register('K2Model', JPATH_ADMINISTRATOR . '/components/com_k2/models/model.php');
JLoader::register('K2ModelItems',JPATH_ADMINISTRATOR . '/components/com_k2/models/items.php');

// Register tables directory.
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_k2/tables');

// Make sure K2 is installed.
if (!class_exists('K2Model') || !class_exists('K2ModelItems'))
{
	return;
}

/**
 * Extend K2ModelItems class to support some features of JSN PageBuilder 4.
 */
class PB4_K2ModelItems extends K2ModelItems
{
	public function getData()
	{
		$application = JFactory::getApplication();
		$user = JFactory::getUser();
		$aid = $user->get('aid');
		$params = JComponentHelper::getParams('com_k2');
		$db = JFactory::getDbo();
		$jnow = JFactory::getDate();
		$now = K2_JVERSION == '15' ? $jnow->toMySQL() : $jnow->toSql();
		$nullDate = $db->getNullDate();
		$limit = $application->input->getInt('limit', $application->getCfg('list_limit'));
		$limitstart = $application->input->getInt('limitstart', 0);
		$filter_order = $application->input->getCmd('filter_order', 'i.id');
		$filter_order_Dir = $application->input->getWord('filter_order_Dir', 'DESC');
		$filter_featured = $application->input->getInt('filter_featured', -1);
		$filter_category = $application->input->get('filter_category_id', array(), 'array');
		$filter_nested_categories = $application->input->getInt('filter_nested_categories', 1);
		$filter_author = $application->input->get('filter_author_id', array(), 'array');
		$filter_state = $application->input->getInt('filter_state', -1);
		$search = $application->input->getString('filter_search', '');
		$search = JString::strtolower($search);
		$tag = $application->input->get('filter_tag', array(), 'array');
		$language = $application->input->getString('language', '');

		$query = "SELECT i.*, g.name AS groupname, c.name AS category, v.name AS author, w.name as moderator, u.name AS editor, l.sef AS lang_sef, cl.sef AS cat_lang_sef FROM #__k2_items as i";
		$query .= " LEFT JOIN #__k2_categories AS c ON c.id = i.catid"." LEFT JOIN #__groups AS g ON g.id = i.access"." LEFT JOIN #__users AS u ON u.id = i.checked_out"." LEFT JOIN #__users AS v ON v.id = i.created_by"." LEFT JOIN #__users AS w ON w.id = i.modified_by";

		// Join with languages table to get language SEF code.
		$query .= " LEFT JOIN #__languages AS l ON l.lang_code = i.language";
		$query .= " LEFT JOIN #__languages AS cl ON cl.lang_code = c.language";

		if ($tag) {
			$query .= " LEFT JOIN #__k2_tags_xref AS tags_xref ON tags_xref.itemID = i.id";
		}

		$query .= " WHERE i.published = 1";
		$query .= " AND ( i.publish_up = " . $db->Quote($nullDate) . " OR i.publish_up <= " . $db->Quote($now) . " )";
		$query .= " AND ( i.publish_down = " . $db->Quote($nullDate) . " OR i.publish_down >= " . $db->Quote($now) . " )";

		if (K2_JVERSION != '15') {
			$query .= " AND i.access IN(" . implode(',', $user->getAuthorisedViewLevels()) . ") AND i.trash = 0 AND c.published = 1 AND c.access IN(" . implode(',', $user->getAuthorisedViewLevels()) . ") AND c.trash = 0";

			if (method_exists($application, 'getLanguageFilter') && ($languageFilter = $application->getLanguageFilter())) {
				$languageTag = JFactory::getLanguage()->getTag();
				$query .= " AND c.language IN (" . $db->quote($languageTag) . ", " . $db->quote('*') . ") AND i.language IN (" . $db->quote($languageTag) . ", " . $db->quote('*') . ")";
			}
		} else {
			$query .= " AND i.access <= {$aid} AND i.trash = 0 AND c.published = 1 AND c.access <= {$aid} AND c.trash = 0";
		}

		if ($search) {
			// Detect exact search phrase using double quotes in search string
			if (substr($search, 0, 1)=='"' && substr($search, -1)=='"') {
				$exact = true;
			} else {
				$exact = false;
			}

			// Now completely strip double quotes
			$search = trim(str_replace('"', '', $search));

			// Escape remaining string
			$escaped = $db->escape($search, true);

			// Search by ID.
			if (substr($escaped, 0, 3) === 'id:')
			{
				$escaped = $db->quote(substr($escaped, 3));
				$query .= " AND i.id = {$escaped}";
			}
			// Full phrase or set of words
			elseif (strpos($escaped, ' ')!==false && !$exact) {
				$escaped=explode(' ', $escaped);
				$quoted = array();
				foreach ($escaped as $key=>$escapedWord) {
					$quoted[] = $db->Quote('%'.$escapedWord.'%', false);
				}
				if ($params->get('adminSearch') == 'full') {
					foreach ($quoted as $quotedWord) {
						$query .= " AND ( ".
							"LOWER(i.title) LIKE ".$quotedWord." ".
							"OR LOWER(i.introtext) LIKE ".$quotedWord." ".
							"OR LOWER(i." . $db->quoteName('fulltext') . ") LIKE ".$quotedWord." ".
							"OR LOWER(i.extra_fields_search) LIKE ".$quotedWord." ".
							"OR LOWER(i.image_caption) LIKE ".$quotedWord." ".
							"OR LOWER(i.image_credits) LIKE ".$quotedWord." ".
							"OR LOWER(i.video_caption) LIKE ".$quotedWord." ".
							"OR LOWER(i.video_credits) LIKE ".$quotedWord." ".
							"OR LOWER(i.metadesc) LIKE ".$quotedWord." ".
							"OR LOWER(i.metakey) LIKE ".$quotedWord." ".
							" )";
					}
				} else {
					foreach ($quoted as $quotedWord) {
						$query .= " AND LOWER(i.title) LIKE ".$quotedWord;
					}
				}
			}
			// Single word or exact phrase to search for (wrapped in double quotes in the search block)
			else {
				$quoted = $db->Quote('%'.$escaped.'%', false);

				if ($params->get('adminSearch') == 'full') {
					$query .= " AND ( ".
						"LOWER(i.title) LIKE ".$quoted." ".
						"OR LOWER(i.introtext) LIKE ".$quoted." ".
						"OR LOWER(i." . $db->quoteName('fulltext') . ") LIKE ".$quoted." ".
						"OR LOWER(i.extra_fields_search) LIKE ".$quoted." ".
						"OR LOWER(i.image_caption) LIKE ".$quoted." ".
						"OR LOWER(i.image_credits) LIKE ".$quoted." ".
						"OR LOWER(i.video_caption) LIKE ".$quoted." ".
						"OR LOWER(i.video_credits) LIKE ".$quoted." ".
						"OR LOWER(i.metadesc) LIKE ".$quoted." ".
						"OR LOWER(i.metakey) LIKE ".$quoted." ".
						" )";
				} else {
					$query .= " AND LOWER(i.title) LIKE ".$quoted;
				}
			}
		}

		if ($filter_state > -1) {
			$query .= " AND i.published={$filter_state}";
		}

		if ($filter_featured > -1) {
			$query .= " AND i.featured={$filter_featured}";
		}

		// Filter by multiple categories.
		$filter_by_categories = array();

		foreach (array_filter($filter_category, 'intval') as $cat)
		{
			if (/*$params->get('showChildCatItems') || */$filter_nested_categories)
			{
				K2Model::addIncludePath(JPATH_SITE . '/components/com_k2/models');
				$itemListModel = K2Model::getInstance('Itemlist', 'K2Model');
				$categories    = $itemListModel->getCategoryTree($cat);
				$sql           = @implode(',', $categories);
				$filter_by_categories[] = "i.catid IN ({$sql})";
			}
			else
			{
				$filter_by_categories[] = "i.catid={$cat}";
			}
		}

		if (count($filter_by_categories))
		{
			$query .= ' AND (' . implode(' OR ', $filter_by_categories) . ')';
		}

		// Filter by multiple authors.
		$filter_by_authors = implode(',', array_filter($filter_author, 'intval'));

		if (!empty($filter_by_authors))
		{
			$query .= " AND i.created_by IN ({$filter_by_authors})";
		}

		// Filter by multiple tags.
		$filter_by_tags = implode(',', array_filter($tag, 'intval'));

		if (!empty($filter_by_tags))
		{
			$query .= " AND tags_xref.tagID IN ({$filter_by_tags})";
		}

		if ($language) {
			$query .= " AND (i.language = ".$db->Quote($language)." OR i.language = '*')";
		}

		$query .= ' GROUP BY i.id';

		if ($filter_order == 'i.ordering') {
			$query .= " ORDER BY i.catid, i.ordering {$filter_order_Dir}";
		} else {
			$query .= " ORDER BY {$filter_order} {$filter_order_Dir} ";
		}

		if (K2_JVERSION != '15') {
			$query = JString::str_ireplace('#__groups', '#__viewlevels', $query);
			$query = JString::str_ireplace('g.name', 'g.title', $query);
		}

		// Plugin Events
		JPluginHelper::importPlugin('k2');
		$dispatcher = JDispatcher::getInstance();

		// Trigger K2 plugins
		$dispatcher->trigger('onK2BeforeSetQuery', array(&$query));

		$db->setQuery($query, $limitstart, $limit);
		$rows = $db->loadObjectList();
		return $rows;
	}

	public function publish()
	{
		$application = JFactory::getApplication();
		$cid = $application->input->get('cid', array(), 'array');
		foreach ($cid as $id) {
			$row = JTable::getInstance('K2Item', 'Table');
			$row->load($id);
			$row->published = 1;
			$row->store();
		}

		// Plugins Events
		JPluginHelper::importPlugin('content');
		JPluginHelper::importPlugin('finder');
		$dispatcher = JDispatcher::getInstance();

		// Trigger content & finder plugins when state changes
		$dispatcher->trigger('onContentChangeState', array('com_k2.item', $cid, 1));
		$dispatcher->trigger('onFinderChangeState', array('com_k2.item', $cid, 1));

		$cache = JFactory::getCache('com_k2');
		$cache->clean();

		return true;
	}

	public function unpublish()
	{
		$application = JFactory::getApplication();
		$cid = $application->input->get('cid', array(), 'array');
		foreach ($cid as $id) {
			$row = JTable::getInstance('K2Item', 'Table');
			$row->load($id);
			$row->published = 0;
			$row->store();
		}

		// Plugins Events
		JPluginHelper::importPlugin('content');
		JPluginHelper::importPlugin('finder');
		$dispatcher = JDispatcher::getInstance();

		// Trigger content & finder plugins when state changes
		$dispatcher->trigger('onContentChangeState', array('com_k2.item', $cid, 0));
		$dispatcher->trigger('onFinderChangeState', array('com_k2.item', $cid, 0));

		$cache = JFactory::getCache('com_k2');
		$cache->clean();

		return true;
	}

	public function remove()
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		$application = JFactory::getApplication();
		$params = JComponentHelper::getParams('com_k2');
		$itemModel = K2Model::getInstance('Item', 'K2Model');
		$db = JFactory::getDbo();
		$cid = $application->input->get('cid', array(), 'array');

		// Plugin Events
		JPluginHelper::importPlugin('content');
		JPluginHelper::importPlugin('finder');
		$dispatcher = JDispatcher::getInstance();

		foreach ($cid as $id) {
			$row = JTable::getInstance('K2Item', 'Table');
			$row->load($id);
			$row->id = (int)$row->id;

			// Delete images
			if (JFile::exists(JPATH_ROOT.'/media/k2/items/src/'.md5("Image".$row->id).'.jpg')) {
				JFile::delete(JPATH_ROOT.'/media/k2/items/src/'.md5("Image".$row->id).'.jpg');
			}
			if (JFile::exists(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_XS.jpg')) {
				JFile::delete(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_XS.jpg');
			}
			if (JFile::exists(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_S.jpg')) {
				JFile::delete(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_S.jpg');
			}
			if (JFile::exists(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_M.jpg')) {
				JFile::delete(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_M.jpg');
			}
			if (JFile::exists(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_L.jpg')) {
				JFile::delete(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_L.jpg');
			}
			if (JFile::exists(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_XL.jpg')) {
				JFile::delete(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_XL.jpg');
			}
			if (JFile::exists(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_Generic.jpg')) {
				JFile::delete(JPATH_ROOT.'/media/k2/items/cache/'.md5("Image".$row->id).'_Generic.jpg');
			}

			// Delete gallery
			if (JFolder::exists(JPATH_ROOT.'/media/k2/galleries/'.$row->id)) {
				JFolder::delete(JPATH_ROOT.'/media/k2/galleries/'.$row->id);
			}

			// Delete video
			preg_match_all("#^{(.*?)}(.*?){#", $row->video, $matches, PREG_PATTERN_ORDER);
			$videotype = $matches[1][0];
			$videofile = $matches[2][0];

			$videoExtensions = array(
				'flv',
				'mp4',
				'ogv',
				'webm',
				'f4v',
				'm4v',
				'3gp',
				'3g2',
				'mov',
				'mpeg',
				'mpg',
				'avi',
				'wmv',
				'divx',
				'swf'
			);
			$audioExtensions = array(
				'mp3',
				'aac',
				'mp4',
				'ogg',
				'wma'
			);

			if (in_array($videotype, $videoExtensions) || in_array($videotype, $audioExtensions)) {
				if (JFile::exists(JPATH_ROOT.'/media/k2/videos/'.$videofile.'.'.$videotype)) {
					JFile::delete(JPATH_ROOT.'/media/k2/videos/'.$videofile.'.'.$videotype);
				}

				if (JFile::exists(JPATH_ROOT.'/media/k2/audio/'.$videofile.'.'.$videotype)) {
					JFile::delete(JPATH_ROOT.'/media/k2/audio/'.$videofile.'.'.$videotype);
				}
			}

			// Delete attachments
			$path = $params->get('attachmentsFolder', null);
			if (is_null($path)) {
				$savepath = JPATH_ROOT.'/media/k2/attachments';
			} else {
				$savepath = $path;
			}

			$attachments = $itemModel->getAttachments($row->id);

			foreach ($attachments as $attachment) {
				if (JFile::exists($savepath.'/'.$attachment->filename)) {
					JFile::delete($savepath.'/'.$attachment->filename);
				}
			}

			$query = "DELETE FROM #__k2_attachments WHERE itemID={$row->id}";
			$db->setQuery($query);
			$db->query();

			// Delete tags
			$query = "DELETE FROM #__k2_tags_xref WHERE itemID={$row->id}";
			$db->setQuery($query);
			$db->query();

			// Delete comments
			$query = "DELETE FROM #__k2_comments WHERE itemID={$row->id}";
			$db->setQuery($query);
			$db->query();

			$row->delete($id);

			// Trigger content & finder plugins after the delete event
			$dispatcher->trigger('onContentAfterDelete', array('com_k2.item', $row));
			$dispatcher->trigger('onFinderAfterDelete', array('com_k2.item', $row));
		}

		$cache = JFactory::getCache('com_k2');
		$cache->clean();

		return true;
	}
}
