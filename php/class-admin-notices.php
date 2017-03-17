<?php
/**
 * Class Admin_Notices
 *
 * @package mkdo\document_management
 */

namespace mkdo\document_management;

/**
 * Notifies the user if the admin needs attention
 */
class Admin_Notices {

	/**
	 * Constructor
	 */
	function __construct() {
	}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Do Admin Notifications
	 */
	public function admin_notices() {

		if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
			$url     = admin_url( '/wp-admin/plugin-install.php?s=Shortcode%20UI&tab=search&type=term' );
			$warning = sprintf( __( 'The %1$sDocument Management%2$s plugin works much better when you %3$sinstall and activate the Shortcode UI plugin%4$s.', 'document-management' ), '<strong>', '</strong>', '<a href="' . $url . '" target="_blank">', '</a>' );
			?>
			<div class="notice notice-warning is-dismissible">
			<p>
			<?php
				echo wp_kses(
					$warning,
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
						'strong'   => array(),
						'em' => array(),
					)
				);
			?>
			</p>
			</div>
			<?php
		}
	}
}
