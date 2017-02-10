<?php
namespace dtg\plugin_name;

/**
 * Class Activator
 *
 * Carry out actions when the plugin is activated.
 *
 * @since	0.1.0
 *
 * @package dtg\plugin_name
 */
class Activator {

	/**
	 * Path to the root plugin file.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $plugin_root;

	/**
	 * Plugin name.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $plugin_name;

	/**
	 * Plugin text-domain.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $plugin_textdomain;

	/**
	 * Plugin prefix.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $plugin_prefix;

	/**
	 * Constructor.
	 *
	 * @since	0.1.0
	 */
	public function __construct() {
		$this->plugin_root 		 = DTG_PLUGIN_NAME_ROOT;
		$this->plugin_name		 = DTG_PLUGIN_NAME_NAME;
		$this->plugin_textdomain = DTG_PLUGIN_NAME_PREFIX;
		$this->plugin_prefix     = DTG_PLUGIN_NAME_TEXT_DOMAIN;
	}

	/**
	 * Unleash Hell.
	 *
	 * @since	0.1.0
	 */
	public function run() {
		add_action( 'admin_notices', array( $this, 'activation_admin_notice' ), 10 );
		add_action( 'admin_init', array( $this, 'activation_admin_init' ), 10 );
	}

	/**
	 * Output notices on plugin activation.
	 *
	 * @since	0.1.0
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
	 * @since	0.1.0
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
	 * @since	0.1.0
	 */
	public function activation_add_notice() {

		// Retrieve any existing notices.
		$notices = get_option( $this->plugin_prefix . '_deferred_admin_notices', array() );

		// Prepare our notice.
		$activation_text   = __( sprintf( '%s has been successfully activated.', $this->plugin_name ), $this->plugin_textdomain );
		$activation_notice = apply_filters( $this->plugin_prefix . '_activation_notice', $activation_text );

		// Add our activation notice to the array.
		$notices[] = $activation_notice;

		// Update the notices setting including our notice.
		update_option( $this->plugin_prefix . '_deferred_admin_notices', $notices );
	}
}
