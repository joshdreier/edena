<?php
/**
 * The template part for displaying the header.
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 10]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1.0, width=device-width, maximum-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!-- <link rel="stylesheet" href="http://basehold.it/26"> -->

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->

    <?php wp_head(); ?>

  </head>
  <?php 

  $customizerOptions = thsp_cbp_get_options_values();

  /* Scroll spy if needed */
  $header_offset   = $customizerOptions['logo_height'] + 57;
  $offset_adminbar = (is_admin_bar_showing())?32:0;
  $offsetscrollspy = $header_offset + $offset_adminbar;
  $data_scrollspy = 'data-spy="scroll" data-target="#main-menu" data-offset="'.$offsetscrollspy.'"';
  /* END Scroll spy if needed */

// Header Options
  if( neko_is_blog() && !is_single() ){
  	$page_for_posts = get_option( 'page_for_posts' );
  	$main_header_position_override = get_post_meta( $page_for_posts, 'neko_overrideheaderposition', true );
  }else{
  	$main_header_position_override = get_post_meta( get_the_ID(), 'neko_overrideheaderposition', true );
  }


  $main_header_position_final = ( !empty($main_header_position_override) && 'emptylabel' !== $main_header_position_override ) ? $main_header_position_override : $customizerOptions['navbarposition'] ;
  $main_header_position       = ( !empty( $main_header_position_final ) ) ? $main_header_position_final : 'navbar-static-top' ;

  $page_preloader    =  get_post_meta( get_the_ID(), 'neko_page_preloader', true );
  $preloader         =  ( !empty($page_preloader) && 'on' == $page_preloader ) ? $page_preloader : $customizerOptions['preload'];
  $preloader_class   =  ( !empty($customizerOptions['preloader_selector']) && 'none' !== $customizerOptions['preloader_selector'] ) ? $customizerOptions['preloader_selector'] : 'signal'; 

  ?>

  <body <?php body_class(); ?> > 

  	<?php if ('on' === $preloader) { ?>
  	<!-- Preloader -->
  	<div id="preloader">
  		<div id="status" class="<?php echo esc_attr($preloader_class); ?>-loader">
  			<?php if ('dots' === $preloader_class){ ?>
  			<i></i>
  			<i></i>
  			<i></i>
  			<?php }elseif('underline' === $preloader_class){  ?>
  			<?php esc_html_e('loading', 'neko'); ?>
  			<?php } ?>
  		</div>
  		<div id="status-ie"></div>
  	</div>
  	<!-- Preloader -->
  	<?php } ?>



  	<div id="global-wrapper">	

  		<?php do_action( 'before' ); ?>

  		<header class="<?php echo esc_attr($main_header_position);?>" id="mainHeader">

  			<?php if('on' == $customizerOptions['neko_header_preheader'] && ( is_active_sidebar( 'preheader-widget-content-left') || is_active_sidebar( 'preheader-widget-content-right') )){ 

  				$class_first_col = ( is_active_sidebar( 'preheader-widget-content-left') ) ? 'col-md-6 neko-preheader-content-left' : 'col-md-12' ;
  				$class_second_col = ( is_active_sidebar( 'preheader-widget-content-right') ) ? 'col-md-6 neko-preheader-content-right' : 'col-md-12' ;
  				$auto_hide_on_scroll = ( !empty( $customizerOptions['neko_header_preheader_autohide'] ) && 'on' === $customizerOptions['neko_header_preheader_autohide'] ) ? 'nk-autohide-scroll' : '' ;
  				?>
  				<div id="neko-preheader" class="<?php echo esc_attr($auto_hide_on_scroll); ?>">
  					<div class="container">
  						<div class="row">

  							<div class="<?php echo esc_attr($class_first_col); ?>">
  								<?php dynamic_sidebar('preheader-widget-content-left'); ?>
  							</div>

  							<div class="<?php echo esc_attr($class_second_col); ?>">
  								<?php dynamic_sidebar('preheader-widget-content-right'); ?>
  							</div>

  						</div>
  					</div>
  				</div>
  				<?php } ?>

  				<div class="container">

  					<nav class="navbar navbar-default">
  						<div class="navbar-header">
  							<!-- responsive navigation -->
  							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  								<span class="sr-only">Toggle navigation</span>
  								<span class="icon-bar"></span>
  								<span class="icon-bar"></span>
  								<span class="icon-bar"></span>
  							</button>
  							<!-- Logo -->
  							<a href="<?php echo esc_url(home_url()); ?>" title="<?php echo get_bloginfo('name'); ?>" class="brand navbar-brand">
  								<span><?php echo get_bloginfo('name'); ?></span>
  							</a>
  						</div>


  						<!-- <div class="collapse navbar-collapse navbar-right"> -->
  						<div class="collapse navbar-collapse">
  							<!-- Social bar -->
  							<?php 
  							$socialbar_activation = $customizerOptions['neko_header_social_activation'];
  							$socialbar_user = $customizerOptions['neko_header_social_user'];

  							if(!empty($socialbar_activation) && 'on' === $socialbar_activation && !empty($socialbar_user) ){  ?> 

  							<?php 
  							echo neko_socialbar(
  								$customizerOptions['neko_header_social_user'], 
  								$class_icon_size = '', 
  								$class_icon_rounded = 'icon-rounded',
  								$position_bar = 'navbar-right',
  								$position_tips = 'bottom'
  								); 
  								?>

  								<?php  } ?>
  								<!-- End Social bar -->	

  								<!-- Main navigation -->
  								<?php 
  								wp_nav_menu( 
  									array(
  										'theme_location'  => 'primary',
  										'container'       => 'div', 
  										'container_class' => 'navbar-right', 
  										'container_id'    => 'main-menu',  
  										'menu_class'      => 'nav navbar-nav navbar-right',
  										'walker'          =>  new Neko_Menu_Walker_Nav_Menu(),
  										'fallback_cb'     => 'Neko_Menu_Walker_Nav_Menu::neko_empty_menu', 
  										)
  									);
  									?>
  									<!-- End main navigation -->
  								</div>
  							</nav>
  						</div>
  					</header>
  					<!-- content -->

