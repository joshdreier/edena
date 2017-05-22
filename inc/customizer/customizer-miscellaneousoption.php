<?php

$options['general_section'] =  array(


	'existing_section' => false,

	'args' => array(
		'title' => esc_html__( 'Miscellaneous', 'neko' ),
		'description' => '',
		'priority' => 12
		),

	'fields' => array(

		'bodylayout_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Body layouy options', 'neko' ),
				'type' => 'sub-title',
				'priority' => 1
				)
			),		

		'bodylayout' => array(
			'setting_args' => array(
				'default' => 'fullwidth',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Layout style', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'boxed' => array(
						'label' => esc_html__( 'Boxed', 'neko' )
						),
					'fullwidth' => array(
						'label' => esc_html__( 'Full width', 'neko' )
						),
					'sidemenu' => array(
						'label' => esc_html__( 'Side menu', 'neko' )
						),
					),
				'priority' => 2
				)
			),

		'bodylayoutbgimg' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Background image for boxed layout', 'neko' ),
				'type' => 'image', 
				'priority' => 3
				)
			),



		'preloader_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Preloader options', 'neko' ),
				'type' => 'sub-title',
				'priority' => 4
				)
			),		

		'preload' => array(
			'setting_args' => array(
				'default' => 'off',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Show preloader', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'on' => array(
						'label' => esc_html__( 'On', 'neko' )
						),
					'off' => array(
						'label' => esc_html__( 'Off', 'neko' )
						)
					),
				'priority' => 5
				)
			),

		'preloader_selector' => array(
			'setting_args' => array(
				'default' => 'none',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Select Preloader', 'neko' ),
				'type' => 'select',
				'choices' => array(
					'none' => array(
						'label' => '&mdash; '.esc_html__( 'select', 'neko' ).'  &mdash;'
					    ),
					'circle' => array(
						'label' => esc_html__( 'Circle', 'neko' )
						),
					'signal' => array(
						'label' => esc_html__( 'Signal', 'neko' )
						),
					'dots' => array(
						'label' => esc_html__( 'Dots', 'neko' )
						),
					'underline' => array(
						'label' => esc_html__( 'Underline', 'neko' )
						)
					),
				'priority' => 6
				)
			),


		'analytics_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Google analytics', 'neko' ),
				'type' => 'sub-title',
				'priority' => 7
				)
			),

		'ga_tracking' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'postMessage',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Google analytics code', 'neko' ),
				'type' => 'textarea', 
				'priority' => 8
				)
			),




		'featured_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Featured images', 'neko' ),
				'type' => 'sub-title',
				'priority' => 9
				)
			),


		'featured_desc' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Here you can set the number of featured images avalaible for posts within your Neko theme.', 'neko' ),
				'type' => 'description',
				'priority' => 10
				)
			),


		'nbfeaturedimg' => array(
			'setting_args' => array(
				'default' => 4,
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Number of featured images', 'neko' ),
				'type' => 'number', 
				'priority' => 11
				)
			)

		)
)



?>