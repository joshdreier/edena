<?php


function neko_import_google_font(){

	$customizerOptions  =  thsp_cbp_get_options_values();

	$regFontName = array(
		'Arial',
		'Arial Black',
		'Comic Sans MS',
		'Impact',
		'Lucida Sans Unicode',
		'Tahoma',
		'Trebuchet MS',
		'Verdana',
		'Georgia',
		'Palatino Linotype',
		'Times New Roman',
		'Courier New',
		'Lucida Console'
	);

	$headings_font = (  !empty($customizerOptions['heading_font']) && !in_array($customizerOptions['heading_font'], $regFontName))?str_replace(' ','+',$customizerOptions['heading_font']):null; 
	$body_font     = (  !empty($customizerOptions['body_font']) && !in_array($customizerOptions['body_font'], $regFontName) )?str_replace(' ','+',$customizerOptions['body_font']):null; 

	$arrayFont = array_values(array_filter(array_unique(array($headings_font, $body_font )), 'strlen'));
	$nbWebFont = sizeof($arrayFont);
	//echo '<pre>'; print_r($arrayFont); echo '</pre>'; 


	//font weight
	$h1_font_weight   = ( !empty($customizerOptions['h1_font_weight']) && !empty($customizerOptions['heading_font']) && !in_array($customizerOptions['heading_font'], $regFontName) )? $customizerOptions['h1_font_weight'] : null; 	
	$h2_font_weight   = ( !empty($customizerOptions['h2_font_weight']) && !empty($customizerOptions['heading_font'])  && !in_array($customizerOptions['heading_font'], $regFontName) )? $customizerOptions['h2_font_weight'] : null; 
	$body_font_weight = ( !empty($customizerOptions['body_font_weight']) && !empty($customizerOptions['body_font']) && !in_array($customizerOptions['body_font'], $regFontName) )? $customizerOptions['body_font_weight'] : null;

	$embededFont ='';
	$patterns = array('/regular/', '/@\s(.*)italic\s/sm');
	$replacements = array('400', '400italic');

	if($nbWebFont > 1){

		$headingWeight = array_filter(array_unique(array($h1_font_weight, $h2_font_weight, $body_font_weight)), 'strlen');
		
		$headingWeight = preg_replace($patterns, $replacements, implode(',', $headingWeight));

		
		$headingWeight = ($headingWeight === 400)?'':$headingWeight;

		$bodyWeight = preg_replace($patterns, $replacements, $body_font_weight);
		$bodyWeight = ($bodyWeight === 400)?'':$bodyWeight;


		foreach ($arrayFont as $keyFont => $valueFont) {

			if($keyFont == 0)
			$embededFont .=  $valueFont.':'.$headingWeight.'|';
			else
			$embededFont .=  $valueFont.':'.$bodyWeight;	
		}

	}else{

	    $fontWeight = array_filter(array_unique(array($h1_font_weight, $h2_font_weight, $body_font_weight)), 'strlen');


	    $fontWeight = preg_replace($patterns, $replacements, implode(',', $fontWeight));

	    if (!empty($arrayFont))
	    {
	    	$embededFont =$arrayFont[0].':'.$fontWeight;
	    }
	    
	}
	
	if(!empty($arrayFont))
	$font_link ='//fonts.googleapis.com/css?family='. $embededFont .'&subset=latin,latin-ext' ;
	else
	$font_link ='';
	

	return $font_link;

}


function load_fonts() {
    wp_register_style('googleFonts', neko_import_google_font());
    wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'load_fonts');	

?>