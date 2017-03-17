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
if ( apply_filters( MKDO_GROUND_CONTROL_PREFIX . '_run_tests', false ) ) {
	require_once 'tools/test/examples-run.php';
}
