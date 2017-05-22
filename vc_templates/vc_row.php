<?php
$atts = vc_map_get_attributes( 'vc_row', $atts );
extract($atts);
//echo '<pre>'; print_r($atts); echo '</pre>';


$el_class = $this->getExtraClass( $el_class );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' 
	. ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) 
	//. get_row_css_class() 
	. $el_class
	. vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts 
);



/**
 * Switch for section & content width
 */
switch ($full_width) {

	case 'stretch_row_content':
	$container_open = 'container-fluid';
	break;

	case 'stretch_row_content_no_spaces':
	$container_open = 'container-fluid no-gutter';
	break;

	default:
	$container_open = 'container';
	break;
}	


/**
 * Type parallax
 */
$parallax_class = '';
$parallax_data = '';
if('parallax' === $neko_section_type){
	$parallax_class = 'neko-parallax-slice';
	$parallax_speed = ( !empty($neko_parallax_option) || '0' == $neko_parallax_option  ) ? $neko_parallax_option : 10 ;
	$wrapper_attributes[] = 'data-type="background" data-speed="'.esc_attr($parallax_speed).'"';
}

/**
 * Type video
 */
$video_on   = false;
if('video' === $neko_section_type){
	$video_on   = true;
	$video_mute_state = ( 'on' === $neko_video_mute ) ? 'true' : 'false' ;
	$video_loop_state = ( 'on' === $neko_video_loop ) ? 'true' : 'false' ;

}

/**
 * Type table
 */
$class_row = '';
if('neko-table-container' === $neko_section_type){
	$container_open = $container_open.' neko-table-container';
	$class_row = "vc_row-o-equal-height vc_row-flex";
}


/**
 * Type fullscreen
 */
$fullscreen = '';
if('fullscreen' === $neko_section_type){
	$fullscreen = 'nk-fullscreen';
}

/**
 * Overlay options
 */
$mask_on   = false;
if('off' !== $neko_mask_activation){
	$mask_on   = true;
}


?>

<section <?php echo implode( ' ', $wrapper_attributes ); ?> class="<?php echo esc_attr($parallax_class) ?> <?php echo esc_attr($css_class);?> <?php echo esc_attr($fullscreen); ?>" >
	
	<?php if( !empty($video_on) ) { ?>
		<!-- VIDEO -->
		<div class="youtube-video-bg" data-property="{videoURL:'http://youtu.be/<?php echo esc_url( $neko_video_yt_id ); ?>',containment:'self',startAt:0,autoPlay:true,loop:<?php echo esc_attr( $video_loop_state ); ?>,opacity:1,mute:<?php echo esc_attr( $video_mute_state ); ?>,showControls:false,showYTLogo:false}"> 
		</div>
		<!-- / VIDEO  -->
	<?php } ?>
	

	
	<?php if( !empty($mask_on) ) { ?>
		<!-- MASK / OVERLAY  -->
		<div class="mask-on" style="background-color:<?php echo esc_attr( $neko_mask_color ); ?>"></div>
		<!-- / MASK / OVERLAY  -->
	<?php } ?>
	

	<div class="<?php echo esc_attr($container_open)?> neko-container">
		<div class="vc_row <?php echo esc_attr($class_row)?>">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
		</div>
	</div>
</section>

<?php echo trim( $this->endBlockComment( 'row' ) );