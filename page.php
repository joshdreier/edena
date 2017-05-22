<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */
$customizerOptions = thsp_cbp_get_options_values();
$position = neko_get_sidebar_layout();
$total_featured_img = $customizerOptions['nbfeaturedimg'];
/* Home vars */
$content_position   = ( !empty($customizerOptions['neko_content_position']) && is_front_page() )?$customizerOptions['neko_content_position']:'belowheader';
$widget_state       = ( !empty($customizerOptions['neko_home_widgets_bar']) && is_front_page() )?$customizerOptions['neko_home_widgets_bar']:'off';
$widget_position    = ( !empty($customizerOptions['neko_wbar_position']) )?$customizerOptions['neko_wbar_position']:'belowheader';
$blog_state         = ( !empty($customizerOptions['neko_home_blog']) && is_front_page() )?$customizerOptions['neko_home_blog']:'off';

$neko_blog_layout   = ( !empty($customizerOptions['neko_home_blog_layout']) )?$customizerOptions['neko_home_blog_layout']:'';
//$neko_position_blog = 'no-sidebar';

$vc_enabled = neko_check_vc_status( get_the_ID() );
$neko_no_vc_class = ( empty($vc_enabled) ) ? 'neko-page-default' : '' ; 

get_header();
//get_template_part( 'page', 'customizable_header'); 
get_template_part( 'page', 'header'); 

$main_container_class = ( 'grid' == $neko_blog_layout || 'twoblocs' == $neko_blog_layout )?'container-fluid':'container';
$neko_toggle_grid = ( $position == 'no-sidebar' ) ? 'col-md-12' : 'col-md-9';

?>


<main id="content" class="site-content <?php  echo esc_attr($neko_no_vc_class); ?>">


	<div id="primary" class="content-area">
	
		<?php if( empty($vc_enabled) ) {  ?>
		<div class="container">
		<?php 	} ?>

			<?php if( 'belowheader' === $content_position || !empty($vc_enabled) ){ ?>

					<?php if( empty($vc_enabled) ) {  ?>
					<div class="row">
						<div class="<?php echo esc_attr( $neko_toggle_grid ); ?><?php if('left' == $position ){?> col-md-push-3 <?php }?>">
					<?php 	} ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>

						<?php if( !empty($vc_enabled) && comments_open() ) {  ?>
						<div class="container">
							<div class="row">
								<div class="col-md-12">
						<?php 	} ?>
								
							<?php comments_template( '', true ); ?>

						<?php if( !empty($vc_enabled) && comments_open() ) {  ?>			
								</div>
							</div>
						</div>
						<?php 	} ?>

					<?php endwhile; // end of the loop. ?>

					<?php if( empty($vc_enabled) ) {  ?>
					</div>

					<?php if ('no-sidebar' != $position) { ?>
					<div class="col-md-3 <?php if('left' == $position ){?> col-md-pull-9 <?php }?>">
						<?php get_sidebar(); ?>
					</div>
					<?php } ?>

					</div>
					<?php 	} ?>

			<?php } ?>

			<?php if( empty($vc_enabled) ) { ?>

				<?php if( 'on' === $widget_state && 'belowheader' === $widget_position && is_active_sidebar('home-widget-content')){ ?>
				<div class="row mb15">
					<?php dynamic_sidebar('home-widget-content') ?>
				</div>
				<?php } ?>


				<?php if('on' === $blog_state ){ ?> 
				<div class="row">
					<?php include(locate_template('bloglist.php')); ?>
				</div>
				<?php } ?>


				<?php if( 'on' === $widget_state && 'belowblog' === $widget_position && is_active_sidebar('home-widget-content') ){ ?>
				<div class="row">
					<?php dynamic_sidebar('home-widget-content') ?>
				</div>
				<?php } ?>
			<?php } ?>

		<?php if( empty($vc_enabled) ) {  ?>
		</div>
		<?php 	} ?>
	</div><!-- #primary .content-area -->

</main>
<?php get_footer(); ?>