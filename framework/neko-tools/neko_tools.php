<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * extract media from content.
 *
 * @package NEko framework
 * @since NEko framework 1.0 
 */
if(!function_exists('neko_media_extractor')){

	function neko_media_extractor($content, $url_only = false)
	{
		$formatedContent =array();

		$content = preg_replace( '|^\s*(https?://[^\s"]+)\s*$|im', "[embed]$1[/embed]", $content );
		preg_match("!\[embed.+?\]|\[neko_video.+?\]|\[video.+?\]|\[audio.+?\]|\[wpvideo.+?\]!", $content, $match_media);

		if(!empty($match_media))
		{
			// global $wp_embed;
			$media = $match_media[0];

			if(false ===  $url_only){
				$formatedContent['mediaV'] = $media;
			}else{

				preg_match("!\[video.+?\]|\[neko_video.+?\]!", $media, $matchurl);
				if(!empty($matchurl)){
					$matchurl[0]               = preg_replace('!\[video|\]|\'|\"!', '', $matchurl[0]);
					$explode                   = explode('=', $matchurl[0]);
					$formatedContent['mediaV'] = $explode[3];
				}else{
					$formatedContent['mediaV'] = $media;
				}
				
			}

			/* clean le shortcode itself */
			$formatedContent['text'] = str_replace($match_media[0], '', $content);

			/* clean closing shortcode tag */
			$formatedContent['text'] =  preg_replace('!\[\/*?audio\]|\[\/*?video\]!', '',$formatedContent['text']);

			//if(empty($formatedContent['text'])) $formatedContent['text'] = '';

		}else{
			$formatedContent['mediaV'] = '';
			$formatedContent['text'] = $content;
		}


		return $formatedContent;
	}
}


/**
 * Gets navtrail.
 *
 * @package NEko framework
 * @since NEko framework 1.0 
 */
if(!function_exists('neko_get_navtrail')){
	function neko_get_navtrail() {
		if (!is_home()) { 
			wp_nav_menu( 
				array( 
					'container' => 'none', 
					'theme_location' => 'primary',
					'walker'=> new neko_breadcrumbwalker, 
					'items_wrap' => '<ul id="navTrail"> %3$s </ul>'
					)
				);
		}
	}
}



/**
 * NEko sidebar layout
 * 
 * @package NEko framework
 * @since NEko framework 1.0 
 */

if(!function_exists('neko_get_sidebar_layout')){
	function neko_get_sidebar_layout(){

		$position = 'no-sidebar';

		if(neko_is_blog()){

			$position = array();

			$post_position = get_post_meta( get_the_ID(), 'neko_sidebar_position', true);

			if( !empty($post_position) && is_singular() && 'blog-default' != $post_position[0]  ){
				$position = $post_position[0];
			}else{
				$customizerOptions = thsp_cbp_get_options_values();
				$position[0] = $customizerOptions['blog_default_sidebar_position'];
			}



		}elseif( is_page() ){

			$position = array();

			$position = get_post_meta( get_the_ID(), 'neko_sidebar_position', true);

		}elseif( function_exists('is_woocommerce') &&  is_woocommerce() ){

			$position = array();
			$pageID = get_option('woocommerce_shop_page_id');
			$position = get_post_meta( $pageID, 'neko_sidebar_position', true);

		}


		if(neko_is_blog()){
			if ( !is_active_sidebar( 'sidebar-1' ) ) {
				$position[0] = 'no-sidebar';
			}
		}elseif( ( is_page() ||  ( function_exists('is_woocommerce') && is_woocommerce() ) ) && empty($position)){
			$position = 'no-sidebar';
		}


		if(is_array($position)){
			return $position[0];
		}else{
			return $position;	
		}
	}
}



/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 * 
 * @package Neko framework
 * @since Neko framework 1.1
*/

