<?php
namespace dtg\plugin_name;

/**
 * Class Deactivator
 *
 * Carry out actions when the plugin is activated.
 *
 * @since	0.1.0
 *
 * @package dtg\plugin_name
 */
class Deactivator {

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
		register_deactivation_hook( $this->plugin_root, array( $this, 'deactivate' ) );
	}

	/**
	 * Deactivate the plugin.
	 *
	 * @since	0.1.0
	 */
	public function deactivate() {
		// Set a transient that we can use later.
		set_transient( $this->plugin_prefix . '_deactivated', true, 5 );

		add_action( 'admin_init', array( $this, 'generate_deactivation_notices' ), 10 );
		add_action( 'admin_notices', array( $this, 'display_deactivation_notices' ), 10 );
	}

	/**
	 * Display admin notices on plugin activation.
	 *
	 * @since	0.1.0
	 */
	public function display_deactivation_notices() {

		// Get the notices transients.
		$deactivated = get_transient( $this->plugin_prefix . '_deactivated' );
		$notices   = get_transient( $this->plugin_prefix . '_deactivated_admin_notices' );

		if ( ! empty( $deactivated ) && ! empty( $notices ) ) {

			// Loop through the array and generate the notices.
			foreach ( $notices as $notice ) {
				echo '<div class="updated notice is-dismissible"><p>' . esc_html( $notice ) . '</p></div>';
			}
		}

		// Delete the notices transients.
		delete_transient( $this->plugin_prefix . '_deactivated' );
		delete_transient( $this->plugin_prefix . '_deactivated_admin_notices' );
	}

	/**
	 * Create admin notices ready for display.
	 *
	 * @since	0.1.0
	 */
	public function generate_deactivation_notices() {

		$notices = array();

		// Add an Activation notice.
		$deactivation_text   = __( sprintf( '%s has been successfully deactivated.', $this->plugin_name ), $this->plugin_textdomain );
		$deactivation_notice = apply_filters( $this->plugin_prefix . '_deactivation_notice', $deactivation_text );
		$notices[] = $deactivation_notice;

		// Add the notices to the transient.
		set_transient( $this->plugin_prefix . '_deactivated_admin_notices', $notices, 5 );
	}
}
