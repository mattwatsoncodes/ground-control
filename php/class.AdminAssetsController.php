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
	 * Constructor.
	 *
	 * @since    0.1.0
	 */
	public function __construct( $plugin_root, $plugin_textdomain, $plugin_prefix ) {
		$this->plugin_root 		 = $plugin_root;
		$this->plugin_textdomain = $plugin_textdomain;
		$this->plugin_prefix     = $plugin_prefix;
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