if ( ! function_exists( 'neko_comment' ) ) :

	function neko_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo wp_kses_post($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
			<?php endif; ?>

			<div class="comment-author vcard">

				<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<div class="comment-author-infos">
					<div class="comment-meta commentmetadata">

						<?php printf( '<cite class="fn">'.esc_html__( 'By %s', 'neko' ).'</cite>', get_comment_author_link() ); ?>
						<span class="comment-time">
							<?php
							/* translators: 1: date, 2: time */
							printf( esc_html__('%1$s at %2$s', 'neko'), get_comment_date(),  get_comment_time() ); ?>
						</span>

					</div>
					<?php edit_comment_link( esc_html__( 'Edit', 'neko'), '  ', '' );
					?>
				</div>

			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'neko'); ?></em>
				<br />
			<?php endif; ?>


			<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php if ( 'div' != $args['style'] ) : ?>
			</div>
		<?php endif; ?>
		<?php

	}
	endif;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
if ( ! function_exists( 'neko_post_infos' ) ) {

	function neko_post_infos( $show_date = true, $wrapper_class='',  $show_icons = true, $show_text = true, $show_categories = true, $show_author = true, $show_comments = true, $activate_author_bio = false) {

		if (!post_password_required()) {

			// icons
			$icon_comments   =( true === $show_icons )?'<i class="neko-icon-comment"></i>':'';
			$icon_categories =( true === $show_icons )?'<i class="neko-icon-tag"></i>':'';
			$icon_date       =( true === $show_icons )?'<i class="neko-icon-clock"></i>':'';
			$icon_author     =( true === $show_icons )?'<i class="neko-icon-user"></i>':'';

			//text
			$txt_categories =( true === $show_text )?esc_html__('Posted In', 'neko'):'';
			$txt_date       =( true === $show_text )?esc_html__('Posted On', 'neko'):'';
			$txt_author     =( true === $show_text )?esc_html__('By', 'neko'):'';


			//comments
			$write_comments ='';
			if ( true === $show_comments ) {
				$num_comments = get_comments_number(); 

				$my_post_format=get_post_format();
				
				if ($my_post_format!='aside' && $my_post_format!='link'){

					if ( comments_open() ) {

						if ( $num_comments == 0 ) {
							$comments = esc_html__('No Comments', 'neko');
						} elseif ( $num_comments > 1 ) {
							$comments = $num_comments . esc_html__(' Comments', 'neko');
						} else {
							$comments = esc_html__('1 Comment', 'neko');
						}

					} else {
						$comments =  esc_html__('No comments' , 'neko');
					}

					$write_comments = '<li class="entry-comments">'.$icon_comments.esc_attr( $comments ).'</li>';
				}
			}

			// categories
			$outputCategories = '';
			if ( true === $show_categories ) {

				$categories = get_the_category();
				$separator = ', ';
				if($categories){
					foreach($categories as $category) {
						$outputCategories .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf(esc_html__( "View all posts in %s", 'neko' ), $category->name )) . '" class="tips">'.$category->cat_name.'</a>'.$separator;
					}
					$outputCategories = trim($outputCategories, $separator);
					$outputCategories ='<li class="entry-category">'.$txt_categories.' '.$icon_categories.$outputCategories .'</li>';
				}

			}

			// date
			$outputDate =''; 
			if ( true === $show_date ) {
				$outputDate ='<li class="entry-date">'.$txt_date.' <a href="'.get_permalink().'" ><time datetime='.esc_attr( get_the_date( 'c' ) ).'>'.$icon_date.esc_html( get_the_date() ).'</time></a></li>';
			}


			// author
			$outputAuthor = '';
			$outputAuthorBio = '';
			if(false == $activate_author_bio){
				$outputAuthor =''; 
				if ( true === $show_author ) {
					$outputAuthor ='<li class="entry-author">'.$txt_author.' '.$icon_author.'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" title="'.esc_attr( sprintf( esc_html__( 'View all posts by %s', 'neko' ), get_the_author() ) ).'" rel="author" class="tips">'.get_the_author().'</a></li>';
				}
			}else{


				$outputAuthorBio = '<div class="neko-author-bio clearfix">';

				$outputAuthorBio .= get_avatar( get_the_author_meta('email') , 90 );

				$outputAuthorBio .= '<div class="author-info">';

				$outputAuthorBio .= get_the_author_link();

				$description = get_the_author_meta('description');
				$outputAuthorBio .= (!empty($description))?'<p class="author-description">'.$description.'</p>':'';


				$outputSocial = '';

				$rss_url = get_the_author_meta( 'rss_url' );
				if ( !empty($rss_url) ) {
					$outputSocial .= '
					<li class="rss">
						<a href="' . esc_url($rss_url) . '">
							<i class="neko-social-icon-rss"></i>
						</a>
					</li>';
				}

				/* Predefined custom profiles */
				$author_id = get_the_author_meta('ID');
				
				$outputAuthorBio .=  neko_socialbar($author_id, $class_icon_size = '', $class_icon_rounded = 'icon-rounded', $position_bar = null, $position_tips = 'bottom', $ul_class = 'author-icon');

				$outputAuthorBio .= '</div>'; //close author-info
				$outputAuthorBio .= '</div>'; //close author-bio

				
			}


			return 
			'<ul class="entry-meta '.$wrapper_class.'">
			'.$outputDate.'
			'.$outputCategories.'
			'.$outputAuthor.'
			'.$write_comments.
			'</ul>'
			.$outputAuthorBio;

		}else{
			return false;
		}
	}
}


