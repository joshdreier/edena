<?php
//delete_transient( 'neko_array_fonts' );	
$cached_array_fonts = get_transient( 'neko_array_fonts' );
if( empty( $cached_array_fonts ) ){

	/* INIT */
	$fonts          = array();
	$regfonts_array = array();
	$webfonts_array = array();	


	/* REGULAR FONTS */
	require_once( get_template_directory() . '/framework/customizer/fonts/regularfont.php'); 
	$regular_font_json = get_regularfont();
	$regfonts_array = json_decode($regular_font_json , TRUE);

	foreach ($regfonts_array['items'] as $key => $value) {
		$fonts[$value['family']]['label'] = $value['family'];
	}
	/* / REGULAR FONTS */



	/* GOOGLE FONTS */
	require_once( get_template_directory() . '/framework/customizer/fonts/webfont.php'); 
	$web_font_json = get_webfont(); 
	$webfonts_array = json_decode($web_font_json , TRUE);
	
	foreach ($webfonts_array['items'] as $key => $value) {
		$fonts[$value['family']]['label'] = $value['family'];
	}
	/* / GOOGLE FONTS */


}else{
	$fonts = get_transient( 'neko_array_fonts' );
}


/* Set transient if not exist */
if( empty( $cached_array_fonts ) ){
	set_transient( 'neko_array_fonts', $fonts, 0 );
}


//DEFAULT WEBFONT WEIGHT
$font_default_weights_options                       = array();				
$font_default_weights_options['100']['label']       = 'Thin 100';
$font_default_weights_options['100italic']['label'] = 'Thin 100 Italic';
$font_default_weights_options['200']['label']       = 'Extra-Light 200';
$font_default_weights_options['200italic']['label'] = 'Extra-Light 200 Italic';	
$font_default_weights_options['300']['label']       = 'Light 300';			
$font_default_weights_options['300italic']['label'] = 'Light 300 Italic';
$font_default_weights_options['regular']['label']   = 'Normal 400';
$font_default_weights_options['italic']['label']    = 'Normal 400 Italic';
$font_default_weights_options['500']['label']       = 'Medium 500';
$font_default_weights_options['500italic']['label'] = 'Medium 500 Italic';
$font_default_weights_options['600']['label']       = 'Semi-Bold 600';
$font_default_weights_options['600italic']['label'] = 'Semi-Bold 600 Italic';
$font_default_weights_options['700']['label']       = 'Bold 700';
$font_default_weights_options['700italic']['label'] = 'Bold 700 Italic';
$font_default_weights_options['800']['label']       = 'Extra-Bold 800';
$font_default_weights_options['800italic']['label'] = 'Extra-Bold 800 Italic';
$font_default_weights_options['900']['label']       = 'Ultra-Bold 900';
$font_default_weights_options['900italic']['label'] = 'Ultra-Bold 900 Italic';


/**
* Customizer options fo Typography 
*/


$options['typography_section'] =  array(

	'existing_section' => false,

	'args' => array(
		'title' => esc_html__( 'Typography', 'neko' ),
		'description' => '',
		'priority' => 3
		),

	'fields' => array(


		'main_desc' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),					
			'control_args' => array(
				'label' => esc_html__( 'Here you can set the font for your Neko theme. You have control over the family, the weight and the size for headings and body', 'neko' ),
				'type' => 'description',
				'priority' => 1
			)
		),

		'heading_font' => array(
			'setting_args' => array(
				'default' => 'Arial',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Headings font family', 'neko' ),
				'type' => 'select',
				'choices' => $fonts,
				'priority' => 2
				)
			),
		
		'h1_heading_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),					
			'control_args' => array(
				'label' => esc_html__( 'Sections title', 'neko' ),
				'type' => 'sub-title',
				'priority' => 8
			)
		),

		'h1_font_size' => array(
			'setting_args' => array(
				'default' => '44',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Font size', 'neko' ),
				'type' => 'number',
				'priority' => 9
				)
			),

		'h1_letter_spacing' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Letter spacing', 'neko' ),
				'type' => 'number',
				'priority' => 10
				)
			),

		'h1_letter_case' => array(
			'setting_args' => array(
				'default' => false,
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Upper case', 'neko' ),
				'type' => 'checkbox',
				'priority' => 11
				)
			),		
		
		'h1_font_weight' => array(
			'setting_args' => array(
				'default' => 'regular',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Font weight', 'neko' ),
				'type' => 'radio',
				'choices' => $font_default_weights_options,
				'priority' => 12
				)
			),


		'h2_heading_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),					
			'control_args' => array(
				'label' => esc_html__( 'Title 2 settings', 'neko' ),
				'type' => 'sub-title',
				'priority' => 13
			)
		),

		'h2_font_size' => array(
			'setting_args' => array(
				'default' => '33',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Font size', 'neko' ),
				'type' => 'number',
				'priority' => 14
				)
			),

		'h2_letter_spacing' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Letter spacing', 'neko' ),
				'type' => 'number',
				'priority' => 15
				)
			),

		'h2_letter_case' => array(
			'setting_args' => array(
				'default' => false,
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Upper case', 'neko' ),
				'type' => 'checkbox',	
				'priority' => 16
				)
			),	


		'h2_font_weight' => array(
			'setting_args' => array(
				'default' => 'regular',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Font weight', 'neko' ),
				'type' => 'radio',
				'choices' => $font_default_weights_options,
				'priority' => 17
				)
			),		

		'body_heading_title' => array(
			'setting_args' => array(
				'default' => '',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
			),					
			'control_args' => array(
				'label' => esc_html__( 'Body settings', 'neko' ),
				'type' => 'sub-title',
				'priority' => 18
			)
		),

		'body_font' => array(
			'setting_args' => array(
				'default' => 'Arial',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Font family', 'neko' ),
				'type' => 'select',
				'choices' => $fonts,
				'priority' => 19
				)
			),


		'body_font_size' => array(
			'setting_args' => array(
				'default' => '18',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Font size (default 18px)', 'neko' ),
				'type' => 'number',
				'priority' => 20
				)
			),

		'body_line_height' => array(

			'setting_args' => array(
				'default' => esc_html__( '1.5', 'neko' ),
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					

			'control_args' => array(
				'label' => esc_html__( 'Line height', 'neko' ),
				'type' => 'text', 
				'priority' => 21
				)
			),	



		'body_font_weight' => array(
			'setting_args' => array(
				'default' => 'regular',
				'type' => 'option',
				'capability' => $thsp_cbp_capability,
				'transport' => 'refresh',
				'sanitize_callback' => 'thsp_sanitize_cb'
				),					
			'control_args' => array(
				'label' => esc_html__( 'Font weight', 'neko' ),
				'type' => 'radio',
				'choices' => $font_default_weights_options,
				'priority' => 22
				)
			),
		)
)

?>