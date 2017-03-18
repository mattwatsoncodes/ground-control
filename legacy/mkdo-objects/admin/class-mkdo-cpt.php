<?php
/**
 * Base class for a custom post type.
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
if( ! class_exists( 'MKDO_Class' ) )	require_once plugin_dir_path( __FILE__ ) . '/class-mkdo-class.php';

/**
 * Base class for a custom post type.
 *
 * Common methods for creating a CPT
 *
 * @package    MKDO_Objects
 * @subpackage MKDO_Objects/admin
 * @author     Make Do <hello@makedo.in>
 */
class MKDO_CPT extends MKDO_Class {

	/**
	 * The icon that represents this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $dash_icon    The icon that represents this plugin.
	 */
	protected $dash_icon;

	/**
	 * The singular version of the plugin name
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $name_singular    The singular version of the plugin name.
	 */
	protected $name_singular;

	/**
	 * The plural version of the plugin name
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $name_plural    The plural version of the plugin name.
	 */
	protected $name_plural;

	/**
	 * The cpt name
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $cpt_name    The cpt name.
	 */
	protected $cpt_name;

	/**
	 * The arguments for the CPT
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $args    The arguments for the CPT.
	 */
	protected $args;

	/**
	 * The cpt slug
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $slug    The cpt slug.
	 */
	protected $slug;

	/**
	 * The custom title for the image metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $image_metabox_title    The custom title for the image metabox
	 */
	protected $image_metabox_title;

	/**
	 * The postion in the menu
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      int    $menu_postition    The postion in the menu
	 */
	protected $menu_postition;

	/**
	 * Place in the MKDO 'Content' menu
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      bool    $use_mkdo_menu    Place in the MKDO 'Content' menu
	 */
	protected $use_mkdo_menu;

	/**
	 * Show this in the admin menu
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      bool    $show_in_menu     Show this in the admin menu
	 */
	protected $show_in_menu;

