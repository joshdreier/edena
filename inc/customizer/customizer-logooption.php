<?php

$options['logo_section'] = array(


	'existing_section' => false,

	'args' => array(
		'title' => esc_html__( 'Logo', 'neko' ),
		'description' => '',
		'priority' => 2
		),


	'fields' => array(



		'logo' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Logo image', 'neko' ),
				'type' => 'image', 
				'priority' => 1
				)
			),

		'logo_transparent' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Logo image for transparent header', 'neko' ),
				'type' => 'image', 
				'priority' => 2
				)
			),

		'logo_width' => array(

			'setting_args' => array(
				'default' => esc_html__( '148', 'neko' ),
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					

			'control_args' => array(
				'label' => esc_html__( 'Logo width in pixels', 'neko' ),
				'type' => 'text', 
				'priority' => 3
				)
			),	


		'logo_height' => array(

			'setting_args' => array(
				'default' => esc_html__( '43', 'neko' ),
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					

			'control_args' => array(
				'label' => esc_html__( 'Logo height in pixels', 'neko' ),
				'type' => 'text', 
				'priority' => 4
				)
			),				




		'logo_retina' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Logo image (Retina Version @2x) ', 'neko' ),
				'type' => 'image', 
				'priority' => 5
				)
			),

		'logo_transparent_retina' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Logo image for transparent header (Retina Version @2x)', 'neko' ),
				'type' => 'image', 
				'priority' => 6
				)
			),
		)
)




?>