<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */


$customizerOptions = thsp_cbp_get_options_values();
$position          =  neko_get_sidebar_layout();
$neko_blog_layout  = $customizerOptions['blog_layout'];
$header_type = get_post_meta($post->ID, 'neko_post_header_type', true);


get_header();

/*if(is_attachment()){
	get_template_part( 'page', 'header'); 
}else{
	get_template_part( 'page', 'customizable_header'); 	
}*/

get_template_part( 'page', 'header'); 

/** Complementary options **/
$neko_author_bio = $customizerOptions['neko_author_bio'];

$neko_toggle_grid = ( $position == 'no-sidebar' ) ? 'col-md-12' : 'col-md-9';
?>
<main id="content" class="site-content">
	<div id="primary" class="content-area">
		<div class="container">
			<div class="row">
				
				<div class="<?php echo esc_attr( $neko_toggle_grid ); ?><?php if('left' == $position ){?> col-md-push-3 <?php }?>">	

					<?php while ( have_posts() ) : the_post(); ?>
						
						<?php get_template_part( 'content', get_post_format() ); ?>

						<div class="neko-single-pagination">
							<?php
							if( !is_attachment() ){
								the_post_navigation( 
									array(
										'next_text' => '<span class="meta-nav" aria-hidden="true"><i class="neko-icon-next-post"></i>'.esc_html__( 'Next', 'neko' ) . '</span> ' . '<span class="post-title hidden-xs">%title</span>',
										'prev_text' => '<span class="meta-nav" aria-hidden="true">'. esc_html__( 'Previous', 'neko' ) . '<i class="neko-icon-previous-post"></i></span>' . ' <span class="post-title hidden-xs">%title</span>',
										)
									);
								}else{ ?>

								<nav id="image-navigation" class="navigation image-navigation">
									<div class="nav-links">
										<?php previous_image_link( false, '<div class="previous-image">' . __( 'Previous Image', 'neko' ) . '</div>' ); ?>
										<?php next_image_link( false, '<div class="next-image">' . __( 'Next Image', 'neko' ) . '</div>' ); ?>

									</div><!-- .nav-links -->
								</nav><!-- #image-navigation -->

								<?php
							}
							?>
						</div>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) {
								echo '<section id="commentWrapper">';
								comments_template( '', true );
								echo '</section>';
							}
						?>	
						
					<?php endwhile; // end of the loop. ?>
					
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