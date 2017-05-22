<?php
$customizerOptions = thsp_cbp_get_options_values();

$neko_position_blog = neko_get_sidebar_layout();
$neko_blog_layout = $customizerOptions['blog_layout'];
?>

<div class="blog-<?php echo esc_attr($neko_blog_layout); ?>">
	<div class="col-md-12">

		<?php if ($wp_query->have_posts() ) : ?>


			<?php if( 'grid' == $neko_blog_layout ) {?>

			<div class="row" >

				<?php while ($wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<div class="col-sm-6 col-xs-12 col-lg-4  gridBlogItem">

						<?php get_template_part( 'content', get_post_format() ); ?>

					</div>

				<?php endwhile; ?>

			</div>

			<?php }else{ ?>


			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>	

			<?php endwhile;?>

			<?php }?>

			


		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

	</div>
</div>

<div class="col-md-12">
	<div class="neko-blog-pagination">
		<?php 			
		the_posts_pagination( array(
			'prev_text'          => esc_html__( 'Previous page', 'neko' ),
			'next_text'          => esc_html__( 'Next page', 'neko' ),
			'screen_reader_text' => esc_html__( 'Search pagination', 'neko' )
			) );
			?>
	</div>
</div>
