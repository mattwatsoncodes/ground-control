<?php

namespace dtg\plugin_name;

/**
 * Class Options
 * @package dtg\plugin_name
 */
class Options {

	/**
	 * Constructor.
	 *
	 * @since	0.1.0
	 */
	public function __construct( $plugin_root, $plugin_textdomain, $plugin_prefix ) {
		$this->plugin_root 		 = $plugin_root;
		$this->plugin_textdomain = $plugin_textdomain;
		$this->plugin_prefix     = $plugin_prefix;
	}

	/**
	 * Do Work
	 *
	 * @since	0.1.0
	 */
	public function run() {
		add_action( 'admin_init', array( $this, 'init_options_page' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'plugin_action_links_' . plugin_basename( $this->plugin_root ) , array( $this, 'add_setings_link' ) );
	}

	/**
	 * Initialise the Options Page.
	 *
	 * @since	0.1.0
	 */
	public function init_options_page() {

		// Register settings.
		register_setting( $this->plugin_prefix . '_settings_group', $this->plugin_prefix . '_example_setting' );

		// Add sections.
		add_settings_section( $this->plugin_prefix . '_example_section', esc_html__( 'Example Section Heading', $this->plugin_textdomain ), array( $this, $this->plugin_prefix . '_example_section_cb' ), $this->plugin_prefix . '_settings' );

		// Add fields to a section.
		add_settings_field( $this->plugin_prefix . '_example_field', esc_html__( 'Example Field Label:', $this->plugin_textdomain ), array( $this, $this->plugin_prefix . '_example_field_cb' ), $this->plugin_prefix . '_settings', $this->plugin_prefix . '_example_section' );
	}

	/**
	 * Call back for the example section.
	 *
	 * @since	0.1.0
	 */
	public function plugin_name_example_section_cb() {
		echo '<p>' . esc_html( 'Example description for this section.', $this->plugin_textdomain ) . '</p>';
	}

	/**
	 * Call back for the example field.
	 *
	 * @since	0.1.0
	 */
	public function plugin_name_example_field_cb() {
		$example_option = get_option( $this->plugin_prefix . '_example_option', 'Default text...' );
		?>

		<div class="field field-example">
			<p class="field-description">
				<?php esc_html_e( 'This is an example field.', $this->plugin_textdomain );?>
			</p>
			<ul class="field-input">
				<li>
					<label>
						<input type="text" name="<?php echo esc_attr( $this->plugin_prefix . '_example_field' ); ?>" value="<?php echo esc_attr( $example_option ); ?>" />
					</label>
				</li>
			</ul>
		</div>
		<?php
	}

	/**
	 * Add the options page.
	 *
	 * @since	0.1.0
	 */
	public function add_options_page() {
		// For WordPress this is options-general.php.
		// For WooCommerce it is edit.php?post_type=shop_order.
		add_submenu_page( 'options-general.php',
			esc_html__( 'Example Settings', $this->plugin_textdomain ),
			esc_html__( 'Plugin Name', $this->plugin_textdomain ),
			'manage_options',
			$this->plugin_prefix,
			array( $this, 'render_options_page' )
		);
	}

	/**
	 * Render the options page.
	 *
	 * @since	0.1.0
	 */
	public function render_options_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Plugin Name', $this->plugin_textdomain );?></h2>

			<form action="options.php" method="POST">
				<?php settings_fields( $this->plugin_prefix . '_settings_group' ); ?>
				<?php do_settings_sections( $this->plugin_prefix . '_settings' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php
	}

	/**
	 * Add 'Settings' action on installed plugin list.
	 *
	 * @param array $links An array of links.
	 *
	 * @since	0.1.0
	 */
	function add_setings_link( $links ) {
		array_unshift( $links, '<a href="options-general.php?page=plugin_name">' . esc_html__( 'Settings', $this->plugin_textdomain ) . '</a>' );

		return $links;
	}
}