/**
 * Returns true if a blog has more than 1 category
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
function neko_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		/* Create an array of all the categories that are attached to posts */
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
			) );

		/* Count the number of categories that are attached to the posts */
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		/* This blog has more than 1 category so neko_categorized_blog should return true */
		return true;
	} else {
		/* This blog has only 1 category so neko_categorized_blog should return false */
		return false;
	}
}





/**
 * Flush out the transients used in neko_categorized_blog
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
function neko_category_transient_flusher() {
	/* Like, beat it. Dig? */
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'neko_category_transient_flusher' );
add_action( 'save_post', 'neko_category_transient_flusher' );





if(!function_exists('neko_get_hover_pics')){

	function neko_get_hover_pics( 
		$hoverThumb, 
		$activateZoom = true, 
		$activateLink = true, 
		$return = false, 
		$post_content = 'pics', 
		$videoType = '', 
		$forceResp = false, 
		$hoverType = 'original',
		$showTitle = false )
	{
		/* CONFIG */

		$customizerOptions = thsp_cbp_get_options_values();
		$resp_class        = ( false === $forceResp )?'img-responsive':'neko_forceResp';

		switch($hoverType){
			case 'romeo':
			$show_title = $showTitle;
			$show_date  = false;
			break;
			
			default:
			$show_title = $showTitle;
			$show_date  = false;
			break;
		}

		$cancel_hover = (false === $activateZoom && false === $activateLink)?'canceled':'';

		/* CONFIG */
		$content ='<figure class="img-hover '.$hoverType.' '.$cancel_hover.'">';

		$alt_media = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
		$alt = (!empty($alt_media))?$alt_media:get_the_title();

		$content .= '<img src="'.$hoverThumb.'" alt="'.$alt.'" class="'.esc_attr($resp_class).'">';

		$content .='<figcaption>';

		/* Show title */
		if(true == $show_title){ $content .='<h2>'.get_the_title().'</h2>'; }

		/* Show date */
		if(true == $show_date){ $content .='<p>'. get_the_date().'</p>'; }

		/* Zoom = true && link = false other than original */
		if(true === $activateZoom && false === $activateLink && 'original' !== $hoverType){
			$content .= neko_create_zoom_link ($post_content, $activateZoom, $activateLink, $custom_class = 'full-link', $videoType, $hoverType);
		}

		/* Zoom = false && link = true other than original */
		if(false === $activateZoom && true === $activateLink && 'original' !== $hoverType ){
			$content .= neko_create_zoom_link ($post_content, $activateZoom, $activateLink, $custom_class = 'full-link', $videoType, $hoverType);
		}

		/* Zoom = true && link = true other than original OR original */
		if(true === $activateZoom && true === $activateLink || 'original' === $hoverType ){
			$content .='<p class="icon-links clearfix">';
			$content .= neko_create_zoom_link ($post_content, $activateZoom, $activateLink, $custom_class = '', $videoType, $hoverType);
			$content .='</p>';
		}

		$content .='</figcaption>';
		$content .='</figure>';

		switch ($return) {
			case true:
			return $content;
			break;
			
			default:
			echo  $content;
			break;
		}

	}
}


