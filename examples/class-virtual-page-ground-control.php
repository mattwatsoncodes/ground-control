<?php
/**
 * Class Virtual_Page_Ground_Control
 *
 * @package mkdo\ground_control
 */

namespace mkdo\ground_control;

/**
 * Creates a virtual page if the page slug dosnt exist
 */
class Virtual_Page_Ground_Control {

	/**
	 * Constructor
	 */
	function __construct() {}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'wp', array( $this, 'setup_virtual_post' ) );
	}

	/**
	 * Setup the Virtual Post data
	 */
	public function setup_virtual_post() {
		if ( is_404() ) {
			wp_die();
		}
	}
}
