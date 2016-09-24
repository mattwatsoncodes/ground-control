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
	private $activation_controller;

	/**
	 * Object firing deactivation notices and tasks.
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $deactivation_controller;

	/**
	 * Constructor.
	 *
	 * @param Options          		 $options           		Object defining the options page.
	 * @param AdminAssetsController  $admin_assets_controller 	Object to load the admin assets.
	 * @param PublicAssetsController $public_assets_controller 	Object to load the public assets.
	 * @param ActivationController   $activation_controller 	Object firing activation notices and tasks.
	 * @param DeactivationController $deactivation_controller 	Object firing deactivation notices and tasks.
	 *
	 * @since		0.1.0
	 */
	function __construct(
		Options $options,
		AdminAssetsController $admin_assets_controller,
		PublicAssetsController $public_assets_controller,
		ActivationController $activation_controller,
		DeactivationController $deactivation_controller ) {

		$this->options                  = $options;
		$this->admin_assets_controller  = $admin_assets_controller;
		$this->public_assets_controller = $public_assets_controller;
		$this->activation_controller    = $activation_controller;
		$this->deactivation_controller  = $deactivation_controller;
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
		$this->activation_controller->run();
		$this->deactivation_controller->run();
	}
}