if(!function_exists('neko_create_zoom_link')){

	function neko_create_zoom_link (
		$post_content, 
		$activateZoom = false, 
		$activateLink = false, 
		$custom_class = '',  
		$videoType    = '',
		$hoverType	  = 'orginal'
		) 
	{

		$customizerOptions = thsp_cbp_get_options_values();	
		$largPic = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');


		switch($hoverType){
			case 'romeo':
			$icon_link = 'neko-icon-glyph-26';
			$icon_zoom  = 'neko-icon-glyph-16';
			break;
			
			default:
			$icon_link = 'neko-icon-glyph-26 iconRounded';
			$icon_zoom  = 'neko-icon-glyph-16 iconRounded';
			break;
		}

		$zoom_link = '';

		if(true === $activateZoom){

			if( 'pics' === $post_content ){

				$zoom_link .= '<a href="'.$largPic[0].'" class="neko-magnificPopImg animated opacityZero '.$custom_class.'" title="'.get_the_title().'"><i class="'.$icon_zoom.'"></i></a>';


			}elseif( 'gal' === $post_content ){

				$otherImg = array();
				for ($i = 1; $i <= $customizerOptions['nbfeaturedimg']; $i++) {

					$attachment_image = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'image'.$i, null, 'full');

					if(!empty($attachment_image)){

						array_push($otherImg, $attachment_image);

					}

				}

				$otherImg  = implode(',', $otherImg);
				$zoom_link .= '<a href="'.$largPic[0].'" class="neko-magnificPopGallery animated opacityZero '.$custom_class.'" title="'.get_the_title().'" data-gallery="'.$otherImg.'"><i class="'.$icon_zoom.'"></i></a>';

			}else{

				switch ($videoType) {
					case 0:
					$url = '//www.youtube.com/watch?v='.$post_content;
					break;
					case 1:
					$url = 'http://vimeo.com/'.$post_content;
					break;
					default:
					$url = $post_content;
					break;
				}


				$zoom_link .= '<a href="'.$url.'" class="neko-magnificPopVideo animated opacityZero '.$custom_class.'" title="'.get_the_title().'"><i class="'.$icon_zoom.'"></i></a>';

			}
		}

		if( true === $activateLink ){
			$zoom_link .= '<a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'" class=" animated opacityZero '.$custom_class.'"><i class="'.$icon_link.'"></i></a>';
		}
		return $zoom_link;
	}
}


	/**
	 * Blog detection
	 */
	if(!function_exists('neko_is_blog')){
		function neko_is_blog () {
			global  $post;
			$posttype = get_post_type($post);
			return ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() )  && ( $posttype == 'post') || is_search() || is_attachment() )  ? true : false ;
		}
	}


/**
 * The code below finds the menu item with the class "[CPT]-menu-item" and adds another “current_page_parent” class to it.
 * Furthermore, it removes the “current_page_parent” from the blog menu item, if this is present. 
 * Via http://vayu.dk/highlighting-wp_nav_menu-ancestor-children-custom-post-types/
 *
 * @package NEko framework
 * @since NEko framework 1.0
 */
