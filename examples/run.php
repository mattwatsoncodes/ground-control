<?php
/**
 * Run Examples
 *
 * @since	0.1.0
 *
 * @package mkdo\ground_control
 */

// Abort if this file is called directly.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Classes.
require_once __DIR__ . '/class-helper-example.php';
require_once __DIR__ . '/class-post-example.php';
require_once __DIR__ . '/class-virtual-page-ground-control.php';

// Namespaces.
use mkdo\ground_control\Helper_Example;
use mkdo\ground_control\Post_Example;
use mkdo\ground_control\Virtual_Page_Ground_Control;

// Instances.
$post_example                = new Post_Example();
$virtual_page_ground_control = new Virtual_Page_Ground_Control();

// Run.
$post_example->run();
$virtual_page_ground_control->run();

// Setup some dummy content.
add_filter( MKDO_GROUND_CONTROL_PREFIX . '_test_content', function() {

	$content = '';

	$content .= '<p>This content has purly been setup to test all the helpers in
				the Ground Control framework.</p>';

	$content .= '<h2>Convert Hashtags to Twitter URLs</h2>';

	$content .= '<p>If this function is working correctly then the hashtag #wcldn
				in the paragraph below should become a Twitter link:</p>';

	$test     = '<p>The hashtag #wcldn should be a link.</p>';
	$test     = Helper_Example::convert_hashtags_to_twitter_urls( $test, true );
	$content .= '<p>' . $test . '</p>';

	$content .= '<h2>Convert Links to Link Tags</h2>';

	$content .= '<p>If this function is working correctly then the link http://google.com
				in the paragraph below should become a clickable link:</p>';

	$test     = '<p>The link http://google.com should become a clickable link.</p>';
	$test     = Helper_Example::convert_links_to_link_tags( $test, true );
	$content .= '<p>' . $test . '</p>';

	$content .= '<h2>Convert Mentions to Twitter URLs</h2>';

	$content .= '<p>If this function is working correctly then the mention @makedoers
				in the paragraph below should become a Twitter link:</p>';

	$test     = '<p>The mention @makedoers should become a Twitter link.</p>';
	$test     = Helper_Example::convert_mentions_to_twitter_urls( $test, true );
	$content .= '<p>' . $test . '</p>';

	$content .= '<h2>Create GUID</h2>';

	$content .= '<p>The following paragraph should contain a unique GUID:</p>';

	$content .= '<p>This is a GUID: ' . Helper_Example::create_guid() . '</p>';

	return $content;
} );
