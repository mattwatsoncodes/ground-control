<?php
/**
 * Ground Control
 *
 * @link              https://github.com/mkdo/ground-control
 * @package           mkdo\ground-control
 *
 * Plugin Name:       Ground Control
 * Plugin URI:        https://github.com/mkdo/ground-control
 * Description:       A brief description of the plugin.
 * Version:           0.1.0
 * Author:            Make Do <hello@makedo.net>
 * Author URI:        https://makedo.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ground-control
 * Domain Path:       /languages
 */

// Abort if this file is called directly.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Constants.
define( 'MKDO_GROUND_CONTROL_ROOT', __FILE__ );
define( 'MKDO_GROUND_CONTROL_NAME', 'Ground Control' );
define( 'MKDO_GROUND_CONTROL_PREFIX', 'mkdo_ground_control' );

// Classes
//
// Create your own, or make copies of those in the examples folder to get you
// started.
require_once 'php/class-helper.php';
require_once 'php/class-settings.php';
require_once 'php/class-controller-assets.php';
require_once 'php/class-controller-main.php';
require_once 'php/class-notices-admin.php';

// Namespaces
//
// Add references for each class here. If you add new classes be sure to include
// the namespace.
use mkdo\ground_control\Helper;
use mkdo\ground_control\Settings;
use mkdo\ground_control\Controller_Assets;
use mkdo\ground_control\Controller_Main;
use mkdo\ground_control\Notices_Admin;

// Instances
//
// Optionally we can pass in the Activator, Deactivator and Uninstaller, however
// not every plugin needs these, so commenting out for now, and putting them into
// the examples folder.
//
// $activator    			  = new Activator();
// $deactivator  			  = new Deactivator();
// $uninstaller  			  = new Uninstaller();
//
// These can easily be added to the list below and added to the main controller.
$settings                 = new Settings();
$controller_assets  	  = new Controller_Assets();
$notices_admin  	      = new Notices_Admin();
$controller_main          = new Controller_Main(
	$settings,
	$controller_assets,
	$notices_admin
);

// Go.
$controller_main->run();

// Tests.
add_action( 'after_setup_theme', function() {
	if ( apply_filters( MKDO_GROUND_CONTROL_PREFIX . '_run_tests', false ) ) {

		// TODO:
		//
		// Add in various helpers and examples:
		//
		// - Settings Helpers
		// - Settings / Bottom of page branding / nag (new)
		// - Widget Examples and Widget Helpers (inc Tiny MCE Widget)
		// - Shortcode Examples and Shortcode Helpers (inc Shortcake example)
		// - Meta Examples and Meta Helpers
		// - Taxonomy Examples and Taxonomy Helpers
		// - Taxonomy Box Hide, Replace with Meta
		// - Proper View Example
		// - Common Specific Examples (People, Address, Etc...)
		// - Tiny MCE Extension Example
		// - Gravity Forms Examples
		// - Google Maps Helpers and Examples
		// - Grab Transients from Daves version for installer and uninstaller
		// - Blog about each of these
		//
		// I may not get all these in, but I will roadmap what I cant get in
		// immediately.
		require_once 'examples/run.php';
	}
});
