<?php
namespace dtg\plugin_name;

/**
 * Class Assets_Controller
 *
 * Sets up the public and admin area JS and CSS needed for this plugin.
 *
 * @since	0.1.0
 *
 * @package dtg\plugin_name
 */
class Assets_Controller {

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
		add_action( 'admin_enqueue_scripts', array( $this, 'public_enqueue_scripts' ), 10 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10 );
	}

	/**
	 * Enqueue Public Scripts.
	 *
	 * @since	0.1.0
	 */
	public function public_enqueue_scripts() {

		$public_css_url  = plugins_url( 'css/public.css', $this->plugin_root );
		$public_css_path = dirname( $this->plugin_root ) . '/css/public.css';

		wp_enqueue_style(
			$this->plugin_textdomain . '-public-css',
			$public_css_url,
			array(),
			filemtime( $public_css_path ),
			true
		);

		$public_js_url   = plugins_url( 'js/public.js', $this->plugin_root );
		$public_js_path  = dirname( $this->plugin_root ) . '/js/public.js';

		wp_enqueue_script(
			$this->plugin_textdomain . '-public-js',
			$public_js_url,
			array( 'jquery' ),
			filemtime( $public_js_path ),
			true
		);
	}

	/**
	 * Enqueue Admin Scripts.
	 *
	 * @since	0.1.0
	 */
	public function admin_enqueue_scripts() {

		$admin_css_url  = plugins_url( 'css/admin.css', $this->plugin_root );
		$admin_css_path = dirname( $this->plugin_root ) . '/css/admin.css';

		wp_enqueue_style(
			$this->plugin_textdomain . '-public-css',
			$admin_css_url,
			array(),
			filemtime( $admin_css_path ),
			true
		);

		$admin_js_url   = plugins_url( 'js/admin.js', $this->plugin_root );
		$admin_js_path  = dirname( $this->plugin_root ) . '/js/admin.js';

		wp_enqueue_script(
			$this->plugin_textdomain . '-public-js',
			$admin_js_url,
			array( 'jquery' ),
			filemtime( $admin_js_path ),
			true
		);
	}
}
