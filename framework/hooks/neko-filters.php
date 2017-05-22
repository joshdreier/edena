<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
* add all the custom sizes to the built-in sizes
* @since neko-framework 1.0
*/



if ( ! function_exists( 'neko_insert_custom_image_sizes' ) ){

	function neko_insert_custom_image_sizes(){
		
 		/**
 		 * GLOBALS
 		 */
 		global $_wp_additional_image_sizes;
 		
 		$image_sizes['full']      = 'Full Size';
 		$image_sizes['large']     = 'Large';
 		$image_sizes['medium']    = 'Medium';
 		$image_sizes['thumbnail'] = 'Thumbnail';

 		foreach ( $_wp_additional_image_sizes as $id => $data ) {
 			/* take the size ID (e.g., 'my-name'), replace hyphens with spaces, */
 			/* and capitalise the first letter of each word */
 			if ( !isset($image_sizes[$id]) )
 				$image_sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
 		}


 		
 		return $image_sizes;

 	}

 	add_filter( 'image_size_names_choose', 'neko_insert_custom_image_sizes' );

 }



/**
* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
* @since neko-framework 1.0
*/
if(!function_exists('neko_page_menu_args')){
	function neko_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}

	add_filter( 'wp_page_menu_args', 'neko_page_menu_args' );
}


/**
* Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
* @since neko-framework 1.0
*/
if(!function_exists('neko_enhanced_image_navigation')){
	function neko_enhanced_image_navigation( $url, $id ) {
		if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
			return $url;

		$image = get_post( $id );
		if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
			$url .= '#main';

		return $url;
	}
	add_filter( 'attachment_link', 'neko_enhanced_image_navigation', 10, 2 );
}


/**
* Filters tag_cloud widget font sizes.
* @since neko-framework 1.1
*/
if(!function_exists('set_tag_cloud_sizes')){
	function set_tag_cloud_sizes($args) {
		$args['smallest'] = 11;
		$args['largest'] = 11;
		return $args; 
	}
	add_filter('widget_tag_cloud_args','set_tag_cloud_sizes');
}


/**
 * Customizer options
 */
if(!function_exists('neko_layout_body_classes')){

	function neko_layout_body_classes( $classes ) {

		global $post;

		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if(neko_is_blog() && !is_single()){
			$classes[] = 'neko-page-blog';
		}

		$customizerOptions = thsp_cbp_get_options_values();

		/* Header option */
		if(!empty($customizerOptions['navbarposition']) && 'navbar-fixed-top' === $customizerOptions['navbarposition']){
			$classes[] = 'fixedMenu';
		}

		/* sub menu color */

		if(!empty($customizerOptions['navbarsubmenustyle']) &&  'dark' === $customizerOptions['navbarsubmenustyle']){
			$classes[] = 'neko-dark-sub-menu';
		}


		/* layout option */
		if(!empty($customizerOptions['bodylayout'])) {

			if ('boxed' === $customizerOptions['bodylayout']){
				$classes[] = 'boxed-layout';
			} elseif ('sidemenu' === $customizerOptions['bodylayout']){
				$classes[] = 'side-menu';
			}
			
		}

		/* parallaxed-footer */
		if(!empty($customizerOptions['footertype']) && 'fixed' === $customizerOptions['footertype']){
			$classes[] = 'fixed-footer';
		}

		/* transparency override in page and posts */
		if( neko_is_blog() && !is_single()){

			$display_header = ('on' === $customizerOptions['display_blog_header'] ) ? true : false ;	

			if( $display_header ){
				$page_for_posts = get_option( 'page_for_posts' );
				$nav_transparency_override = get_post_meta( $page_for_posts, 'neko_overrideheaderoption', true );
			}else{
				$nav_transparency_override = '1';	
			}

		}elseif( is_attachment()){	

			$nav_transparency_override = '1';

		}else{

			$nav_transparency_override = get_post_meta( get_the_ID(), 'neko_overrideheaderoption', true );

		}
		

		/* defines priority for transparency settings ( override first => customizer option )*/
		$navbar_transparency_setting = ( !empty($nav_transparency_override) && 'emptylabel' !== $nav_transparency_override ) ? $nav_transparency_override : $customizerOptions['navbartransparency'] ;
		$nav_transparency = (!empty($navbar_transparency_setting) && '1' !== $navbar_transparency_setting )?'transparent':'opaque';
		


		$classes[]        = 'header-'.$nav_transparency;
		$nav_style        = (!empty($customizerOptions['navbarstyle']))?$customizerOptions['navbarstyle']:'default';
		$classes[]        = 'header-'.$nav_style;

		return $classes;
	}

	add_filter( 'body_class', 'neko_layout_body_classes' );

}


/**
* Remove default wordpress gallery styling
* @since neko-framework 1.1
*/

add_filter( 'use_default_gallery_style', '__return_false' );

/**
* Add shortcode support in widgets
* @since neko-framework 1.1
*/

add_filter('widget_text', 'do_shortcode');



/**
 * Generate colums for sidebar widget
 */


