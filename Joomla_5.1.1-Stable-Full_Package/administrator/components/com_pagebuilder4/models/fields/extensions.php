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
 * Form field to load a list of JSN PageBuilder 4 supported extensions.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JFormFieldExtensions extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var   string
	 */
	public $type = 'Extensions';

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

			// Return the result.
			if (count($options = JSNPageBuilder4Helper::getInstalledSupportedExtensions()))
			{
				static::$options[$hash] = array_merge(static::$options[$hash], array_map(function($ext) {
					JFactory::getLanguage()->load("{$ext['value']}.sys");

					return array(
						'text' => JText::_(strtoupper($ext['value'])),
						'value' => $ext['value']
					);
				}, $options));
			}
		}

		return static::$options[$hash];
	}
}
