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
defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

/**
 * Page Manager controller.
 *
 * @package  JSN_PageBuilder_4
 * @since    1.0.0
 */
class JSNPageBuilder4ControllerManage extends JControllerAdmin
{
	/**
	 * The name of the controller
	 */
	protected $name = 'pagebuilder4';

	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  The array of possible config values. Optional.
	 *
	 * @return  JModelLegacy
	 */
	public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		$name = empty($name) ? 'Manage' : $name;
		$prefix = empty($prefix) ? 'JSNPageBuilder4Model' : $prefix;

		return parent::getModel($name, $prefix, $config);
	}

	/**
	 * Method to publish a list of items.
	 *
	 * @return  void
	 */
	public function publish()
	{
		// Check for request forgeries.
		$this->checkToken();

		// Get items to publish from the request.
		$cid = $this->input->get('cid', array(), 'array');
		$data = array('publish' => 1, 'unpublish' => 0);
		$task = $this->getTask();
		$value = ArrayHelper::getValue($data, $task, 0, 'int');

		if (empty($cid))
		{
			$this->setMessage(JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), 'error');
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Make sure the item ids are integers.
			$cid = ArrayHelper::toInteger($cid);

			// Publish the items.
			try
			{
				if ($success = $model->publish($cid, $value))
				{
					if ($value === 1)
					{
						{
							$ntext = $this->text_prefix . '_N_ITEMS_PUBLISHED';
						}
					}
					elseif ($value === 0)
					{
						$ntext = $this->text_prefix . '_N_ITEMS_UNPUBLISHED';
					}

					if ($ntext !== null)
					{
						$this->setMessage(\JText::plural($ntext, $success));
					}
				}
			}
			catch (\Exception $e)
			{
				$this->setMessage($e->getMessage(), 'error');
			}
		}

		$this->setRedirect(\JRoute::_("index.php?option={$this->option}&view={$this->view_list}", false));
	}

	/**
	 * Method to remove a list of items.
	 *
	 * @return  void
	 */
	public function delete()
	{
		// Check for request forgeries
		$this->checkToken();

		// Get items to remove from the request.
		$cid = $this->input->get('cid', array(), 'array');

		if (empty($cid))
		{
			$this->setMessage(JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), 'error');
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Make sure the item ids are integers
			$cid = ArrayHelper::toInteger($cid);

			// Remove the items.
			if ($success = $model->delete($cid))
			{
				$this->setMessage(\JText::plural($this->text_prefix . '_N_ITEMS_DELETED', $success));
			}
			else
			{
				$this->setMessage($model->getError(), 'error');
			}

			// Invoke the postDelete method to allow for the child class to access the model.
			$this->postDeleteHook($model, $cid);
		}

		$this->setRedirect(\JRoute::_("index.php?option={$this->option}&view={$this->view_list}", false));
	}
}