if(!function_exists('neko_current_type_nav_class') && !function_exists('neko_get_current_value')){



	add_filter('nav_menu_css_class', 'neko_current_type_nav_class', 10, 2);

	function neko_current_type_nav_class($classes, $item) {
    	// Get post_type for this post
		$post_type = get_query_var('post_type');

    	// Removes current_page_parent class from blog menu item
		if ( get_post_type() == $post_type )
			$classes = array_filter($classes, "neko_get_current_value" );

    	// Go to Menus and add a menu class named: {custom-post-type}-menu-item
    	// This adds a current_page_parent class to the parent menu item
		if(!is_array($post_type)){
			if( in_array( $post_type.'-menu-item', $classes ) )
				array_push($classes, 'current_page_parent');
		}

		return $classes;
	}

	function neko_get_current_value( $element ) {
		return ( $element != "current_page_parent" );
	}
}
/**
 * Get the first link in post content
 * used in link post format
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
if(!function_exists('neko_get_post_link')){
	function neko_get_post_link() {
		if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
			return false;
		return esc_url_raw( $matches[1] );
	}
}

/**
 * Remove link tag from post content
 * used in link post format
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
if(!function_exists('neko_remove_post_link')){
	function neko_remove_post_link($content) {
		$content=preg_replace('#<a.*?>.*?</a>#i', '', $content);
		return ( do_shortcode($content) );
	}
}

/**
 * neko get post gallery
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
if(!function_exists('neko_get_gallery')){
	function neko_get_gallery($postThumbnail = false, $img_size = '', $total_featured_img = 5){

		$allImg          = array();
		$gallery         ='';
		$gallery_content ='';


		if(true === $postThumbnail){
			$hoverThumb = wp_get_attachment_image_src(get_post_thumbnail_id(),  $img_size );
			array_push($allImg, $hoverThumb[0]);
		}

		for ($i = 1; $i <= $total_featured_img; $i++) {

			$attachment_image = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'image'.$i, null, $img_size);
			$attachment_thumb = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'image'.$i, null, 'img-small');

			if(!empty($attachment_image)){
				array_push($allImg, $attachment_image);
			}
		}

		if(!empty($allImg)){

			foreach ($allImg as $key => $value) {
				$link = (false === is_single())?true:false; 
				$gallery_content .= '<div class="item">';
				//$gallery_content .= neko_get_hover_pics( $value, true, $link, true, 'gal');

				$gallery_content .= neko_get_hover_pics( 
					$hoverThumb   =  $value, 
					$activateZoom = false, 
					$activateLink = $link, 
					$return       = true, 
					$post_content = 'gal', 
					$videoType    = '', 
					$forceResp    = true, 
					$hoverType    = 'romeo'
					); 


				$gallery_content .= '</div>';

			}
		}

		if(!empty($gallery_content)){

			$gallery .= '<div class="nekoOwlCarouselSlideshowThumb owl-carousel owl-theme">';
			$gallery .= $gallery_content;
			$gallery .= '</div>';

			return $gallery;

		}else{
			return false;
		}
	}
}

/**
 * neko get post gallery
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
if(!function_exists('neko_get_data_gallery')){
	function neko_get_data_gallery($postThumbnail = false, $img_size = '', $total_featured_img = 5){

		$allImg          = array();
		$gallery         ='';
		$gallery_content ='';


		if(true === $postThumbnail){
			$hoverThumb = wp_get_attachment_image_src(get_post_thumbnail_id(),  $img_size );
			array_push($allImg, $hoverThumb[0]);
		}

		for ($i = 1; $i <= $total_featured_img; $i++) {

			$attachment_image = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'image'.$i, null, $img_size);
			$attachment_thumb = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'image'.$i, null, 'img-small');

			if(!empty($attachment_image)){
				array_push($allImg, $attachment_image);
			}
		}

		if(!empty($allImg)){

			foreach ($allImg as $key => $value) {
				$link = (false === is_singular())?true:false; 
				$gallery_content .= '<div class="item" style="background-image:url('.$value.')">';
				//$gallery_content .= '<img src="'.$value.'" alt="" class="img-responsive"/>';//neko_get_hover_pics( $value, true, $link, true, 'gal');
				$gallery_content .= '</div>';

			}
		}

		if(!empty($gallery_content)){

			// $gallery .= '<div class="nekoOwlCarouselSlideshowThumb owl-carousel owl-theme">';
			$gallery = $gallery_content;
			// $gallery .= '</div>';

			return $gallery;

		}else{
			return false;
		}
	}
}

/**
 * Enable multiples Post Thumbnails and set number of featured image for customizer
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
if (class_exists('MultiPostThumbnails')) {
	$customizerOptions = thsp_cbp_get_options_values();
	$total_featured_img = (!empty($customizerOptions['nbfeaturedimg']))?$customizerOptions['nbfeaturedimg']:4;


	for ($i = 1; $i <= $total_featured_img ; $i++) {
		new MultiPostThumbnails(
			array(
				'label' => esc_html__('Featured Image ', 'neko').($i + 1),
				'id' => 'image'.$i,
				'post_type' =>'post'
				)   
			);
		/*new MultiPostThumbnails(
			array(
				'label' => 'Featured Image '.($i + 1),
				'id' => 'image'.$i,
				'post_type' =>'page'
			)   
			);*/
		}
	}



