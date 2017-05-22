<?php
/**
 * Template Name: Archives
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
*/
$customizerOptions = thsp_cbp_get_options_values();
$position = neko_get_sidebar_layout();
$total_featured_img = $customizerOptions['nbfeaturedimg'];
/* Home vars */
$content_position   = (!empty($customizerOptions['neko_content_position']) && is_front_page())?$customizerOptions['neko_content_position']:'belowheader';
$widget_state       = (!empty($customizerOptions['neko_home_widgets_bar']) && is_front_page())?$customizerOptions['neko_home_widgets_bar']:'off';
$widget_position    = (!empty($customizerOptions['neko_wbar_position']))?$customizerOptions['neko_wbar_position']:'belowheader';
$blog_state         = (!empty($customizerOptions['neko_home_blog']) && is_front_page())?$customizerOptions['neko_home_blog']:'off';

$neko_blog_layout   = $customizerOptions['blog_layout'];
$main_container_class = ( 'grid' == $neko_blog_layout || 'twoblocs' == $neko_blog_layout )?'container-fluid':'container';
$blog_layout_class = ( !empty($neko_blog_layout) ) ? 'neko-blog-'.$neko_blog_layout : '' ;

$neko_position_blog = 'no-sidebar';
$neko_toggle_grid = ( $position == 'no-sidebar' ) ? 'col-md-12' : 'col-md-9';


get_header();
get_template_part( 'page', 'customizable_header'); 
?>
<main id="content" class="site-content <?php echo  esc_attr($blog_layout_class) ?>">
	<div id="primary" class="content-area">
		<div class="<?php echo esc_attr($main_container_class); ?>">
			<div class="row">
				<div class="<?php echo esc_attr($neko_toggle_grid); ?><?php if('left' == $position ){?> col-md-push-3 <?php }?>">

					<?php the_post(); ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<?php get_search_form(); ?>


					<h2><?php esc_html_e('Archives by Month:', 'neko'); ?></h2>
					<ul class="archives-by-month">
						<?php wp_get_archives('type=monthly'); ?>
					</ul>

					<h2><?php esc_html_e('Archives by Subject:', 'neko'); ?></h2>
					<ul class="archives-by-categories">
						<?php wp_list_categories('title_li='); ?>
					</ul>
					
				</div>
				
				<?php if('no-sidebar' !== $position ) { ?>
				<div class="col-md-3 <?php if('left' == $position ){?> col-md-pull-9 <?php }?>">
					<?php get_sidebar(); ?>
				</div>
				<?php } ?>

			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>