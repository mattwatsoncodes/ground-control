<?php
namespace dtg\plugin_name;

/**
 * Class Deactivator
 *
 * Carry out actions when the plugin is deactivated.
 *
 * @link		https://github.com/davetgreen/plugin-name
 * @since		0.1.0
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
	private $root;

	/**
	 * Plugin text-domain.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $textdomain;

	/**
	 * Plugin prefix.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $prefix;

	/**
	 * Constructor.
	 *
	 * @since		0.1.0
	 */
	public function __construct() {
		$this->plugin_root 		 = DTG_PLUGIN_NAME_ROOT;
		$this->plugin_name		 = DTG_PLUGIN_NAME_NAME;
		$this->plugin_textdomain = DTG_PLUGIN_NAME_PREFIX;
		$this->plugin_prefix     = DTG_PLUGIN_NAME_TEXT_DOMAIN;
	}

	/**
	 * Do Work.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		add_action( 'admin_notices', array( $this, 'deactivation_admin_notice' ), 10 );
		add_action( 'admin_init', array( $this, 'deactivation_admin_init' ), 10 );
	}

	/**
	 * Output notices on plugin deactivation.
	 *
	 * @since    0.1.0
	 */
	public function deactivation_admin_notice() {

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
	 * Add an deactivation notice if we haven't already displayed one.
	 *
	 * @since    0.1.0
	 */
	public function deactivation_admin_init() {

		// Ensure the notice is shown only once.
		if ( 1 != get_option( $this->plugin_prefix . '_deactivation_notice' ) ) {

			// Save the fact the plugin is active in an option.
			add_option( $this->plugin_prefix . '_deactivation_notice', 1 );

			// Add our activation notice.
			$this->deactivation_add_notice();
		}
	}

	/**
	 * Add an admin notice to the output.
	 *
	 * @since    0.1.0
	 */
	public function deactivation_add_notice() {

		// Retrieve any existing notices.
		$notices = get_option( $this->plugin_prefix . '_deferred_admin_notices', array() );

		// Prepare our notice.
		$deactivation_text   = __( sprintf( '%s has been successfully activated.', $this->plugin_name ), $this->plugin_textdomain );
		$deactivation_notice = apply_filters( $this->plugin_prefix . '_activation_notice', $deactivation_text );

		// Add our activation notice to the array.
		$notices[] = $deactivation_notice;

		// Update the notices setting including our notice.
		update_option( $this->plugin_prefix . '_deferred_admin_notices', $notices );
	}
}
