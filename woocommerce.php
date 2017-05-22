<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

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
$neko_no_vc_class = 'neko-page-default'; 

get_header();
//get_template_part( 'page', 'customizable_header'); 
get_template_part( 'page', 'header'); 

$main_container_class = ( 'grid' == $neko_blog_layout || 'twoblocs' == $neko_blog_layout )?'container-fluid':'container';
$neko_toggle_grid = ( $position == 'no-sidebar' ) ? 'col-md-12' : 'col-md-9';

?>


<main id="content" class="site-content <?php  echo esc_attr($neko_no_vc_class); ?>">

	<div id="primary" class="content-area">
	

		<div class="container">

		<div class="row">

			<div class="<?php echo esc_attr( $neko_toggle_grid ); ?><?php if('left' == $position ){?> col-md-push-3 <?php }?>">

				<?php /* SHOP */ ?>
				<div class="woocommerce">
				<?php woocommerce_content(); ?>
				</div>
			</div>

			<?php if ('no-sidebar' != $position) { ?>
			<div class="col-md-3 <?php if('left' == $position ){?> col-md-pull-9 <?php }?>">
				<?php dynamic_sidebar('woocommerce-area'); ?>
			</div>
			<?php } ?>

		</div>

		</div>

	</div><!-- #primary .content-area -->

</main>
<?php get_footer(); ?>