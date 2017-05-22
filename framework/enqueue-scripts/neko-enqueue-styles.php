<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Enqueue scripts
 */

if(!function_exists('neko_styles')){

	function neko_styles(){

		$customizerOptions = thsp_cbp_get_options_values();

		/*** Bootstrap ***/
		wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/bootstrap/css/bootstrap.min.css', false, '3.3.5', 'all');
		//wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri().'/bootstrap/css/bootstrap-theme.min.css');
		
		/*** plugins css ***/
		wp_enqueue_style( 'neko-theme-custom-plugins', get_template_directory_uri().'/css/plugins.min.css', false, '2.0', 'all');

		/*** Icon Fonts ***/
		wp_enqueue_style( 'neko-social-icon', get_template_directory_uri().'/font-icons/neko-social-icons/css/neko-social-icons.css', false, '2.0', 'all');
		wp_enqueue_style( 'custom-icons', get_template_directory_uri().'/font-icons/custom-icons/css/custom-icons.css', false, '2.0', 'all');

		/*** VC_ ROW ***/
		wp_enqueue_style( 'custom-vc-row', get_template_directory_uri().'/inc/vc-custom/assets/css/vc-override.css', false, '2.0', 'all');

		/*** WooCommerce ***/
		if( defined( 'WPB_VC_VERSION' ) ){
			wp_enqueue_style( 'neko-woocommerce', get_template_directory_uri().'/woocommerce/assets/css/neko-woocommerce.css', false, '2.0', 'all');
		}

		/*** CUSTOM CSS ***/
		wp_enqueue_style( 'style', get_stylesheet_uri(), false, '2.0', 'all' );

	}

	add_action( 'wp_enqueue_scripts', 'neko_styles', 20);
}