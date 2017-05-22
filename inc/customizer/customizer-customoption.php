<?php

$options['custom section'] = array(
	'existing_section' => false,
	'args' => array(
		'title' => esc_html__( 'Custom CSS', 'neko' ),
		'description' => esc_html__( 'Will overidde everything (customizations or default stylesheet', 'neko' ),
			'priority' => 11
			),

	'fields' => array(

		'custom_css' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Put your custom CSS here', 'neko' ),
				'type' => 'textarea',
				'priority' => 1
				)
			),				
		)
	)

?>