	/**
	 * Show this in the custom menu dash
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      bool    $use_mkdo_custom_dash     Show this in the custom menu dash
	 */
	protected $use_mkdo_custom_dash;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $instance       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $instance, $version, $args = array() ) {
		
		parent::__construct( $instance, $version );

		$defaults 								= 	array(
														'cpt_name' 				=> $instance,
														'dash_icon' 			=> '',
														'name_singular' 		=> 'CPT',
														'name_plural' 			=> 'CPTs',
														'slug' 					=> sanitize_title( $this->cpt_name ),
														'image_metabox_title'	=> '',
														'menu_postition'		=> 20,
														'use_mkdo_menu'			=> TRUE,
														'post_type_args'		=> array(),
														'show_in_menu'			=> TRUE,
														'use_mkdo_custom_dash'	=> TRUE,
														'mkdo_custom_dash_args'	=> array(),
														'top_html'				=> '',
														'after_title_html'		=> ''
													);

		$this->args 							= 	array_merge( $defaults, $args );

		$this->cpt_name 						= 	$this->args[ 'cpt_name'				];
		$this->dash_icon 						= 	$this->args[ 'dash_icon'			];
		$this->name_singular 					= 	$this->args[ 'name_singular'		];
		$this->name_plural 						= 	$this->args[ 'name_plural'			];
		$this->slug 							= 	$this->args[ 'slug'					];
		$this->image_metabox_title 				= 	$this->args[ 'image_metabox_title'	];
		$this->menu_postition 					= 	$this->args[ 'menu_postition'		];
		$this->use_mkdo_menu 					= 	$this->args[ 'use_mkdo_menu'		];
		$this->show_in_menu 					= 	$this->args[ 'show_in_menu'			];
		$this->use_mkdo_custom_dash 			= 	$this->args[ 'use_mkdo_custom_dash'	];

		// Lets check whether our custom content menu has been created
		if( $this->show_in_menu && class_exists( 'MKDO_Admin' ) && $this->use_mkdo_menu ) {
			// Set this post type to show in the custom content menu
			$this->show_in_menu  				= 'mkdo_content_menu';
		}

		$post_type_args 						=	array(
														'description'			=> 	'',
														'public'				=> 	TRUE,
														'publicly_queryable'	=> 	TRUE,
														'show_in_nav_menus'		=> 	TRUE,
														'show_in_admin_bar'		=> 	TRUE,
														'exclude_from_search'	=> 	FALSE,
														'show_ui'				=> 	TRUE,
														'show_in_menu'			=> 	$this->show_in_menu ,
														'can_export'			=> 	TRUE,
														'delete_with_user'		=> 	FALSE,
														'hierarchical'			=> 	FALSE,
														'has_archive'			=> 	TRUE,
														'menu_icon'				=> 	$this->dash_icon,
														'query_var'				=> 	$this->cpt_name,
														'menu_position'			=> 	$this->menu_postition,

														'rewrite' 				=> 	array(
																						'slug' => $this->slug 
																					),

														'supports' 				=> 	array(
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
																						'post-formats'
																					),
													
														'label'					=> __( $this->name_plural, $this->instance  ),
														'labels' 				=> array(
																						'name'					=> __( $this->name_plural, 														$this->instance  ),
																						'singular_name'			=> __( $this->name_singular, 													$this->instance  ),
																						'menu_name'				=> __( $this->name_plural, 														$this->instance  ),
																						'name_admin_bar'		=> __( $this->name_plural, 														$this->instance  ),
																						'add_new'				=> __( 'Add New', 																$this->instance  ),
																						'add_new_item'			=> __( 'Add New ' 				. $this->name_singular, 						$this->instance  ),
																						'edit_item'				=> __( 'Edit ' 					. $this->name_singular, 						$this->instance  ),
																						'new_item'				=> __( 'New ' 					. $this->name_singular, 						$this->instance  ),
																						'view_item'				=> __( 'View ' 					. $this->name_singular, 						$this->instance  ),
																						'search_items'			=> __( 'Search '				. $this->name_plural, 							$this->instance  ),
																						'not_found'				=> __( 'No ' 					. $this->name_plural 	. 	' found', 			$this->instance  ),
																						'not_found_in_trash'	=> __( 'No ' 					. $this->name_plural 	. 	' found in trash', 	$this->instance  ),
																					)
													);
		
		$this->args['post_type_args'] 			= 	array_merge( $post_type_args, $this->args[ 'post_type_args'] );
	
		$mkdo_custom_dash_args 					=	array(
														'title' 				=> $this->name_plural,
														'dashicon' 				=> $this->dash_icon,
														'desc' 					=> '<p>This content type is for managing ' . $this->name_plural . '.</p>',
														'post_type' 			=> $this->cpt_name,
														'button_label' 			=> 'Edit / Manage ' . $this->name_plural,
														'css_class' 			=> $this->cpt_name,
														'show_tax' 				=> true,
														'link' 					=> admin_url( 'edit.php?post_type=' . $this->cpt_name ),
														'call_to_action_text'	=> 'Add New',
														'call_to_action_link' 	=> admin_url( 'post-new.php?post_type=' . $this->cpt_name )
													);

		$this->args['mkdo_custom_dash_args'] 	= 	array_merge( $mkdo_custom_dash_args, $this->args[ 'mkdo_custom_dash_args'] );
	}

	/**
	 * Change the name of the featured image meta box so it is more relevent to the plugin
	 *
	 * @since    1.0.0
	 */
	public function set_featured_image_metabox_title() {
	
		remove_meta_box( 'postimagediv', $this->cpt_name, 'side' );

		if( empty( $this->image_metabox_title ) )
		{
			add_meta_box('postimagediv', __( $this->name_singular . ' Image' ), 'post_thumbnail_meta_box', $this->cpt_name, 'side', 'default');
		}
		else
		{
			add_meta_box('postimagediv', __( $this->image_metabox_title ), 'post_thumbnail_meta_box', $this->cpt_name, 'side', 'default');
		}
	}

	/**
	 * Register the CPT
	 *
	 * @since    1.0.0
	 */
	public function register_post_type() {

		// Set up the arguments for the portfolio item post type
		$args = apply_filters( 
			'mkdo_' . $this->cpt_name . '_post_type_filter',
			$this->args['post_type_args']
		);
		
		/* register the post type */
		register_post_type( $this->cpt_name, $args );
	}

	/**
	 * Add the plugin to the homepage content block
	 *
	 * @since    1.0.0
	 * @param 	array 	$blocks 	The current array of admin content blocks
	 * @return 	array 	$blocks 	The new modified array of admin content blocks
	 */
	public function add_content_block( $blocks ) {
	
		if( $this->use_mkdo_custom_dash )
		{
			/* add our content block array */
			$blocks[] = apply_filters( 
							'mkdo_' . $this->cpt_name . '_custom_dash_filter',
							$this->args['mkdo_custom_dash_args']
						);
		}
		
		/* return the modified array */
		return $blocks;
	}

	/**
	 * Add the metaboxes from other plugins to this plugin
	 *
	 * @since    	1.0.0
	 * @param 		array 	$pages 		The current array of pages that are registerd
	 * @return 		array 	$pages 		The new modified array of pages
	 */
	public function post_type_filter( $pages ) {

		$pages[] = $this->cpt_name;

		return $pages;
	}

	/**
	 * Insert text
	 *
	 * @since    	1.0.0
	 */
	public function insert_top() {
		
		global $post, $wp_meta_boxes;

		$html = apply_filters( 
					'mkdo_' . $this->cpt_name . '_top_filter',
					$this->args['top_html']
				);

		if( !empty( $html ) )
		{
			$screen = get_current_screen();
		
			if( $screen->id == $this->cpt_name ) {
				echo $html;
			}
		}
	}

	/**
	 * Insert text
	 *
	 * @since    	1.0.0
	 */
	public function insert_after_title() {
		
		global $post, $wp_meta_boxes;

		$html = apply_filters( 
					'mkdo_' . $this->cpt_name . '_after_title_filter',
					$this->args['after_title_html']
				);

		if( !empty( $html ) )
		{
			$screen = get_current_screen();
		
			if( $screen->id == $this->cpt_name ) {
				echo $html;
			}
		}
		
	}

	/**
	 * Move advanced metaboxes above the editor
	 *
	 * @since    	1.0.0
	 */
	public function move_advanced_metaboxes_above_editor() {
		
		global $post, $wp_meta_boxes;

		$screen = get_current_screen();
		
		if( $screen->id == $this->cpt_name )
		{
			echo '<br/>';
			do_meta_boxes( get_current_screen(), 'advanced', $post );
			unset( $wp_meta_boxes[get_post_type($post)]['advanced'] );
		}
	}
}
