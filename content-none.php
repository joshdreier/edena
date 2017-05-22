<?php
/**
 * The template for displaying a "No posts found" message.
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
?>
<header class="page-header">
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'neko' ); ?></h1>
</header><!-- .page-header -->

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'neko' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'neko' ); ?></p>
		<?php get_search_form(); ?>

	<?php else : ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'neko' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div><!-- .page-content -->
