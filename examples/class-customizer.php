<?php
/**
 * Class Customizer
 *
 * Register Customizer settings, panels, section and controls.
 *
 * @since		0.1.0
 *
 * @package mkdo\ground_control
 */

namespace mkdo\ground_control;

/**
 * Register Customizer settings, panels, section and controls.
 */
class Customizer {

	/**
	 * Constructor.
	 *
	 * @since	0.1.0
	 */
	public function __construct() {}

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
		$customizer_js_url  = plugins_url( 'js/customizer.js', MKDO_GROUND_CONTROL_ROOT );
		$customizer_js_path = dirname( MKDO_GROUND_CONTROL_ROOT ) . '/js/customizer.js';

		wp_enqueue_script( MKDO_GROUND_CONTROL_PREFIX . '-customizer', $customizer_js_url, array( 'customize-preview' ), filemtime( $customizer_js_path ), true );
	}
}
