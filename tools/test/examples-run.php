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
require_once __DIR__ . '/../../examples/class-virtual-page-ground-control.php';

// Namespaces.
use mkdo\ground_control\Post_Example;
use mkdo\ground_control\Virtual_Page_Ground_Control;

// Instances.
$post_example                = new Post_Example();
$virtual_page_ground_control = new Virtual_Page_Ground_Control();

// Run.
$post_example->run();
$virtual_page_ground_control->run();
