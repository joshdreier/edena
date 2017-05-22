<?php

/**
 * Get all wp users
 */
$all_users = get_users(array( 'fields' => array( 'display_name', 'ID')));
// echo '<pre>'; print_r($all_users); echo '</pre>';

$option_user = array(0 => array( 'label' => '&mdash; '.esc_html__( 'select', 'neko' ).'  &mdash;') );
foreach ($all_users as $key => $value) {
	$option_user[$value->ID] = array('label' => $value->display_name);
}
//echo '<pre>'; print_r($option_user); echo '</pre>';


$options['header_section'] = array(
	'existing_section' => false,
	'args' => array(
		'title' => esc_html__( 'Header', 'neko' ),
		'description' => '',
		'priority' => 5,
		'sanitize_callback' => 'thsp_sanitize_cb'
		),

	'fields' => array(


		'navbarstyle' => array(
			'setting_args' => array(
				'default' => 'default',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Skin', 'neko' ),
				'type' => 'select',
				'choices' => array('default' => array(
					'label' => esc_html__( 'Default', 'neko' )),
					'centered-logo' => array('label' => esc_html__( 'Centered logo', 'neko')),
					'classic' => array('label' => esc_html__( 'Classic', 'neko')),
					'modern' => array('label' => esc_html__( 'Modern', 'neko')),
					'boxed' => array('label' => esc_html__( 'Boxed', 'neko'))
				),
				'priority' => 3
				)
			),	

			'navbarpadding' => array(

			'setting_args' => array(
				'default' => esc_html__( '26', 'neko' ),
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					

			'control_args' => array(
				'label' => esc_html__( 'Padding', 'neko' ),
				'type' => 'text', 
				'priority' => 3
				)
			),	
		
		'navbarposition' => array(
			'setting_args' => array(
				'default' => 'navbar-fixed-top',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Positioning', 'neko' ),
				'type' => 'select',
				'choices' => array('navbar-fixed-top' => array('label' => esc_html__( 'Fixed top', 'neko' )), 'navbar-static-top' => array('label' => esc_html__( 'Static top', 'neko'))),
				'priority' => 1
				)
			),	



		'navbartransparency' => array(
			'setting_args' => array(
				'default' => '1',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Opacity', 'neko' ),
				'type' => 'select',
				'choices' => 
				array(
					'transparent' =>array('label' => '0'),
					'0.1'         =>array('label' => '0.1'),
					'0.2'         =>array('label' => '0.2'),
					'0.3'         =>array('label' => '0.3'),
					'0.4'         =>array('label' => '0.4'),
					'0.5'         =>array('label' => '0.5'),
					'0.6'         =>array('label' => '0.6'),
					'0.7'         =>array('label' => '0.7'),
					'0.8'         =>array('label' => '0.8'),
					'0.9'         =>array('label' => '0.9'),
					'1'           =>array('label' => '1')					
				),
				'priority' => 2
				)
			),	


		'navbarsubmenustyle' => array(
			'setting_args' => array(
				'default' => 'light',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Sub menu color', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'light' => array(
						'label' => esc_html__( 'Light', 'neko' )
					),
					'dark' => array(
						'label' => esc_html__( 'Dark', 'neko' )
					)),
				'priority' => 3
				)
			),	


			'neko_header_social_title' => array(
				'setting_args' => array(
					'default' => '',
					'type' => 'option',
					'capability' => $thsp_cbp_capability,
					'transport' => 'refresh',
					'sanitize_callback' => 'thsp_sanitize_cb'
					),					
				'control_args' => array(
					'label' => esc_html__( 'Social header', 'neko' ),
					'type' => 'sub-title',
					'priority' => 4
					)
				),

			'neko_header_social_desc' => array(
				'setting_args' => array(
					'default' => '',
					'type' => 'option',
					'capability' => $thsp_cbp_capability,
					'transport' => 'refresh',
					'sanitize_callback' => 'thsp_sanitize_cb'
					),					
				'control_args' => array(
					'label' => esc_html__( 'This section allow you to set a socialbar in the header of your neko theme.', 'neko' ),
					'type' => 'description',
					'priority' => 5
					)
				),

		'neko_header_social_activation' => array(
			'setting_args' => array(
				'default' => 'off',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),	

			'control_args' => array(
				'label' => esc_html__( 'Display social bar', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'on' => array(
						'label' => esc_html__( 'On', 'neko' )
					),
					'off' => array(
						'label' => esc_html__( 'Off', 'neko' )
					)
				),					
				'priority' => 6
			)
		),	


		'neko_header_social_user' => array(
			'setting_args' => array(
				'default' => 0,
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),					
			'control_args' => array(
				'label' => esc_html__( 'Select a user', 'neko' ),
				'type' => 'select',
				'choices' => $option_user,					
				'priority' => 7
			)
		),		
		'neko_header_preheader_title' => array(
				'setting_args' => array(
					'default' => '',
					'type' => 'option',
					'capability' => $thsp_cbp_capability,
					'transport' => 'refresh',
					'sanitize_callback' => 'thsp_sanitize_cb'
					),					
				'control_args' => array(
					'label' => esc_html__( 'Pre header', 'neko' ),
					'type' => 'sub-title',
					'priority' => 8
					)
				),
		'neko_header_preheader' => array(
			'setting_args' => array(
				'default' => 'off',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),					
			'control_args' => array(
				'label' => esc_html__( 'Display preheader', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'on' => array(
						'label' => esc_html__( 'On', 'neko' )
					),
					'off' => array(
						'label' => esc_html__( 'Off', 'neko' )
					)
				),					
				'priority' => 9
			)
		),
		'neko_header_preheader_autohide' => array(
			'setting_args' => array(
				'default' => 'off',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),					
			'control_args' => array(
				'label' => esc_html__( 'Autohide preheader on scroll', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'on' => array(
						'label' => esc_html__( 'On', 'neko' )
					),
					'off' => array(
						'label' => esc_html__( 'Off', 'neko' )
					)
				),					
				'priority' => 9
			)
		)			
	) /* END FIELDS */
) /* END OPTIONS */





?>