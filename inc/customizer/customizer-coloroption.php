<?php

$options['colors'] = array(
	'existing_section' => false,
	'args' => array(
		'title' => esc_html__( 'Colors', 'neko' ),
		'description' => '',
		'priority' => 4
		),

	'fields' => array(


		'background_color' => array(
			'setting_args' => array(
				'default' => '#ffffff',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Body background color', 'neko' ),
				'type' => 'color',
				'priority' => 2
				)
			),

		'post_background_color' => array(
			'setting_args' => array(
				'default' => '#ffffff',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Post background color', 'neko' ),
				'type' => 'color',
				'priority' => 2
				)
			),

		'body_text_color' => array(
			'setting_args' => array(
				'default' => '#333333',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Body text', 'neko' ),
				'type' => 'color',
				'priority' => 5
				)
			),		


		'headings_color' => array(
			'setting_args' => array(
				'default' => '#333333',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Headings', 'neko' ),
				'type' => 'color',
				'priority' => 6
				)
			),		



		'links_color' => array(
			'setting_args' => array(
				'default' => '#555555',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Links', 'neko' ),
				'type' => 'color',
				'priority' => 7
				)
			),		



		'hover_links_color' => array(
			'setting_args' => array(
				'default' => '#111111',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Hover links', 'neko' ),
				'type' => 'color',
				'priority' => 8
				)
			),

		'neutral_color' => array(
			'setting_args' => array(
				'default' => '#888888',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Neutral color', 'neko' ),
				'type' => 'color',
				'priority' => 9
				)
			),

		'accent_color' => array(
			'setting_args' => array(
				'default' => '#967e51',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Accent color', 'neko' ),
				'type' => 'color',
				'priority' => 9
				)
			),
		
		/** ============== BUTTONS ============== **/
		'panel_button_colors' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Buttons', 'neko' ),
				'type' => 'sub-title',
				'priority' => 16
				)
			),

		'btn_color' => array(
			'setting_args' => array(
				'default' => '#1e1e1e',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Button background', 'neko' ),
				'type' => 'color',
				'priority' => 17
				)
			),		



		'btn_text_color' => array(
			'setting_args' => array(
				'default' => '#ffffff',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Button text', 'neko' ),
				'type' => 'color',
				'priority' => 18
				)
			),		


		'btn_hover_color' => array(
			'setting_args' => array(
				'default' => '#d1d1d1',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Hover button background', 'neko' ),
				'type' => 'color',
				'priority' => 19
				)
			),		



		'btn_hover_text_color' => array(
			'setting_args' => array(
				'default' => '#1e1e1e',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Hover button text', 'neko' ),
				'type' => 'color',
				'priority' => 20
				)
			),	

		/** ============== Header ============== **/
		'panel_header_colors' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Header and main menu', 'neko' ),
				'type' => 'sub-title',
				'priority' => 21
				)
			),

		'header_background_color' => array(
			'setting_args' => array(
				'default' => '#ffffff',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Header background color', 'neko' ),
				'type' => 'color',
				'priority' => 22
				)
			),		


		'top_level_menu_bg_color' => array(
			'setting_args' => array(
				'default' => '#eeeeee',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Top level menu background color (if applicable)', 'neko' ),
				'type' => 'color',
				'priority' => 23
				)
			),		



		'top_level_menu_text_color' => array(
			'setting_args' => array(
				'default' => '#444444',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Top level menu text color', 'neko' ),
				'type' => 'color',
				'priority' => 24
				)
			),		


		'top_level_menu_bg_color_hover' => array(
			'setting_args' => array(
				'default' => '#222222',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Hover top level menu background color (if applicable)', 'neko' ),
				'type' => 'color',
				'priority' => 25
				)
			),		


		'top_level_menu_text_color_hover' => array(
			'setting_args' => array(
				'default' => '#999',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Hover top level menu text color', 'neko' ),
				'type' => 'color',
				'priority' => 26
				)
			),
	/** ============== Header transparent ============== **/
		'panel_header_transparent_colors' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Transparent header', 'neko' ),
				'type' => 'sub-title',
				'priority' => 27
				)
			),


		'top_level_menu_transparent_text_color' => array(
			'setting_args' => array(
				'default' => '#EEEEEE',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Top level menu text color', 'neko' ),
				'type' => 'color',
				'priority' => 28
				)
			),			

		'top_level_menu_transparent_text_color_hover' => array(
			'setting_args' => array(
				'default' => '#ffffff',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Hover top level menu text color', 'neko' ),
				'type' => 'color',
				'priority' => 29
				)
			),



		/** ============== FOOTER ============== **/
		'panel_footer_colors' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Footer', 'neko' ),
				'type' => 'sub-title',
				'priority' => 30
				)
			),

		'footer_bg_color' => array(
			'setting_args' => array(
				'default' => '#333333',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Footer background', 'neko' ),
				'type' => 'color',
				'priority' => 31
				)
			),		


		'footer_text_color' => array(
			'setting_args' => array(
				'default' => '#999999',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Footer text', 'neko' ),
				'type' => 'color',
				'priority' => 32
				)
			),	

		'footer_secondary_color' => array(
			'setting_args' => array(
				'default' => '#555555',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Footer secondary color', 'neko' ),
				'type' => 'color',
				'priority' => 33
				)
			),		



		'footer_link_color' => array(
			'setting_args' => array(
				'default' => '#eeeeee',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Footer link', 'neko' ),
				'type' => 'color',
				'priority' => 34
				)
			),		



		'footer_hover_link_color' => array(
			'setting_args' => array(
				'default' => '#ffffff',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Footer hover link', 'neko' ),
				'type' => 'color',
				'priority' => 35
				)
			),

		/** ============== COPYRIGHT ============== **/
		'panel_copyright_colors' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Copyright section', 'neko' ),
				'type' => 'sub-title',
				'priority' => 36
				)
			),
		'footer_copyright_bg_color' => array(
			'setting_args' => array(
				'default' => '#444444',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Copyright section background', 'neko' ),
				'type' => 'color',
				'priority' => 37
				)
			),		



		'footer_copyright_text_color' => array(
			'setting_args' => array(
				'default' => '#777777',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Copyright section text', 'neko' ),
				'type' => 'color',
				'priority' => 38
				)
			),		



		'footer_copyright_link_color' => array(
			'setting_args' => array(
				'default' => '#eeeeee',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Copyright section link', 'neko' ),
				'type' => 'color',
				'priority' => 39
				)
			),		



		'footer_copyright_hover_link_color' => array(
			'setting_args' => array(
				'default' => '#ffffff',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Copyright section hover link', 'neko' ),
				'type' => 'color',
				'priority' => 40
				)
			),	
		




		),	
)

?>