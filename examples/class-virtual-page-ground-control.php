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
		add_filter( 'the_posts', array( $this, 'setup_virtual_post' ) );
	}

	/**
	 * Setup the Virtual Post data
	 *
	 * @param array $posts Posts.
	 */
	public function setup_virtual_post( $posts ) {
		global $wp_query;

		// If the post matches the name 'ground-control'.
		if (
			property_exists( $wp_query, 'query' ) &&
			isset( $wp_query->query['name'] ) &&
			'ground-control' === $wp_query->query['name']
		) {
			// We need to virtually create the page.
			$post_object = new \stdClass();
			$post_object->post_name    = $wp_query->query['name'];
			$post_object->post_title   = esc_html__( 'Virtual Page Example', 'ground-control' );
			$post_object->post_type    = 'page';
			$post_object->post_content = apply_filters( MKDO_GROUND_CONTROL_PREFIX . '_test_content', '' );
			$post_object->post_status  = 'publish';

			// Create the posts collection.
			$posts = array( $post_object );

			// Check if the post exists.
			$post_object_check = get_page_by_path( $post_object->post_name, OBJECT, $post_object->post_type );
			if ( is_object( $post_object_check ) ) {
				$posts = array( $post_object_check );
			}

			// We have hit our page, it is no longer a 404.
			status_header( 200 );
			$wp_query->is_404         = false;
			$wp_query->is_page        = true;
			$wp_query->is_singular    = true;
			$wp_query->is_single      = false;
			unset( $wp_query->query['error'] );
			$wp_query->query_vars['error'] = '';
		}

		return $posts;
	}
}
