<?php

$options['footer_section'] = array(
	'existing_section' => false,
	'args' => array(
		'title' => esc_html__( 'Footer', 'neko' ),
		'description' => '',
		'priority' => 10
		),

	'fields' => array(

		'footertype' => array(
			'setting_args' => array(
				'default' => 'static',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Select the footer type here', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'static' => array(
						'label' => esc_html__( 'Static', 'neko' )
						),
											
					'fixed' => array(
						'label' => esc_html__( 'Fixed', 'neko' )
						),

					'none' => array(
						'label' => esc_html__( 'No Footer', 'neko' )
						)
					),
				'priority' => 1
				)
			),

		'footerlayout' => array(
			'setting_args' => array(
				'default' => 'option_1',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
					), // End setting args			
			'control_args' => array(
				'label' => esc_html__( 'Footer layout', 'neko' ),
						'type' => 'images_radio', // Image radio replacement
						'choices' => array(
							'full' => array(
								'label' => esc_html__( '1 column', 'neko' ),
								'image_src' => get_template_directory_uri() . '/inc/customizer/assets/full.jpg'
								),
							'3cols' => array(
								'label' => esc_html__( '3 columns', 'neko' ),
								'image_src' => get_template_directory_uri() . '/inc/customizer/assets/3cols.jpg'
								),
							'4cols' => array(
								'label' => esc_html__( '4 columns', 'neko' ),
								'image_src' => get_template_directory_uri() . '/inc/customizer/assets/4cols.jpg'
								),
							'2tier1tier' => array(
								'label' => esc_html__( '2/3 - 1/3', 'neko' ),
								'image_src' => get_template_directory_uri() . '/inc/customizer/assets/2tier-1tier.jpg'
								),
							'1tier2tier' => array(
								'label' => esc_html__( '1/3 - 2/3', 'neko' ),
								'image_src' => get_template_directory_uri() . '/inc/customizer/assets/1tier-2tier.jpg'
								),
							'1demi1demi' => array(
								'label' => esc_html__( '1/2 - 1/2', 'neko' ),
								'image_src' => get_template_directory_uri() . '/inc/customizer/assets/1demi-1demi.jpg'
								)
							),					
						'priority' => 2
					) // End control args
			),




		'copyright' => array(
			'setting_args' => array(
				'default' => 'on',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Enable copyright', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'on' => array(
						'label' => esc_html__( 'On', 'neko' )
						),
					'off' => array(
						'label' => esc_html__( 'Off', 'neko' )
						)
					),					
				'priority' => 3
				)
			),


		'copyright_text' => array(
			'setting_args' => array(
				'default' => 'Copyright &copy; 2013 <a href="htpp://www.little-neko.com">Little NEKO</a> / All rights reserved.',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Copyright text', 'neko' ),
				'type' => 'textarea',				
				'priority' => 4
				)
			),

		
		)
)

?>