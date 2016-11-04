<?php
namespace dtg\plugin_name;

/**
 * Class Activator
 *
 * Carry out actions when the plugin is activated.
 *
 * @link		https://github.com/davetgreen/plugin-name
 * @since		0.1.0
 *
 * @package dtg\plugin_name
 */
class Activator {

	/**
	 * Constructor.
	 *
	 * @since		0.1.0
	 */
	function __construct() {
	}

	/**
	 * Do Work.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		register_activation_hook( DTG_PLUGIN_NAME_ROOT, array( $this, 'activation_notices' ), 10 );
		register_activation_hook( DTG_PLUGIN_NAME_ROOT, array( $this, 'activation_tasks' ), 10 );
	}

	/**
	 * Display admin notices on plugin activation.
	 *
	 * @since		0.1.0
	 */
	public function activation_notices() {
		add_action( 'admin_notices', array( $this, 'activation_admin_notice' ), 10 );
		add_action( 'admin_init', array( $this, 'activation_admin_init' ), 10 );
	}

	/**
	 * Carry out tasks on plugin activation.
	 *
	 * @since		0.1.0
	 */
	public function activation_tasks() {

	}

	/**
	 * Output notices on plugin activation.
	 *
	 * @since    0.1.0
	 */
	public function activation_admin_notice() {
		// If we have notices.
		if ( $notices = get_option( 'plugin_name_deferred_admin_notices' ) ) {

			// Loop through the array and generate the notices.
			foreach ( $notices as $notice ) {
				echo '<div class="updated"><p>' . esc_html( $notice ) . '</p></div>';
			}

			// Clear out our notices option.
			delete_option( 'plugin_name_deferred_admin_notices' );
		}
	}

	/**
	 * Add an activation notice if we haven't already displayed one.
	 *
	 * @since    0.1.0
	 */
	public function activation_admin_init() {

		// Ensure the notice is shown only once.
		if ( 1 != get_option( 'plugin_name_notice' ) ) {

			// Save the fact the plugin is active in an option.
			add_option( 'plugin_name_notice', 1 );

			// Add our activation notice.
			$this->activation_add_notice();
		}
	}

	/**
	 * Add an admin notice to the output.
	 *
	 * @since    0.1.0
	 */
	public function activation_add_notice() {

		// Retrieve any existing notices.
		$notices = get_option( 'plugin_name_deferred_admin_notices', array() );

		// Prepare our notice.
		$msg        = __( 'Plugin Name has been successfully activated.', DTG_PLUGIN_NAME_TEXT_DOMAIN );
		$activation = apply_filters( 'plugin_name_activation_notice_text', $msg );

		// Add our activation notice to the array.
		$notices[] = $activation;

		// Update the notices setting including our notice.
		update_option( 'plugin_name_deferred_admin_notices', $notices );
	}
}
