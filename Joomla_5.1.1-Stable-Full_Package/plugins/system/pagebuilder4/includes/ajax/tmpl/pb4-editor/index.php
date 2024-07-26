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

// Get Joomla document object.
$doc = JFactory::getDocument();

/**
 * @var   string  $liveChatHtml  HTML markups that render live chat popup.
 */
?>
<!DOCTYPE html>
<html lang="<?php echo $doc->language; ?>" dir="<?php echo $doc->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<?php
	// Load and render document head.
	$head = $doc->loadRenderer('head');

	echo $head->render('');

	// Print live chat HTML.
    echo $liveChatHtml;
	?>
</head>
<body>
	<div id="root"></div>
	<?php
	// Render header component.
	JSNPageBuilder4Helper::renderHeader();

	// Render footer.
	JSNPageBuilder4Helper::renderFooter('Editor');
	?>
</body>
</html>
