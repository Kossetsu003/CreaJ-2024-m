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

// Define necessary constants for the plugin.
define('JSNEXTFW_ID', 'ext_framework2');
define('JSNEXTFW_VERSION', '1.2.0');
define('JSNEXTFW_RELEASED_DATE', '02/08/2022');

define('JSNEXTFW_PATH', dirname(__FILE__));
define('JSNEXTFW_URL', JUri::root(true) . '/plugins/system/jsnextfw');

// Define common URLs for communicating with JoomlaShine server.
$urls = array(
	'JSN_SUPPORT_URL' => 'https://www.joomlashine.com/forum.html',
	'JSN_CUSTOMER_AREA_URL' => 'https://www.joomlashine.com/customer-area/licenses.html',
	'JSN_POST_CLIENT_INFO_URL' => '',

	'JSN_VERSIONING_URL' => '',
	'JSN_GET_BANNER_URL' => '',

	'JSN_GET_TOKEN_URL' => '',
	'JSN_GET_LICENSE_URL' => '',
	'JSN_JOIN_TRIAL_URL' => '',

	'JSN_GET_PRODUCT_UPDATE_URL' => '',
	'JSN_GET_DEPENDENCY_UPDATE_URL' => '',

	'JSN_GET_FEEDBACK_OPTIONS_URL' => '',
	'JSN_POST_CUSTOMER_FEEDBACK_URL' => ''
);

foreach ($urls as $key => $url)
{
	defined($key) || define($key, $url);
}
