<?php
/**
 * @version    $Id$
 * @package    JSN Extension Framework 2
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
 * Class for handling text related actions.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwText
{

	/**
	 * Translate an array of text string.
	 *
	 * @param   array  $keys  An array of text string.
	 * @param   boolean  $json  Whether to return the result as JSON-encoded string.
	 *
	 * @return  mixed  Either an array or a JSON-encoded string that maps the given text keys with real text strings.
	 */
	public static function translate($keys, $json = false)
	{
		$map = array();

		foreach ($keys as $key)
		{
			$map[strtoupper($key)] = JText::_($key, $json);
		}

		return $json ? json_encode($map) : $map;
	}

	/**
	 * Find a JSON encoded data in the given string and parse to array.
	 *
	 * @param   string  $str  String to find JSON encoded data.
	 *
	 * @return  mixed
	 */
	public static function parseJson($str)
	{
		if (preg_match('/\{"|\[([\{\[\d"]|true|false)/', $str, $match))
		{
			$json = array_slice(explode($match[0], $str), 1);
			$json = $match[0] . implode($match[0], $json);

			if ($json = json_decode($json, true))
			{
				return $json;
			}
		}

		return $str;
	}

	/**
	 * JSON encode a variable and refine the JSON encoded string for safely use as value for HTML tag attribute.
	 *
	 * @param   mixed  $var  Variable to be converted to JSON encoded string.
	 *
	 * @return  string
	 */
	public static function toJson($var)
	{
		return str_replace('"', '&quot;', json_encode($var, JSON_UNESCAPED_SLASHES));
	}

	/**
	 * Truncate text by given number of character or word.
	 *
	 * @param   string   $text      Text to be truncated.
	 * @param   string   $limit     Character or word limitation, e.g. 100c for 100 character limitation, or 10w for 10 word limitation.
	 * @param   boolean  $cleanTag  Whether to clean all HTML markup tags from truncated text or not?
	 *
	 * @return  string
	 */
	public static function truncate($text, $limit = '25w', $cleanTag = false)
	{
		// Clear all <!-- ... --> comment tags.
		$parts = explode('<!--', $text);
		$text = $parts[0];

		for ($i = 1, $n = count($parts); $i < $n; $i++) {
			$tmp = explode('-->', $parts[$i]);
			$text .= $tmp[1];
		}

		// Insert a whitespace in the middle of 2 continuous HTML markup tags.
		$text = str_replace('><', ">\n<", trim($text));

		// Remove all whitespaces inside self-closed tags.
		$text = preg_replace('#<([a-zA-Z0-9]+)[\s\t\r\n]+/>#', '<\\1/>', $text);

		// Strip all HTML markup tags if necessary.
		if ($cleanTag)
		{
			// Clear all <style> tag.
			$parts = explode('<style', $text);
			$text = $parts[0];

			for ($i = 1, $n = count($parts); $i < $n; $i++) {
				$tmp = explode('</style>', $parts[$i]);
				$text .= $tmp[1];
			}

			// Clear all <script> tag.
			$parts = explode('<script', $text);
			$text = $parts[0];

			for ($i = 1, $n = count($parts); $i < $n; $i++) {
				$tmp = explode('</script>', $parts[$i]);
				$text .= $tmp[1];
			}

			// Clear all <object> tag.
			$parts = explode('<object', $text);
			$text = $parts[0];

			for ($i = 1, $n = count($parts); $i < $n; $i++) {
				$tmp = explode('</object>', $parts[$i]);
				$text .= $tmp[1];
			}

			// Strip remaining HTML tags.
			$text = strip_tags($text);

			// Decode all HTML entities.
			$text = html_entity_decode($text, ENT_QUOTES);
		}

		// Initialize text truncation value.
		$unit	= in_array($unit = substr($limit, -1), array('c', 'w')) ? $unit : 'w';
		$limit	= (int) $limit;

		// Get all words.
		$words	= preg_split('/[\s\t\r\n]+/u', $text);
		$max	= count($words);

		if (($unit == 'w' && $max > $limit) || ($unit == 'c' && strlen($text) > $limit))
		{
			// Preset some variables.
			$openTag	= array();
			$text		= '';
			$counting	= 0;
			$i			= 0;

			while ($i < $max && $counting < $limit)
			{
				if ( ! empty($words[$i]))
				{
					// Append word.
					if ( ! empty($text))
					{
						$text .= ' ' . $words[$i];
					}
					else
					{
						$text = $words[$i];
					}

					// Count also the whitespace between 2 continuous words if truncating by character.
					if ($unit == 'c' && $counting > 0 && strpos($text, ' ') !== false) {
						$counting++;
					}

					// Find HTML tags.
					if (preg_match('#^(.*)<(script|style|object)>?.*$#', $words[$i], $match))
					{
						// Increase words count if the tag is prefixed with a word.
						if (!empty($match[1]))
						{
							if ($unit == 'w')
							{
								$counting++;
							}
							else
							{
								$counting += strlen($match[1]);
							}
						}

						// Check if the tag is closed or not.
						if (!preg_match('#^.*</(script|style|object)>(.*)$#', $words[$i], $match))
						{
							// Get all remaining parts of the tag.
							do
							{
								$i++;
								$text .= ' ' . $words[$i];
							} while (!preg_match('#^.*</(script|style|object)>(.*)$#', $words[$i], $match));
						}

						// Increase words count if the final part of the tag is suffixed with a word.
						if (!empty($match[2]))
						{
							if ($unit == 'w')
							{
								$counting++;
							}
							else
							{
								$counting += strlen($match[2]);
							}
						}
					}
					elseif (preg_match('#^(.*)<([a-zA-Z0-9]+)(/)?>(.*)$#', $words[$i], $match))
					{
						// Found a single word open or self-closed tag, e.g. <b>, <i>, <strong>, <em>
						$openTag[] = $match[2];

						// Check if this tag is a self-closed tag, e.g. <br/>
						if ($match[3] == '/')
						{
							array_pop($openTag);
						}

						// Increase words count if the open / self-closed tag is prefixed.
						if (!empty($match[1]))
						{
							if ($unit == 'w')
							{
								$counting++;
							}
							else
							{
								$counting += strlen($match[1]);
							}
						}

						// Check if the tag is closed or not.
						if (preg_match('#^.*</([a-zA-Z0-9]+)>(.*)$#', $words[$i], $m))
						{
							array_pop($openTag);

							// Get string inside the open and close tag.
							$tmp = strip_tags($words[$i]);

							if (!empty($tmp))
							{
								if ($unit == 'w')
								{
									$counting++;
								}
								else
								{
									$counting += strlen($tmp);
								}
							}

							// Increase words count if the close tag is suffixed.
							if (!empty($m[2]))
							{
								if ($unit == 'w')
								{
									$counting++;
								}
								else
								{
									$counting += strlen($m[2]);
								}
							}
						}
						else
						{
							// Increase words count if the open / self-closed tag is suffixed.
							if (!empty($match[4]))
							{
								if ($unit == 'w')
								{
									$counting++;
								}
								else
								{
									$counting += strlen($match[4]);
								}
							}
						}
					}
					elseif (preg_match('#^(.*)</[a-zA-Z0-9]+>(.*)$#', $words[$i]))
					{
						// Found close tag, e.g. </b>, </i>, </strong>, </em>
						array_pop($openTag);

						// Increase words count also if the close tag is prefixed or suffixed with a word.
						if (!empty($match[1]) || !empty($match[2]))
						{
							if ($unit == 'w')
							{
								$counting++;
							}
							else
							{
								$counting += strlen($match[1]) + strlen($match[2]);
							}
						}
					}
					elseif (preg_match('#^(.*)<([a-zA-Z0-9]+)$#', $words[$i], $match))
					{
						// Found starting part of an open tag, e.g. <a, <table
						$openTag[] = $match[2];

						// Increase words count also if the open tag is prefixed with a word.
						if (!empty($match[1]))
						{
							if ($unit == 'w')
							{
								$counting++;
							}
							else
							{
								$counting += strlen($match[1]);
							}
						}

						// Get all remaining parts of the tag.
						do
						{
							$i++;
							$text .= ' ' . $words[$i];
						}
						while ( ! preg_match('#^.*(/)?>(.*)$#', $words[$i], $match));

						// Increase words count if the final part of the tag is suffixed with a word.
						if (!empty($match[2]))
						{
							if ($unit == 'w')
							{
								$counting++;
							}
							else
							{
								$counting += strlen($match[2]);
							}
						}

						// Check if this tag is a self-closed tag.
						if ($match[1] == '/')
						{
							array_pop($openTag);
						}
					}
					else
					{
						// Not a tag, increase words count.
						if ($unit == 'w')
						{
							$counting++;
						}
						else
						{
							$counting += strlen($words[$i]);
						}
					}

					// Refine character-based truncation.
					if ($unit == 'c' && $counting > $limit)
					{
						$words	= explode(' ', $text);
						$last	= array_pop($words);

						if (preg_match('#.*(</?[a-zA-Z0-9]+>)[^<]*$#', $last, $match))
						{
							$tag = $match[1];
						}

						$last	= substr(empty($tag) ? $last : substr($last, 0, strrpos($last, $tag)), 0, $limit - $counting);
						$text	= implode(' ', $words) . " {$last}{$tag}";

						// Break the loop immediately.
						break;
					}
				}

				// Increase words array index.
				$i++;
			}

			// Finalize the truncated text.
			if ($i < $max)
			{
				$text = preg_replace('#(.)(</?[a-zA-Z0-9]+>)*$#', '\\1...\\2', $text);
			}

			if ( ! $cleanTag && count($openTag))
			{
				// The truncated text has tag(s) that is/are not closed, close now.
				for ($i = count($openTag) - 1; $i >= 0; $i--)
				{
					$text .= '</' . $openTag[$i] . '>';
				}
			}
		}

		return $text;
	}

	/**
	 * Truncate text by given number of word.
	 *
	 * @param   string   $text      Text to be truncated.
	 * @param   integer  $limit     Word limitation.
	 * @param   boolean  $cleanTag  Whether to clean HTML markup tag from truncated text or not?
	 *
	 * @return  string
	 */
	public static function getWords($text, $limit = 25, $cleanTag = true)
	{
		return self::truncate($text, "{$limit}w", $cleanTag);
	}
}
