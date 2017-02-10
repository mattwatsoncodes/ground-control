<?php
namespace dtg\plugin_name;

/**
 * Class Customizer
 *
 * Register Customizer settings, panels, section and controls.
 *
 * @link		https://github.com/davetgreen/plugin-name
 * @since		0.1.0
 *
 * @package dtg\plugin_name
 */
class Customizer {

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
	 * Unleash Hell.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		// Handle Settings, Panels, Sections and Controls.
		add_action( 'customize_register', array( $this, 'customizer_settings' ), 10 );
		add_action( 'customize_register', array( $this, 'customizer_sections' ), 10 );
		add_action( 'customize_register', array( $this, 'customizer_controls' ), 10 );

		// Enqueue JS assets.
		add_action( 'customize_preview_init', array( $this, 'courtauld_customize_preview_js' ), 10 );
	}

	/**
	 * Register Customizer settings.
	 *
	 * @param	WP_Customize $wp_customize WP Customize object.
	 *
	 * @since    0.1.0
	 */
	public function customizer_settings( $wp_customize ) {

	}

	/**
	 * Register Customizer panels and sections.
	 *
	 * @param	WP_Customize $wp_customize WP Customize object.
	 *
	 * @since    0.1.0
	 */
	public function customizer_sections( $wp_customize ) {

	}

	/**
	 * Register Customizer controls.
	 *
	 * @param	WP_Customize $wp_customize WP Customize object.
	 *
	 * @since    0.1.0
	 */
	public function customizer_controls( $wp_customize ) {

	}

	/**
	 * Enqueue live preview JS handlers.
	 */
	function customizer_preview_js() {
		$customizer_js_url = plugins_url( 'js/customizer.js', $this->plugin_root );
		wp_enqueue_script( $this->plugin_textdomain . '-customizer', $customizer_js_url, array( 'customize-preview' ), filemtime( $customizer_js_url ), true );
	}
}
