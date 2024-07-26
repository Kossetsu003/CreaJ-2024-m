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

// Load J2StoreModelProducts class.
JLoader::register('J2StoreModelProducts',JPATH_ADMINISTRATOR . '/components/com_j2store/models/products.php');

// Register tables directory.
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_j2store/tables');

// Make sure J2Store is installed.
if (!class_exists('J2StoreModelProducts'))
{
	return;
}

/**
 * Extend J2StoreModelProducts class to support some features of JSN PageBuilder 4.
 */
class PB4_J2StoreModelProducts extends J2StoreModelProducts
{
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $name The table name. Optional.
	 * @param   string  $prefix The class prefix. Optional.
	 * @param   array   $options Configuration array for model. Optional.
	 *
	 * @throws Exception
	 *
	 * @return  F0FTable  A F0FTable object
	 */
	public function getTable($name = 'Product', $prefix = 'J2StoreTable', $options = array())
	{
		return parent::getTable($name, $prefix, $options);
	}

	/**
	 * Method to build where query based on the filters
	 * @param string $query
	 */
	function _sfBuildWhereQuery(&$query){
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$session = JFactory::getSession();
		$db = $this->getDbo();
		//$state = $this->getFilterValues();
		$state = $this->getSFFilterValues();

		// Filter by a single or group of categories
		$categoryId = $this->getState('catids');

		if (is_numeric($categoryId))
		{
			$type = $this->getState('filter.category_id.include', true) ? ' ' : 'NOT ';

			// Add subcategory check
			$includeSubcategories = $this->getState('filter.subcategories', false);
			//$categoryEquals = 'a.catid ' . $type . ' REGEXP BINARY '. $db->q('[[:<:]]'.$categoryId.'[[:>:]]') ;
			if ($this->checkTable () ) {
				$categoryEquals = 'mc.catid ' . $type . ' REGEXP BINARY '. $db->q('[[:<:]]'.$categoryId.'[[:>:]]') ;
			}else{
				$categoryEquals = 'a.catid ' . $type . ' REGEXP BINARY '. $db->q('[[:<:]]'.$categoryId.'[[:>:]]') ;
			}
			if ($includeSubcategories)
			{
				//TODO: include subcategories does not support multicategory
				$levels = (int) $this->getState('filter.max_category_levels', '1');

				// Create a subquery for the subcategory list
				$subQuery = $db->getQuery(true)
					->select('sub.id')
					->from('#__categories as sub')
					->join('INNER', '#__categories as this ON sub.lft > this.lft AND sub.rgt < this.rgt')
					->where('this.id = ' . $db->q((int) $categoryId));

				if ($levels >= 0)
				{
					$subQuery->where('sub.level <= (this.level + ' . $levels.')');
				}
				$db->setQuery($subQuery);
				$sub_data = $db->loadAssocList();
				$sub_cats = array();
				foreach($sub_data as $k=> $sub_cat){
					$sub_cats [] = $sub_cat['id'];
				}
				if(count($sub_cats) > 0){
					$sub_string = implode(',', $sub_cats) ;
					$categoryEquals .= ' OR a.catid IN ('.$sub_string.')';
				}
				// Add the subquery to the main query
				$query->where('(' . $categoryEquals . ')');
			}
			else
			{
				$query->where($categoryEquals);
			}

		}
		elseif (is_array($categoryId) && (count($categoryId) > 0))
		{
			JArrayHelper::toInteger($categoryId);
			$categoryIds = '[[:<:]]'. implode('[[:>:]]|[[:<:]]', $categoryId) .'[[:>:]]';

			if (!empty($categoryId))
			{
				$type = $this->getState('filter.category_id.include', true) ? '' : 'NOT ';
				$levels = (int) $this->getState('filter.max_category_levels', '1');

				$includeSubcategories = $this->getState('filter.subcategories', false);
				//$categoryEquals = 'a.catid ' . $type . ' REGEXP BINARY '. $db->q($categoryIds) ;

				if ($this->checkTable () ) {
					$categoryEquals = 'mc.catid ' . $type . ' REGEXP BINARY '. $db->q($categoryIds) ;
				}else{
					$categoryEquals = 'a.catid ' . $type . ' REGEXP BINARY '. $db->q($categoryIds) ;
				}

				if ($includeSubcategories)
				{
					//TODO: include subcategories does not support multicategory
					$levels = (int) $this->getState('filter.max_category_levels', '1');

					// Create a subquery for the subcategory list
					$subQuery = $db->getQuery(true)
						->select('sub.id')
						->from('#__categories as sub')
						->join('INNER', '#__categories as this ON sub.lft > this.lft AND sub.rgt < this.rgt');
					$subQuery->where('this.id IN ( ' . implode(',', $categoryId).' )');

					if ($levels >= 0)
					{

						$subQuery->where('sub.level <= (this.level + ' . $levels.')');
					}
					$db->setQuery($subQuery);
					$sub_data = $db->loadAssocList();
					$sub_cats = array();
					foreach($sub_data as $k=> $sub_cat){
						$sub_cats [] = $sub_cat['id'];
					}

					$regSubcats = '[[:<:]]'. implode('[[:>:]]|[[:<:]]', $sub_cats) .'[[:>:]]';
					$subCategoryEquals = 'a.catid ' . $type . ' REGEXP BINARY '. $db->q($regSubcats) ;
					// Add the subquery to the main query
					$query->where('(' . $categoryEquals . ' OR '.$subCategoryEquals.' )');
					// Add the subquery to the main query
					//$query->where('(' . $categoryEquals . ' OR a.catid IN (' . $subQuery->__toString() . '))');

				}
				else
				{
					$query->where($categoryEquals);
				}

			}
		}

		//access
		$groups = implode(',', $user->getAuthorisedViewLevels());
		$query->where('a.access IN (' . $groups . ')')
			->where('c.access IN (' . $groups . ')');


		// Define null and now dates
		$nullDate	= $db->quote($db->getNullDate());
		//$nowDate	= $db->quote(JFactory::getDate()->toSql());
		$tz = JFactory::getConfig()->get('offset');
		$date = JFactory::getDate('now', $tz);

		//default to the sql formatted date
		$nowDate = $db->quote( $date->toSql());

		$query	->where('(a.publish_up = '.$nullDate.' OR a.publish_up <= '.$nowDate.')')
			->where('(a.publish_down = '.$nullDate.' OR a.publish_down >= '.$nowDate.')');

		// Filter by language
		/*if ($this->getState('filter.language'))
		{
			$lang_tag = $this->getState('lang_tag', JFactory::getLanguage()->getTag());
			$query->where('a.language in (' . $db->quote($lang_tag) . ',' . $db->quote('*') . ')');
		}*/

		if (method_exists($app, 'getLanguageFilter') && ($languageFilter = $app->getLanguageFilter())) {
			$lang_tag = JFactory::getLanguage()->getTag();
			$query->where('a.language in (' . $db->quote($lang_tag) . ',' . $db->quote('*') . ')');
		}

		$query->where(
			$db->qn('#__j2store_variants').'.'.$db->qn('is_master').' = '.$db->q(1)
		);

		if($state->search){
			if (substr($state->search, 0, 3) === 'id:')
			{
				$query->where('#__j2store_products.j2store_product_id = ' . intval(substr($state->search, 3)));
			}
			else
			{
				$query->where(
					' ( '.
					'a.'.$db->qn('title').' LIKE '.$db->q('%'.$state->search.'%').'OR '.
					'a.'.$db->qn('introtext').' LIKE '.$db->q('%'.$state->search.'%').'OR '.
					'a.'.$db->qn('fulltext').' LIKE '.$db->q('%'.$state->search.'%').'OR '.
					$db->qn('#__j2store_products').'.'.$db->qn('j2store_product_id').' LIKE '.$db->q('%'.$state->search.'%').'OR '.
					$db->qn('#__j2store_products').'.'.$db->qn('product_source').' LIKE '.$db->q('%'.$state->search.'%').'OR '.
					$db->qn('#__j2store_variants').'.'.$db->qn('sku').' LIKE '.$db->q('%'.$state->search.'%').'AND  a.state =1 OR '.
					$db->qn('#__j2store_variants').'.'.$db->qn('upc').' LIKE '.$db->q('%'.$state->search.'%').'AND  a.state =1 OR '.
					$db->qn('#__j2store_variants').'.'.$db->qn('price').' LIKE '.$db->q('%'.$state->search.'%').'AND  a.state =1 OR '.
					$db->qn('#__j2store_products').'.'.$db->qn('product_type').' LIKE '.$db->q('%'.$state->search.'%')
					.' ) '
				) ;
			}
		}
		if($state->product_type) {
			$query->where(
				$db->qn('#__j2store_products').'.'.$db->qn('product_type').' LIKE '.
				$db->q('%'.$state->product_type.'%')
			);
		}
		//since
		$since = trim($state->since);
		if(empty($since) || ($since == '0000-00-00') || ($since == '0000-00-00 00:00:00')) {
			$since = '';
		} else {
			$regex = '/^\d{1,4}(\/|-)\d{1,2}(\/|-)\d{2,4}[[:space:]]{0,}(\d{1,2}:\d{1,2}(:\d{1,2}){0,1}){0,1}$/';
			if(!preg_match($regex, $since)) {
				$since = '2001-01-01';
			}
			$jFrom = new JDate($since);
			$since = $jFrom->toUnix();
			if($since == 0) {
				$since = '';
			} else {
				$since = $jFrom->toSql();
			}
			// Filter from-to dates
			$query->where(
				$db->qn('#__j2store_products').'.'.$db->qn('created_on').' >= '.$since
			);
		}

		// "Until" queries
		$until = trim($state->until);
		if(empty($until) || ($until == '0000-00-00') || ($until == '0000-00-00 00:00:00')) {
			$until = '';
		} else {
			$regex = '/^\d{1,4}(\/|-)\d{1,2}(\/|-)\d{2,4}[[:space:]]{0,}(\d{1,2}:\d{1,2}(:\d{1,2}){0,1}){0,1}$/';
			if(!preg_match($regex, $until)) {
				$until = '2037-01-01';
			}
			$jFrom = new JDate($until);
			$until = $jFrom->toUnix();
			if($until == 0) {
				$until = '';
			} else {
				$until = $jFrom->toSql();
			}
			$query->where(
				$db->qn('#__j2store_products').'.'.$db->qn('created_on').' <= '.$until
			);
		}

		if($state->manufacturer_id){
			$query->where($db->qn('#__j2store_products').'.'.$db->qn('manufacturer_id').' IN ('.$state->manufacturer_id.')') ;
		}

		if($state->vendor_id) {
			$query->where($db->qn('#__j2store_products').'.'.$db->qn('vendor_id').' IN ('.$state->vendor_id.')');
		}

		if($state->taxprofile_id) {
			$query->where($db->qn('#__j2store_products').'.'.$db->qn('taxprofile_id').'='.$db->q($state->taxprofile_id));
		}

		if(!is_null($state->visible) &&  !empty($state->visible)) {
			$query->where($db->qn('#__j2store_products').'.'.$db->qn('visibility').'='.$db->q($state->visible));
		}

		if(!is_null($state->enabled) &&  !empty($state->enabled)) {
			$query->where($db->qn('#__j2store_products').'.'.$db->qn('enabled').' IN ('.$state->enabled.')');
		}

		if(!is_null($state->sku) && !empty($state->sku)){
			$query->where($db->qn('#__j2store_variants').'.'.$db->qn('sku').' LIKE ('.$db->q('%'.$state->sku.'%').')');
		}


		// filter price range
		if (!is_null($state->pricefrom ) && ($state->pricefrom >=0 || !empty($state->pricefrom )) && !is_null($state->priceto ) && !empty($state->priceto)  )
		{
			$variant_pricerange_qry = '';
			$variant_pricerange_qry .= '(price >= '.$db->q(( int ) $state->pricefrom).') ' ;
			$variant_pricerange_qry .= ' AND ';
			$variant_pricerange_qry .= '(price <= '.$db->q(( int ) $state->priceto).') ' ;

			$query->where( '#__j2store_products.j2store_product_id in ( select distinct product_id from #__j2store_variants where '
				. $variant_pricerange_qry .' )' );
		}

		if (! is_null ( $state->productfilter_id ) && ! empty ( $state->productfilter_id )) {
			if (! is_array ( $state->productfilter_id )) {
				$filter_ids = ( array ) $state->productfilter_id;
			} else {
				$filter_ids = $state->productfilter_id;
			}
			//get the filter condition
			$filter_condition = $session->get('list_product_filter_search_logic_rel', 'OR', 'j2store');
			if ($filter_condition == 'AND') {
				$count_ids = 0;
				$filter_all_ids = array ();
				foreach ( $filter_ids as $k => $ids ) {
					if (count ( $ids ) > 0) {
						$arr_ids = explode ( ',', $ids );
						$filter_all_ids = array_merge ( $arr_ids, $filter_all_ids );
					}
				}
				$filter_all_ids = array_unique ( $filter_all_ids );
				$count_ids = count ( $filter_all_ids );

				if (is_array ( $filter_ids )) {
					$query->where ( '#__j2store_product_filters.product_id IN (SELECT product_id FROM #__j2store_product_filters WHERE filter_id IN (' . implode ( ',', $filter_all_ids ) . ') GROUP BY product_id HAVING COUNT(*) = ' . $count_ids . ')' );
				}
			} else {
				$query->where ( '#__j2store_product_filters.filter_id IN (' . implode ( ',', $filter_ids ) . ')' );
			}
		}

		if($state->product_types){
			if (! is_array ( $state->product_types )) {
				$product_types = ( array ) $state->product_types;
			} else {
				$product_types = $state->product_types;
			}
			$query->where ( '#__j2store_products.product_type IN (\'' . implode ( '\',\'', $product_types ) . '\')' );
		}

		if(!is_null ( $state->show_feature_only ) && !empty( $state->show_feature_only )){
			$query->where($db->qn('a').'.'.$db->qn('featured').' = '.$db->q($state->show_feature_only));
		}
	}

	/**
	 * Method to build orderby query
	 * @param string $query
	 */
	protected function _sfBuildQueryOrderBy(&$query){

		/*$app = JFactory::getApplication();
		$db = $this->getDbo();
		$this->_sfBuildSortQuery($query);

		$params = $this->getMergedParams();
		//$article_category_ordering = $params->get('consider_category',0);
		$articleOrderby		= $params->get('orderby_sec', 'rdate');
		$articleOrderDate	= $params->get('order_date');
		$secondary			= $this->orderbySecondary($articleOrderby, $articleOrderDate,$query);
		if(empty( $secondary )){
			$secondary = 'a.ordering';
		}
		//else{
		// $orderby = trim ( $secondary );
		//if($article_category_ordering){
		//$query->order('category_title'.' '.$this->getState('list.direction', 'ASC'));
		//}
		//}

		$this->setState('list.ordering', $secondary);*/

		$query->order($this->getState('list.ordering', 'a.ordering').' '.$this->getState('list.direction', 'ASC'));


	}
}
