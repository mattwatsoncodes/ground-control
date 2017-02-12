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
		$this->plugin_textdomain = DTG_PLUGIN_NAME_TEXT_DOMAIN;
		$this->plugin_prefix     = DTG_PLUGIN_NAME_PREFIX;
	}

	/**
	 * Unleash Hell.
	 *
	 * @since	0.1.0
	 */
	public function run() {
		// Register our activation callback.
		register_activation_hook( $this->plugin_root, array( $this, 'activate' ) );

		// Hook in our specific functions - these cannot be hooked inside activate() !
		add_action( 'admin_init', array( $this, 'generate_activation_notices' ), 10 );
		add_action( 'admin_notices', array( $this, 'display_activation_notices' ), 10 );
	}

	/**
	 * Activate the plugin.
	 *
	 * @since	0.1.0
	 */
	public function activate() {
		// Set a transient that we can use later.
		set_transient( $this->plugin_prefix . '_activated', true, 10 );
	}

	/**
	 * Create admin notices ready for display.
	 *
	 * @since	0.1.0
	 */
	public function generate_activation_notices() {

		if ( get_transient( $this->plugin_prefix . '_activated' ) ) {

			$notices = array();

			// Add an Activation notice.
			$activation_text   = __( sprintf( '%s has been successfully activated.', $this->plugin_name ), $this->plugin_textdomain );
			$activation_notice = apply_filters( $this->plugin_prefix . '_activation_notice', $activation_text );
			$notices[] = $activation_notice;

			// Add the notices to the transient.
			set_transient( $this->plugin_prefix . '_activated_admin_notices', $notices, 5 );
		}
	}

	/**
	 * Display admin notices on plugin activation.
	 *
	 * @since	0.1.0
	 */
	public function display_activation_notices() {

		if ( ! empty( get_transient( $this->plugin_prefix . '_activated' ) ) ) {

			// Get the notices transients.
			$notices   = get_transient( $this->plugin_prefix . '_activated_admin_notices' );

			if ( ! empty( $notices ) ) {

				// Loop through the array and generate the notices.
				foreach ( $notices as $notice ) {
					echo '<div class="updated notice is-dismissible"><p>' . esc_html( $notice ) . '</p></div>';
				}
			}

			// Delete the notices transients.
			delete_transient( $this->plugin_prefix . '_activated' );
			delete_transient( $this->plugin_prefix . '_activated_admin_notices' );
		}
	}
}