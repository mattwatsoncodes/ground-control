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
	function __construct() {
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

		$plugin_public_css_url = plugins_url( 'css/admin.css', DTG_PLUGIN_NAME_ROOT );
		$plugin_public_js_url  = plugins_url( 'js/admin.js', DTG_PLUGIN_NAME_ROOT );

		wp_enqueue_style( DTG_PLUGIN_NAME_TEXT_DOMAIN, $plugin_public_css_url );
		wp_enqueue_script( DTG_PLUGIN_NAME_TEXT_DOMAIN, $plugin_public_js_url );

	}
}
