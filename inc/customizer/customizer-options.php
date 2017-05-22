<?php

/**
* Get Theme Customizer Fields
*
* @package		Theme_Customizer_Boilerplate
* @copyright	Copyright (c) 2013, Little Neko
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
* @author		Slobodan Manic
*
* @since		neko-framework 1.0
*/


/**
* Set the customizer path
* @since neko-framework 1.0
*/

function neko_set_customizer_path( $args ) {
    return get_template_directory_uri() . '/framework/customizer/customizer_boilerplate';
}

add_filter( 'thsp_cbp_directory_uri', 'neko_set_customizer_path', 1 );




/**
* Register & Enqueue custom js for the customizer
* @since neko-framework 1.0
*/

if ( ! function_exists( 'neko_jsadmin_customizer' ) ) {
  function neko_jsadmin_customizer() {

    wp_register_script( 'customizer-fonts', get_template_directory_uri()  . '/framework/customizer/customizer_boilerplate/js/customizer-fonts.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'customizer-fonts' );

  }
  add_action( 'customize_controls_print_footer_scripts', 'neko_jsadmin_customizer' );
}


/**
* Define theme specific options array.
*
* @return	array	$neko_options	Array of theme options
* @uses	thsp_cbp_options_array hook	defined in customizer/options.php
*/

function neko_set_options_array( ) {

	   /**
		* Using helper function to get default required capability
		*/

		$thsp_cbp_capability = thsp_cbp_capability();

		$options = array();

		include('customizer-logooption.php');

		global $wp_customize;
		if( isset( $wp_customize ) ){
			include('customizer-typographyoption.php');
		}

		include('customizer-coloroption.php');
		include('customizer-header.php');
		include('customizer-blogoption.php');
		include('customizer-footeroption.php');
		include('customizer-404option.php');		
		include('customizer-customoption.php');
		include('customizer-miscellaneousoption.php');
	
		/** Set the customizer path.*/
		return $options;
}

return add_filter ( 'thsp_cbp_options_array', 'neko_set_options_array' );




