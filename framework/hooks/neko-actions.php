<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since neko-framework 1.0
 */

if ( ! function_exists( 'neko_setup' ) ){

		function neko_setup() {

		global $wp_version;	

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */

		load_theme_textdomain( 'neko', get_stylesheet_directory() . '/languages' );
		//echo get_locale();
		//load_theme_textdomain( 'neko', WP_CONTENT_DIR . '/languages' );

		/* Add default posts and comments RSS feed links to head */
		add_theme_support( 'automatic-feed-links' ); 


		/* Enable support for Post Thumbnails */
		add_theme_support( 'post-thumbnails' );

		add_theme_support( "title-tag" );

	    /* Custom image size */
	    if ( function_exists( 'add_image_size' ) ) {

			add_image_size( 'img-xx-large-ms', 1140  );
			add_image_size( 'img-xx-large', 1140,  800, true );
			add_image_size( 'img-x-large-ms', 750 );
			add_image_size( 'img-x-large', 750, 526, true );
			add_image_size( 'img-large', 570, 400, true );
			add_image_size( 'img-large-ms', 570 );
			add_image_size( 'img-medium', 368, 258, true );
			add_image_size( 'img-medium-ms', 368 );
			add_image_size( 'img-small', 270, 189, true );
			add_image_size( 'img-small-ms', 270);
			add_image_size( 'img-x-small', 62, 62, true);
			add_image_size( 'img-admin-thumbnail',  100, 100, true );

	    }


		/* This theme uses wp_nav_menu() in one location. */
		register_nav_menus( 
			array(
				'primary' => esc_html__( 'Primary Menu', 'neko' ),
			) 
		);

		/* Enable support for Post Formats */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'status', 'gallery' ) );

		/* woocommerce support */
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'neko_setup' );
} 

/**
 * Backwards compatibility for older versions for title-tag
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function neko_theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'neko_theme_slug_render_title' );
}

/**
 * Register widgetized area and update sidebar with default widgets
 * @since neko-framework 1.0
 */

if ( ! function_exists( 'neko_widgets_init' ) ){
	function neko_widgets_init() {

		$customizerOptions = thsp_cbp_get_options_values();

		/* Blog */
		register_sidebar( array(
			'name'          => esc_html__( 'Blog sidebar', 'neko' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '<span></span></h3>',
			));


		/* Home widgets bar */
		$activate_home_widgetbar = ( !empty( $customizerOptions['neko_home_widgets_bar'] ) ) ? $customizerOptions['neko_home_widgets_bar'] : false;
		if('on' === $activate_home_widgetbar){
			register_sidebar( array(
				'name'          => esc_html__( 'Home content widget bar', 'neko' ),
				'id'            => 'home-widget-content',
				'description'   => 'Appears in the content of your static homepage',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="home-widget-title">',
				'after_title'   => '</h3>',
				));
		}

		/* pre header sidebar */
		$activate_hpreheader_widgetbar = ( !empty( $customizerOptions['neko_header_preheader'] ) ) ? $customizerOptions['neko_header_preheader'] : false ;
		if('on' === $activate_hpreheader_widgetbar){

			register_sidebar( array(
				'name'          => esc_html__( 'Preheader widget bar left', 'neko' ),
				'id'            => 'preheader-widget-content-left',
				'description'   => 'Appears in the prehead bar (left side)',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="home-widget-title">',
				'after_title'   => '</h3>',
				));

			register_sidebar( array(
				'name'          => esc_html__( 'Preheader widget bar right', 'neko' ),
				'id'            => 'preheader-widget-content-right',
				'description'   => 'Appears in the prehead bar (right side)',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="home-widget-title">',
				'after_title'   => '</h3>',
				));	
		}

		/* Footer */
		$footer_layout = ( !empty( $customizerOptions['footerlayout'] ) ) ? $customizerOptions['footerlayout'] : 'full' ;



		switch ($footer_layout) {
			case 'full':
				$nb_footer_col = 1;
				break;

			case '3cols':
				$nb_footer_col = 3;
				break;

			case '4cols':
				$nb_footer_col = 4;
				break;

			case '2tier1tier':
			case '1tier2tier':
				$nb_footer_col = 2;
				break;	

			case '1demi1demi':
				$nb_footer_col = 2;
				break;	

			default:
				$nb_footer_col = 1;
				break;
		}

		for ($i=1; $i <= $nb_footer_col ; $i++) { 
			register_sidebar( 
				array(
					'name'          => esc_html__( 'Footer column ', 'neko' ).$i,
					'id'            => 'footer-area-'.$i,
					'description'   => 'All widgets placed here will appear in the column '.$i.' of the footer',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3>',
					'after_title'   => '</h3>',
				)
			);
		}

		/** WOOCOMMERCE **/
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( 
				array(
					'name'          => esc_html__( 'Woocommerce sibebar', 'neko' ),
					'id'            => 'woocommerce-area',
					'description'   => 'All widgets placed here will appear on woocommerce shop page ',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3>',
					'after_title'   => '</h3>',
					)
				);
		}
	}

	add_action( 'widgets_init', 'neko_widgets_init' );

}