/**
 * hex -> rgb
 * @param  [string] $hex [hex color]
 * @return [array]       [rgb color]
 * 
 * @package NEko framework
 * @since NEko framework 1.0
 */
if(!function_exists('neko_hex2rgb')){
	function neko_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		/* return implode(",", $rgb); // returns the rgb values separated by commas */
		return $rgb; /* returns an array with the rgb values */
	}	
}


/**
 * Paginated content
 */
if(!function_exists('neko_paginated_content')){
	function neko_paginated_content(){
		$pagination = wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'neko' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="post-pagination-link">',
			'link_after'  => '</span>',
			'pagelink'    => '%',
			'separator'   => '<span class="screen-reader-text">, </span>',
			'echo'        => 0
			));
		return $pagination;
	}
}


/**
 * Get all image sizes and names
 */
if(!function_exists('neko_get_image_sizes')){

	function neko_get_image_sizes( $size = '' ) {

		global $_wp_additional_image_sizes;

		$sizes = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
		foreach( $get_intermediate_image_sizes as $_size ) {

			if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

				$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

				$sizes[ $_size ] = array( 
					'width' => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
					);

			}

		}

        // Get only 1 size if found
		if ( $size ) {

			if( isset( $sizes[ $size ] ) ) {
				return $sizes[ $size ];
			} else {
				return false;
			}

		}

		return $sizes;
	}
}

/**
 * Build socialbar li's from user profile information
 */
