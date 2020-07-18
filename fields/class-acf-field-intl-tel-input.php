<?php

// Exit if accessed directly.
if( ! defined( 'ABSPATH' ) ) exit;


// Check if class already exists.
if( !class_exists('acf_field_intl_tel_input') ) :


class acf_field_intl_tel_input extends acf_field {


	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct( $settings ) {
		
		// Name.
		$this->name = 'intl_tel_input';
		
		// Label.
		$this->label = __('International Telephone Input', 'acf-intl-tel-input');
		
		// Category.
		$this->category = 'jquery';
		
		// Field settings.
		$this->defaults = [
			'allowDropdown' => true,
			'excludeCountries' => '',
			'initialCountry' => 'auto',
			'onlyCountries' => '',
			'placeholderNumberType' => 'MOBILE',
			'preferredCountries' => '',
			'separateDialCode' => false,
		];

		// Plugin settings.
		$this->settings = $settings;

		// Parent constructor.
		parent::__construct();
		
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {

		// Country format link.
		$countryCodeLink = '<a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2">ISO 3166-1 alpha-2</a>';

		// Separate dial code.
		acf_render_field_setting( $field, [
			'label'			=> __( 'Separate dial code', 'acf-intl-tel-input'),
			'instructions'	=> '',
			'type'			=> 'true_false',
			'name'			=> 'separateDialCode',
			'ui'			  => 1
		]);

		// Allow drop down.
		acf_render_field_setting( $field, [
			'label'			=> __( 'Allow drop down', 'acf-intl-tel-input'),
			'instructions'	=> '',
			'type'			=> 'true_false',
			'name'			=> 'allowDropdown',
			'ui'			=> 1
		]);

		// Initial country.
		acf_render_field_setting( $field, [
			'label'			=> __( 'Initial country', 'acf-intl-tel-input' ),
			'instructions'	=> sprintf( __('Comma separated list of country codes (%s)', 'acf-intl-tel-input' ), $countryCodeLink ),
			'type'			=> 'text',
			'name'			=> 'initialCountry',
		]);

		// Exclude countries.
		acf_render_field_setting( $field, [
			'label'			=> __( 'Exclude countries', 'acf-intl-tel-input' ),
			'instructions'	=> sprintf( __('Comma separated list of country codes (%s)', 'acf-intl-tel-input' ), $countryCodeLink ),
			'type'			=> 'textarea',
			'name'			=> 'excludeCountries',
			'rows'			=> 2
		]);

		// Only countries.
		acf_render_field_setting( $field, [
			'label'			=> __( 'Only countries', 'acf-intl-tel-input' ),
			'instructions'	=> sprintf( __('Comma separated list of country codes (%s)', 'acf-intl-tel-input' ), $countryCodeLink ),
			'type'			=> 'textarea',
			'name'			=> 'onlyCountries',
			'rows'			=> 2
		]);

		// Preferred countries.
		acf_render_field_setting( $field, [
			'label'			=> __( 'Preferred countries', 'acf-intl-tel-input' ),
			'instructions'	=> sprintf( __('Comma separated list of country codes (%s)', 'acf-intl-tel-input' ), $countryCodeLink ),
			'type'			=> 'textarea',
			'name'			=> 'preferredCountries',
			'rows'			=> 2
		]);

		// Placeholder number type
		acf_render_field_setting( $field, [
			'label'			=> __( 'Placeholder number type', 'acf-intl-tel-input' ),
			'instructions'	=> '',
			'type'			=> 'select',
			'name'			=> 'placeholderNumberType',
			'choices'	   => [
				"MOBILE"	 => __( 'Mobile', 'acf-intl-tel-input' ),
				"FIXED_LINE" => __( 'Fixed line', 'acf-intl-tel-input' ),
			]
		]);

	}
	

	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {

		// Set hidden input attribute.
		$attr[] = 'data-hiddenInput="' . esc_attr($field['key']) . '"';

		// Parse settings.
		foreach( $this->defaults as $key => $value ){
			$value = $field[$key];

			// Format country lists.
			switch( $key ) {
				case 'preferredCountries':
				case 'excludeCountries':
				case 'onlyCountries':
					$value = str_replace(' ', '', $value );
					break;
			}

			// Append attribute.
			$attr[] = 'data-' . $key .'="' . $value . '"';
		}

		// Join attributes.
		$attr = implode( ' ', $attr );

?>
<input type="tel" value="<?php echo esc_attr($field['value']['phone']) ?>" <?php echo $attr; ?> <?php echo $field['required'] ? 'required="required"' : ''; ?>>
<input type="hidden" name="<?php echo esc_attr($field['name']) ?>" value="<?php echo esc_attr($field['value']) ?>">
<?php

	}
	
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function input_admin_enqueue_scripts() {
		
		// Get plugin settings.
		$url = $this->settings['url'];
		$version = $this->settings['version'];
		$intlTelInputVersion = '17.0.0';
		$jsCookieVersion = '2.2.1';

		// International Telephone Input script.
		wp_register_script(
			'intl-tel-input',
			"{$url}assets/intl-tel-input/js/intlTelInput-jquery.min.js",
			['jquery'],
			$intlTelInputVersion,
			true
		);

		// International Telephone Input utils.
		wp_register_script(
			'intl-tel-input-util',
			"{$url}assets/intl-tel-input/js/utils.js",
			['jquery'],
			$intlTelInputVersion,
			true
		);

		// Javascript Cookie script.
		wp_register_script(
			'js-cookie',
			"{$url}assets/js/js.cookie.min.js",
			[],
			$jsCookieVersion,
			true
		);

		// Custom field script.
		wp_register_script(
			'acf-intl-tel-input',
			"{$url}assets/js/input.js",
			[
				'acf-input',
				'jquery',
				'intl-tel-input',
				'intl-tel-input-util',
				'js-cookie'
			],
			$version,
			true
		);

		// Send information about cookies.
		wp_localize_script(
			'acf-intl-tel-input',
			'acf_intl_tel_input_obj',
			[
				'COOKIEPATH' => COOKIEPATH,
				'COOKIE_DOMAIN' => COOKIE_DOMAIN,
			]
		);

		// Enqueue scripts.
		wp_enqueue_script('acf-intl-tel-input');


		// International Telephone Input stylesheet.
		wp_register_style(
			'intl-tel-input',
			"{$url}assets/intl-tel-input/css/intlTelInput.min.css",
			[],
			$intlTelInputVersion
		);

		// Custom field stylesheet.
		wp_register_style(
			'acf-intl-tel-input',
			"{$url}assets/css/input.css",
			[
				'acf-input',
				'intl-tel-input'
			],
			$version
		);

		// Enqueue stylesheets.
		wp_enqueue_style('acf-intl-tel-input');
		
	}

	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/

	function load_value( $value, $post_id, $field ) {

		// Ensure value is an array.
		if ( $value ) {
			return wp_parse_args($value, [
				'phone'			=> '',
				'nationalPhone'	=> '',
			]);
		}

		// Return default.
		return false;
	}


	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/

	function update_value( $value, $post_id, $field ) {

		// Decode JSON string.
		if ( is_string($value) ) {
			$value = json_decode( wp_unslash($value), true );
		}

		// Ensure value is an array.
		if ( $value ) {
			return (array) $value;
		}

		// Return default.
		return false;
	}


}


// Initialize
new acf_field_intl_tel_input( $this->settings );


// class_exists check.
endif;

?>
