<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* TGM */
require_once (get_template_directory() . '/framework/tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once (get_template_directory() . '/framework/tgm-plugin-activation/neko-tgm-plugins.php' );


if( is_admin() ){
	require_once (get_template_directory() . '/framework/admin/neko-admin-class.php' );
}

//Neko Theme hooks
require_once(get_template_directory() . '/framework/hooks/neko-actions.php');
require_once(get_template_directory() . '/framework/hooks/neko-filters.php');

//Neko Theme enqueue scripts
require_once(get_template_directory() . '/framework/enqueue-scripts/neko-enqueue-styles.php');
require_once(get_template_directory() . '/framework/enqueue-scripts/neko-enqueue-scripts.php');

//Neko Theme Walkers & Menu gestion
require_once( get_template_directory() . '/framework/walkers/neko-custom-nav-fields.php' );
require_once( get_template_directory() . '/framework/walkers/neko-menu-walker-class.php' );
require_once( get_template_directory() . '/framework/walkers/neko-breadcrum-walker-class.php' );

//Neko Theme classes
require_once( get_template_directory() . '/framework/classes/multiple_thumbs/multi-post-thumbnails.php' );
require_once( get_template_directory() .  '/framework/classes/neko-metabox-generator/engine/my-meta-box-custom-class.php');
/* Include this if tax metabox is needed ( not the case for now ) */ /* require_once( get_template_directory() .  '/framework/classes/neko-metabox-tax-generator/neko-meta-box-class.php'); */

//Neko Theme customizer
require_once( get_template_directory() . '/framework/customizer/customizer_boilerplate/customizer.php');
require_once( get_template_directory() . '/inc/customizer/customizer-options.php'); // include theme specific options
require_once( get_template_directory() . '/framework/customizer/fonts/fonts.php'); // builds custom fonts link 
require_once( get_template_directory() . '/inc/style/custom_styles.php'); 

//Neko Theme tools
require_once(get_template_directory() . '/framework/neko-tools/neko_tools.php');
require_once( get_template_directory() .  '/framework/classes/sidebar-generator/sidebar_generator.php');

//Neko Woocommerce
if( class_exists( 'WooCommerce' ) ){
	require_once( get_template_directory() . '/woocommerce/hooks/actions.php' );
	require_once( get_template_directory() . '/woocommerce/hooks/filters.php' );
	require_once( get_template_directory() . '/woocommerce/functions.php' );
}



/**
 * Set the content width based on the theme's design and stylesheet.
 * @since neko-framework 1.0
 */
if ( ! isset( $content_width ) ) $content_width = 1140; 
?>
