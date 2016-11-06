<?php
namespace dtg\plugin_name;

/**
 * Class AdminAssetsController
 *
 * Sets up the admin area JS and CSS needed for this plugin.
 *
 * @link		https://github.com/davetgreen/plugin-name
 * @since		0.1.0
 *
 * @package dtg\plugin_name
 */
class AdminAssetsController {

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
	 * @since    0.1.0
	 */
	public function run() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Enqueue Admin Scripts.
	 *
	 * @since    0.1.0
	 */
	public function admin_enqueue_scripts() {

		$admin_css_url = plugins_url( 'css/admin.css', $this->plugin_root );
		$admin_js_url  = plugins_url( 'js/admin.js', $this->plugin_root );

		wp_enqueue_style( $this->plugin_textdomain, $admin_css_url );
		wp_enqueue_script( $this->plugin_textdomain, $admin_js_url );

	}
}
