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
$header_type;


if( 'grid' == $neko_blog_layout ){
	$img_size = 'img-large-ms';
}else{
	if( 'default' == $neko_blog_layout ){
		$img_size = (empty($neko_position_blog) || $neko_position_blog == 'no-sidebar')?'img-xx-large-ms':'img-x-large-ms';
	}else{
		$img_size = 'img-x-large-ms';
	}	
}

/* check if post has a title */
$has_post_title=get_the_title();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix '); ?>>
	<?php
	/**
	 * Single Options
	 */
	if ( is_single() ) { 	
		global $neko_author_bio;
		$activate_bio = (!empty($neko_author_bio) && 'on' === $neko_author_bio)?true:false;
		?>

		<!-- entry header -->
		<header class="entry-header">
				<!-- the title if not in header --> 
				<?php  if( ( 'no-page-header' === $header_type || empty( $header_type ) ) ){  the_title( '<h1>', '</h1>' ); }  ?>
				<!-- the title if not in header --> 
			</header>
			<!-- entry header -->


			<?php 
			$header_type =  get_post_meta($post->ID, 'neko_post_header_type', true);
				//if ( has_post_thumbnail() && 'gallery' !== $header_type && 'fixed_image' !== $header_type && 'parallaxed_image' !== $header_type ) {
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
					<?php //} ?>


					<!-- entry content -->
					<div class="entry-content">

						<?php the_content(); ?> 
						<?php echo neko_paginated_content(); ?>

					</div>
					<!-- entry content -->

					<!-- entry footer -->
					<footer class="entry-footer">
						<?php 
						echo neko_post_infos(
							$show_date = true, 
							$wrapper_class = '', 
							$show_icons = false, 
							$show_text = false, 
							$show_categories = true, 
							$show_author = true, 
							$show_comments = true, 
							$activate_author_bio = $activate_bio
							);
						?>

						<!-- post tags -->
						<div class="entry-tags">
							<?php if(get_the_tag_list()) { echo '<ul>'.get_the_tag_list('<li>','</li><li>','</li></ul>'); }?>
						</div>
						<!-- post tags -->

						<!-- edit post-->
						<?php edit_post_link( esc_html__( 'Edit', 'neko' ), '', '' ); ?>
						<!-- edit post-->

					</footer>
					<!-- entry footer -->

					<?php 
	/**
	 * List Options
	 */
}else{ 
	?>



		<?php if ( has_post_thumbnail() && !post_password_required() ) { ?>
		<!-- entry media --> 
		<div class="entry-media">
			<?php 
			$hoverThumb = wp_get_attachment_image_src(get_post_thumbnail_id(),  $img_size );
			neko_get_hover_pics( 
					$hoverThumb   = $hoverThumb[0], 
					$activateZoom = false, 
					$activateLink = true, 
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

			<!-- entry header -->
			<header class="entry-header">


				<?php if (!empty($has_post_title)){?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'neko' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
						<?php  the_title(); ?>
					</a>
				</h1>
				<?php		/* post metas */

				echo neko_post_infos(
					$show_date = true,
					$wrapper_class='',  
					$show_icons = false, 
					$show_text = false, 
					$show_categories = true, 
					$show_author = true, 
					$show_comments = true, 
					$activate_author_bio = false
					);
				/* post metas */
				?>
				<?php } ?>

			</header>
			<!-- entry header -->


			<!-- entry summary -->
			<?php $class_mobile = ( 'twoblocs' == $neko_blog_layout ) ?'hidden-sm hidden-xs' :''; ?>
			<div class="entry-summary <?php echo esc_attr($class_mobile); ?>">
				<?php the_content(); ?>
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