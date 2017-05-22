<?php
// check for Visual Composer is activated, if so then remove the meta generator tag.
if ( class_exists( 'Vc_Manager' ) && !function_exists('neko_remove_meta') ) {
    function neko_remove_meta() {
        remove_action('wp_head', array(visual_composer(), 'addMetaData'));
    }
    add_action('init', 'neko_remove_meta', 100);
}




/**
 * Configure and Add params to row vc shortcodes
 */
if (function_exists('vc_remove_param')) {
	vc_remove_param( 'vc_row', 'full_width' );
	vc_remove_param( 'vc_row', 'parallax' );
	vc_remove_param( 'vc_row', 'parallax_image' );
	vc_remove_param( 'vc_row', 'parallax_speed_bg' );
	vc_remove_param( 'vc_row', 'parallax_speed_video' );
	vc_remove_param( 'vc_row', 'full_height' );
	vc_remove_param( 'vc_row', 'content_placement' );
	vc_remove_param( 'vc_row', 'video_bg' );
	vc_remove_param( 'vc_row', 'video_bg_url' );
	vc_remove_param( 'vc_row', 'video_bg_parallax' );
	vc_remove_param( 'vc_row', 'gap' );
	vc_remove_param( 'vc_row', 'columns_placement' );
	vc_remove_param( 'vc_row', 'equal_height' );
}




if (function_exists('vc_add_params')) {

	$attributes = array(

		/**
		 * ROW BEHAVIOR
		 */
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row stretch', 'neko' ),
			'param_name' => 'full_width',
			'value' => array(
				esc_html__( 'Default', 'neko' ) => 'neko_contained',
				esc_html__( 'Stretch row and content', 'neko' ) => 'stretch_row_content',
				esc_html__( 'Stretch row and content without spaces', 'neko' )   => 'stretch_row_content_no_spaces'
				),
			'description' => esc_html__( 'Select stretching options for row and content. Stretched row overlay sidebar and may not work if parent container has overflow: hidden css property.', 'neko' ),
			'weight' => 20
		),


		/**
		 * ROW TYPE
		 */
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Section type', 'neko' ),
			'param_name' => 'neko_section_type',
			'value' => array(
				esc_html__( 'Default', 'neko' )     => 'default',
				esc_html__( 'Parallax', 'neko' )    => 'parallax',
				esc_html__( 'Video', 'neko' )       => 'video',
				esc_html__( 'Equal height', 'neko' )   => 'neko-table-container',
				esc_html__( 'Full screen', 'neko' ) => 'fullscreen',
				),
			'description' => esc_html__( 'Set the type of section you want to create', 'neko' ),
			'weight' => 19
		),


		/**
		 * PARALLAX SPEED SETTING
		 */
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Parallax effect', 'neko' ),
			'param_name' => 'neko_parallax_option',
			'value' => array(
				esc_html__( 'fixed', 'neko' ) => 0,
				esc_html__( 'Animated', 'neko' )  => 10
				),
			'description' => esc_html__( 'Set the style of the paralax effect', 'neko' ),
			'dependency' => Array('element' => 'neko_section_type', 'value' => array('parallax')),
			'weight' => 18
		),


		/**
		 * VIDEO ID (YOUTUBE)
		 */
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Youtube video id', 'neko' ),
			'param_name' => 'neko_video_yt_id',
			'description' => esc_html__( 'Add the youtube id of the video you want to display as background', 'neko' ),
			'dependency' => Array('element' => 'neko_section_type', 'value' => array('video')),
			'weight' => 18
		),

		/**
		 * VIDEO MUTE STATE (YOUTUBE)
		 */
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'muted video', 'neko' ),
			'param_name' => 'neko_video_mute',
			'value' => array(
				'Off' => 'off',
				'On'  => 'on'
			),
			'description' => esc_html__( 'If set on \'On\' the background video will be muted' , 'neko' ),
			'dependency' => Array('element' => 'neko_section_type', 'value' => array('video')),
			'weight' => 17
		),

		/**
		 * VIDEO LOOP STATE (YOUTUBE)
		 */
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'loop video', 'neko' ),
			'param_name' => 'neko_video_loop',
			'value' => array(
				esc_html__( 'Off', 'neko' ) => 'off',
				esc_html__( 'On', 'neko' )  => 'on'
			),
			'description' => esc_html__( 'If set on \'On\' the background video will loop indefinitely' , 'neko' ),
			'dependency' => Array('element' => 'neko_section_type', 'value' => array('video')),
			'weight' => 16
		),	

		/**
		 * MASK / OVERLAY ACTIVATION
		 */
		array(

			'type' => 'dropdown',
			'heading' => esc_html__( 'Mask activation', 'neko' ),
			'param_name' => 'neko_mask_activation',
			'value' => array(
				esc_html__( 'Off', 'neko' ) => 'off',
				esc_html__( 'On', 'neko' )  => 'on'
			),

			'description' => esc_html__( 'Activate mask/overlay', 'neko' ),
			'weight' => 18

		),


		/**
		 * MASK / OVERLAY COLOR SETTING
		 */
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Mask color', 'neko' ),
			'param_name' => 'neko_mask_color',
			'description' => esc_html__( 'Configure the color of the overlay', 'neko' ),
			'dependency' => Array('element' => 'neko_mask_activation', 'value' => array('on')),
			'weight' => 18
		), 

	);
   vc_add_params( 'vc_row', $attributes ); // Note: 'vc_message' was used as a base for 'Message box' element
}

