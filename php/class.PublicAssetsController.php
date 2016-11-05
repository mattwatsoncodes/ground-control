<?php
namespace dtg\plugin_name;

/**
 * Class PublicAssetsController
 *
 * Sets up the public JS and CSS needed for this plugin.
 *
 * @link		https://github.com/davetgreen/plugin-name
 * @since		0.1.0
 *
 * @package dtg\plugin_name
 */
class PublicAssetsController {

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
		add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue_scripts' ) );
	}

	/**
	 * Enqueue Public Scripts.
	 *
	 * @since    0.1.0
	 */
	public function public_enqueue_scripts() {

		$public_css_url = plugins_url( 'css/admin.css', $this->plugin_root );
		$public_js_url  = plugins_url( 'js/admin.js', $this->plugin_root );

		wp_enqueue_style( $this->plugin_textdomain, $public_css_url );
		wp_enqueue_script( $this->plugin_textdomain, $public_js_url );
	}
}
