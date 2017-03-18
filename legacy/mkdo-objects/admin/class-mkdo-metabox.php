<?php
/**
 * Base class for registering a metabox
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
 * Base class for registering a metabox
 *
 * Common methods for creating a metabox
 *
 * @package    MKDO_Objects
 * @subpackage MKDO_Objects/admin
 * @author     Make Do <hello@makedo.in>
 */
class MKDO_Metabox extends MKDO_Class {

	/**
	 * The name of the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $name    The name of the metabox.
	 */
	protected $name;

	/**
	 * The name of the taxonomy
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $metabox_id    The metabox_id of the metabox.
	 */
	protected $metabox_id;

	/**
	 * The key prefix for all the fields
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $key_prefix    The key prefix for all the fields.
	 */
	protected $key_prefix;

	/**
	 * The id prefix for the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $id_prefix    The id prefix for all the metabox.
	 */
	protected $id_prefix;

	/**
	 * The id for the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $id    The id for the metabox.
	 */
	protected $id;

	/**
	 * The context for the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $context    The context for the metabox
	 */
	protected $context;

	/**
	 * The part of the page where the boxes should sit
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $priority    The part of the page where the boxes should sit
	 */
	protected $priority;

	/**
	 * The arguments for the Metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $args    The arguments for the Metabox.
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
														'id' 					=> '',
														'id_prefix' 			=> 'mkdo_metabox_',
														'name' 					=> 'Metabox',
														'context' 				=> 'normal',
														'priority'				=> 'high',
														'metabox_id' 			=> '',
														'key_prefix' 			=> '',
														'metabox_args'			=> array()
													);

		$this->args 							= 	array_merge( $defaults, $args );

		$this->id 								= 	$this->args[ 'id'			];
		$this->id_prefix						= 	$this->args[ 'id_prefix'	];
		$this->name 							= 	$this->args[ 'name'			];
		$this->context 							= 	$this->args[ 'context'		];
		$this->priority 						=	$this->args[ 'priority'		];

		if( empty( $this->args['metabox_id'] ) )
		{
			$this->args['metabox_id'] 			=	$this->id_prefix . 'metabox_' . $this->id;
		}

		if( empty( $this->args['key_prefix'] ) )
		{
			$this->args['key_prefix'] 			=	'_' . $this->id_prefix;
		}

		$this->metabox_id						=	$this->args['metabox_id'];
		$this->key_prefix						=	$this->args['key_prefix'];
		
		$metabox_args							=	array(
														'id' 				=> 	$this->metabox_id,
														'title' 			=> 	$this->name,
														'pages' 			=> 	array(),
														'context' 			=> 	$this->context,
														'priority' 			=> 	$this->priority,
														'show_on'			=>	array(),
														'hide_on'			=>	array(),
														'fields' 			=> 	array()
													);

		$this->args['metabox_args'] 			= 	array_merge( $metabox_args, $this->args[ 'metabox_args'] );
	}

	/**
	 * Creates the custom meta boxes for the associated post edit screens.
	 *
	 * @param 	array 	$meta_boxes 	The existing metaboxes array
	 * @return	array 	$meta_boxes 	The modified metaboxes array
	 */
	function register_metabox( $meta_boxes ) {
		
		$this->args['metabox_args']['pages'] 	= 	apply_filters(
														$this->metabox_id . '_pages_filter',
														$this->args['metabox_args']['pages']
													);

		/* create meta box for chain contact */
		$meta_boxes[] 							= 	apply_filters(
														$this->metabox_id . '_metabox_filter',
														$this->args['metabox_args']
													);
		
		return $meta_boxes;
	}

	/**
	 * Remove the meta box
	 *
	 * @since    1.0.0
	 */
	public function remove_metabox() {

		$post_types = 	apply_filters( 
							$this->metabox_id . '_remove_pages_filter',
							array()
						);

		foreach( $post_types as $post_type )
		{
			remove_meta_box( $this->metabox_id, $post_type, $this->context );
		}
	}
}