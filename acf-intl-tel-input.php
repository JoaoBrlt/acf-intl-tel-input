<?php

/*
 * Plugin Name: Advanced Custom Fields: International Telephone Input
 * Plugin URI: https://github.com/JoaoBrlt/acf-intl-tel-input
 * Description: Adds International Telephone Input to Advanced Custom Fields.
 * Version: 1.2.0
 * Author: João Brilhante
 * Author URI: http://joao.brilhante.dev
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

// Exit if accessed directly.
if( ! defined( 'ABSPATH' ) ) exit;


// Check if class already exists.
if( !class_exists('acf_plugin_intl_tel_input') ) :


class acf_plugin_intl_tel_input {

	// Plugin settings.
	var $settings;


	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		// Plugin settings.
		$this->settings = [
			'version' => '1.2.0',
			'url'     => plugin_dir_url( __FILE__ ),
			'path'    => plugin_dir_path( __FILE__ )
		];


		// Include the field.
		add_action( 'acf/include_field_types', [$this, 'include_field_types'] );

	}


	/*
	*  include_field_types
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	n/a
	*/

	function include_field_types( $version = false ) {

		// Load text domain.
		load_plugin_textdomain( 'acf-intl-tel-input', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );


		// Include the field.
		include_once( 'fields/class-acf-field-intl-tel-input.php' );

	}

}


// Initialize the plugin.
new acf_plugin_intl_tel_input();


// class_exists check.
endif;

?>