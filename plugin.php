<?php
/**
 * Plugin Name
 *
 * @link              https://github.com/davetgreen/plugin-name
 * @package           dtg\plugin-name
 *
 * Plugin Name:       Plugin Name
 * Plugin URI:        https://github.com/davetgreen/plugin-name
 * Description:       A brief description of the plugin.
 * Version:           0.1.0
 * Author:            Dave Green <hello@davetgreen.me>
 * Author URI:        http://www.davetgreen.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Variables.
$root 	    = __FILE__;
$prefix	    = 'plugin_name';
$textdomain = 'plugin-name';

// Classes.
require_once 'php/class.Activator.php';
require_once 'php/class.Deactivator.php';
require_once 'php/class.Uninstaller.php';
require_once 'php/class.AdminAssetsController.php';
require_once 'php/class.PublicAssetsController.php';
require_once 'php/class.Options.php';
require_once 'php/class.MainController.php';

// Namespaces.
use dtg\plugin_name\Activator;
use dtg\plugin_name\Deactivator;
use dtg\plugin_name\Uninstaller;
use dtg\plugin_name\AdminAssetsController;
use dtg\plugin_name\PublicAssetsController;
use dtg\plugin_name\Options;
use dtg\plugin_name\MainController;

// Instances.
$activator    			  = new Activator( $root, $textdomain, $prefix );
$deactivator  			  = new Deactivator( $root, $textdomain, $prefix );
$uninstaller  			  = new Uninstaller( $root, $textdomain, $prefix );
$admin_assets_controller  = new AdminAssetsController( $root, $textdomain, $prefix );
$public_assets_controller = new PublicAssetsController( $root, $textdomain, $prefix );
$options                  = new Options( $root, $textdomain, $prefix );
$main_controller          = new MainController(
	$activator,
	$deactivator,
	$uninstaller,
	$admin_assets_controller,
	$public_assets_controller,
	$options,
	$root,
	$textdomain,
	$prefix
);

// Go!
$main_controller->run();
