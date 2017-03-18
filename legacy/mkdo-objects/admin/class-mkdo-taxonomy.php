<?php
/**
 * Base class for registering a taxonomy
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
 * Base class for registering a taxonomy
 *
 * Defines aTaxonomy
 *
 * @package    MKDO_Objects
 * @subpackage MKDO_Objects/admin
 * @author     Make Do <hello@makedo.in>
 */
class MKDO_Taxonomy extends MKDO_Class {

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
	 * The name of the taxonomy
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $taxonomy_name    The name of the taxonomy.
	 */
	protected $taxonomy_name;

	/**
	 * The slug of the taxonomy
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $slug    The slug of the taxonomy.
	 */
	protected $slug;

	/**
	 * The arguments for the taxonomy
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $args    The arguments for the taxonomy.
	 */
	protected $args;



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
														'name_singular' 		=> 'Taxonomy',
														'name_plural' 			=> 'Taxonomies',
														'taxonomy_name' 		=> 'taxonomy',
														'slug' 					=> 'taxonomy',
														'register_pages' 		=> array(),
														'taxonomy_args'			=> array(),
														'taxonomy_terms'		=> array(),
														'metabox_remove_pages'	=> array()
													);

		$this->args 							= 	array_merge( $defaults, $args );

		$this->name_singular 					= 	$this->args[ 'name_singular'		];
		$this->name_plural 						= 	$this->args[ 'name_plural'			];
		$this->taxonomy_name 					= 	$this->args[ 'taxonomy_name'		];
		$this->slug 							= 	$this->args[ 'slug'					];

		$taxonomy_args 							=	array(
														'label'				=> __( $this->name_plural),
														'labels' 			=> 	array(
																					'name' 				=> _x( $this->name_singular, 		'taxonomy general name' 			),
																					'singular_name' 	=> _x( $this->name_singular, 		'taxonomy singular name' 			),
																					'search_items' 		=> __( 'Search ' 					. $this->name_plural 				),
																					'all_items' 		=> __( 'All ' 						. $this->name_plural 				),
																					'parent_item'		=> __( 'Parent ' 					. $this->name_plural 				),
																					'parent_item_colon' => __( 'Parent ' 					. $this->name_plural 	. ':' 		),
																					'edit_item' 		=> __( 'Edit ' 						. $this->name_plural 				), 
																					'update_item' 		=> __( 'Update ' 					. $this->name_plural 				),
																					'add_new_item' 		=> __( 'Add New ' 					. $this->name_singular 				),
																					'new_item_name' 	=> __( 'New ' 						. $this->name_singular 	. ' Name' 	),
																					'menu_name' 		=> __( $this->name_plural 												),
																				),
														'show_in_nav_menus' => 	FALSE,
														'show_ui' 			=> 	TRUE,
														'hierarchical' 		=> 	TRUE,
														'sort' 				=> 	TRUE,
														'args' 				=> 	array(
																					'orderby' => 'term_order'
																				),
														'rewrite' 			=> 	array(
																					'slug' => $this->slug
																				),
														'show_admin_column' => 	TRUE,
													);

		$this->args['taxonomy_args'] 			= 	array_merge( $taxonomy_args, $this->args[ 'taxonomy_args'] );

	}

	/**
	 * Register the taxonomy.
	 *
	 * @since    1.0.0
	 */
	public function register_taxonomy() {
	
	 	$pages 	= 	apply_filters(
						$this->taxonomy_name  . '_pages_filter',
						$this->args['register_pages']
					);

	
		$args 	=	apply_filters(
						$this->taxonomy_name . '_filter',		
						$this->args['taxonomy_args']
					);
		
		register_taxonomy( $this->taxonomy_name, $pages, $args );
	}

	/**
	 * Populate the taxonomy.
	 *
	 * @since    1.0.0
	 */
	public function populate_taxonomy() {

		$terms = 	apply_filters(
						$this->taxonomy_name . '_terms_filter',
						$this->args['taxonomy_terms']
					);

		foreach( $terms as $term=>$properties ) {

			$parent_id		= 0;
			$slug 			= ( isset($properties['slug']) ) 			? $properties['slug'] 					: FALSE;
			$parent 		= ( isset($properties['parent']) ) 			? esc_attr($properties['parent']) 		: 0;
			$description 	= ( isset($properties['description']) ) 	? esc_attr($properties['description']) 	: FALSE;
			
			if( $parent !== 0 ) {

				$parent_object = get_term_by( 'name', $parent, $this->taxonomy_name  );
				
				if( is_object( $parent_object ) ) {
					$parent_id = $parent_object->term_id;
				}
			}
			
			if ( !term_exists( $term, $this->taxonomy_name  ) ) {

				wp_insert_term( 
					$term, 
					$this->taxonomy_name , 
					array( 
						'slug' => $slug,
						'parent' => $parent_id,
						'description'=> $description
					)
				);
			}
		}
	}

	/**
	 * Hide the taxonomy meta box
	 *
	 * @since    1.0.0
	 */
	public function remove_taxonomy_metabox() {

		$post_types = 	apply_filters( 
							$this->taxonomy_name . '_remove_pages_filter',
							$this->args['metabox_remove_pages']
						);

		foreach( $post_types as $post_type )
		{
			remove_meta_box( $this->taxonomy_name . 'div', $post_type, 'side' );
		}
	}
}