<?php
if( defined( 'WPB_VC_VERSION' ) ){
	
	/**
	 * VC REMOVE COMPONENT
	 */
	vc_remove_element( "vc_gallery" );
	vc_remove_element( "vc_tta_pageable" );
	/*vc_remove_element( "vc_basic_grid" );*/
	vc_remove_element( "vc_cta" );
	/* vc_remove_element( "vc_toggle" ); */
	
	/**
	 * VC ROW NEKO MODIFICATIONS
	 */
	require_once(get_template_directory() . '/inc/vc-custom/vc-params/vc-row.php');
	require_once(get_template_directory() . '/inc/vc-custom/vc-params/vc-tab-accordeon.php');
	
}