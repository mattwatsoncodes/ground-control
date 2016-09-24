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
	public function __construct() {
	}

	/**
	 * Do Work
	 *
	 * @since	0.1.0
	 */
	public function run() {
		add_action( 'admin_init', array( $this, 'init_options_page' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'plugin_action_links_' . plugin_basename( DTG_PLUGIN_NAME_ROOT ) , array( $this, 'add_setings_link' ) );
	}

	/**
	 * Initialise the Options Page.
	 *
	 * @since	0.1.0
	 */
	public function init_options_page() {

		// Register settings.
		register_setting( 'dtg_plugin_name_settings_group', 'dtg_plugin_name_example_setting' );

		// Add sections.
		add_settings_section( 'dtg_plugin_name_example_section', esc_html__( 'Example Section Heading', DTG_PLUGIN_NAME_TEXT_DOMAIN ), array( $this, 'dtg_plugin_name_example_section_cb' ), 'dtg_plugin_name_settings' );

		// Add fields to a section.
		add_settings_field( 'dtg_plugin_name_example_field', esc_html__( 'Example Field Label:', DTG_PLUGIN_NAME_TEXT_DOMAIN ), array( $this, 'dtg_plugin_name_example_field_cb' ), 'dtg_plugin_name_settings', 'dtg_plugin_name_example_section' );
	}

	/**
	 * Call back for the example section.
	 *
	 * @since	0.1.0
	 */
	public function dtg_plugin_name_example_section_cb() {
		echo '<p>' . esc_html( 'Example description for this section.', DTG_PLUGIN_NAME_TEXT_DOMAIN ) . '</p>';
	}

	/**
	 * Call back for the example field.
	 *
	 * @since	0.1.0
	 */
	public function dtg_plugin_name_example_field_cb() {
		$dtg_plugin_name_example_option = get_option( 'dtg_plugin_name_example_option', 'Default text...' );
		?>

		<div class="field field-example">
			<p class="field-description">
				<?php esc_html_e( 'This is an example field.', DTG_PLUGIN_NAME_TEXT_DOMAIN );?>
			</p>
			<ul class="field-input">
				<li>
					<label>
						<input type="text" name="dtg_plugin_name_example_field" value="<?php echo esc_attr( $dtg_plugin_name_example_option ); ?>" />
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
		// For WordPress this is options-general.php,
		// for WooCommerce it is edit.php?post_type=shop_order.
		add_submenu_page( 'options-general.php', esc_html__( 'Example Settings', DTG_PLUGIN_NAME_TEXT_DOMAIN ), esc_html__( 'Plugin Name', DTG_PLUGIN_NAME_TEXT_DOMAIN ), 'manage_options', 'plugin_name', array( $this, 'render_options_page' ) );
	}

	/**
	 * Render the options page.
	 *
	 * @since	0.1.0
	 */
	public function render_options_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Plugin Name', DTG_PLUGIN_NAME_TEXT_DOMAIN );?></h2>

			<form action="options.php" method="POST">
				<?php settings_fields( 'dtg_plugin_name_settings_group' ); ?>
				<?php do_settings_sections( 'dtg_plugin_name_settings' ); ?>
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
		array_unshift( $links, '<a href="options-general.php?page=plugin_name">' . esc_html__( 'Settings', DTG_PLUGIN_NAME_TEXT_DOMAIN ) . '</a>' );

		return $links;
	}
}
