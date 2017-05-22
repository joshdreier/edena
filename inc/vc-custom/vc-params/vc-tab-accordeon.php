<?php

/**
 * Configure and Add params to tab / accordeon vc shortcodes
 */
if (function_exists('vc_remove_param')) {
	vc_remove_param( 'vc_tta_tabs', 'style' );
	vc_remove_param( 'vc_tta_accordion', 'style' );	
	vc_remove_param( 'vc_tta_tour', 'style' );
}


if (function_exists('vc_add_params')) {


	/** vc_tta_tabs **/
	$attributes = array(


		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'neko' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__( 'Classic', 'neko' ) => 'classic',
				esc_html__( 'Modern', 'neko' ) => 'modern',
				esc_html__( 'Flat', 'neko' )   => 'flat',
				esc_html__( 'Outline', 'neko' )   => 'outline',
				esc_html__( 'Theme style', 'neko' )   => 'theme'
				),
			'description' => '',
			'weight' => 1
		),


	);
   
   /** vc_tta_tabs **/
   vc_add_params( 'vc_tta_tabs', $attributes ); // Note: 'vc_message' was used as a base for 'Message box' element

   /** vc_tta_accordion **/
   vc_add_params( 'vc_tta_accordion', $attributes ); // Note: 'vc_message' was used as a base for 'Message box' element

   /** vc_tta_tour **/
   vc_add_params( 'vc_tta_tour', $attributes ); // Note: 'vc_message' was used as a base for 'Message box' element
   

}