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
defined('_JEXEC') or die('Restricted access');

// Define product identified name and version
define('JSN_PAGEBUILDER4_IDENTIFIED_NAME', 'ext_pagebuilder4');
define('JSN_PAGEBUILDER4_VERSION', '1.4.0');

// Define required Joomla version
define('JSN_PAGEBUILDER4_REQUIRED_JOOMLA_VER', '3.0');

// Define some common links
define('JSN_PAGEBUILDER4_BUY_LINK', '#');
define('JSN_PAGEBUILDER4_DOC_LINK', 'https://www.joomlashine.com/documentation/jsn-extensions/jsn-pagebuilder/jsn-pagebuilder-4.html');
define('JSN_PAGEBUILDER4_INFO_LINK', '#');
define('JSN_PAGEBUILDER4_FORUM_LINK', '#');
define('JSN_PAGEBUILDER4_VIDEO_LINK', '#');
define('JSN_PAGEBUILDER4_REVIEW_LINK', '#');
define('JSN_PAGEBUILDER4_UPDATE_LINK', '');
define('JSN_PAGEBUILDER4_CONTACT_LINK', '#');
define('JSN_PAGEBUILDER4_LICENSE_LINK', '#');
define('JSN_PAGEBUILDER4_LIVE_CHAT_LINK', '');
define('JSN_PAGEBUILDER4_HOW_TO_ACTIVATE_DOMAIN_LINK', '#');

// Define link to get templates data
define('JSN_PAGEBUILDER4_TEMPLATES_LINK', '');

// Define link to get Instagram token
define('JSN_PAGEBUILDER4_INSTAGRAM_GET_TOKEN_LINK', 'https://www.joomlashine.com/instagram/auth.php');

