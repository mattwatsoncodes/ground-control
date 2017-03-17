<?php
/**
 * Class Post_Example
 *
 * @package mkdo\ground_control
 */

namespace mkdo\ground_control;

/**
 * Register the Example Post Type
 */
class Post_Example {

	/**
	 * Constructor
	 */
	function __construct() {}

	/**
	 * Do Work
	 */
	public function run() {
		add_filter( 'gettext', array( $this, 'custom_title_placeholder' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Custom Title Placeholder
	 *
	 * @param  string $input The placeholder text.
	 * @return string        The altered placeholder text.
	 */
	public function custom_title_placeholder( $input ) {

		if ( is_admin() && 'Enter title here' === $input && 'news' === get_post_type( get_the_ID() ) ) {
			return __( 'Enter Example Title', 'ground-control' );
		}

		return $input;
	}

	/**
	 * Register Post Type
	 */
	public function register_post_type() {

		$labels = array(
			'name'                  => _x( 'Examples', 'Post Type General Name', 'ground-control' ),
			'singular_name'         => _x( 'Example', 'Post Type Singular Name', 'ground-control' ),
			'menu_name'             => __( 'Examples', 'ground-control' ),
			'name_admin_bar'        => __( 'Examples', 'ground-control' ),
			'archives'              => __( 'Example Archives', 'ground-control' ),
			'parent_item_colon'     => __( 'Parent Example:', 'ground-control' ),
			'all_items'             => __( 'All Examples', 'ground-control' ),
			'add_new_item'          => __( 'Add New Examples', 'ground-control' ),
			'add_new'               => __( 'Add New', 'ground-control' ),
			'new_item'              => __( 'New Example', 'ground-control' ),
			'edit_item'             => __( 'Edit Example', 'ground-control' ),
			'update_item'           => __( 'Update Example', 'ground-control' ),
			'view_item'             => __( 'View Example', 'ground-control' ),
			'search_items'          => __( 'Search Example', 'ground-control' ),
			'not_found'             => __( 'Not found', 'ground-control' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ground-control' ),
			'featured_image'        => __( 'Featured Image', 'ground-control' ),
			'set_featured_image'    => __( 'Set featured image', 'ground-control' ),
			'remove_featured_image' => __( 'Remove featured image', 'ground-control' ),
			'use_featured_image'    => __( 'Use as featured image', 'ground-control' ),
			'insert_into_item'      => __( 'Insert into Example', 'ground-control' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Example', 'ground-control' ),
			'items_list'            => __( 'Examples list', 'ground-control' ),
			'items_list_navigation' => __( 'Examples list navigation', 'ground-control' ),
			'filter_items_list'     => __( 'Filter Examples list', 'ground-control' ),
		);
		$args = array(
			'label'               => __( 'Example', 'ground-control' ),
			'description'         => __( 'Custom Post Type for Examples', 'ground-control' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'page-attributes',
				'post-formats',
			),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-admin-post',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => false,
			'can_export'          => true,
			'has_archive'         => 'examples',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array( 'slug' => _x( 'example', 'Examples URL', 'ground-control' ) ),
		);

		register_post_type( 'example', $args );
	}
}