if(!function_exists('neko_socialbar')){

	function neko_socialbar($user_id, $class_icon_size, $class_icon_rounded, $position_bar = null, $position_tips = null, $ul_class = null){
		/* Init var */
		$social_li        = '';
		$social_custom_li = '';	
		$position_tips = (null === $position_tips)?'top':$position_tips;

		$user_rss         = get_user_meta($user_id, 'rss_url', true);
		$user_google_plus = get_user_meta($user_id, 'google_profile', true);
		$user_twitter     = get_user_meta($user_id, 'twitter_profile', true);
		$user_facebook    = get_user_meta($user_id, 'facebook_profile', true);
		$user_linkedin    = get_user_meta($user_id, 'linkedin_profile', true);
		$user_github      = get_user_meta($user_id, 'github_profile', true);
		$user_flickr      = get_user_meta($user_id, 'flickr_profile', true);
		$user_dribbble    = get_user_meta($user_id, 'dribbble_profile', true);
		$user_tumblr      = get_user_meta($user_id, 'tumblr_profile', true);
		$user_reddit      = get_user_meta($user_id, 'reddit_profile', true);
		$user_deviantart  = get_user_meta($user_id, 'deviantart_profile', true);
		$user_vimeo       = get_user_meta($user_id, 'vimeo_profile', true);
		$user_youtube     = get_user_meta($user_id, 'youtube_profile', true);

		$user_social_array = array(
			'rss'        => $user_rss, 
			'googleplus' => $user_google_plus, 
			'twitter'    => $user_twitter, 
			'facebook'   => $user_facebook, 
			'linkedin'   => $user_linkedin, 
			'github'     => $user_github,
			'flickr'     => $user_flickr,
			'dribbble'   => $user_dribbble,
			'tumblr'     => $user_tumblr,
			'reddit'     => $user_reddit,
			'deviantart' => $user_deviantart,
			'vimeo'      => $user_vimeo,
			'youtube'    => $user_youtube,
			);

		foreach ($user_social_array as $key => $value) {

			$social_li .= (!empty($value))? '<li><a href="'.esc_url($value).'" class="tips socialIcon-'.$key.'" target="_blank" title="'.$key.'" data-placement="'.$position_tips.'"> <i class="neko-social-icon-'.$key.'-1 '.$class_icon_rounded.' '.$class_icon_size.'"></i></a></li>':'';

		}

		$array_custom_field = get_the_author_meta( 'custom_network', $user_id );

		if(!empty($array_custom_field)){

			foreach ($array_custom_field as $key => $value) {
				$social_custom_li .= (!empty($value['name']))? '<li><a href="'.esc_url($value['url']).'" class="tips socialIcon-'.esc_attr($value['name']).'" target="_blank" title="'.esc_attr($value['name']).'" data-placement="'.$position_tips.'"> <i class="'.esc_attr($value['icon']).' '.$class_icon_rounded.' '.$class_icon_size.'"></i></a></li>':'';
			}

		}

		if(!empty($social_li) || !empty($social_custom_li)){
			$position_bar = (null !== $position_bar)?$position_bar:'';
			return '<ul class="social-network-bar '.esc_attr($position_bar).' '.esc_attr($ul_class).'">'.$social_li.$social_custom_li.'</ul>';	
		}else{
			return false;
		}
		
	}

}


/**
 * Get the content of a dynamic sidebar for echoing later
 */
if( !function_exists('neko_get_dynamic_sidebar') ){
	function neko_get_dynamic_sidebar($index = 1)
	{
		$sidebar_contents = "";
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();
		return $sidebar_contents;
	}
}


/**
* Custom functions that act independently of the theme templates
* @package neko-framework
* @since neko-framework 1.0
*/

/**
 * Visual composer check active and activated on a specifique page
 */
if( !function_exists('neko_check_vc_status') ){

	function neko_check_vc_status( $post_id = false ) {
		
		/* If vc is installed and plugin is activated */
		if( defined( 'WPB_VC_VERSION' ) ){

			/* If we want to check status on a specific page */
			if( false !== $post_id ){
				$vc_enabled = get_post_meta( $post_id, '_wpb_vc_js_status', true);

				/* If vc is active on the page or post  */
				if( 'true' == $vc_enabled ){

					return true;

					/* If vc is NOT active on the page or post  */
				}else{
					return false;
				}

			}else{
				return true;
			}

			/* If vc is NOT installed and plugin is NOT activated */	
		}else{
			return false;
		}
	}
}


/**
 * Force change local programatically
 */
/*if( !function_exists('wpse_52419_change_language') ){

	add_filter( 'locale', 'wpse_52419_change_language', 10); 
	function wpse_52419_change_language( $locale )
	{
	    return 'fr_FR';
	}

}*/
