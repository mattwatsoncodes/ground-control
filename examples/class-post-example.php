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
	 * The Post Type.
	 *
	 * @var 	string
	 * @access	private
	 * @since	0.1.0
	 */
	private $post_type;

	/**
	 * Constructor
	 */
	function __construct() {
		$this->post_type = 'example';
	}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_filter( 'gettext', array( $this, 'title_placeholder' ) );
		add_action( 'post_type_link', array( $this, 'post_type_link' ), 1, 3 );
		add_filter( 'get_the_archive_title', array( $this, 'get_the_archive_title' ), 10, 1 );
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
			'add_new_item'          => __( 'Add New Example', 'ground-control' ),
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

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Title Placeholder
	 *
	 * @param  string $input The placeholder text.
	 * @return string        The altered placeholder text.
	 */
	public function title_placeholder( $input ) {

		if ( is_admin() && 'Enter title here' === $input && $this->post_type === get_post_type( get_the_ID() ) ) {
			return __( 'Enter Example Title', 'ground-control' );
		}

		return $input;
	}

	/**
	 * Transform Post Type Link
	 *
	 * @param  string $link The original link.
	 * @param  object $post The post object.
	 * @return string       The transformed link
	 */
	public function post_type_link( $link, $post ) {

		// Example
		//
		// Alter the permalink of the post type by changing the URL dynamically.
		//
		// This example replaces the link with a link to the post type archive
		// with an anchor to the post on the post type archive.
		if ( $this->post_type === $post->post_type ) {
			$archive_link = get_post_type_archive_link( $post->post_type );
			return $archive_link . '#post-' . $post->ID;
		}
		return $link;
	}

	/**
	 * Filter the Archive Title
	 *
	 * Will work with any archive title, it just needs filtering right.
	 * See https://developer.wordpress.org/reference/functions/get_the_archive_title/.
	 *
	 * @param  string $title The original title.
	 * @return string        The transformed title
	 */
	public function get_the_archive_title( $title ) {

	    if ( is_post_type_archive( $this->post_type ) ) {
			$title_prefix = esc_html__( 'My Example Prefix', 'ground-control' );
	        $title        = sprintf( __( '%1$s: %2$s' ), $title_prefix, post_type_archive_title( '', false ) );
	    }

		return $title;
	}
}
