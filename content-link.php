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
$neko_author_bio,
$header_type;

$activate_bio = (!empty($neko_author_bio) && 'on' === $neko_author_bio)?true:false;


/* check if post has a title */
$has_post_title=get_the_title();

$class_content = (is_single())?'entry-content':'entry-summary';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

	<!-- entry header -->
	<header class="entry-header">
		
		<!-- the title if not in header --> 
		<?php  if( ( 'no-page-header' === $header_type || empty( $header_type ) ) && is_single() ){  the_title( '<h1>', '</h1>' ); }  ?>
		<!-- the title if not in header --> 

	</header>
	<!-- entry header -->
	<?php
	$bg_class = '';
	$bg_style = '';
	
	if(has_post_thumbnail()){
		$background_img = wp_get_attachment_image_src(get_post_thumbnail_id(),  'img-xx-large-ms' );
		
		$bg_class = 'image-bg';
			//$bg_style = 'style="background-image:url('.esc_url($background_img[0]).');"';
	}
	?>
	<!-- entry content / summary -->
	<div class="<?php echo esc_attr($class_content); ?>">
		<a href="<?php echo neko_get_post_link() ?>" class="format-link-wrapper <?php echo esc_attr($bg_class); ?>" 
			<?php
			if(has_post_thumbnail()){
				echo 'style="background-image:url('.esc_url($background_img[0]).');"';
			}
			?>
			>	
			<div>
				<?php if (!empty($has_post_title)){ ?>

				<h2 class="entry-title"> <?php the_title(); ?></h2>
				<?php } ?>

				<?php echo neko_remove_post_link(get_the_content()); ?> 
			</div>
		</a>
	</div>
	<!-- entry content / summary -->


	<!-- entry footer -->
	<footer class="entry-footer">
		<!-- post meta infos-->
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
			<!-- post meta infos --> 
			<!-- post tags -->
			<div class="entry-tags">
				<?php if(get_the_tag_list()) { echo '<ul><li>'.esc_html__( 'Tags:', 'neko' ).'</li>'.get_the_tag_list('<li>','</li><li>','</li></ul>'); } ?>
			</div>
			<!-- post tags -->

			<!-- edit post-->
			<?php edit_post_link( esc_html__( 'Edit', 'neko' ), '<p>', '</p>' ); ?>
			<!-- edit post-->
		</footer>
		<!-- entry footer -->

	</article>