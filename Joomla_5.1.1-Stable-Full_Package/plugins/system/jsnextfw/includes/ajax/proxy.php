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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Base class for proxying an Ajax request.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwAjaxProxy extends JsnExtFwAjax
{

	/**
	 * Define target component.
	 *
	 * @var  string
	 */
	protected $option = '';

	/**
	 * Define additional query parameters.
	 *
	 * @var  string
	 */
	protected $query_params = '';

	public function indexAction()
	{
		// Backup the current error reporting level.
		$error_reporting = ini_get('error_reporting');

		// Then, disable error reporting to prevent unwanted notice and warning from being shown.
		error_reporting(0);

		// Get request method.
		$method = strtolower($_SERVER['REQUEST_METHOD']);

		// Get request URL.
		$link = JUri::getInstance()->toString();

		// Get request headers.
		if (!function_exists('getallheaders'))
		{
			$headers = $this->getAllHeaders();
		}
		else
		{
			$headers = getallheaders();
		}

		// Get posted data.
		$data = JFactory::getApplication()->input->post->getArray();

		// Prepare to proxy the request.
		$link = preg_replace('/[?&]group=[^&]+/', '', $link);
		$link = preg_replace('/[?&]plugin=[^&]+/', '', $link);
		$link = preg_replace('/[?&]format=[^&]+/', '', $link);
		$link = preg_replace('/[?&]context=[^&]+/', '', $link);

		if (array_key_exists('option', $data))
		{
			$data['option'] = $this->option;
		}
		elseif (strpos($link, '?option=') !== false || strpos($link, '&option=') !== false)
		{
			$link = preg_replace('/([?&])option=[^&]+/', "\\1option={$this->option}", $link);
		}

		if (!empty($this->query_params))
		{
			$link .= (strpos($link, '?') === false ? '?' : '&') . ltrim($this->query_params, '&');
		}

		// Proxy the request.
		$http = new JHttp();

		if (in_array($method, array('delete', 'get', 'head', 'options', 'trace')))
		{
			$http = call_user_func(array($http, $method), $link, $headers);
		}
		elseif (in_array($method, array('patch', 'post', 'put')))
		{
			$http = call_user_func(array($http, $method), $link, $data, $headers);
		}

		$isNginxServer = false;
		$tmpBody = $http->body;
		// Work around for GZip compressed HTTP response.
		foreach ($http->headers as $k => $v)
		{

			if (strtolower($k) === 'server')
            {
				if (strpos(strtolower($v), 'nginx') !== false)
                {
					$isNginxServer = true;
                }
            }

			if (strtolower($k) === 'content-encoding' && strtolower($v) === 'gzip' && $isNginxServer)
			{
				if (function_exists('gzdecode'))
				{
					$http->body = gzdecode($http->body);
				}
				else
				{
					$http->body = gzinflate(substr($http->body, 10, -8));
				}

                if ($http->body === false)
                {
                    $http->body = $tmpBody;
                } 

				break;
			}
		}

		// Set response.
		$this->setResponse($http->body);

		// Restore error reporting level.
		error_reporting($error_reporting);
	}

	/**
	 * Process and set response content.
	 *
	 * @param   mixed  $content  Content will be sent to client.
	 *
	 * @return  void
	 */
	protected function setResponse($content)
	{
		// Replace target link with proxy link.
		$pattern = "/(action|href)=(['\"])([^'\"]*index\.php\?option={$this->option}[^'\"]*)(['\"])/";

		if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER))
		{
			$base = str_replace('&', '&amp;', $this->baseUrl);

			foreach ($matches as $match)
			{
				// Clear token from link.
				$link = preg_replace('/&(amp;)?[a-z0-9]{32}=1/', '', $match[3]);

				// Generate proxy link from target link.
				$link = str_replace("index.php?option={$this->option}", $base, $link);

				// Replace target link with proxy link.
				$content = str_replace($match[0], "{$match[1]}={$match[2]}{$link}{$match[4]}", $content);
			}
		}

		parent::setResponse($content);
	}

	/**
     * Get all HTTP header key/values as an associative array for the current request.
     *
     * @return string[string] The HTTP header key/value pairs.
     */
    public function getAllHeaders()
    {
        $headers = array();

        $copy_server = array(
            'CONTENT_TYPE'   => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5'    => 'Content-Md5',
        );

        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }

        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }

        return $headers;
    }
}
