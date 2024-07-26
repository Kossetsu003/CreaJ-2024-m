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

defined('_JEXEC') or die('Restricted access');

if (is_file(JPATH_ROOT . '/plugins/search/k2/k2.php'))
{
	require_once JPATH_ROOT . '/plugins/search/k2/k2.php';

	class PlgSearchPB4K2Items extends plgSearchK2
	{
		/**
		 * Search content (K2 items).
		 *
		 * The SQL must return the following fields that are used in a common display
		 * routine: href, title, section, created, text, browsernav.
		 *
		 * @param   string  $text      Target search string.
		 * @param   string  $phrase    Matching option (possible values: exact|any|all).
		 *                             Default is "any".
		 * @param   string  $ordering  Ordering option (possible values: newest|oldest|popular|alpha|category).
		 *                             Default is "newest".
		 * @param   mixed  $areas      An array if the search it to be restricted to areas or null to search all areas.
		 *
		 * @return  array  Search results.
		 */
		public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null)
		{
			// Disable error reporting.
			$errorReporting = error_reporting();
			error_reporting(0);

			// Get search results.
			$results = parent::onContentSearch($text, $phrase, $ordering, $areas);

			// Re-enable error reporting.
			error_reporting($errorReporting);

			// Load JSN PageBuilder 4 system plugin if necessary.
			if (!class_exists('plgSystemPageBuilder4'))
			{
				require_once JPATH_ROOT . '/plugins/system/pagebuilder4/pagebuilder4.php';
			}

			foreach ($results as &$result)
			{
				if (preg_match(plgSystemPageBuilder4::$signPattern, $result->text))
				{
					if (!empty($result->metadesc))
					{
						$result->text = $result->metadesc;
					}
				}

				// Remove all <script> tags.
				$parts = explode('<script', $result->text);
				$html = $parts[0];

				for ($i = 1, $n = count($parts); $i < $n; $i++)
				{
					$tmp = explode('</script>', $parts[$i], 2);
					$html .= $tmp[1];
				}

				// Remove all <style> tags.
				$parts = explode('<style', $html);
				$html = $parts[0];

				for ($i = 1, $n = count($parts); $i < $n; $i++)
				{
					$tmp = explode('</style>', $parts[$i], 2);
					$html .= $tmp[1];
				}

				// Remove all embed tags.
				$html = preg_replace('#<!-- [^\r\n]+ /-->#', '', $html);
				$html = preg_replace('@{{#[^}]+}}[^\r\n]+{{/[^}]+}}@', '', $html);

				// Remove all plugin tags.
				$html = preg_replace('/({{[^}]*}}|{[^}]*})/', '', $html);

				$result->text = $html;
			}

			return $results;
		}
	}
}
else
{
    class PlgSearchPB4K2Items extends JPlugin
    {
        public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null)
        {
            return array();
        }
    }
}
