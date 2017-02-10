<?php
namespace dtg\plugin_name;

/**
 * Class Customizer
 *
 * Register Customizer settings, panels, section and controls.
 *
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
		// Handle Settings, Panels, Sections and Controls.
		add_action( 'customize_register', array( $this, 'customizer_settings' ), 10 );
		add_action( 'customize_register', array( $this, 'customizer_sections' ), 10 );
		add_action( 'customize_register', array( $this, 'customizer_controls' ), 10 );

		// Enqueue live preview JS handlers.
		add_action( 'customize_preview_init', array( $this, 'customizer_preview_js' ), 10 );
	}

	/**
	 * Register Customizer settings.
	 *
	 * @param	WP_Customize $wp_customize WordPress Customizer object.
	 *
	 * @since	0.1.0
	 */
	public function customizer_settings( $wp_customize ) {

	}

	/**
	 * Register Customizer panels and sections.
	 *
	 * @param	WP_Customize $wp_customize WordPress Customizer object.
	 *
	 * @since	0.1.0
	 */
	public function customizer_sections( $wp_customize ) {

	}

	/**
	 * Register Customizer controls.
	 *
	 * @param	WP_Customize $wp_customize WordPress Customizer object.
	 *
	 * @since	0.1.0
	 */
	public function customizer_controls( $wp_customize ) {

	}

	/**
	 * Enqueue live preview JS handlers.
	 *
	 * @since	0.1.0
	 */
	function customizer_preview_js() {
		$customizer_js_url  = plugins_url( 'js/customizer.js', $this->plugin_root );
		$customizer_js_path = dirname( $this->plugin_root ) . '/js/customizer.js';

		wp_enqueue_script( $this->plugin_textdomain . '-customizer', $customizer_js_url, array( 'customize-preview' ), filemtime( $customizer_js_path ), true );
	}
}
