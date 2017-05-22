<?php

$args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'post_title',
	'hierarchical' => 1,
	'exclude' => '',
	'include' => '',
	'meta_key' => '',
	'meta_value' => '',
	'authors' => '',
	'child_of' => 0,
	'parent' => -1,
	'exclude_tree' => '',
	'number' => '',
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish'
	);

$pages_list = get_pages( $args );
//echo '<pre>'; print_r($pages_list); echo '</pre>';

$option = array();
if(!empty($pages_list)){
	$option[0] = array('label' => '&mdash; '.esc_html__('select', 'neko').' &mdash;');
	foreach ($pages_list as $key => $value) {
		$option[$value->ID] = array('label' => $value->post_title);
	}
}else{
	$option[0] = array('label' => esc_html__('No page created yet', 'neko'));
}


$options['error page'] = array(
	'existing_section' => false,
	'args' => array(
		'title' => esc_html__( '404 error page', 'neko' ),
		'description' => esc_html__( 'Create a page that will be selected below as your 404 page', 'neko' ),
		'priority' => 8
		),

	'fields' => array(

		'error_404_page' => array(
			'setting_args' => array(
				'capability' => $thsp_cbp_capability,
				'default' => $option[0],
				'type' => 'option',
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),

			'control_args' => array(
				'label' => esc_html__( 'Select a page', 'neko' ),
				'type' => 'select',
				'choices' => $option,
				'priority' => 1
				)
			),

		)

	)

?>