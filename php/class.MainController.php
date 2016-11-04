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
		Deactivator $deactivator ) {


		$this->admin_assets_controller  = $admin_assets_controller;
		$this->public_assets_controller = $public_assets_controller;
		$this->options                  = $options;
		$this->activator    			= $activator;
		$this->deactivator  			= $deactivator;
	}

	/**
	 * Do Work.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		load_plugin_textdomain( DTG_PLUGIN_NAME_TEXT_DOMAIN, false, DTG_PLUGIN_NAME_ROOT . '\..\languages' );

		$this->options->run();
		$this->admin_assets_controller->run();
		$this->public_assets_controller->run();
		$this->activator->run();
		$this->deactivator->run();
	}
}
