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
			array( $this, 'artcorpus_bychpage_callback' ),
			'general'
		);

		// Guests page ID
		register_setting( 'general', 'artcorpus_guestspage', 'esc_attr' );
		add_settings_field(
			'artcorpus_guestspage_id',
			'<label for="artcorpus_guestspage_id">' . __( 'ID de la page "Guests"' , 'artcorpus_guestspage' ) . '</label>',
			array( $this, 'artcorpus_guestspage_callback' ),
			'general'
		);

		// Google Maps API Key
		register_setting( 'general', 'artcorpus_googleapikey', 'esc_attr' );
		add_settings_field(
			'artcorpus_googleapikey_id',
			'<label for="artcorpus_googleapikey_id">' . __( 'Clé d\'API Google Maps' , 'artcorpus_googleapikey' ) . '</label>',
			array( $this, 'artcorpus_googleapikey_callback' ),
			'general'
		);

		// Shop postal address
		register_setting( 'general', 'artcorpus_postaladdress', 'esc_attr' );
		add_settings_field(
			'artcorpus_postaladdress_id',
			'<label for="artcorpus_postaladdress_id">' . __( 'Adresse de la boutique' , 'artcorpus_postaladdress' ) . '</label>',
			array( $this, 'artcorpus_postaladdress_callback' ),
			'general'
		);

	}

	/**
	 * HTML for extra settings
	 * #TODO: must be a better way!
	 */
	public function artcorpus_bychpage_callback() {
		$value = get_option( 'artcorpus_bychpage', '' );
		echo '<input type="text" id="artcorpus_bychpage_id" name="artcorpus_bychpage" value="' . esc_attr( $value ) . '" />';
	}

	public function artcorpus_guestspage_callback() {
		$value = get_option( 'artcorpus_guestspage', '' );
		echo '<input type="text" id="artcorpus_guestspage_id" name="artcorpus_guestspage" value="' . esc_attr( $value ) . '" />';
	}

	public function artcorpus_googleapikey_callback() {
		$value = get_option( 'artcorpus_googleapikey', '' );
		echo '<input type="text" id="artcorpus_googleapikey_id" name="artcorpus_googleapikey" value="' . esc_attr( $value ) . '" />';
	}

	public function artcorpus_postaladdress_callback() {
		$value = get_option( 'artcorpus_postaladdress', '' );
		echo '<input type="text" id="artcorpus_postaladdress_id" name="artcorpus_postaladdress" value="' . esc_attr( $value ) . '" />';
	}

}
new Add_Settings_Field();