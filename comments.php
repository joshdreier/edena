<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to neko_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() ){ ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php return; }




    $spanSize = (is_page())?'col-md-8':'col-md-7 col-md-offset-1';
?>
	
	
	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<!--<?php
				 printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'neko' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>-->
			<?php echo 'Comments ('.number_format_i18n( get_comments_number()).')'; ?>
	
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h2 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'neko' ); ?></h2>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'neko' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'neko' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		
		<?php endif; // check for comment navigation ?>
		<div id="comments-wrapper">
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'callback' => 'neko_comment',
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 64,
				) );
			?>
		</ol>
	</div>
		<!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h2 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'neko' );  ?></h2>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'neko' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'neko' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'neko' ); ?></p>
	<?php endif; ?>

	<?php


	$args=array( 
		'comment_notes_after' => '',
	 	'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'comment form title', 'neko' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
	);

	
	 comment_form($args);
	 ?>


