<?php
namespace dtg\plugin_name;

/**
 * Class MainController
 *
 * @package dtg\plugin_name
 */
class MainController {

	/**
	 * Object to load the admin assets.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $admin_assets_controller;

	/**
	 * Object to load the public assets.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $public_assets_controller;

	/**
	 * Object defining the options page.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $options;

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
	 * @param 	Activator			   $activator				 	Object to handle plugin activation.
	 * @param 	Deactivator			   $deactivator				 	Object to handle plugin deactivation.
	 * @param 	Uninstaller			   $uninstaller				 	Object to handle plugin uninstall.
	 * @param 	AdminAssetsController  $admin_assets_controller 	Object to load the admin assets.
	 * @param 	PublicAssetsController $public_assets_controller 	Object to load the public assets.
	 * @param 	Options          	   $options           			Object defining the options page.
	 * @param 	string	 			   $root 						Path to the root plugin file.
	 * @param 	string	 			   $textdomain 					Plugin text-domain.
	 * @param 	string	 			   $prefix 						Plugin prefix.
	 *
	 * @since 0.1.0
	 */
	function __construct(
		Activator $activator,
		Deactivator $deactivator,
		Uninstaller $uninstaller,
		AdminAssetsController $admin_assets_controller,
		PublicAssetsController $public_assets_controller,
		Options $options,
		$root,
		$textdomain,
		$prefix ) {

		$this->activator 				= $activator;
		$this->deactivator				= $deactivator;
		$this->uninstaller				= $uninstaller;
		$this->admin_assets_controller  = $admin_assets_controller;
		$this->public_assets_controller = $public_assets_controller;
		$this->options                  = $options;
		$this->plugin_root				= $root;
		$this->plugin_textdomain		= $textdomain;
		$this->plugin_prefix			= $prefix;
	}

	/**
	 * Do Work.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		load_plugin_textdomain( $this->plugin_textdomain, false, $this->plugin_root . '/../languages' );

		$this->activator->run();
		$this->deactivator->run();
		$this->uninstaller->run();
		$this->options->run();
		$this->admin_assets_controller->run();
		$this->public_assets_controller->run();
	}
}
