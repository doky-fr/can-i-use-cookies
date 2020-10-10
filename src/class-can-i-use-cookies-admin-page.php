<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Can_I_Use_Cookies_Admin_Pages {
	private $options;

	private static $page_name = 'can-i-use-cookies-settings';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	public function add_page() {
		add_options_page(
			'Consentement Cookies',
			'Consentement Cookies',
			'manage_options',
			self::$page_name,
			array( $this, 'create_admin_page' )
		);
	}

	public function create_admin_page() {
		// Refresh options
		$this->options = get_option( 'can-i-use-cookies' );
		?>
		<div class="wrap">
			<h1>Configuration du popup de consentement des cookies</h1>
			<form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields( 'can-i-use-cookies' );
				do_settings_sections( self::$page_name );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
		register_setting(
			'can-i-use-cookies',
			'can-i-use-cookies',
			array( $this, 'sanitize' )
		);

		/*
		 * Section: Texts
		 */

		add_settings_section(
			'can-i-use-cookies-texts-section',
			'Textes à afficher dans la popup de consentement',
			array( $this, 'print_section_info_texts' ),
			self::$page_name
		);

		add_settings_field(
			'title',
			'Titre',
			array( $this, 'title_callback' ),
			self::$page_name,
			'can-i-use-cookies-texts-section'
		);

		add_settings_field(
			'content',
			'Explication',
			array( $this, 'content_callback' ),
			self::$page_name,
			'can-i-use-cookies-texts-section'
		);

		add_settings_field(
			'yes_button',
			'Bouton "Accepter"',
			array( $this, 'yes_button_callback' ),
			self::$page_name,
			'can-i-use-cookies-texts-section'
		);

		add_settings_field(
			'no_button',
			'Bouton "Refuser"',
			array( $this, 'no_button_callback' ),
			self::$page_name,
			'can-i-use-cookies-texts-section'
		);

		/*
		 * Section: Image URL
		 */

		add_settings_section(
			'can-i-use-cookies-images-section',
			'URL de l\'image',
			array( $this, 'print_section_info_images' ),
			self::$page_name
		);

		add_settings_field(
			'image',
			'Image',
			array( $this, 'image_callback' ),
			self::$page_name,
			'can-i-use-cookies-images-section'
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 *
	 * @return array
	 */
	public function sanitize( $input ) {
		$new_input = array();

		if ( isset( $input['title'] ) ) {
			$new_input['title'] = esc_html( $input['title'] );
		}

		if ( isset( $input['content'] ) ) {
			$new_input['content'] = esc_html( $input['content'] );
		}

		if ( isset( $input['yes_button'] ) ) {
			$new_input['yes_button'] = esc_html( $input['yes_button'] );
		}

		if ( isset( $input['no_button'] ) ) {
			$new_input['no_button'] = esc_html( $input['no_button'] );
		}

		if ( isset( $input['image'] ) ) {
			$new_input['image'] = esc_url( $input['image'] );
		}

		return $new_input;
	}


	public function print_section_info_texts() {
		print 'Veuillez saisir les différents textes affichés dans la popup de consentement.';
	}

	public function print_section_info_images() {
		print 'Veuillez saisir l\'URL de l\'image affichée sur la gauche.';
	}

	public function title_callback() {
		printf(
			'<input type="text" name="can-i-use-cookies[title]" value="%s" />',
			isset( $this->options['title'] ) ? esc_attr( $this->options['title'] ) : ''
		);
	}

	public function content_callback() {
		printf(
			'<textarea name="can-i-use-cookies[content]" rows="5" cols="50">%s</textarea>',
			isset( $this->options['content'] ) ? esc_html( $this->options['content'] ) : ''
		);
	}

	public function yes_button_callback() {
		printf(
			'<input type="text" name="can-i-use-cookies[yes_button]" value="%s" />',
			isset( $this->options['yes_button'] ) ? esc_attr( $this->options['yes_button'] ) : ''
		);
	}

	public function no_button_callback() {
		printf(
			'<input type="text" name="can-i-use-cookies[no_button]" value="%s" />',
			isset( $this->options['no_button'] ) ? esc_attr( $this->options['no_button'] ) : ''
		);
	}

	public function image_callback() {
		printf(
			'<input type="text" name="can-i-use-cookies[image]" value="%s" />',
			isset( $this->options['image'] ) ? esc_url( $this->options['image'] ) : ''
		);
	}
}
