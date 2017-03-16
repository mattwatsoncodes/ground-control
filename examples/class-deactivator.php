<?php
/**
 * Class Deactivator
 *
 * @since	0.1.0
 *
 * @package mkdo\ground_control
 */
namespace mkdo\ground_control;

/**
 * Carry out actions when the plugin is activated.
 */
class Deactivator {

	/**
	 * Constructor.
	 *
	 * @since	0.1.0
	 */
	public function __construct() {}

	/**
	 * Unleash Hell.
	 *
	 * @since	0.1.0
	 */
	public function run() {
		// Register the deactivation callback.
		register_deactivation_hook( MKDO_GROUND_CONTROL_ROOT, array( $this, 'deactivate' ) );
	}

	/**
	 * Deactivate the plugin.
	 *
	 * @since	0.1.0
	 */
	public function deactivate() {

	}
}
