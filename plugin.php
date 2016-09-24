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

// Constants.
define( 'DTG_PLUGIN_NAME_ROOT', __FILE__ );
define( 'DTG_PLUGIN_NAME_TEXT_DOMAIN', 'plugin-name' );

// Classes.
require_once 'php/class.MainController.php';
require_once 'php/class.Options.php';
require_once 'php/class.AssetsController.php';
require_once 'php/class.ActivationController.php';
require_once 'php/class.DeactivationController.php';

// Namespaces.
use dtg\plugin_name\MainController;
use dtg\plugin_name\Options;
use dtg\plugin_name\AssetsController;
use dtg\plugin_name\ActivationController;
use dtg\plugin_name\DeactivationController;

// Init.
$options                 = new Options();
$assets_controller       = new AssetsController();
$activation_controller   = new ActivationController();
$deactivation_controller = new DeactivationController();
$main_controller         = new MainController(
	$options,
	$assets_controller,
	$activation_controller,
	$deactivation_controller
);

// Go!
$main_controller->run();
