<?php
/**
 * Custom settings fields.
 * @link https://codex.wordpress.org/Modifying_Options_Pages
 * @package Art_Corpus
 */

/**
 * Class for adding a new field to the options-general.php page
 */
class Add_Settings_Field {

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'admin_init' , array( $this , 'register_fields' ) );
	}

	/**
	 * Add new fields to wp-admin/options-general.php page
	 */
	public function register_fields() {
		// BYCH page ID
		register_setting( 'general', 'artcorpus_bychpage', 'esc_attr' );
		add_settings_field(
			'artcorpus_bychpage_id',
			'<label for="artcorpus_bychpage_id">' . __( 'ID de la page "Avant de passer à la boutique"' , 'artcorpus_bychpage' ) . '</label>',
			array( $this, 'fields_html' ),
			'general'
		);
	}

	/**
	 * HTML for extra settings
	 */
	public function fields_html() {
		$value = get_option( 'artcorpus_bychpage', '' );
		echo '<input type="text" id="artcorpus_bychpage_id" name="artcorpus_bychpage" value="' . esc_attr( $value ) . '" />';
	}

}
new Add_Settings_Field();