/**
 * Add Custom Favicon
 */

if ( ! function_exists( 'neko_custom_style' ) ){
	function neko_custom_style() {
		/*** styles ***/
		echo '
		<!--option styles-->
		<style type="text/css" media="all" title="nk-custom-style">'.neko_get_custom_styles().'</style>
		<!--option styles-->
		';

	}
	add_action( 'wp_head', 'neko_custom_style' );
}


/**
 * Add Google Analytics
 */
if ( ! function_exists( 'neko_ga_tracking' ) ){
	function neko_ga_tracking() {
		$customizerOptions = thsp_cbp_get_options_values();
		echo  '<script>'.$customizerOptions['ga_tracking'].'</script>'."\r\n";
	}
	add_action( 'wp_footer', 'neko_ga_tracking' );
}




/**
 * redirect on 404
 */
if(!function_exists('neko_redirect_404')){
	function neko_redirect_404() {
		global $wp_query, $customizerOptions;
		$page_404_id = $customizerOptions['error_404_page'];

		if ($wp_query->is_404) {
			$page_title = get_the_title( $page_404_id );
			if(get_page($page_404_id)){
				$redirect_404_url = esc_url(get_permalink(get_page($page_404_id))); 
				wp_redirect( $redirect_404_url );
			}else{
				return;
			}
			exit();	
		}
	}
	add_action( 'template_redirect', 'neko_redirect_404');
}

/**
 * Make sure proper 404 status code is returned
 */
if(!function_exists('neko_is_page_function')){
	function neko_is_page_function() {
		global $customizerOptions;
		$page_404_id = $customizerOptions['error_404_page'];
		$page_title = get_the_title( $page_404_id );
		if (is_page($page_404_id)) {
			header("Status: 404 Not Found");
		}
		else {
			return;
		}
	}

	add_action('template_redirect', 'neko_is_page_function');
}

/**
 * Rewrite search url for pretty url 
 */
$permalink_structure = get_option('permalink_structure');

if( !function_exists('neko_search_url_rewrite_rule') && !empty($permalink_structure) ){
	function neko_search_url_rewrite_rule() {
		if ( is_search() ) {

			if(!empty($_GET['s'])){
				wp_redirect(home_url("/search/") . urlencode(get_query_var('s')) .'/' );
				exit();
			}

		}
	}
	add_action('template_redirect', 'neko_search_url_rewrite_rule');
}

/**
 * Fixes empty search
 */
if( !is_admin() && !function_exists('neko_search_query_fix') && !empty($permalink_structure) ){

    function neko_search_query_fix(){
        if(isset($_GET['s']) && $_GET['s']==''){
            $_GET['s']=' ';
        }
    }
    add_action('init', 'neko_search_query_fix');
}


/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( !function_exists('neko_vcSetAsTheme') ){

	function neko_vcSetAsTheme() {
	    vc_set_as_theme( $disable_updater = true );
	}
	add_action( 'vc_before_init', 'neko_vcSetAsTheme' );

}

if( !function_exists('neko_vc_remove_frontend_links') ){

	function neko_vc_remove_frontend_links() {
		vc_disable_frontend(); /* this will disable frontend editor */
	}
	add_action( 'vc_after_init', 'neko_vc_remove_frontend_links' );
	
}


/**
 * Add id to media library list
 * rest is in neko_filters.php
 */
if( !function_exists('neko_posts_custom_columns_attachment_id') ){
	function neko_posts_custom_columns_attachment_id($column_name, $id){
	        if($column_name === 'wps_post_attachments_id'){
	        echo intval( $id );
	    }
	}
	add_action('manage_media_custom_column', 'neko_posts_custom_columns_attachment_id', 1, 2);
}

/**
 * Revolution slider
 */

if(!function_exists( 'neko_rs_bundle' )){

	function neko_rs_bundle() {
		
		if(function_exists( 'set_revslider_as_theme' )){
			set_revslider_as_theme();
			add_action( 'init', 'neko_rs_bundle' );
		}
	}
}
