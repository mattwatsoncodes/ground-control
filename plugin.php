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

// Abort if this file is called directly.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Constants.
define( 'DTG_PLUGIN_NAME_ROOT', __FILE__ );
define( 'DTG_PLUGIN_NAME_NAME', 'Plugin Name' );
define( 'DTG_PLUGIN_NAME_TEXT_DOMAIN', 'plugin-name' );
define( 'DTG_PLUGIN_NAME_PREFIX', 'plugin_name' );

// Classes.
require_once 'php/class.Helpers.php';
require_once 'php/class.Activator.php';
require_once 'php/class.Deactivator.php';
require_once 'php/class.Uninstaller.php';
require_once 'php/class.Assets_Controller.php';
require_once 'php/class.Settings.php';
require_once 'php/class.Customizer.php';
require_once 'php/class.Main_Controller.php';

// Namespaces.
use dtg\plugin_name\Helpers;
use dtg\plugin_name\Activator;
use dtg\plugin_name\Deactivator;
use dtg\plugin_name\Uninstaller;
use dtg\plugin_name\Assets_Controller;
use dtg\plugin_name\Settings;
use dtg\plugin_name\Customizer;
use dtg\plugin_name\Main_Controller;

// Instances.
$helpers				  = new Helpers();
$activator    			  = new Activator();
$deactivator  			  = new Deactivator();
$uninstaller  			  = new Uninstaller();
$assets_controller  	  = new Assets_Controller();
$settings                 = new Settings();
$customizer               = new Customizer();
$main_controller          = new Main_Controller(
	$activator,
	$deactivator,
	$uninstaller,
	$assets_controller,
	$settings,
	$customizer
);

// Unleash Hell.
$main_controller->run();
