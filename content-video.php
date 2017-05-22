<?php
/**
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */
?>

<?php
global 
$neko_blog_layout, 
$neko_position_blog, 
$position_blog,
$total_featured_img,
$header_type,
$wp_embed;

/* check if post has a title */
$has_post_title=get_the_title();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<?php
	if ( is_single() ) { 
	/**
	 * Single Options
	 */
	global $neko_author_bio;
	$activate_bio = ('on' === $neko_author_bio)?true:false;
	?>
	<!-- entry header -->
	<header class="entry-header">

		<!-- the title if not in header --> 
		<?php  if( 'no-page-header' === $header_type || empty( $header_type ) ){  the_title( '<h1>', '</h1>' ); }  ?>
		<!-- the title if not in header --> 

		</header>
		<!-- entry header -->

		<!-- entry content -->
		<div class="entry-content">
			<?php the_content() ?> 
			<?php echo neko_paginated_content(); ?>
		</div>
		<!-- entry content -->

		<!-- entry footer -->
		<footer class="entry-footer">
			<?php 
		echo neko_post_infos(
			$show_date = true, 
			$wrapper_class = 'footer-metas', 
			$show_icons = false, 
			$show_text = false, 
			$show_categories = false, 
			$show_author = false,
			$show_comments = false, 
			$activate_author_bio = true
			);
			?>
			<!-- edit post-->
			<?php edit_post_link( esc_html__( 'Edit', 'neko' ), '', '' ); ?>
			<!-- edit post-->
		</footer>
		<!-- entry footer -->

		<?php }else{ ?>

			<!-- entry media -->
			<?php $fContent = neko_media_extractor(get_the_content()); ?>
			
			
			<div class="entry-media">
				<?php echo do_shortcode($wp_embed->run_shortcode($fContent['mediaV'])); ?>
			</div>
			<!-- entry media -->


			<header class="entry-header">

				<?php if (!empty($has_post_title)){?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'neko' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h1>
				<!-- post meta -->
				<?php 			
				echo neko_post_infos(
					$show_date = true,
					$wrapper_class='',  
					$show_icons = false, 
					$show_text = true, 
					$show_categories = true, 
					$show_author = true, 
					$show_comments = true, 
					$activate_author_bio = false
					);
					?>
					<!-- post meta  -->
					<?php } ?>
				</header>


				<!-- entry summary -->	
				<?php $class_mobile = ( 'twoblocs' == $neko_blog_layout ) ?'hidden-sm hidden-xs' :''; ?>
				<div class="entry-summary <?php echo esc_attr($class_mobile); ?>">
					<?php echo  wp_kses_post( $fContent['text'] ); ?>
					<!-- paginated post-->
					<?php //echo neko_paginated_content(); ?>
					<!-- paginated post-->	
				</div>
				<!-- entry summary -->

				<!-- entry footer -->
				<footer class="entry-footer">
					<!-- edit post-->
					<?php edit_post_link( esc_html__( 'Edit', 'neko' ), '<p>', '</p>' ); ?>
					<!-- edit post-->
				</footer>
				<!-- entry footer -->
				<?php } ?>
			</article>