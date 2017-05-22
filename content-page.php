<?php
/**
 * The template used for displaying page content in page.php
 *
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
	$total_featured_img;

if( '' !== get_post()->post_content ){ 
	$classes = array( 'clearfix' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	
		<?php 
		$header_type =  get_post_meta($post->ID, 'neko_post_header_type', true);
		if ( has_post_thumbnail() && 'gallery' !== $header_type && 'fixed_image' !== $header_type && 'parallaxed_image' !== $header_type && 'video' !== $header_type && 'featured_post' !== $header_type) {
			$hoverThumb = wp_get_attachment_image_src(get_post_thumbnail_id(),  'full' ); 
		?>
		<!-- entry media -->
		<div class="entry-media">
			<?php
			neko_get_hover_pics( 
				$hoverThumb   = $hoverThumb[0], 
				$activateZoom = false, 
				$activateLink = false, 
				$return = false, 
				$post_content = 'pics', 
				$videoType = '', 
				$forceResp = false, 
				$hoverType = 'romeo'
			); 
			?>
		</div>
		<!-- entry media -->
		<?php } ?>
	
	<!-- entry content -->
	<div class="entry-content">
		
		<?php the_content(); ?>
		<?php echo neko_paginated_content(); ?>

	</div>
	<!-- entry content -->

	<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?> 
	<!-- entry footer -->
	<footer class="entry-footer">

		<!-- edit post-->
		<?php // edit_post_link( esc_html__( 'Edit', 'neko' ), '', '' ); ?>
		<!-- edit post-->

	</footer>
	<!-- entry footer -->
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->
<?php } ?>