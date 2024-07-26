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

class PlgSearchPB4K2ItemsInstallerScript
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

	        // Disable the search plugin of K2.
	        $dbo->setQuery(
		        $dbo->getQuery(true)
			        ->update('#__extensions')
			        ->set(array('enabled = 0'))
			        ->where("element = 'k2'")
			        ->where("type = 'plugin'", 'AND')
			        ->where("folder = 'search'", 'AND')
	        )->execute();

	        // Enable JSN PageBuilder 4 search plugin for K2 items by default.
	        $dbo->setQuery(
	        	$dbo->getQuery(true)
			        ->update('#__extensions')
			        ->set(array('enabled = 1', 'protected = 1', 'ordering= -9999', 'client_id = 0', 'state = 0'))
			        ->where("element = 'pb4k2items'")
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
