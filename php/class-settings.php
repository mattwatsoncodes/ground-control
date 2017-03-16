<?php
/**
 * Class Settings
 *
 * @since	0.1.0
 *
 * @package mkdo\ground_control
 */

namespace mkdo\ground_control;

/**
 * The main plugin settings page
 */
class Settings {

	/**
	 * Constructor.
	 *
	 * @since	0.1.0
	 */
	public function __construct() {}

	/**
	 * Do Work
	 *
	 * @since	0.1.0
	 */
	public function run() {
		add_action( 'admin_init', array( $this, 'init_settings_page' ) );
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_action( 'plugin_action_links_' . plugin_basename( MKDO_GROUND_CONTROL_ROOT ) , array( $this, 'add_setings_link' ) );
	}

	/**
	 * Initialise the Settings Page.
	 *
	 * @since	0.1.0
	 */
	public function init_settings_page() {

		// Register settings.
		register_setting( MKDO_GROUND_CONTROL_PREFIX . '_settings_group', MKDO_GROUND_CONTROL_PREFIX . '_example_setting' );

		// Add sections.
		add_settings_section( MKDO_GROUND_CONTROL_PREFIX . '_example_section',
			esc_html__( 'Example Section Heading', 'ground-control' ),
			array( $this, MKDO_GROUND_CONTROL_PREFIX . '_example_section_cb' ),
			MKDO_GROUND_CONTROL_PREFIX . '_settings'
		);

		// Add fields to a section.
		add_settings_field( MKDO_GROUND_CONTROL_PREFIX . '_example_field',
			esc_html__( 'Example Field Label:', 'ground-control' ),
			array( $this, MKDO_GROUND_CONTROL_PREFIX . '_example_field_cb' ),
			MKDO_GROUND_CONTROL_PREFIX . '_settings',
			MKDO_GROUND_CONTROL_PREFIX . '_example_section'
		);
	}

	/**
	 * Call back for the example section.
	 *
	 * @since	0.1.0
	 */
	public function mkdo_ground_control_example_section_cb() {
		echo '<p>' . esc_html( 'Example description for this section.', 'ground-control' ) . '</p>';
	}

	/**
	 * Call back for the example field.
	 *
	 * @since	0.1.0
	 */
	public function mkdo_ground_control_example_field_cb() {
		$example_option = get_option( MKDO_GROUND_CONTROL_PREFIX . '_example_option', 'Default text...' );
		?>

		<div class="field field-example">
			<p class="field-description">
				<?php esc_html_e( 'This is an example field.', 'ground-control' );?>
			</p>
			<ul class="field-input">
				<li>
					<label>
						<input type="text" name="<?php echo esc_attr( MKDO_GROUND_CONTROL_PREFIX . '_example_field' ); ?>" value="<?php echo esc_attr( $example_option ); ?>" />
					</label>
				</li>
			</ul>
		</div>

		<?php
	}

	/**
	 * Add the settings page.
	 *
	 * @since	0.1.0
	 */
	public function add_settings_page() {
		add_submenu_page( 'options-general.php',
			esc_html__( 'Ground Control', 'ground-control' ),
			esc_html__( 'Ground Control', 'ground-control' ),
			'manage_options',
			MKDO_GROUND_CONTROL_PREFIX,
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Render the settings page.
	 *
	 * @since	0.1.0
	 */
	public function render_settings_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Ground Control', 'ground-control' );?></h2>

			<form action="settings.php" method="POST">
				<?php settings_fields( MKDO_GROUND_CONTROL_PREFIX . '_settings_group' ); ?>
				<?php do_settings_sections( MKDO_GROUND_CONTROL_PREFIX . '_settings' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php
	}

	/**
	 * Add 'Settings' action on installed plugin list.
	 *
	 * @param array $links An array of plugin action links.
	 *
	 * @since	0.1.0
	 */
	function add_setings_link( $links ) {
		array_unshift( $links, '<a href="options-general.php?page=' . esc_attr( MKDO_GROUND_CONTROL_PREFIX ) . '">' . esc_html__( 'Settings', 'ground-control' ) . '</a>' );

		return $links;
	}
}
