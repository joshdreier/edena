<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * NEko Theme widgets
 */
require_once( get_template_directory() . '/inc/widget/neko_contact.php'); 
require_once( get_template_directory() . '/inc/widget/neko_tabs.php'); 
require_once( get_template_directory() . '/inc/widget/neko_about/neko_about.php'); 

/**
 * NEko metaboxes & tax metaboxes
 */

/* COMMON TO ALL POST TYPES */
require_once(get_template_directory() . '/framework/metaboxes/metabox_menu_override.php');


/* SPECIFIC TO PAGE */
require_once(get_template_directory() . '/framework/metaboxes/metabox_header.php');
require_once(get_template_directory() . '/framework/metaboxes/metabox_preloader.php');
/*require_once(get_template_directory() . '/framework/metaboxes/metabox_headerfeaturedposts.php');
require_once(get_template_directory() . '/framework/metaboxes/metabox_mask_header.php');
require_once(get_template_directory() . '/framework/metaboxes/metabox_video_header.php');
require_once(get_template_directory() . '/framework/metaboxes/metabox_parallax_header.php');*/


/**
 * Customize vc
 */
require_once( get_template_directory() . '/inc/vc-custom/vc-custom.php'); 


/**
* Get post format icon
*
* @package edena
* @since edena 1.0
*/
if ( ! function_exists( 'neko_get_post_icon' ) ) :

	function neko_get_post_icon($return = false) { 
		/*get the format and choose icon */ 
		$post_icon='';
		$my_post_format=get_post_format();
		if ($my_post_format==false){
			$post_icon='edit';
		} else if ($my_post_format=='image'){
			$post_icon='picture';
		} else if ($my_post_format=='aside'){
			$post_icon='comment';
		} else if ($my_post_format=='chat'){
			$post_icon='chat-1';
		} else if ($my_post_format=='gallery'){
			$post_icon='camera';
		} else if ($my_post_format=='link'){
			$post_icon='link-ext';
		} else if ($my_post_format=='quote'){
			$post_icon='quote-left-1';
		} else if ($my_post_format=='status'){
			$post_icon='twitter';
		} else if ($my_post_format=='video'){
			$post_icon='videocam';
		} else if ($my_post_format=='audio'){
			$post_icon='headphones';
		}

		/* output */
		if( false === $return ){

			printf('<i class="neko-icon-'.$post_icon.'"></i>');

		}else{

			return '<i class="neko-icon-'.$post_icon.'"></i>'; 
		}
	}

endif;

/**
* Get post date box
*
* @package edena
* @since edena 1.0
*/

if ( ! function_exists( 'neko_get_post_date' ) ) :

	function neko_get_post_date($return = false) {

		if( false === $return ){

	    printf('<div class="postDate">
	            <span class="dateDay big-heading">'.get_the_time('d').'</span>
	            <span class="dateMonth">'.get_the_time('M').'.</span>
	        </div>');

	    }else{
	        
	    return '<div class="postDate">
	           <span class="dateDay big-heading">'.get_the_time('d').'</span>
	           <span class="dateMonth">'.get_the_time('M').'.</span>
	        </div>'; 

	    }

	}

endif;

?>