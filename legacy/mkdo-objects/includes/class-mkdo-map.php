<?php
/**
 * The base plugin for maps
 *
 * @link       http://makedo.in
 * @since      1.0.0
 *
 * @package    MKDO_Objects
 * @subpackage MKDO_Objects/admin
 */

/** 
 * Load dependancies
 */
if( ! class_exists( 'MKDO_Class' ) )	require_once plugin_dir_path( __FILE__ ) . '../admin/class-mkdo-class.php';

/**
 * The base plugin for maps
 *
 * Defines the plugin instance name, and version.
 *
 * @package    MKDO_Objects
 * @subpackage MKDO_Objects/admin
 * @author     Make Do <hello@makedo.in>
 */
class MKDO_Map extends MKDO_Class {


	/**
	 * The arguments for the Map
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $args    The arguments for the Map.
	 */
	protected $args;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $instance   The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $instance, $version, $args = array() ) {

		parent::__construct( $instance, $version );

		$defaults 								= 	array(

													);

		$this->args 							= 	array_merge( $defaults, $args );
	}

	public function enqueue_scripts() {
		
		$do_enqueue = 	apply_filters(
						'mkdo_do_enqueue_map_css',
						TRUE
					);

		if( $do_enqueue ) {
			wp_enqueue_script( 'google_maps_api', 			'https://maps.googleapis.com/maps/api/js?v=3.exp', 						array( 'jquery' ), '1.0', 			TRUE );
			// wp_enqueue_script( 'mkdo-helper-text', 			plugin_dir_url( __FILE__ ) . 'js/mkdo-helper-text.js', 					array( 'jquery' ), $this->version, 	TRUE );
			// wp_enqueue_script( 'mkdo-helper-url', 			plugin_dir_url( __FILE__ ) . 'js/mkdo-helper-url.js', 					array( 'jquery' ), $this->version, 	TRUE );
			// wp_enqueue_script( 'mkdo-helper-location', 		plugin_dir_url( __FILE__ ) . 'js/mkdo-helper-location.js', 				array( 'jquery' ), $this->version, 	TRUE );
			// wp_enqueue_script( 'unserialize', 				plugin_dir_url( __FILE__ ) . 'js/vendor/unserialize.js',				array( 'jquery' ), $this->version, 	TRUE );
			// wp_enqueue_script( 'google-marker-clusterer', 	plugin_dir_url( __FILE__ ) . 'js/vendor/google/marker-clusterer.js', 	array( 'jquery' ), $this->version, 	TRUE );
			// wp_enqueue_script( 'mkdo-map-initialize', 		plugin_dir_url( __FILE__ ) . 'js/mkdo-map-initialize.js',				array( 'jquery' ), $this->version, 	TRUE );
		}
	}

	public function do_enqueue( $do_enqueue ) {

		// Example logic
		// if( $do_enqueue && $some_logic == TRUE ) {
		// 		return TRUE;
		// }
		// else {
		// 		return FALSE;
		// }

		return $do_enqueue;
	}

	public function render_map() {

	}
}