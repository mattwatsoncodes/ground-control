<?php
namespace dtg\plugin_name;

/**
 * Class MainController
 *
 * @package dtg\plugin_name
 */
class MainController {

	/**
	 * Object defining the options page.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $options;

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
	 * Object firing activation notices and tasks.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $activator;

	/**
	 * Object firing deactivation notices and tasks.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $deactivator;

	/**
	 * Constructor.
	 *
	 * @param AdminAssetsController  $admin_assets_controller 	Object to load the admin assets.
	 * @param PublicAssetsController $public_assets_controller 	Object to load the public assets.
	 * @param Options          		 $options           		Object defining the options page.
	 * @param Activator   			 $activator 				Object firing activation notices and tasks.
	 * @param Deactivator 			 $deactivator 				Object firing deactivation notices and tasks.
	 *
	 * @since		0.1.0
	 */
	function __construct(
		AdminAssetsController $admin_assets_controller,
		PublicAssetsController $public_assets_controller,
		Options $options,
		Activator $activator,
		Deactivator $deactivator,
		$plugin_root,
		$plugin_textdomain,
		$plugin_prefix ) {

		$this->admin_assets_controller  = $admin_assets_controller;
		$this->public_assets_controller = $public_assets_controller;
		$this->options                  = $options;
		$this->activator    			= $activator;
		$this->deactivator  			= $deactivator;
		$this->plugin_root				= $plugin_root;
		$this->plugin_textdomain		= $plugin_textdomain;
		$this->plugin_prefix			= $plugin_prefix;
	}

	/**
	 * Do Work.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		load_plugin_textdomain( $this->plugin_textdomain, false, $this->plugin_root . '/../languages' );

		$this->options->run();
		$this->admin_assets_controller->run();
		$this->public_assets_controller->run();
		$this->activator->run();
		$this->deactivator->run();
	}
}
