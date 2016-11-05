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
	public function __construct( $plugin_root, $plugin_textdomain, $plugin_prefix ) {
		$this->plugin_root 		 = $plugin_root;
		$this->plugin_textdomain = $plugin_textdomain;
		$this->plugin_prefix     = $plugin_prefix;
	}

	/**
	 * Do Work.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		register_activation_hook( $this->plugin_root, array( $this, 'activation_notices' ), 10 );
		register_activation_hook( $this->plugin_root, array( $this, 'activation_tasks' ), 10 );
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
		if ( $notices = get_option( $this->plugin_prefix . '_deferred_admin_notices' ) ) {

			// Loop through the array and generate the notices.
			foreach ( $notices as $notice ) {
				echo '<div class="updated"><p>' . esc_html( $notice ) . '</p></div>';
			}

			// Clear out our notices option.
			delete_option( $this->plugin_prefix . '_deferred_admin_notices' );
		}
	}

	/**
	 * Add an activation notice if we haven't already displayed one.
	 *
	 * @since    0.1.0
	 */
	public function activation_admin_init() {

		// Ensure the notice is shown only once.
		if ( 1 != get_option( $this->plugin_prefix . '_activation_notice' ) ) {

			// Save the fact the plugin is active in an option.
			add_option( $this->plugin_prefix . '_activation_notice', 1 );

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
		$notices = get_option( $this->plugin_prefix . '_deferred_admin_notices', array() );

		// Prepare our notice.
		$activation_text   = __( 'Plugin Name has been successfully activated.', $this->plugin_textdomain );
		$activation_notice = apply_filters( $this->plugin_prefix . '_activation_notice', $activation_text );

		// Add our activation notice to the array.
		$notices[] = $activation_notice;

		// Update the notices setting including our notice.
		update_option( $this->plugin_prefix . '_deferred_admin_notices', $notices );
	}
}
