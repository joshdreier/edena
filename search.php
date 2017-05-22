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

$customizerOptions = thsp_cbp_get_options_values();

$blogPageId  = get_option('page_for_posts', true) ;
$page_object = get_page( $blogPageId );


$position             = neko_get_sidebar_layout();
$neko_blog_layout     = $customizerOptions['blog_layout'];
$total_featured_img   = $customizerOptions['nbfeaturedimg'];
$main_container_class = 'container';
$blog_layout_class    = ( !empty($neko_blog_layout) ) ? 'neko-blog-'.$neko_blog_layout : '' ;

get_header();
get_template_part( 'page', 'header'); 
?>


<main id="page-content" role="main"  class="site-content <?php echo  esc_attr($blog_layout_class) ?>">
	<div id="primary" class="content-area">
		<div class="<?php echo esc_attr($main_container_class); ?>">
			<section id="search-page-search">
				<div class="row">
					<div class="col-md-12">
						<?php get_search_form(); ?>
					</div>
				</div>
			</section>

			<div class="row">
				<div class="col-md-12">

					<?php if (have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<article class="search-result">

								<header class="entry-header">
									<h1 class="entry-title">
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'neko' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
											<?php  the_title(); ?>
										</a>
									</h1>

									<!-- post meta infos-->
									<?php 
									echo neko_post_infos(
										$show_date = true, 
										$wrapper_class = '', 
										$show_icons = false, 
										$show_text = true, 
										$show_categories = false, 
										$show_author = false, 
										$show_comments = false, 
										$activate_author_bio = false
										);
										?>
										<!-- post meta infos --> 
									</header>
									<div class="entry-summary">
										<?php the_excerpt(); ?>
									</div>
								</article>

							<?php endwhile; ?>

							<div class="neko-search-pagination">
							<?php 			
							the_posts_pagination( array(
								'prev_text'          => __( 'Previous page', 'neko' ),
								'next_text'          => __( 'Next page', 'neko' ),
								'screen_reader_text' => __( 'Page', 'neko' )
								) );
							?>
							</div>

						<?php else : ?>

							<?php get_template_part( 'no-results', 'index' ); ?>

						<?php endif; ?>
						<!-- </div> -->
				</div>

<!-- 				<div class="col-md-3">
					<?php /*get_sidebar();*/ ?>
				</div> -->

			</div>
		</div>
	</main>
	<?php get_footer(); ?>