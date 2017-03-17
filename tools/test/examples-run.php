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
require_once __DIR__ . '/../../examples/class-post-example.php';

// Namespaces.
use mkdo\ground_control\Post_Example;

// Instances.
$post_example = new Post_Example();

// Run.
$post_example->run();
