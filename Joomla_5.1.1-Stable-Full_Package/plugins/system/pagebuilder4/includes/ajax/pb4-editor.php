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

/**
 * Handle Ajax requests.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JsnExtFwAjaxPb4Editor extends JsnExtFwAjax
{
	/**
	 * Method to get the user agent of current browser.
	 *
	 * @return  void
	 */
	public function getUserAgentAction()
	{
		$this->setResponse($_SERVER['HTTP_USER_AGENT']);
	}

	/**
	 * Method to render sandbox for the editor app.
	 *
	 * @return  void
	 */
	public function renderSandboxAction()
	{
		// Load required assets.
		JsnExtFwAssets::loadJsnComponents();

		// Init event tracking.
		//JSNPageBuilder4Helper::initEventTracking();

		// Init edition manager.
		JSNPageBuilder4Helper::initEditionManager();

		// Get JSN PageBuilder 4 parameters.
		$config = JsnExtFwHelper::getSettings('com_pagebuilder4');
		$liveChatHtml = '';

		// if ($config['live_chat_popup'])
		// {
		// 	try
		// 	{
		// 		$liveChatHtml = JsnExtFwHttp::get(
		// 			JsnExtFwHelper::getConstant('LIVE_CHAT_LINK', 'com_pagebuilder4'),
		// 			24 * 60 * 60
		// 		);
		// 	}
		// 	catch (Exception $e)
		// 	{
		// 		error_log($e->getMessage());
		// 	}
		// }

		$this->render('index', compact('liveChatHtml'), dirname(__FILE__) . '/tmpl');
	}

	/**
	 * Method for retrieving dynamic content.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=get-content&<FORM_TOKEN>=1
	 *
	 * Use the following query parameters to filter items list:
	 * - type: Supported type are:
	 *         + articles: Get Joomla articles.
	 *         + authors: Get Joomla authors.
	 *         + categories: Get Joomla categories.
	 *         + modules: Get Joomla modules.
	 *         + tags: Get Joomla tags.
	 *         + k2_authors: Get K2 authors.
	 *         + k2_categories: Get K2 categories.
	 *         + k2_items: Get K2 items.
	 *         + k2_tags: Get K2 tags.
	 *         + easyblog_authors: Get EasyBlog authors.
	 *         + easyblog_categories: Get EasyBlog categories.
	 *         + easyblog_posts: Get EasyBlog items.
	 *         + easyblog_tags: Get EasyBlog tags.
	 *         + jsn_uniform_forms: Get JSN UniForm form list.
	 * - limit: Total number of items to retrieve.
	 * - start: Start retrieving items from this index.
	 * - order_by: Visit the items list screen of the appropriated type to get available options.
	 * - order_dir: Either asc or desc.
	 * - filter_author: Filter items list by an author ID or list of author ID separated by comma.
	 * - filter_category: Filter items list by a category ID or list of category ID separated by comma.
	 * - filter_tag: Filter items list by a tag ID or list of tag ID separated by comma.
	 * - filter_search: Filter items list by a keyword.
	 *
	 * Please note that filter_author, filter_category and filter_tag are supported when retrieving
	 * content of type articles, k2_items and easyblog_posts only.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function getContentAction()
	{
		// Get request parameters.
		$start = $this->input->getInt('start', 0);
		$limit = $this->input->getInt('limit', 10);
		
		if ($limit == 0)
		{
			$limit = 10;
		}

		$type = $this->input->getString('type', 'articles');
		$order_by = $this->input->getString('order_by', '');
		$order_dir = $this->input->getString('order_dir', '');

		// Generate filters array from request parameters.
		$filters = array();

		if (($option = $this->input->getString('filter_author', '')) !== '')
		{
			$filters['author_id'] = array_filter(explode(',', $option), 'intval');
		}

		if (($option = $this->input->getString('filter_category', '')) !== '')
		{
			$filters['category_id'] = array_filter(explode(',', $option), 'intval');
			$filters['nested_categories'] = $this->input->getInt('filter_nested_categories', 1);
		}

		if (($option = $this->input->getString('filter_tag', '')) !== '')
		{
			$filters['tag'] = array_filter(explode(',', $option), 'intval');
		}

		if (($option = $this->input->getString('filter_search', '')) !== '')
		{
			$filters['search'] = trim($option);
		}

		// Retrieve dynamic content.
		$this->setResponse(
			JSNPageBuilder4Helper::getContentItems(
				$type, $limit, $start, trim("{$order_by} {$order_dir}"), $filters
			)
		);
	}

	/**
	 * Method to save editor section.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=save-editor-section&<FORM_TOKEN>=1
	 *
	 * Post the following parameters in request body:
	 *
	 * - name: Section name.
	 * - image: Section thumbnail.
	 * - data: Section data.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function saveEditorSectionAction()
	{
		// Only allow POST method.
		if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST')
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_INVALID_REQUEST_METHOD'));
		}

		// Get request parameters.
		$name = $this->input->post->getString('name');
		$image = $this->input->post->get('image', '', 'raw');
		$data = $this->input->post->get('data', '', 'raw');

		// Save editor section.
		$this->setResponse(JSNPageBuilder4Helper::saveEditorSection($name, $image, $data));
	}

	/**
	 * Method to rename editor section.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=rename-editor-section&<FORM_TOKEN>=1
	 *
	 * Post the following parameters in request body:
	 *
	 * - id: Record ID of the section saved in database.
	 * - name: New section name.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function renameEditorSectionAction()
	{
		// Only allow POST method.
		if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST')
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_INVALID_REQUEST_METHOD'));
		}

		// Get request parameters.
		$id = $this->input->post->getInt('id');
		$name = $this->input->post->getString('name');

		// Rename editor section.
		$this->setResponse(JSNPageBuilder4Helper::renameEditorSection($id, $name));
	}

	/**
	 * Method to remove editor section.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=remove-editor-section&<FORM_TOKEN>=1
	 *
	 * The following query parameter is required:
	 *
	 * - id: Record ID of the section saved in database.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function removeEditorSectionAction()
	{
		// Get request parameters.
		$id = $this->input->getInt('id');

		// Remove editor section.
		$this->setResponse(JSNPageBuilder4Helper::removeEditorSection($id));
	}

	/**
	 * Method to get saved editor sections.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=get-editor-sections&<FORM_TOKEN>=1
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function getEditorSectionsAction()
	{
		// Get saved editor sections.
		$this->setResponse(JSNPageBuilder4Helper::getEditorSections());
	}

	/**
	 * Method to save page data.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=save-page-data&<FORM_TOKEN>=1
	 *
	 * Post the following parameters in request body:
	 *
	 * - extension: Extension of the content item that is being saved.
	 *              E.g. com_content when saving a Joomla article, com_k2 if saving a K2 item, etc.
	 * - hash: Hash of the page which data is being saved.
	 * - data: Page data.
	 * - html: Generated HTML markups.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function savePageDataAction()
	{
		// Only allow POST method.
		if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST')
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_INVALID_REQUEST_METHOD'));
		}

		// Get request parameters.
		$extension = $this->input->post->getCmd('extension');
		$hash = $this->input->post->getString('hash');
		$data = $this->input->post->get('data', '', 'raw');
		$html = $this->input->post->get('html', '', 'raw');

		// Save page data.
		$this->setResponse(
			JSNPageBuilder4Helper::savePageData($extension, $hash, $data, $html)
		);
	}

	/**
	 * Method to get page data.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=get-page-data&<FORM_TOKEN>=1
	 *
	 * The following query parameter is required:
	 *
	 * - hash: Hash of page to get data for. If a number is provided,
	 *         database record with ID equivalent to that number will be returned.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function getPageDataAction()
	{
		// Get request parameters.
		$hash = $this->input->getString('hash');

		// Get page data.
		$this->setResponse(JSNPageBuilder4Helper::getPageData($hash));
	}

	/**
	 * Method to save page revision.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=save-page-revision&<FORM_TOKEN>=1
	 *
	 * Post the following parameters in request body:
	 *
	 * - hash: Hash of the page which revision is being saved.
	 * - type: Revision type.
	 * - data: Revision data.
	 * - html: Generated HTML markups.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function savePageRevisionAction()
	{
		// Only allow POST method.
		if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST')
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_INVALID_REQUEST_METHOD'));
		}

		// Get request parameters.
		$hash = $this->input->post->getString('hash');
		$type = $this->input->post->getString('type');
		$data = $this->input->post->get('data', '', 'raw');
		$html = $this->input->post->get('html', '', 'raw');

		// Save page revision.
		$this->setResponse(JSNPageBuilder4Helper::savePageRevision($hash, $data, $html, $type));
	}

	/**
	 * Method to remove page revision.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=remove-page-revision&<FORM_TOKEN>=1
	 *
	 * The following query parameter is required:
	 *
	 * - id: Record ID of the page revision saved in database.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function removePageRevisionAction()
	{
		// Get request parameters.
		$id = $this->input->getInt('id');

		// Remove page revision.
		$this->setResponse(JSNPageBuilder4Helper::removePageRevision($id));
	}

	/**
	 * Method to get page revision(s).
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=get-page-revisions&<FORM_TOKEN>=1
	 *
	 * The following query parameter is required:
	 *
	 * - hash: Hash of page to get data for. If a number is provided,
	 *         database record with ID equivalent to that number will
	 *         be returned. Otherwise, all database record associated
	 *         with the provided page hash will be returned.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function getPageRevisionsAction()
	{
		// Get request parameters.
		$hash = $this->input->getString('hash');

		// Get page revision.
		$this->setResponse(JSNPageBuilder4Helper::getPageRevisions($hash));
	}

	public function verifyDomainAction()
	{
		throw new Exception('This feature has been removed');
		return;
		/*
		// Get identified name.
		$identifiedName = JsnExtFwHelper::getConstant('IDENTIFIED_NAME', 'com_pagebuilder4');

		// Get extension config.
		$config = JsnExtFwHelper::getSettings('com_pagebuilder4', true);

		// Get host domain.
		$domain = JUri::getInstance()->toString(array('host'));

        // Look for domain data in the temporary directory first.
        $cache = JFactory::getConfig()->get('tmp_path') . "/com_pagebuilder4/domain.data";

		// Send a request to JSN server to verify domain.
		$url =
			'https://www.joomlashine.com/index.php?option=com_lightcart&view=authenticationapi'
			. '&task=authenticationapi.getDomainStatus&tmpl=component'
			. "&identified_name={$identifiedName}"
			. "&token={$config['token']}"
			. "&domain={$domain}";

        try
        {
            $result = JsnExtFwHttp::get($url);

            if ($result && $result['result'] === 'success')
            {
                if (JFolder::create(dirname($cache)))
                {
                    JFile::write($cache, $result['message']);
                }
                return $this->setResponse($result);

            }
            elseif (!$result || $result['result'] === 'failure')
            {
                if ($result)
                {
                    $key = 'JSN_EXTFW_LIGHTCART_' . strtoupper($result['error_code'] ? $result['error_code'] : $result['message']);
                    $msg = JText::_($key);

                    if ($msg == $key)
                    {
                        $msg = $result['message'];
                    }
                }
                throw new Exception($result ? $msg : json_last_error_msg());
            }
        }
        catch (\Exception $e)
        {
            // Reuse cache file if available.
            if (JFile::exists($cache) && ( $domainData = file_get_contents($cache) ) != '')
            {
                $tmpResult 					= array();
                $tmpResult ['result'] 		= 'success';
                $tmpResult ['error_code'] 	= '';
                $tmpResult ['message'] 		= $domainData;
                return $this->setResponse($tmpResult);
            }
            else
            {
                throw $e;
            }
        }*/
	}

	/**
	 * Method to handle contact form submission.
	 *
	 * @return  void
	 */
	public function submitContactFormAction()
	{
		// Verify reCaptcha if necessary.
		if ($this->input->getInt('recaptcha') || $this->input->getInt('invisible_recaptcha'))
		{
			// Get Joomla event dispatcher.
			$dispatcher = JEventDispatcher::getInstance();

			if ($this->input->getInt('recaptcha')
				&& JPluginHelper::importPlugin('captcha', 'recaptcha', false))
			{
				// Load the plugin from the database.
				$plugin = JPluginHelper::getPlugin('captcha', 'recaptcha');

				// Instantiate the plugin.
				$plugin = new PlgCaptchaRecaptcha($dispatcher, (array) $plugin);
			}
			elseif ($this->input->getInt('invisible_recaptcha')
				&& JPluginHelper::importPlugin('captcha', 'recaptcha_invisible', false))
			{
				// Load the plugin from the database.
				$plugin = JPluginHelper::getPlugin('captcha', 'recaptcha_invisible');

				// Instantiate the plugin.
				$plugin = new PlgCaptchaRecaptcha_Invisible($dispatcher, (array) $plugin);
			}

			try
			{
				if (!isset($plugin))
				{
					throw new Exception(JText::_('JSN_PAGEBUILDER4_CAPTCHA_VERIFICATION_PLUGIN_NOT_FOUND'));
				}

				if (!$plugin->onCheckAnswer())
				{
					throw new Exception(JText::_('JSN_PAGEBUILDER4_CAPTCHA_VERIFICATION_FAILED'));
				}
			}
			catch (Exception $e)
			{
				throw new Exception('CAPTCHA_ERROR: ' . $e->getMessage());
			}
		}

		// Get form submission data.
		$id = $this->input->getString('id');
		$hash = $this->input->getString('hash');
		$submission = $this->input->get('contact', array(), 'array');

		// Get page data.
		$page = JSNPageBuilder4Helper::getPageData($hash);

		if (!$page)
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_CONTACT_FORM_SUBMISSION_PAGE_NOT_FOUND'));
		}

		// Decode page data.
		$data = json_decode($page['data']);

		if (!$data)
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_CONTACT_FORM_SUBMISSION_DECODE_PAGE_DATA_FAILED'));
		}

		// Get contact form settings.
		$item = null;

		foreach ($data->items as $_item)
		{
			if ($_item->id === $id)
			{
				$item = $_item;

				break;
			}
		}

		if (!$item)
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_CONTACT_FORM_SUBMISSION_CONTACT_FORM_NOT_FOUND'));
		}

		// Make sure recipient is defined.
		$recipients = $item->data->recipientEmail ?: $this->app->get('mailfrom');

		if (empty($recipients))
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_CONTACT_FORM_SUBMISSION_NO_RECIPIENT'));
		}

		// Produce submission content.
		$content = array();

		foreach ($submission as $label => $value)
		{
			if (is_string($value) && $value == 'undefined')
		    {
		        $value = '';
		    }
			$content[] = "<b>{$label}</b>: " . implode(', ', (array) $value);
		}

		// Produce email subject.
		$subject = empty($item->data->emailTitle)
			? JText::_('JSN_PAGEBUILDER4_CONTACT_FORM_SUBMISSION_SUBJECT')
			: $item->data->emailTitle;

		// Produce email message.
		$message = str_replace(
			array('%LOCATION%', '%SUBMISSION%'),
			array($_SERVER['HTTP_REFERER'], implode('<br/>', $content)),
			JText::_('JSN_PAGEBUILDER4_CONTACT_FORM_SUBMISSION_MESSAGE')
		);

		// Then, send to all admins.
		$mailer = JFactory::getMailer();
		$fromEmail = empty($item->data->fromEmail) ? $this->app->get('mailfrom') : $item->data->fromEmail;
		$fromName = empty($item->data->fromName) ? $this->app->get('fromname') : $item->data->fromName;

		$mailer->setSender(array($fromEmail, $fromName));
		$mailer->setSubject(stripslashes($subject));
		$mailer->setBody($message);
		$mailer->IsHtml(true);

		// Send email.
		$recipients = array_map('trim', explode(',', $recipients));
		$res = null;

		if (isset($item->data->useBCC) && $item->data->useBCC)
		{
			foreach ($recipients as $recipient)
			{
				$mailer->addRecipient($recipient);

				$res = $mailer->Send();

				if ($res instanceof Exception)
				{
					break;
				}

				$mailer->clearAllRecipients();
			}
		}
		else
		{
			$mailer->addRecipient($recipients);

			$res = $mailer->Send();
		}

		if ($res instanceof Exception)
		{
			error_log($res->getMessage());

			throw new Exception('');
		}
	}

	/**
	 * Method to request templates data.
	 *
	 * @return  void
	 */
	public function getTemplatesAction()
	{
		$this->setResponse(array());
		/*try
		{
			$templates = JsnExtFwHttp::get(
				JsnExtFwHelper::getConstant('TEMPLATES_LINK', 'com_pagebuilder4'), 0);

			$this->setResponse($templates);
		}
		catch (Exception $e)
		{
			$this->setResponse(array());
		}*/
	}

	/**
	 * Method to request template data.
	 *
	 * @return  void
	 */
	public function getTemplateDataAction()
	{
		throw new Exception("This feature has been removed", 410);
		return;
		/*try
		{
			$target = $this->input->getString('target');
			$template = JsnExtFwHttp::get($target);

			$this->setResponse($template);
		}
		catch (Exception $e)
		{
			$this->setResponse(new stdClass());
		}*/
	}

	/**
	 * Method to request template HTML.
	 *
	 * @return  void
	 */
	public function getTemplateHtmlAction()
	{
		throw new Exception("This feature has been removed", 410);
		return;
		/*try
		{
			$target = $this->input->getString('target');
			$template = JsnExtFwHttp::get($target);
			$template = JSNPageBuilder4Helper::replaceBaseUrl($template);

			$this->setResponse($template);
		}
		catch (Exception $e)
		{
			$this->setResponse('');
		}*/
	}

	/**
	 * Method to get full html for building page template.
	 *
	 * Ajax URL: index.php?option=com_ajax&format=json&plugin=pagebuilder4&action=get-full-revision&<FORM_TOKEN>=1
	 *
	 * Post the following parameters in request body:
	 *
	 * - hash: Hash of the page which revision is being saved.
	 * - html: Generated HTML markups.
	 *
	 * Remember to replace <FORM_TOKEN> in the Ajax URL above with the real form token. Form token can be
	 * retrieved by calling the static method getFormToken of the class JSession.
	 *
	 * @return  void
	 */
	public function getFullHtmlAction()
	{
		// Only allow POST method.
		if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST')
		{
			throw new Exception(JText::_('JSN_PAGEBUILDER4_INVALID_REQUEST_METHOD'));
		}

		// Get request parameters.
		$hash = $this->input->post->getString('hash');
		$html = $this->input->post->get('html', '', 'raw');

		// Save page revision.
		$this->setResponse(JSNPageBuilder4Helper::getFullHtml($hash, $html));
	}
}