// Define documentation links for all elements in the editor app.
define(
	'JSN_PAGEBUILDER4_ELEMENT_DOCUMENTATION',
	json_encode(array(
		// Containers.
		'Section' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',
		'Tabs2' => JSN_PAGEBUILDER4_DOC_LINK . '#tabs-element-261-1978',
		'Accordion2' => JSN_PAGEBUILDER4_DOC_LINK . '#accordion-element-261-1978',
		'Slider' => JSN_PAGEBUILDER4_DOC_LINK . '#slideshow-element-261-1978',

		// Basic elements.
		'Heading' => JSN_PAGEBUILDER4_DOC_LINK . '#heading-element-261-1978',
		'Paragraph2' => JSN_PAGEBUILDER4_DOC_LINK . '#paragraph-element-261-1978',
		'Button' => JSN_PAGEBUILDER4_DOC_LINK . '#button-element-261-1978',
		'List' => JSN_PAGEBUILDER4_DOC_LINK . '#list-element-261-1978',
		'CustomHTML' => JSN_PAGEBUILDER4_DOC_LINK . '#custom-html-261-1978',

		// Media elements.
		'Image' => JSN_PAGEBUILDER4_DOC_LINK . '#image-element-261-1978',
		'Icon' => JSN_PAGEBUILDER4_DOC_LINK . '#icon-element-261-1978',
		'Youtube2' => JSN_PAGEBUILDER4_DOC_LINK . '#youtube-video-element-261-1978',
		'Vimeo2' => JSN_PAGEBUILDER4_DOC_LINK . '#vimeo-video-element-261-1978',
		'HTML.Video' => JSN_PAGEBUILDER4_DOC_LINK . '#html-video-element-261-1978',
		'SoundCloud' => JSN_PAGEBUILDER4_DOC_LINK . '#soundcloud-element-261-1978',
		'QRCode' => JSN_PAGEBUILDER4_DOC_LINK . '#qrcode-element-261-1978',
		'Divider' => JSN_PAGEBUILDER4_DOC_LINK . '#divider-element-261-1978',

		// Social elements.
		'Instagram' => JSN_PAGEBUILDER4_DOC_LINK . '#instagram-element-261-1978',
		'FBLikeButton' => JSN_PAGEBUILDER4_DOC_LINK . '#facebook-like-element-261-1978',
		'FBPageBox' => JSN_PAGEBUILDER4_DOC_LINK . '#facebook-page-element-261-1978',
		'TwitterFeed' => JSN_PAGEBUILDER4_DOC_LINK . '#twitter-element-261-1978',

		// Advanced elements.
		'CountDown2' => JSN_PAGEBUILDER4_DOC_LINK . '#countdown-timer-element-261-1978',
		'MailChimp' => JSN_PAGEBUILDER4_DOC_LINK . '#mailchimp-form-element-261-1978',
		'Table' => JSN_PAGEBUILDER4_DOC_LINK . '#table-element-261-1978',
		'ProgressBox' => JSN_PAGEBUILDER4_DOC_LINK . '#progress-element-261-1978',
		'GMap' => JSN_PAGEBUILDER4_DOC_LINK . '#google-map-element-261-1978',

		// Form elements.
		'Form2' => JSN_PAGEBUILDER4_DOC_LINK . '#contact-form-261-1978',
		'Form2.Field' => JSN_PAGEBUILDER4_DOC_LINK . '#contact-form-form-field-261-1978',
		'Form2.Button' => JSN_PAGEBUILDER4_DOC_LINK . '#contact-form-form-button-261-1978',

		// Joomla Article elements.
		'ArticleList' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-list-261-1978',
		'ArticleDetails' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-details-261-1978',
		'ArticleImage' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-image-261-1978',
		'ArticleTitle' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-title-261-1978',
		'ArticleDate' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-date-261-1978',
		'ArticleAuthor' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-author-261-1978',
		'ArticleCategory' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-category-261-1978',
		'ArticleIntroText' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-intro-text-261-1978',
		'ArticleReadMore' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-read-more-261-1978',
		'ArticleField' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-article-field-261-1978',

		// Joomla Module element.
		'JoomlaModule' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-module-261-1978',

		// Joomla Article Field element.
	    'JoomlaArticleField' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-joomla-article-field-261-1978',

		// 3rd-party integration elements.
		'JSNImageShow' => JSN_PAGEBUILDER4_DOC_LINK . '#joomlashine-element-jsn-imageshow-261-1978',
		'JSNUniForm' => JSN_PAGEBUILDER4_DOC_LINK . '#joomlashine-element-jsn-uniform-261-1978',

		// K2 Item elements.
		'K2ItemList' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemDetails' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemImage' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemTitle' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemDate' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemAuthor' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemCategory' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemIntroText' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',
		'K2ItemReadMore' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-k2-item-261-1978',

		// EasyBlog Post elements.
		'EasyBlogPostList' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostDetails' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostImage' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostTitle' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostDate' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostAuthor' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostCategory' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostIntroText' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',
		'EasyBlogPostReadMore' => JSN_PAGEBUILDER4_DOC_LINK . '#joomla-element-easyblog-post-261-1978',

		// Pre-made section elements.
		'Newsletter' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',
		'Testimonial' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',
		'Team member' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',
		'Pricing table' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',
		'Image with text' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',
		'Icon with text' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',
		'Image with text overlay' => JSN_PAGEBUILDER4_DOC_LINK . '#layout-element-261-1978',

		// Guides.
		'google-analytics-guide' => JSN_PAGEBUILDER4_DOC_LINK . '#integrate-with-google-analytics-to-track-the-page-261-1981',
		'facebook-pixel-guide' => JSN_PAGEBUILDER4_DOC_LINK . '#set-up-facebook-pixel-to-the-page-261-1981',
		'contact-form-guide' => JSN_PAGEBUILDER4_DOC_LINK . '#how-to-setup-a-contact-form-261-1981',
		'captcha-guide' => JSN_PAGEBUILDER4_DOC_LINK . '#how-to-setup-google-recaptcha-for-a-contact-form-261-1981',


		// J2Store  elements.
		'J2StoreProductList' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-list-261-1978',
		'J2StoreProductDetails' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-details-261-1978',
		'J2StoreProductImage' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-image-261-1978',
		'J2StoreProductTitle' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-title-261-1978',
		'J2StoreProductPrice' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-price-261-1978',
		'J2StoreProductQuantity' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-quantity-261-1978',
		'J2StoreProductAddToCart' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-add-to-cart-261-1978',
		'J2StoreProductDescription' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-description-261-1978',
		'J2StoreProductViewDetails' => JSN_PAGEBUILDER4_DOC_LINK . '#3rd-party-element-j2store-product-view-details-261-1978'		
	))
);

