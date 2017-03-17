<?php
/**
 * Class Post_News
 *
 * @package mkdo\global_food_security_core
 */

namespace mkdo\global_food_security_core;

/**
 * Register the News Post Type
 */
class Post_News {

	/**
	 * Constructor
	 */
	function __construct() {}

	/**
	 * Do Work
	 */
	public function run() {
		add_filter( 'gettext', array( $this, 'custom_enter_title' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Custom Enter Title
	 *
	 * @param  string $input The placeholder text.
	 * @return string        The altered placeholder text.
	 */
	public function custom_enter_title( $input ) {

		if ( is_admin() && 'Enter title here' === $input && 'news' === get_post_type( get_the_ID() ) ) {
			return __( 'Enter News Headline', 'global-food-security-core' );
		}

		return $input;
	}

	/**
	 * Register Post Type
	 */
	public function register_post_type() {

		$labels = array(
			'name'                  => _x( 'News', 'Post Type General Name', 'global-food-security-core' ),
			'singular_name'         => _x( 'News Item', 'Post Type Singular Name', 'global-food-security-core' ),
			'menu_name'             => __( 'News', 'global-food-security-core' ),
			'name_admin_bar'        => __( 'News', 'global-food-security-core' ),
			'archives'              => __( 'News Item Archives', 'global-food-security-core' ),
			'parent_item_colon'     => __( 'Parent News Item:', 'global-food-security-core' ),
			'all_items'             => __( 'All News', 'global-food-security-core' ),
			'add_new_item'          => __( 'Add New News', 'global-food-security-core' ),
			'add_new'               => __( 'Add New', 'global-food-security-core' ),
			'new_item'              => __( 'New News Item', 'global-food-security-core' ),
			'edit_item'             => __( 'Edit News Item', 'global-food-security-core' ),
			'update_item'           => __( 'Update News Item', 'global-food-security-core' ),
			'view_item'             => __( 'View News Item', 'global-food-security-core' ),
			'search_items'          => __( 'Search News Item', 'global-food-security-core' ),
			'not_found'             => __( 'Not found', 'global-food-security-core' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'global-food-security-core' ),
			'featured_image'        => __( 'Featured Image', 'global-food-security-core' ),
			'set_featured_image'    => __( 'Set featured image', 'global-food-security-core' ),
			'remove_featured_image' => __( 'Remove featured image', 'global-food-security-core' ),
			'use_featured_image'    => __( 'Use as featured image', 'global-food-security-core' ),
			'insert_into_item'      => __( 'Insert into News Item', 'global-food-security-core' ),
			'uploaded_to_this_item' => __( 'Uploaded to this News Item', 'global-food-security-core' ),
			'items_list'            => __( 'News list', 'global-food-security-core' ),
			'items_list_navigation' => __( 'News list navigation', 'global-food-security-core' ),
			'filter_items_list'     => __( 'Filter News list', 'global-food-security-core' ),
		);
		$args = array(
			'label'               => __( 'News Item', 'global-food-security-core' ),
			'description'         => __( 'Custom Post Type for News', 'global-food-security-core' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				// 'author',
				'thumbnail',
				'excerpt',
				// 'trackbacks',
				// 'custom-fields',
				// 'comments',
				// 'revisions',
				// 'page-attributes',
				// 'post-formats',
			),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-welcome-widgets-menus',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => false,
			'can_export'          => true,
			'has_archive'         => 'news',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array( 'slug' => _x( 'news', 'News URL', 'global-food-security-core' ) ),
		);

		register_post_type( 'news', $args );
	}
}
