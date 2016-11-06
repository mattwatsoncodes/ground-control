<?php
namespace dtg\plugin_name;

/**
 * Class Uninstaller
 *
 * Carry out actions when the plugin is uninstalled.
 *
 * Things to consider:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * @link		https://github.com/davetgreen/plugin-name
 * @since		0.1.0
 *
 * @package dtg\plugin_name
 */
class Uninstaller {

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
	 * @param 	string $root 		Path to the root plugin file.
	 * @param 	string $textdomain 	Plugin text-domain.
	 * @param 	string $prefix 		Plugin prefix.
	 *
	 * @since		0.1.0
	 */
	public function __construct( $root, $textdomain, $prefix ) {
		$this->plugin_root 		 = $root;
		$this->plugin_textdomain = $textdomain;
		$this->plugin_prefix     = $prefix;
	}

	/**
	 * Do Work.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		// Exit if WordPress hasn't requested the uninstall.
		// if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
		// 	die;
		// }

		// Otherwise, continue.
	}
}
