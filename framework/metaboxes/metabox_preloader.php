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
	'id'             => 'post_preloader_meta_box',     // meta box id, unique per meta box
	'title'          => 'Preloader options',           // meta box title
	'pages'          => array('page'),     	   		   // post types, accept custom post types as well, default is array('post'); optional
	'context'        => 'side',                        // where the meta box appear: normal (default), advanced, side; optional
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
	$preloader_title = esc_html__('Activate ajax preloader', 'neko');
	$preloader_desc  = '';
	$my_meta->addRadio(
		$prefix.'page_preloader',
		array(
		'on' =>esc_html__('On', 'neko'),
		'off' =>esc_html__('Off', 'neko')
		),
		array(
			'name' => $preloader_title,
			'desc' => $preloader_desc,
			'std'  => array('off')
			)
		);

	/**
	 * Finish Meta Box Declaration
	 */
	$my_meta->Finish();

}