if( !function_exists('neko_sidebar_params') ){

	function neko_sidebar_params($params) {
		
		$sidebar_id = $params[0]['id'];
		$customizerOptions = thsp_cbp_get_options_values();

		if ( /* 'footer-area' == $sidebar_id && 'column' === $customizerOptions['footerlayout'] || */ 'home-widget-content' == $sidebar_id ) {

			$total_widgets = wp_get_sidebars_widgets();
			$sidebar_widgets = count($total_widgets[$sidebar_id]);

			$params[0]['before_widget'] = str_replace('class="', 'class="clearfix col-md-' . floor(12 / $sidebar_widgets) . ' ', $params[0]['before_widget']);
		}

		return $params;
	}

	add_filter('dynamic_sidebar_params','neko_sidebar_params');
}



/**
 * Add .ico upload
 */

add_filter( 'upload_mimes', 'add_upload_mimes', 99999 );
/*Add Ico File Extension to Allowed Mimes*/
function add_upload_mimes( $site_mimes ) {
	if (isset($site_mimes['ico'])  === false) $site_mimes['ico'] = 'image/vnd.microsoft.icon';
	if (isset($site_mimes['json']) === false) $site_mimes['json'] = 'application/json';
	if (isset($site_mimes['svg'])  === false) $site_mimes[ 'svg' ] = "image/svg+xml ";
	return $site_mimes;
}



/**
 * Custom read more
 */
if(!function_exists('neko_modify_read_more_link')){
	
	function neko_modify_read_more_link() {
		return '<div><a class="more-link" href="'. get_permalink( get_the_ID() ). '">'._x( 'Read more', 'button',  'neko' ).'</a></div>';
	}
	add_filter( 'the_content_more_link', 'neko_modify_read_more_link' );

}


/**
 * neko_excerpt_more
 */
if(!function_exists('neko_excerpt_more')){
	function neko_excerpt_more($more) {
		return '';
	}
	add_filter( 'excerpt_more', 'neko_excerpt_more' );
	//add_filter( 'get_the_excerpt', 'neko_excerpt_more' );
}



/**
 * remove read more from excerpt
 */

if(!function_exists('neko_excerpt_read_more_link')){

function neko_excerpt_read_more_link( $output ) {

	if ( is_search() ) {

		global $post;
		return $output . '<div><a href="' . get_permalink( $post->ID ) . '" class="more-link" >'._x( 'Read more', 'button',  'neko' ).'</a></div>' ;

	}else{

		return $output;

	}
}

add_filter( 'get_the_excerpt', 'neko_excerpt_read_more_link' );
}



/**
 * no header class to body
 */
if(!function_exists('neko_body_classes_no_header')){

	function neko_body_classes_no_header( $classes ) {

		if(neko_is_blog()){

			if(  is_single() ){
				global $post;
				$neko_use_defaultheader =  get_post_meta($post->ID, 'neko_page_header_display', true);
				if( 1 == $neko_use_defaultheader || !isset($neko_use_defaultheader) ){
					$header_type = 'neko-blog-header'; 
				}


			}else{
				$header_type = 'neko-blog-header'; 
			}
			


		}else{
			$header_type =  get_post_meta(get_the_ID(), 'neko_post_header_type', true);
		}
		

		$classes[] = ( !empty( $header_type )  ) ? $header_type : 'no-page-header';

		return $classes;
	}
	add_filter( 'body_class', 'neko_body_classes_no_header' );
}
	

/**
 * Add id to media library list
 * rest is in neko_actions.php
 */
if( !function_exists('neko_posts_columns_attachment_id') ){
	function neko_posts_columns_attachment_id($defaults){
	    $defaults['wps_post_attachments_id'] = esc_html__('ID', 'neko');

	    return $defaults;
	}
	add_filter('manage_media_columns', 'neko_posts_columns_attachment_id', 1);	
}

/**
 * Fix crappy archive widget output
 * 
 */
if( !function_exists('neko_fix_widget_archives_output') ){
	function neko_fix_widget_archives_output($link_html) {
		$link_html = str_replace('</a>', '', $link_html);
		$link_html = str_replace('</li>', '</a></li>', $link_html);
		return $link_html;
	}
	add_filter('get_archives_link', 'neko_fix_widget_archives_output');
}


/**
 * Fix crappy categories widget output
 */

if( !function_exists('neko_fix_widget_categories_output') ){
	function neko_fix_widget_categories_output($output) {
		$output = str_replace('</a> (','<span>&nbsp;(',$output);
			$output = str_replace(')',')</span></a> ',$output);
			return $output;
		}
		add_filter('wp_list_categories', 'neko_fix_widget_categories_output');
	}



/**
 * Add allowed css style attr to default allowed inline css
 */

if( !function_exists('neko_wp_kses_custom_allowed') ){
	add_filter( 'safe_style_css', 'neko_wp_kses_custom_allowed');

	function neko_wp_kses_custom_allowed( $styles ) {
	    $styles[] = 'opacity';
	    $styles[] = 'background-image';
	    $styles[] = 'display';
	    $styles[] = 'transition';
	    $styles[] = 'transform';
	    $styles[] = 'transform-origin';
	    $styles[] = 'position';
	    $styles[] = 'left';
	    $styles[] = 'right';
	    $styles[] = 'top';
	    $styles[] = 'bottom';
	    return $styles;
	} 	
}

/**
 * Kill canonical redirect for pagination and prettylink
 */
if( !function_exists('neko_redirect_canonical') ){

	function neko_redirect_canonical($redirect_url, $requested_url) { 
		$do_redirect = true; 
		if(preg_match('/page/',$requested_url)){
			$do_redirect = false; 
		}
		return $do_redirect; 
	} 
	add_filter('redirect_canonical', 'neko_redirect_canonical', 10, 2); 
}