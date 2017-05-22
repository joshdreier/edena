<?php

$options['blog_section'] = array(
	'existing_section' => false,
	'args' => array(
		'title' => esc_html__( 'Blog', 'neko' ),
		'description' => '',
		'priority' => 7
		),

	'fields' => array(

		'bloglist_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Blog list options', 'neko' ),
				'type' => 'sub-title',
				'priority' => 1
				)
			),		

		'bloglist_desc' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Here you can set options for the blog list pages (blog page, category, search, tag, author, attachement and archive).', 'neko' ),
				'type' => 'description',
				'priority' => 2
				)
			),

		'blog_layout' => array(
			'setting_args' => array(
				'default' => 'default',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb',
				),					
			'control_args' => array(
				'label' => esc_html__( 'Blog layout', 'neko' ),
				'type' => 'select',
				'choices' => array(
					'default' => array(
						'label' => esc_html__( 'Default', 'neko' )
						),
					'twoblocs' => array(
						'label' => esc_html__( 'Large', 'neko' )
						),
					'grid' => array(
						'label' => esc_html__( 'Grid', 'neko' )
						)
					),					
				'priority' => 3
				)
			),

		'blog_default_sidebar_position' => array(
			'setting_args' => array(
				'default' => 'left',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Sidebar position', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'left' => array(
						'label' => esc_html__( 'Left', 'neko' )
						),
					'right' => array(
						'label' => esc_html__( 'Right', 'neko' )
						),
					'no-sidebar' => array(
						'label' => esc_html__( 'No sidebar', 'neko' )
						)
					),					
				'priority' => 4
				)
			),

		'display_blog_header' => array(
			'setting_args' => array(
				'default' => 'on',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Enable blog header', 'neko' ),
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

		'size_blog_header' => array(
			'setting_args' => array(
				'default' => 'small',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Blog header size', 'neko' ),
				'type' => 'select',
				'choices' => array(
					'small' => array(
						'label' => esc_html__( 'Small', 'neko' )
						),
					'medium' => array(
						'label' => esc_html__( 'Medium', 'neko' )
						),
					'large' => array(
						'label' => esc_html__( 'Large', 'neko' )
						)
					),					
				'priority' => 6
				)
			),	


		'blog_header_image' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Default background image', 'neko' ),
				'type' => 'image',
				'priority' => 7
				)
			),

		'blog_header_mask_color' => array(
			'setting_args' => array(
				'default' => '#000000',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Mask header color', 'neko' ),
				'type' => 'color',			
				'priority' => 8
				)
			),


		'blog_header_mask_opacity' => array(
			'setting_args' => array(
				'default' => '0',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Mask header opacity', 'neko' ),
				'type' => 'select',
				'choices' => array(
					'0'   => array( 'label' => '0'),
					'0.1' => array( 'label' => '0.1'),
					'0.2' => array( 'label' => '0.2'),
					'0.3' => array( 'label' => '0.3'),
					'0.4' => array( 'label' => '0.4'),
					'0.5' => array( 'label' => '0.5'),
					'0.6' => array( 'label' => '0.6'),
					'0.7' => array( 'label' => '0.7'),
					'0.8' => array( 'label' => '0.8'),
					'0.9' => array( 'label' => '0.9'),
					'1'   => array( 'label' => '1')	
				),			
				'priority' => 9
				)
			),


		'parallax_blog_header' => array(
			'setting_args' => array(
				'default' => 'off',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Blog Parallax header', 'neko' ),
				'type' => 'select',
				'choices' => array(
					'0' => array(
						'label' => esc_html__( 'Fixed', 'neko' )
						),
					'10' => array(
						'label' => esc_html__( 'Animated', 'neko' )
						),
					'off' => array(
						'label' => esc_html__( 'Off', 'neko' )
						)
					),					
				'priority' => 10
				)
			),	


		'blog_header_text' => array(
			'setting_args' => array(
				'default' => 'The blog',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Blog header text', 'neko' ),
				'type' => 'text',
				'priority' => 11
				)
			),


		'blogmoreoption_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Additional blog options', 'neko' ),
				'type' => 'sub-title',
				'priority' => 12
				)
			),		

		'blogmoreoption_desc' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'The options below enable you to fine tune your blog pages to fit your need.', 'neko' ),
				'type' => 'description',
				'priority' => 13
				)
			),

		'neko_author_bio' => array(
			'setting_args' => array(
				'default' => 'off',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Activate author sheet on post pages', 'neko' ),
				'type' => 'radio',
				'choices' => array(
					'on' => array(
						'label' => esc_html__( 'on', 'neko' )
						),
					'off' => array(
						'label' => esc_html__( 'off', 'neko' )
						)
					),					
				'priority' => 14
				)
			)


		)
)


?>