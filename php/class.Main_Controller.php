<?php
namespace dtg\plugin_name;

/**
 * Class Main_Controller
 *
 * @package dtg\plugin_name
 */
class Main_Controller {

	/**
	 * Object to load the public and admin assets.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $assets_controller;

	/**
	 * Object defining the settings page.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $settings;

	/**
	 * Path to the root plugin file.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $root;

	/**
	 * Plugin text-domain.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $textdomain;

	/**
	 * Plugin prefix.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $prefix;

	/**
	 * Constructor.
	 *
	 * @param 	Activator		  $activator		 Object to handle plugin activation.
	 * @param 	Deactivator		  $deactivator		 Object to handle plugin deactivation.
	 * @param 	Uninstaller		  $uninstaller		 Object to handle plugin uninstall.
	 * @param 	Assets_Controller $assets_controller Object to load the public and admin assets.
	 * @param 	Settings		  $settings          Object defining the settings page.
	 * @param 	Customizer		  $customizer        Object defining the customizer options.
	 *
	 * @since 0.1.0
	 */
	function __construct(
		Activator $activator,
		Deactivator $deactivator,
		Uninstaller $uninstaller,
		Assets_Controller $assets_controller,
		Settings $settings,
		Customizer $customizer
		) {

		$this->activator 				= $activator;
		$this->deactivator				= $deactivator;
		$this->uninstaller				= $uninstaller;
		$this->assets_controller 		= $assets_controller;
		$this->settings                 = $settings;
		$this->customizer               = $customizer;
		$this->plugin_root 		 		= DTG_PLUGIN_NAME_ROOT;
		$this->plugin_name		 		= DTG_PLUGIN_NAME_NAME;
		$this->plugin_textdomain 		= DTG_PLUGIN_NAME_PREFIX;
		$this->plugin_prefix     		= DTG_PLUGIN_NAME_TEXT_DOMAIN;
	}

	/**
	 * Unleash Hell.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		load_plugin_textdomain( $this->plugin_textdomain, false, $this->plugin_root . '/../languages' );

		$this->activator->run();
		$this->deactivator->run();
		$this->uninstaller->run();
		$this->assets_controller->run();
		$this->settings->run();
		$this->customizer->run();
	}
}
