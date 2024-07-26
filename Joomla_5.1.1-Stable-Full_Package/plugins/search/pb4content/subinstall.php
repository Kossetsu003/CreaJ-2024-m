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

class PlgSearchPB4ContentInstallerScript
{
    /**
     * Enable plugin after installation completed.
     *
     * @param   string  $route      Route type: install, update or uninstall.
     * @param   object  $installer  The installer object.
     *
     * @return bool
     * @throws \Exception
     */
    public function postflight($route, $installer)
    {
        try
        {
	        $dbo = JFactory::getDbo();

	        // Disable the default content search plugin of Joomla.
	        $dbo->setQuery(
		        $dbo->getQuery(true)
			        ->update('#__extensions')
			        ->set(array('enabled = 0'))
			        ->where("element = 'content'")
			        ->where("type = 'plugin'", 'AND')
			        ->where("folder = 'search'", 'AND')
	        )->execute();

	        // Disable the search plugin of JSN PageBuilder 3.
	        $dbo->setQuery(
		        $dbo->getQuery(true)
			        ->update('#__extensions')
			        ->set(array('enabled = 0'))
			        ->where("element = 'pagebuilder3'")
			        ->where("type = 'plugin'", 'AND')
			        ->where("folder = 'search'", 'AND')
	        )->execute();

	        // Enable JSN PageBuilder 4 search plugin for Joomla articles by default.
	        $dbo->setQuery(
	        	$dbo->getQuery(true)
			        ->update('#__extensions')
			        ->set(array('enabled = 1', 'protected = 1', 'ordering= -9999', 'client_id = 0', 'state = 0'))
			        ->where("element = 'pb4content'")
			        ->where("type = 'plugin'", 'AND')
			        ->where("folder = 'search'", 'AND')
	        )->execute();
        }
        catch (Exception $e)
        {
            throw $e;
        }
    }
}
