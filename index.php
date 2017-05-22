<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */

/** VARS **/
$customizerOptions  = thsp_cbp_get_options_values();
$position           = neko_get_sidebar_layout();
$neko_blog_layout   = $customizerOptions['blog_layout'];
$total_featured_img = $customizerOptions['nbfeaturedimg'];

get_header();
get_template_part( 'page', 'header'); 

$main_container_class = ( 'grid' == $neko_blog_layout || 'twoblocs' == $neko_blog_layout )?'container-fluid':'container';
$blog_layout_class = ( !empty($neko_blog_layout) ) ? 'neko-blog-'.$neko_blog_layout : '' ;
$neko_toggle_grid = ( $position == 'no-sidebar' ) ? 'col-md-12' : 'col-md-9';

?>

<main id="content" class="site-content  <?php echo  esc_attr($blog_layout_class) ?>">
	<div id="primary" class="content-area">
		<div class="<?php echo esc_attr($main_container_class); ?>">
			<div class="row">

				<div class="<?php echo esc_attr( $neko_toggle_grid ); ?><?php if('left' == $position ){?> col-md-push-3 <?php }?>">
					<div class="row">
						<?php include(locate_template('bloglist.php')); ?>
					</div>
				</div>
				
				<?php if ('no-sidebar' != $position) { ?>
				<div class="col-md-3 <?php if('left' == $position ){?> col-md-pull-9 <?php }?>">
					<?php get_sidebar(); ?>
				</div>
				<?php } ?>

			</div>
		</div>

	</div><!-- #primary .content-area -->

</main>
<?php get_footer(); ?>