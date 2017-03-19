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

	$content .= '<h2>Format Bytes</h2>';
	$content .= '<p>The following examples are a number that represents bytes,
				converted into various measurements automatically</p>';
	$content .= '<ul>';
	$content .= '<li>1 = ' . Helper_Example::format_bytes( 1 ) . '</li>';
	$content .= '<li>10 = ' . Helper_Example::format_bytes( 10 ) . '</li>';
	$content .= '<li>100 = ' . Helper_Example::format_bytes( 100 ) . '</li>';
	$content .= '<li>1000 = ' . Helper_Example::format_bytes( 1000 ) . '</li>';
	$content .= '<li>10000 = ' . Helper_Example::format_bytes( 10000 ) . '</li>';
	$content .= '<li>100000 = ' . Helper_Example::format_bytes( 100000 ) . '</li>';
	$content .= '<li>1000000 = ' . Helper_Example::format_bytes( 1000000 ) . '</li>';
	$content .= '<li>100000000 = ' . Helper_Example::format_bytes( 100000000 ) . '</li>';
	$content .= '<li>1000000000 = ' . Helper_Example::format_bytes( 1000000000 ) . '</li>';
	$content .= '<li>10000000000 = ' . Helper_Example::format_bytes( 10000000000 ) . '</li>';
	$content .= '<li>100000000000 = ' . Helper_Example::format_bytes( 100000000000 ) . '</li>';
	$content .= '<li>1000000000000 = ' . Helper_Example::format_bytes( 1000000000000 ) . '</li>';
	$content .= '<li>10000000000000 = ' . Helper_Example::format_bytes( 10000000000000 ) . '</li>';
	$content .= '</ul>';

	$content .= '<h2>Get Icons</h2>';
	$content .= '<p>The following example returns an array of Font Awesome icon
				ID\' and names. I dont want to dump it all out, so here are the
				first 2:</p>';
	$test     = Helper_Example::get_icons();
	$content .= '<ul>';
	$content .= '<li>Icon 1';
	$content .= '<ul>';
	$content .= '<li>ID: ' . $test[0]['id'] . '</li>';
	$content .= '<li>Name: ' . $test[0]['name'] . '</li>';
	$content .= '</ul>';
	$content .= '</li>';
	$content .= '<li>Icon 2';
	$content .= '<ul>';
	$content .= '<li>ID: ' . $test[1]['id'] . '</li>';
	$content .= '<li>Name: ' . $test[1]['name'] . '</li>';
	$content .= '</ul>';
	$content .= '</li>';
	$content .= '</ul>';

	$content   .= '<h2>Render View</h2>';
	$content   .= '<p>The following example is a rendered view. Views let us use
				  variables that are passed to them in the file that calls them.
				  We will pass the following variables into the view:</p>';
	$quote     = 'Planet Earth is blue and there\'s nothing I can do';
	$attribute = 'David Bowie';
	$content  .= '<ul>';
	$content  .= '<li>Quote: ' . esc_html( $quote ) . '</li>';
	$content  .= '<li>Attribute: ' . esc_html( $attribute ) . '</li>';
	$content  .= '</ul>';

	ob_start();
	include Helper_Example::render_view( 'view-example' );
	$test = ob_get_clean();
	$content .= $test;

	$content .= '<h2>END TESTS</h2>';
	$content .= '<p>Thats all folks!</p>';

	return $content;
} );
