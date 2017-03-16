<?php
/**
 * Class Activator
 *
 * @since	0.1.0
 *
 * @package mkdo\ground_control
 */

namespace mkdo\ground_control;

/**
 * Carry out actions when the plugin is activated.
 */
class Activator {

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
		// Register the activation callback.
		register_activation_hook( MKDO_GROUND_CONTROL_ROOT, array( $this, 'activate' ) );

		// Hook in specific functionality such as adding notices etc.
		add_action( 'admin_init', array( $this, 'generate_activation_notices' ), 10 );
		add_action( 'admin_notices', array( $this, 'display_activation_notices' ), 10 );
	}

	/**
	 * Activate the plugin.
	 *
	 * @since	0.1.0
	 */
	public function activate() {
		// Set a transient to confirm activation.
		set_transient( MKDO_GROUND_CONTROL_PREFIX . '_activated', true, 10 );
	}

	/**
	 * Create admin notices ready for display.
	 *
	 * @since	0.1.0
	 */
	public function generate_activation_notices() {

		// Check for the activation transient.
		if ( ! empty( get_transient( MKDO_GROUND_CONTROL_PREFIX . '_activated' ) ) ) {

			$activation_notices = array();

			// Add a activation notice.
			$activation_text      = __( sprintf( '%s has been successfully activated.', MKDO_GROUND_CONTROL_NAME ), 'ground-control' );
			$activation_notice    = apply_filters( MKDO_GROUND_CONTROL_PREFIX . '_activation_notice', $activation_text );
			$activation_notices[] = $activation_notice;

			// Add the notices to the transient.
			set_transient( MKDO_GROUND_CONTROL_PREFIX . '_activation_notices', $activation_notices, 10 );
		}
	}

	/**
	 * Display admin notices on plugin activation.
	 *
	 * @since	0.1.0
	 */
	public function display_activation_notices() {

		// Check for the activation transient.
		if ( ! empty( get_transient( MKDO_GROUND_CONTROL_PREFIX . '_activated' ) ) ) {

			// Get any notices from the transient.
			$activation_notices = get_transient( MKDO_GROUND_CONTROL_PREFIX . '_activation_notices' );

			if ( ! empty( $activation_notices ) ) {

				// Loop through the array and generate the notices.
				foreach ( $activation_notices as $notice ) {
					echo '<div class="updated notice is-dismissible"><p>' . esc_html( $notice ) . '</p></div>';
				}
			}

			// Delete the notices transients.
			delete_transient( MKDO_GROUND_CONTROL_PREFIX . '_activated' );
			delete_transient( MKDO_GROUND_CONTROL_PREFIX . '_activation_notices' );
		}
	}
}
