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

/* check if post has a title */
$has_post_title = get_the_title();

if( 'grid' == $neko_blog_layout ){
	$img_size = 'img-medium-ms';
}else{

	if('default' == $neko_blog_layout){
		$img_size = (empty($neko_position_blog) || $neko_position_blog == 'no-sidebar')?'img-xx-large-ms':'img-x-large-ms';
	}else{
		$img_size = (empty($neko_position_blog) || $neko_position_blog == 'no-sidebar')?'img-large-ms':'img-medium-ms';
	}

}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
<?php
if ( is_single() ) { 
	/** 
	 * Single Options
	 */
	global $neko_author_bio;
	$activate_bio = (!empty($neko_author_bio) && 'on' === $neko_author_bio)?true:false;
?>		
		<!-- entry header -->
		<header class="entry-header">

			<!-- the title if not in header --> 
			<?php  if( 'no-page-header' === $header_type ){  the_title( '<h1>', '</h1>' ); }  ?>
			<!-- the title if not in header -->  			
		</header>
		<!-- entry header -->

		<?php  if(wp_attachment_is_image(get_the_ID())){  ?>

		<!-- entry attachement -->
		<div class="entry-attachement">
			<p class="attachment">
				<?php
				echo wp_get_attachment_image( get_the_ID(), 'full' ); 
				?>
			</p>
		</div>
		<!-- entry attachement -->

		<?php }else{ ?>

		<!-- entry content -->
		<div class="entry-content">
			<?php the_content(); ?>
			<?php echo neko_paginated_content(); ?>
		</div>
		<!-- entry content -->

		<?php } ?> 


		<!-- entry footer -->
		<footer class="entry-footer">

			<!-- post meta infos-->
			<?php 
			echo neko_post_infos(
				$show_date = true, 
				$wrapper_class = '', 
				$show_icons = false, 
				$show_text = true, 
				$show_categories = true, 
				$show_author = true, 
				$show_comments = true, 
				$activate_author_bio = $activate_bio
			);
			?>
			<!-- post meta infos -->  

			<!-- post tags -->
			<div class="entry-tags">
				<?php 
				if(get_the_tag_list()) echo '<ul><li>'.esc_html__( 'Tags:', 'neko' ).'</li>'.get_the_tag_list('<li>','</li><li>','</li></ul>'); 
				?>
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
		<!-- entry header -->
		<header class="entry-header">
			

			<?php if (!empty($has_post_title)){?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'neko' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<?php  the_title(); ?>
				</a>
			</h1>
			<!-- entry meta -->
			<?php
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
			?>
			<!-- entry meta  -->
			<?php } ?>
		</header>
		<!-- entry header -->

		<!-- entry summary -->
		<div class="entry-summary">
			<?php the_content(); ?>
			<!-- paginated post-->
			<?php //echo neko_paginated_content(); ?>
			<!-- paginated post-->
		</div>
		<!-- entry summary -->	


		<footer class="entry-footer">
			<!-- edit post-->
			<?php edit_post_link( esc_html__( 'Edit', 'neko' ), '<p>', '</p>' ); ?>
			<!-- edit post-->
		</footer>

	<?php } ?>
</article>