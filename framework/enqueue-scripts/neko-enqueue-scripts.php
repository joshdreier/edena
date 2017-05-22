<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Enqueue scripts
 */

if(!function_exists('neko_scripts')){

	function neko_scripts() {

		$customizerOptions = thsp_cbp_get_options_values();

		/*** JQUERY ***/
		//wp_enqueue_script('jquery');

		/*** MODERNIZR ***/
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr/modernizr-2.6.1.min.js', null, '2.6.1', false );


		/*** Jquery plugins & bootstrap js ***/
		wp_enqueue_script( 'neko-jquery-plugins', get_template_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), '1.0.0', true );


		/*** Comment reply ***/	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	
		/*** Wp Masonry ***/
		if (! function_exists('slug_scripts_masonry') ) {
			if ( ! is_admin() ){
				wp_enqueue_script('masonry');	
			}	
		}

		/*** CUSTOM SCRIPT ***/
		wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom.js', array( 'jquery', 'modernizr' ), '20130215', true );
	}

	add_action( 'wp_enqueue_scripts', 'neko_scripts', 1);
}
