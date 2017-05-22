<?php

if (is_admin()){

	/** 
	 * prefix of meta keys, optional
	 * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
	 * you also can make prefix empty to disable it
	 */
	$prefix = 'neko_';
	$templateUri = get_template_directory_uri();

	/** 
	 * configure your meta box
	 */
	$config = array(
	'id'             => 'post_meta_box',       		   // meta box id, unique per meta box
	'title'          => 'Header options',              // meta box title
	'pages'          => array('post', 'page'),     	   // post types, accept custom post types as well, default is array('post'); optional
	'context'        => 'normal',                      // where the meta box appear: normal (default), advanced, side; optional
	'priority'       => 'high',                        // order of meta box: high (default), low; optional
	'fields'         => array(),                       // list of meta fields (can be added by field arrays)
	'local_images'   => false,                         // Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => $templateUri . '/framework/classes/neko-metabox-generator/engine'
	);

	/**
	 * Initiate your meta box
	 */
	$my_meta =  new Neko_at_Meta_Box($config);



	/**
	 * Header default title
	 */
	$display_default_header_title = esc_html__('Display default header', 'neko');
	$display_default_header_desc  = '';
	$my_meta->addRadio(
		$prefix.'page_header_display',
		array(
		'1' =>esc_html__('On', 'neko'),
		'0' =>esc_html__('Off', 'neko')
		),
		array(
			'name' => $display_default_header_title,
			'desc' => $display_default_header_desc,
			'std'  => array('0')
			)
		);



	/**
	 * Header default title
	 */
	$title_use_post_title = esc_html__('Use custom title', 'neko');
	$desc_use_post_title  = esc_html__('If set on "Off" the post title of the page or post will be used in the header', 'neko');
	$my_meta->addRadio(
		$prefix.'post_header_default_title',
		array(
		'1' =>esc_html__('On', 'neko'),
		'0' =>esc_html__('Off', 'neko')
		),
		array(
			'name' => $title_use_post_title,
			'desc' => $desc_use_post_title,
			'std'  => array('0')
			)
		);

	/**
	 * Custom Title
	 */
	$title_customtitle = esc_html__('Custom title', 'neko');
	$desc_customtitle  = esc_html__('Add a custom title in the post header', 'neko');


	$my_meta->addTextarea(
		$prefix.'post_header_customtitle',
		array(
			'name' => $title_customtitle,
			'desc' => $desc_customtitle
			)
		);

	/**
	 * Subtitle
	 */
	$title_subtitle = esc_html__('Subtitle', 'neko');
	$desc_subtitle  = esc_html__('Add a subtitle below the title', 'neko');


	$my_meta->addTextarea(
		$prefix.'post_header_subtitle',
		array(
			'name' => $title_subtitle,
			'desc' => $desc_subtitle
			)
		);



	/**
	 * Finish Meta Box Declaration
	 */
	$my_meta->Finish();


}