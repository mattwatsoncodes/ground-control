<?php
/**
 * Class Controller_Assets
 *
 * @since	0.1.0
 *
 * @package mkdo\ground_control
 */

namespace mkdo\ground_control;

/**
 * Sets up the public and admin area JS and CSS needed for this plugin.
 *
 * These enqueues should exist here for reference, but we highly recommend that
 * the appropriate filters are used to deactivate these enqueues, and these are
 * concatenated and enqueued in your own themes workflow.
 */
class Controller_Assets {

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
		add_action( 'admin_enqueue_scripts', array( $this, 'public_enqueue_scripts' ), 10 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10 );
	}

	/**
	 * Enqueue Public Scripts.
	 *
	 * @since	0.1.0
	 */
	public function public_enqueue_scripts() {

		$do_public_enqueue     = apply_filters( MKDO_GROUND_CONTROL_PREFIX . 'do_public_enqueue', true );
		$do_public_css_enqueue = apply_filters( MKDO_GROUND_CONTROL_PREFIX . 'do_public_css_enqueue', true );
		$do_public_js_enqueue  = apply_filters( MKDO_GROUND_CONTROL_PREFIX . 'do_public_js_enqueue', true );

		/* CSS */
		if ( $do_public_enqueue && $do_public_css_enqueue ) {
			$plugin_css_url  = plugins_url( 'css/plugin.css', MKDO_GROUND_CONTROL_ROOT );
			$plugin_css_path = dirname( MKDO_GROUND_CONTROL_ROOT ) . '/css/plugin.css';
			wp_enqueue_style(
				MKDO_GROUND_CONTROL_PREFIX . '-plugin-css',
				$plugin_css_url,
				array(),
				filemtime( $plugin_css_path ),
				false
			);
		}

		/* JS */
		if ( $do_public_enqueue && $do_public_js_enqueue ) {
			$plugin_js_url   = plugins_url( 'js/plugin.js', MKDO_GROUND_CONTROL_ROOT );
			$plugin_js_path  = dirname( MKDO_GROUND_CONTROL_ROOT ) . '/js/plugin.js';
			wp_enqueue_script(
				MKDO_GROUND_CONTROL_PREFIX . '-plugin-js',
				$plugin_js_url,
				array( 'jquery' ),
				filemtime( $plugin_js_path ),
				true
			);
		}
	}

	/**
	 * Enqueue Admin Scripts.
	 *
	 * @since	0.1.0
	 */
	public function admin_enqueue_scripts() {

		$do_admin_enqueue            = apply_filters( MKDO_GROUND_CONTROL_PREFIX . 'do_admin_enqueue', true );
		$do_admin_css_enqueue        = apply_filters( MKDO_GROUND_CONTROL_PREFIX . 'do_admin_css_enqueue', true );
		$do_admin_editor_css_enqueue = apply_filters( MKDO_GROUND_CONTROL_PREFIX . 'do_admin_editor_css_enqueue', true );
		$do_admin_js_enqueue         = apply_filters( MKDO_GROUND_CONTROL_PREFIX . 'do_admin_js_enqueue', true );

		/* CSS */
		if ( $do_admin_enqueue && $do_admin_css_enqueue ) {
			$plugin_css_url  = plugins_url( 'css/plugin-admin.css', MKDO_GROUND_CONTROL_ROOT );
			$plugin_css_path = dirname( MKDO_GROUND_CONTROL_ROOT ) . '/css/plugin-admin.css';
			wp_enqueue_style(
				MKDO_GROUND_CONTROL_PREFIX . '-plugin-admin-css',
				$plugin_css_url,
				array(),
				filemtime( $plugin_css_path ),
				false
			);
		}

		/* Editor CSS */
		if ( $do_admin_enqueue && $do_admin_editor_css_enqueue ) {
			$editor_css_url  = plugins_url( 'css/plugin-admin-editor.css', MKDO_GROUND_CONTROL_ROOT );
			$editor_css_path = dirname( MKDO_GROUND_CONTROL_ROOT ) . '/css/plugin-admin-editor.css';
			add_editor_style( $editor_css_url . '?v=' . $editor_css_path );
		}

		/* JS */
		if ( $do_admin_enqueue && $do_admin_js_enqueue ) {
			$plugin_js_url   = plugins_url( 'js/plugin-admin.js', MKDO_GROUND_CONTROL_ROOT );
			$plugin_js_path  = dirname( MKDO_GROUND_CONTROL_ROOT ) . '/js/plugin-admin.js';
			wp_enqueue_script(
				MKDO_GROUND_CONTROL_PREFIX . '-plugin-admin-js',
				$plugin_js_url,
				array( 'jquery' ),
				filemtime( $plugin_js_path ),
				true
			);
		}
	}
}
