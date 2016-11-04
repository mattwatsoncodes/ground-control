<?php

/**
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

// Constants.
define( 'DTG_PLUGIN_NAME_ROOT', __FILE__ );
define( 'DTG_PLUGIN_NAME_TEXT_DOMAIN', 'plugin-name' );

// Classes.
require_once 'php/class.MainController.php';
require_once 'php/class.AdminAssetsController.php';
require_once 'php/class.PublicAssetsController.php';
require_once 'php/class.Options.php';
require_once 'php/class.Activator.php';
require_once 'php/class.Deactivator.php';

// Namespaces.
use dtg\plugin_name\MainController;
use dtg\plugin_name\AdminAssetsController;
use dtg\plugin_name\PublicAssetsController;
use dtg\plugin_name\Options;
use dtg\plugin_name\Activator;
use dtg\plugin_name\Deactivator;

// Instances.
$admin_assets_controller  = new AdminAssetsController();
$public_assets_controller = new PublicAssetsController();
$options                  = new Options();
$activator    			  = new Activator();
$deactivator  			  = new Deactivator();
$main_controller          = new MainController(
	$admin_assets_controller,
	$public_assets_controller,
	$options,
	$activator,
	$deactivator
);

// Go!
$main_controller->run();
