<?php
/**
 * Page header template.
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 **/
?>


<?php
global $customizerOptions;
$parallax_class = '';
$parallax_data  = '';
$class_mask     = '';
$blog_type	    = '';

if( neko_is_blog() ){	

	$display_header = ('on' === $customizerOptions['display_blog_header'] ) ? true : false ;


	$mask_opacity   = $customizerOptions['blog_header_mask_opacity'];

	if( '0' != $mask_opacity){
		$class_mask = 'mask-active';
	}

	if( isset($customizerOptions['parallax_blog_header']) && 'off' !== $customizerOptions['parallax_blog_header'] ){
		
		$parallax_class = 'neko-parallax-slice';

		$parallax_speed = $customizerOptions['parallax_blog_header'];

		$parallax_data  = 'data-type=background data-speed='.$parallax_speed;

	}

	if( true === $display_header ){

		$blog_type = 'blog';

		$neko_title_heading = $customizerOptions['blog_header_text'];

		if ( is_category() ) {

			$neko_title_heading = sprintf( esc_html__( 'Category %s', 'neko' ), '<span>' . single_cat_title( '', false ) . '</span>' ); 

		} elseif ( is_tag() ) {

			$neko_title_heading = sprintf( esc_html__( 'Tag Archives %s', 'neko' ), '<span>' . single_tag_title( '', false ) . '</span>' );

		} elseif ( is_author() ) {

			/*
			* Queue the first post, that way we know
			* what author we're dealing with (if that is the case).
			*/
			the_post();
			$neko_title_heading = sprintf( esc_html__( 'Author Archives %s', 'neko' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );

			/*
			* Since we called the_post() above, we need to
			* rewind the loop back to the beginning that way
			* we can run the loop properly, in full.
			*/
			rewind_posts();

		} elseif ( is_day() ){

			$neko_title_heading = sprintf( esc_html__( 'Daily Archives %s', 'neko' ), '<span>' . get_the_date() . '</span>' );

		} elseif ( is_month() ) {

			$neko_title_heading = sprintf( esc_html__( 'Monthly Archives %s', 'neko' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		} elseif ( is_year() ) {

			$neko_title_heading = sprintf( esc_html__( 'Yearly Archives %s', 'neko' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		} elseif ( is_search() ) {
			
			$neko_title_heading = sprintf( esc_html__( 'Search Results for %s', 'neko' ), '<span>' . get_search_query() . '</span>' );

		}elseif ( is_attachment() ) {

			$neko_title_heading = get_the_title();

		}
	

		/* Adjustment for transparent and semi-transparent heade and small page-header */
		$blog_header_size  = $customizerOptions['size_blog_header'];


		/* Transparency override */
		$page_for_posts = get_option( 'page_for_posts' );
		$nav_transparency_override = get_post_meta( $page_for_posts, 'neko_overrideheaderoption', true );
		$navbar_transparency_setting = ( !empty($nav_transparency_override) && 'emptylabel' !== $nav_transparency_override ) ? $nav_transparency_override : $customizerOptions['navbartransparency'] ;
		$extraDiv = ( ( 'small' == $blog_header_size || 'medium' == $blog_header_size ) && !empty($navbar_transparency_setting) && '1' !== $navbar_transparency_setting ) ? true : false ;

		if ( is_attachment() || is_single() ) {
			$extraDiv = null;
		}
		
	}


	if( is_single() && !is_attachment() ){

			$neko_use_defaultheader =  get_post_meta($post->ID, 'neko_page_header_display', true);

			if( 1 == $neko_use_defaultheader || !isset($neko_use_defaultheader) ){
				$display_header = true;

				$parallax_class     = '';
				$parallax_data      = '';
				$class_mask         = '';
				$blog_type          = 'blog';


				$neko_use_customtitle =  get_post_meta($post->ID, 'neko_post_header_default_title', true);
				$neko_customtitle =  get_post_meta($post->ID, 'neko_post_header_customtitle', true);
				$neko_subtitle =  get_post_meta($post->ID, 'neko_post_header_subtitle', true);

				if( isset($neko_use_customtitle) && 1 == $neko_use_customtitle && !empty($neko_customtitle) ){
					$neko_title_heading = $neko_customtitle;
				}else{
					$neko_title_heading = get_the_title();
				}

				if(!empty($neko_subtitle)){
					$neko_subtitle = '<span>'.$neko_subtitle.'</span>';
				}	

			}else{

					$display_header = false;

			}

		}


}elseif( is_page() || ( class_exists( 'WooCommerce' ) && is_shop() ) ){

	//$option_display_header = get_post_meta($post->ID, 'neko_page_header_display', true);
	$page_id = (  class_exists( 'WooCommerce' ) && is_shop() ) ? get_option( 'woocommerce_shop_page_id' ) : $post->ID ; 

	$display_header  = get_post_meta($page_id, 'neko_page_header_display', true);

	$blog_type = 'page';

	$neko_use_customtitle =  get_post_meta($page_id, 'neko_post_header_default_title', true);
	$neko_customtitle     =  get_post_meta($page_id, 'neko_post_header_customtitle', true);
	$neko_subtitle        =  get_post_meta($page_id, 'neko_post_header_subtitle', true);

	if( isset($neko_use_customtitle) && 1 == $neko_use_customtitle && !empty($neko_customtitle) ){
		$neko_title_heading = $neko_customtitle;
	}else{

		$neko_title_heading = ( class_exists( 'WooCommerce' ) && is_shop() ) ? esc_html__('shop', 'neko') : get_the_title();

	}

	if(!empty($neko_subtitle)){
		$neko_subtitle = '<span>'.$neko_subtitle.'</span>';
	}else{
		$neko_subtitle = '';
	}



}else if(  class_exists( 'WooCommerce' ) && !is_shop() ){

	$display_header = true;
	$blog_type = 'page';

	if( is_product_category() || is_product() ){

		$neko_title_heading =  woocommerce_page_title( $echo = false );

	}



}

?>

<?php if( true == $display_header){ ?>

	<header class="neko-page-header <?php echo esc_attr($parallax_class); ?> page-header <?php echo esc_attr($class_mask); ?>" <?php echo esc_attr( $parallax_data ); ?> >
		<div class="container">
			<div class="row">

				<!-- EXTRA DIV  -->
				<?php  if( !empty($extraDiv) ) { ?>
					<div class="header-pusher"></div>
				<?php } ?>
				<!-- / EXTRA DIV  -->	

				<?php /* BLOG LOOP */ if( 'blog' === $blog_type && !is_single() ) { ?>

					<div class="col-md-12">
						<h1 class="big-heading">
							<?php echo wp_kses_post($neko_title_heading); ?>
						</h1>
					</div>


				<?php /* BLOG SINGLE */  }elseif( 'blog' === $blog_type && is_single() ) { ?>
						<div class="col-md-12">
							<h1 class="noMargin"><?php echo wp_kses_post($neko_title_heading); ?></h1>
						</div>

				<?php /* PAGES & WOO COMMERCE */  } else { ?>

					<div class="col-md-6">
						<h1>
							<?php echo wp_kses_post($neko_title_heading); ?>
							<?php  if( !empty($neko_subtitle) ){ echo wp_kses_post($neko_subtitle);  } ?>
						</h1>
					</div>

					<div class="col-md-6">
						<div class="header-navtrail">

							<?php	
							if( class_exists( 'WooCommerce' ) && is_woocommerce() ){

								$args = array( 'delimiter' => '<span class="delimiter">/</span>');
								woocommerce_breadcrumb( $args );

							}elseif ( is_single() ){
						
								/*
								<div id="breadcrumb" class="neko-single-breadcrum">
																		
									<a href="http://neko-demo.com/edena"> <?php esc_html_e('Home', 'neko'); ?> </a>
									<span class="delimiter">/</span> 
							
									<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"> <?php esc_html_e('blog', 'neko'); ?> </a>
									<span class="delimiter">/</span>
									<span class="current-page"><?php echo wp_kses_post($neko_title_heading); ?></span>
								</div>
								*/
							
							}else{
								wp_nav_menu( 
									array(
										'theme_location'  => 'primary',
										'container' => 'none', 
										'depth' => 0,
										'walker'=> new neko_BreadCrumbWalker, 
										'items_wrap' => '<div id="breadcrumb" class="%2$s">%3$s</div>'
										)
									);
							}

							?>

						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</header>

<?php } ?>