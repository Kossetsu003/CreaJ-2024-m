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
 * Base class for creating item selector screen.
 *
 * @package  JSN Extension Framework 2
 * @since    1.0.0
 */
class JsnExtFwChooser
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

	/**
	 * Define the CSS class of the list table.
	 *
	 * @var  string
	 */
	protected $list_class = 'table-striped';

	/**
	 * Define the CSS class of the link to edit an item.
	 *
	 * @var  string
	 */
	protected $edit_class = '';

	/**
	 * Define base edit link.
	 *
	 * @var  string
	 */
	protected $edit_link = '';

	/**
	 * Define base view link.
	 *
	 * @var  string
	 */
	protected $view_link = '';

	/**
	 * Joomla application object.
	 *
	 * @var  JApplicationCms
	 */
	protected $app;

	/**
	 * Joomla database object.
	 *
	 * @var  JDatabaseDriver
	 */
	protected $dbo;

	/**
	 * Input object.
	 *
	 * @var  JInput
	 */
	protected $input;

	/**
	 * Define context.
	 *
	 * @var  string
	 */
    protected $context;
    /**
     * Define component.
     *
     * @var  string
     */
    protected $component;
    /**
     * Define callback.
     *
     * @var  string
     */
    protected $callback;
    /**
     * Define plugin.
     *
     * @var  string
     */
    protected $plugin;
	/**
	 * provider.
	 *
	 * @param   string  $component  The component associated with the current Ajax request.
	 *
	 * @return  void
	 */
    protected $provider;

	/**
	 * Constructor.
	 *
	 * @param   string  $component  The component associated with the current Ajax request.
	 *
	 * @return  void
	 */
	public function __construct()
	{
		// Get necessary Joomla objects.
		$this->app        = JFactory::getApplication();
		$this->dbo        = JFactory::getDbo();
		$this->input      = $this->app->input;

        $this->context    = $this->input->getCmd('jsncontext', '');
        $this->component  = $this->input->getString('component', '');
        $this->callback   = $this->input->getString('callback', '');
        $this->plugin     = $this->input->getString('plugin', '');
        $this->provider   = $this->input->getString('provider', '');

	}
	/**
	 * Process and set response content.
	 *
	 * @param   mixed  $content  Content will be sent to client.
	 *
	 * @return  void
	 */
    public static function execute($content)
	{
		// Get Joomla is application instance.
		$app        = JFactory::getApplication();
		$user	    = JFactory::getUser();
		// Prepare to execute Ajax action.
		$context    = $app->input->getCmd('jsncontext', '');
        $option     = $app->input->getCmd('option', '');
        // Verify token.
        $isValidToken = !JSession::checkToken('get') && !JSession::checkToken('post');

        if ($isValidToken)
        {
            throw new Exception(JText::_('JSN_EXTFW_AJAX_INVALID_TOKEN'));
        }
        // Context check
        if (empty($context) || empty($option))
        {
            throw new Exception(JText::sprintf('JSN_EXTFW_AJAX_INVALID_CONTEXT', $context));
        }

        // Access check
        if (!$user->authorise('core.manage',  $option))
        {
            throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
        }

        // Generate context class.
        $contextClass = 'JsnExtFwChooser' . str_replace(
            ' ', '', ucwords(preg_replace('/[^a-zA-Z0-9]+/', ' ', $context))
        );

        if (!class_exists($contextClass))
        {
            throw new Exception(JText::sprintf('JSN_EXTFW_AJAX_INVALID_CONTEXT', $context));
        }

        // Create a new instance of the request context.
        $contextObject = new $contextClass();
        return $contextObject->setResponse($content);
	}

	protected function setResponse($content)
	{
		// Get callback function.
		$cb = $this->input->getString('callback');

		// Get currently selected item.
		$selected = $this->input->getString('selected', '');

		// Create a DOMDocument object from the response.
		$dom = new DOMDocument();

		// Handle errors internally
		libxml_use_internal_errors(true);
		
		$dom->loadHTML($content);
		
		// Clear errors
		libxml_clear_errors();
		// Get the admin form.
		$form = $dom->getElementById('adminForm');

		// Get action related inputs.
		$inputs = array();
		$action = array();

		// Define necessary fields
		$extraElements = array();
        $extraElements ['provider'] = $this->provider;
        $extraElements ['type'] = 'chooser';
        $extraElements ['jsncontext'] = $this->context;
        $extraElements ['plugin'] = $this->plugin;
        $extraElements ['component'] = $this->component;
        $extraElements ['callback'] = $this->callback;
        $extraElements ['selected'] = $selected;
        $extraElements ['tmpl'] = 'component';

		foreach ($form->getElementsByTagName('input') as $input)
		{
			if ('hidden' === (string) $input->getAttribute('type'))
			{
				if (in_array((string) $input->getAttribute('name'), array('option', 'view', 'task')))
				{
					$inputs[] = $input;
					$action[] = $input->getAttribute('name') . '=' . $input->getAttribute('value');
				}
			}
		}

		// Remove action related inputs.
		/*foreach ($inputs as $input)
		{
			$input->parentNode->removeChild($input);
		}*/

		// Rebuild action link based on the value of action related inputs.
		$actionLink = '&provider='. $this->provider .'&selected='. $selected .'&type=chooser&jsncontext=' . $this->context . '&plugin=' . $this->plugin . '&component=' . $this->component . '&callback=' .$this->callback;

		if ($form->getAttribute('action') === 'index.php')
		{
			$form->setAttribute('action', 'index.php?' . implode('&amp;', $action) . $actionLink);
		}
		else
		{
		    $form->setAttribute('action', $form->getAttribute('action') . $actionLink);
		}

        // Add necessary fields to form
		foreach ($extraElements as $key => $value)
        {
            $elm = $dom->createElement('input');
            $elm->setAttribute('type', 'hidden');
            $elm->setAttribute('name', $key);
            $elm->setAttribute('value', $value);
            $form->appendChild($elm);
        }

		// Get the list table.
		foreach ($form->getElementsByTagName('table') as $table)
		{
			if (strpos($table->getAttribute('class'), $this->list_class) !== false)
			{
				// Make sure list table has content.
				$tbody = $table->getElementsByTagName('tbody')->item(0);
				$rows = $tbody->getElementsByTagName('tr');

				if ($rows->length === 1)
				{
					$col = $rows->item(0)->getElementsByTagName('td')->item(0);

					if ($col->getAttribute('colspan'))
					{
						break;
					}
				}

				// Prepend a column to the list table head.
				$thead = $table->getElementsByTagName('thead')->item(0);
				$row = $thead->getElementsByTagName('tr')->item(0);
				$col = $dom->createElement('th', '#');

				$col->setAttribute('width', '3%');
				$col->setAttribute('class', 'center nowrap');

				$row->insertBefore($col, $row->firstChild);

				// Prepend a column containing a radio box to every row of the list table body.
				foreach ($rows as $row)
				{
					// Prepend a column containing a radio box to the current row.
					$col = $dom->createElement('td');
					$elm = $dom->createElement('input');

					$row->setAttribute('onclick', 'selectItem(this);');

					$col->setAttribute('class', 'center');

					$elm->setAttribute('type', 'radio');
					$elm->setAttribute('name', 'check');
					$elm->setAttribute('class', 'checked-id');

					$col->appendChild($elm);
					$row->insertBefore($col, $row->firstChild);

					// Replace the select link with a `span` element.
					$links = $row->getElementsByTagName('a');

					for ($i = $links->length - 1; $i >= 0; $i--)
					{
						if ($links[$i]->getAttribute('class') === $this->edit_class)
						{
							$span = $dom->createElement('span', '');

							while ($links[$i]->childNodes->length)
							{
								$span->appendChild($links[$i]->childNodes[0]);
							}

							$span->setAttribute('class', $this->edit_class);
							$links[$i]->parentNode->replaceChild($span, $links[$i]);
						}
					}
				}

				// Increase column span for the list table foot.
				$tfoot = $table->getElementsByTagName('tfoot')->item(0);

				if ($tfoot->firstChild->firstChild)
				{
					$tfoot->firstChild->firstChild->setAttribute(
						'colspan',
						(int) $tfoot->firstChild->firstChild->getAttribute('colspan') + 1
					);
				}

				break;
			}
		}

		// Change mouse pointer when hovering a table row.
		$style[] = "#adminForm .{$this->list_class} tbody tr { cursor: pointer; }";

		// Trigger an event to allow 3rd-party to add more styles.
		$this->app->triggerEvent('onJsnExtFwGetSelectorStyles', array($this, &$style));

		// Append custom style to the original document.
		$head = $dom->getElementsByTagName('head')->item(0);
		$style = $dom->createElement('style', implode("\n", $style));

		$style->setAttribute('type', 'text/css');
		$head->appendChild($style);

		// Override jModalClose function to prevent the selector modal from being closed after selecting an item.
		$script[] = 'window.parent.jModalClose = function(){};';

		// If current site is a multi-lingual one, pass all language to frontend.
		if (JLanguageMultilang::isEnabled())
		{
			$script[] = trim(preg_replace('/[\t\r\n]+/', ' ', '
			window.languages = ' . json_encode(
				JLanguageHelper::getContentLanguages(array(1), true, 'sef')
			) . ";
			function getItemLanguage(that) {
				var table = that.parentNode;
				while (table.nodeName !== 'TABLE') {
					table = table.parentNode;
				}
				var cols = table.querySelectorAll('th');
				for (var idx = 0; idx < cols.length; idx++) {
					if (!cols[idx].children.length) {
						continue;
					}
					if (/language(_title)?$/.test(cols[idx].children[0].getAttribute('data-order'))) {
						for (var lang in languages) {
							if (
								that.children[idx].textContent.indexOf(languages[lang].title) > -1
								||
								that.children[idx].textContent.indexOf(languages[lang].title_native) > -1
							) {
								return lang;
							}
						}
					}
				}
				return '';
			}"));
		}

		// Define function to get item title.
		$script[] = trim(preg_replace('/[\t\r\n]+/', ' ', "
		function getItemTitle(that) {
			var titles = that.querySelectorAll('.{$this->edit_class}');
			for (var i = 0; i < titles.length; i++) {
				if (titles[i].textContent.trim() !== '') {
					return titles[i].textContent.trim();
				}
			}
			return '';
		}"));

		// Define function to get link to view item.
		$script[] = trim(preg_replace('/[\t\r\n]+/', ' ', "
		function getLinkToViewItem(that, id) {
			var view = " . ($this->view_link ? "'{$this->view_link}' + id" : "''") . ";
			if (typeof getItemLanguage === 'function') {
				var lang = getItemLanguage(that);
				if (lang !== '') {
					view += '&lang=' + lang;
				}
			}
			return view;
		}"));

		// Define function to get link to edit item.
		$script[] = trim(preg_replace('/[\t\r\n]+/', ' ', '
		function getLinkToEditItem(that, id) {
			return ' . ($this->edit_link ? "'{$this->edit_link}' + id" : "''") . ';
		}'));

		// Create select function.
		$script[] = trim(preg_replace('/[\t\r\n]+/', ' ', "
		window.selectItem = function (that) {
			that.querySelector('input.checked-id').checked = true;
			var id = that.lastElementChild.textContent.trim();
			var title = getItemTitle(that);
			var view = getLinkToViewItem(that, id);
			var edit = getLinkToEditItem(that, id);
			if (window.parent['{$cb}']) {
				window.parent['{$cb}'](id, title, view, edit);
			}
		};"));

		// Pre-select the item that is currently selected.
		if ($selected)
		{
			$script[] = trim(preg_replace('/[\t\r\n]+/', ' ', "
			var rows = document.querySelectorAll('#adminForm tbody tr');
			for (var i = 0; i < rows.length; i++) {
				if (rows[i].lastElementChild.textContent.trim() === '{$selected}') {
					selectItem(rows[i]);
					break;
				}
			}"));
		}

		// Handle onBeforeUnload event to clear current selection.
		$script[] = trim(preg_replace('/[\t\r\n]+/', ' ', "
		var oldOnBeforeUnload = window.onbeforeunload;
		window.onbeforeunload = function() {
			if (window.parent['{$cb}']) {
				window.parent['{$cb}']();
			}
			if (typeof oldOnBeforeUnload === 'function') {
				oldOnBeforeUnload();
			}
		};"));

		// Trigger an event to allow 3rd-party to add more scripts.
		$this->app->triggerEvent('onJsnExtFwGetSelectorScripts', array($this, &$script));

		// Append custom script to the original document.
		$body = $dom->getElementsByTagName('body')->item(0);
		$script = $dom->createElement('script', '(function() { ' . implode(' ', $script) . ' })();');

		$script->setAttribute('type', 'text/javascript');
		$body->appendChild($script);

		// Trigger an event to allow 3rd-party extensions load additional stylesheets or script files.
		$stylesheets = $scripts = array();

		$this->app->triggerEvent(
			'onJsnExtFwGetSelectorScreenAssets', array($this->context, &$stylesheets, &$scripts)
		);

		// Load additional stylesheets.
		foreach ($stylesheets as $link)
		{
			$stylesheet = $dom->createElement('link');

			$stylesheet->setAttribute('rel', 'stylesheet');
			$stylesheet->setAttribute('href', $link);

			$head->appendChild($stylesheet);
		}

		// Load additional script files.
		foreach ($scripts as $link)
		{
			$script = $dom->createElement('script');

			$script->setAttribute('src', $link);
			$script->setAttribute('type', 'text/javascript');

			$body->appendChild($script);
		}

		return $dom->saveHTML();
	}
}
