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
$header_type;


/* check if post has a title */
$has_post_title = get_the_title();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
<?php
if ( is_single() ) { 
	/** Single Options **/
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
		if ( has_post_thumbnail() && 'gallery' !== $header_type && 'fixed_image' !== $header_type && 'parallaxed_image' !== $header_type ) { ?>
		<!-- entry media -->
		<div class="entry-media">
			<?php the_post_thumbnail('post-thumbnail' , array('class' => 'postImg img-responsive')); ?> 
		</div>
		<!-- entry media -->
	<?php } ?>

	<!-- entry content -->
	<div class="entry-content">

		<?php the_content() ?> 
		<?php echo neko_paginated_content(); ?>

	</div>
	<!-- entry content -->

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
			<?php if(get_the_tag_list()) { echo '<ul><li>'.esc_html__( 'Tags:', 'neko' ).'</li>'.get_the_tag_list('<li>','</li><li>','</li></ul>'); }?>
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


	<?php if('grid' == $neko_blog_layout){ ?>
		<header class="entry-header">
			<!-- entry meta -->
			<?php
			echo neko_post_infos(
				$show_date = true,
				$wrapper_class='',  
				$show_icons = false, 
				$show_text = false, 
				$show_categories = false, 
				$show_author = false, 
				$show_comments = false, 
				$activate_author_bio = false
				);
				?>
				<!-- entry meta  -->
		</header>
	<?php } ?>

	<!-- entry media -->
	<div class="entry-media">
		
		<!-- image -->
		<?php  
		if ( has_post_thumbnail() && !post_password_required() ) {          
			$hoverThumb = wp_get_attachment_image_src(get_post_thumbnail_id(),  'full' );

			neko_get_hover_pics( 
				$hoverThumb   = $hoverThumb[0], 
				$activateZoom = false, 
				$activateLink = true, 
				$return       = false, 
				$post_content = 'pics', 
				$videoType    = '', 
				$forceResp    = false, 
				$hoverType    = 'romeo'
			); 
		}
		?>
		<!-- image -->

		<!-- audio -->
		<?php $fContent = neko_media_extractor( get_the_content()); ?>
		<?php echo do_shortcode($fContent['mediaV']); ?>

		<!-- audio -->

	</div>
	<!-- entry media -->

	<header class="entry-header">
		<!-- post meta -->
		<?php
			$date_on = (empty($has_post_title) || 'grid' == $neko_blog_layout )?false:true;
			$txt_on  = (empty($has_post_title) || 'grid' == $neko_blog_layout )?false:true;
			$icon_on = (empty($has_post_title) || 'grid' == $neko_blog_layout )?true:false;

			echo neko_post_infos(
				$show_date = $date_on,
				$wrapper_class='',  
				$show_icons = $icon_on, 
				$show_text = $txt_on, 
				$show_categories = false, 
				$show_author = false, 
				$show_comments = false, 
				$activate_author_bio = false
			);
		?>
		<!-- post meta  -->
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'neko' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php  the_title(); ?>
			</a>
		</h1>

	</header>

	<!-- entry summary -->
	<?php $class_mobile = ( 'twoblocs' == $neko_blog_layout ) ?'hidden-sm hidden-xs' :''; ?>
	<div class="entry-summary <?php echo esc_attr($class_mobile); ?>">
		<?php echo  wp_kses_post( $fContent['text'] ); ?>

		<!-- paginated post-->
		<?php echo neko_paginated_content(); ?>
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