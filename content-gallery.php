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
	$img_size = 'img-large-ms';

}else{

	if('default' == $neko_blog_layout){
		$img_size = (empty($neko_position_blog) || $neko_position_blog == 'no-sidebar')?'img-xx-large-ms':'img-x-large-ms';
	}else{
		$img_size = 'img-x-large-ms';
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
			<?php  if( 'no-page-header' === $header_type || empty( $header_type ) ){  the_title( '<h1>', '</h1>' ); }  ?>
			<!-- the title if not in header -->  

		</header>
		<!-- entry header -->


		<?php if (has_post_thumbnail()){ ?>
		<!-- entry media -->
		<div class="entry-media">
			<?php 
				$header_type =  get_post_meta($post->ID, 'neko_post_header_type', true);
				if('gallery' !== $header_type){
					echo neko_get_gallery(
						$postThumbnail      = true, 
						$img_size           = 'img-x-large-ms' , 
						$total_featured_img = $total_featured_img
					); 
				}
			?>
		</div>
		<!-- entry media -->
		<?php } ?>

		<!-- entry content -->
		<div class="entry-content">
			<!-- post content -->
			<?php the_content(); ?> 
			<?php echo neko_paginated_content(); ?>
			<!-- post content -->
		</div>
		<!-- entry content -->

		<!-- entry footer -->
		<footer class="entry-footer">
			<!-- post meta infos-->
			<?php 
				echo neko_post_infos(
					$show_date = true, 
					$wrapper_class = 'footer-metas', 
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
				<?php if(get_the_tag_list()) { echo '<ul><li>'.esc_html__( 'Tags:', 'neko' ).'</li>'.get_the_tag_list('<li>','</li><li>','</li></ul>'); } ?>
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

	<?php if (has_post_thumbnail()){ ?>
	<!-- entry media -->
	<div class="entry-media">
		<?php 
		echo neko_get_gallery(
			$postThumbnail      = has_post_thumbnail(), 
			$img_size = $img_size , 
			$total_featured_img = $total_featured_img
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
		<?php
			/* post metas */
			
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