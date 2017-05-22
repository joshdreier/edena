<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */

$customizerOptions = thsp_cbp_get_options_values();
get_header();
//get_template_part( 'page', 'customizable_header'); 
 ?>
 <header class="page-header small">
 	<div class="container-fluid">
 		<div class="row">
 			<div class="content-wrapper">							
 				<div class="col-md-12">
 				<h1 class="big-heading">404</h1>
 				</div>				
 			</div>
 		</div>
 	</div>
 </header>

<div id="primary" class="content-area">
	<section id="content" class="site-content" role="main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<article id="post-0" class="post error404 not-found">
						<div class="text-center">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'neko' ); ?></h1>
							
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'neko' ); ?></p>

							<?php get_search_form(); ?>
			
							<a href="<?php echo site_url(); ?>" class="btn btn-primary btn-lg">Back to homepage</a>
						</div>
		
					</article><!-- #post-0 .post .error404 .not-found -->

				</div><!-- #content .site-content -->
			</div><!-- #primary .content-area -->
		</div>
	</section>
</div>
<?php get_footer(); ?>