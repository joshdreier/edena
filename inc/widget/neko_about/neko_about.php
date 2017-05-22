<?php
/**/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');



/**
 * Register the Widget
 */
function neko_about_widgetloader()
{
	register_widget('neko_about_widget');
}


add_action('widgets_init', 'neko_about_widgetloader');

class neko_about_widget extends WP_Widget
{

	const VERSION = '4.1';
	const CUSTOM_IMAGE_SIZE_SLUG = 'neko_about_widget_thumb';


    /**
     * Constructor
     **/
    public function __construct()
    {

        $widget_ops = array(
            'classname' => 'neko_about_widget',
            'description' => 'About Informations.'
        );
        $control_ops = array( 'id_base' => 'neko_about_widget' );

        parent::__construct( 'neko_about_widget', '[ NEKO ] About', $widget_ops, $control_ops );

		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );

		add_action( 'admin_head-widgets.php', array( $this, 'admin_head' ) );

    }

	/**
	 * Test to see if this version of WordPress supports the new image manager.
	 * @return bool true if the current version of WordPress does NOT support the current image management tech.
	 */
	private function use_old_uploader() {
		if ( defined( 'IMAGE_WIDGET_COMPATIBILITY_TEST' ) ) return true;
		return !function_exists('wp_enqueue_media');
	}

	/**
	 * Enqueue all the javascript.
	 */
	function admin_setup() {
		wp_enqueue_media();
		wp_enqueue_script( 'neko_about-widget', get_template_directory_uri().'/inc/widget/neko_about/assets/image-widget.js', array( 'jquery', 'media-upload', 'media-views' ), self::VERSION );

		wp_localize_script( 'neko_about-widget', 'NekoAboutWidget', array(
			'frame_title' => esc_html__( 'Select an Image', 'neko' ),
			'button_title' => esc_html__( 'Insert Into Widget', 'neko' ),
		) );
	}


    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );
		if ( !empty( $instance['imageurl'] ) || !empty( $instance['attachment_id'] ) ) {

			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
			$instance['description'] = apply_filters( 'widget_text', $instance['description'], $args, $instance );
			$instance['width'] = apply_filters( 'image_widget_image_width', abs( $instance['width'] ), $args, $instance );
			$instance['height'] = apply_filters( 'image_widget_image_height', abs( $instance['height'] ), $args, $instance );
			$instance['maxwidth'] = apply_filters( 'image_widget_image_maxwidth', esc_attr( $instance['maxwidth'] ), $args, $instance );
			$instance['maxheight'] = apply_filters( 'image_widget_image_maxheight', esc_attr( $instance['maxheight'] ), $args, $instance );
			$instance['align'] = apply_filters( 'image_widget_image_align', esc_attr( $instance['align'] ), $args, $instance );

			$alt = apply_filters( 'image_widget_image_alt', esc_attr( $instance['title'] ), $args, $instance );

			$instance['size'] = apply_filters( 'image_widget_image_size', esc_attr( $instance['size'] ), $args, $instance );
			$instance['attachment_id'] = ( $instance['attachment_id'] > 0 ) ? $instance['attachment_id'] : $instance['image'];
			$instance['attachment_id'] = apply_filters( 'image_widget_image_attachment_id', abs( $instance['attachment_id'] ), $args, $instance );
			$instance['size'] = apply_filters( 'image_widget_image_size', esc_attr( $instance['size'] ), $args, $instance );
			$instance['imageurl'] = apply_filters( 'image_widget_image_url', esc_url( $instance['imageurl'] ), $args, $instance );

			// No longer using extracted vars. This is here for backwards compatibility.
			extract( $instance );

			include( get_template_directory().'/inc/widget/neko_about/views/widget.php' );
		}
	}

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, self::get_defaults() );



		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') ) {
			$instance['description'] = $new_instance['description'];
		} else {
			$instance['description'] = wp_filter_post_kses($new_instance['description']);
		}

		$instance['width']  = abs( $new_instance['width'] );
		$instance['height'] = abs( $new_instance['height'] );
		$instance['size']   = $new_instance['size'];
		$instance['align']  = $new_instance['align'];

		// Reverse compatibility with $image, now called $attachement_id
		if ( !defined( 'IMAGE_WIDGET_COMPATIBILITY_TEST' ) && $new_instance['attachment_id'] > 0 ) {
			$instance['attachment_id'] = abs( $new_instance['attachment_id'] );
		} elseif ( $new_instance['image'] > 0 ) {
			$instance['attachment_id'] = $instance['image'] = abs( $new_instance['image'] );
			if ( class_exists('ImageWidgetDeprecated') ) {
				$instance['imageurl'] = ImageWidgetDeprecated::get_image_url( $instance['image'], $instance['width'], $instance['height'] );  // image resizing not working right now
			}
		}

		$instance['imageurl'] = $new_instance['imageurl']; // deprecated

		$instance['aspect_ratio'] = $this->get_image_aspect_ratio( $instance );



		return $instance;
	}

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void
     **/
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, self::get_defaults() );
		//echo '<pre>'; print_r($instance); echo '</pre>';
		include( get_template_directory().'/inc/widget/neko_about/views/widget-admin.php'  );

	}


	/**
	 * Admin header css
	 *
	 * @author Modern Tribe, Inc.
	 */
	function admin_head() { ?>

	<style type="text/css">
		.uploader input.button {
			width: 100%;
			height: 34px;
			line-height: 33px;
			margin-top: 15px;
		}
		.neko_about_preview .aligncenter {
			display: block;
			margin-left: auto !important;
			margin-right: auto !important;
		}
		.neko_about_preview {
			overflow: hidden;
			max-height: 300px;
		}
		.neko_about_preview img {
			margin: 10px 0;
			height: auto;
			/*width:400px;*/
		}
	</style>
	<?php
	}


	/**
	 * Render an array of default values.
	 *
	 * @return array default values
	 */
	private static function get_defaults() {

		$defaults = array(
			'title' => '',
			'description' => '',
			'link' => '',
			'linktarget' => '',
			'width' => 0,
			'height' => 0,
			'maxwidth' => '100%',
			'maxheight' => '',
			'image' => 0, // reverse compatible - now attachement_id
			'imageurl' => '', // reverse compatible.
			'align' => 'none',
			'alt' => '',
		);

		$defaults['size'] = self::CUSTOM_IMAGE_SIZE_SLUG;
		$defaults['attachment_id'] = 0;

		return $defaults;
	}

	/**
	 * Render the image html output.
	 *
	 * @param array $instance
	 * @param bool $include_link will only render the link if this is set to true. Otherwise link is ignored.
	 * @return string image html
	 */
	private function get_image_html( $instance, $include_link = true ) {

		// Backwards compatible image display.
		if ( $instance['attachment_id'] == 0 && $instance['image'] > 0 ) {
			$instance['attachment_id'] = $instance['image'];
		}

		$output = '';

		if ( $include_link && !empty( $instance['link'] ) ) {
			$attr = array(
				'href' => $instance['link'],
				'target' => $instance['linktarget'],
				'class' => 	$this->widget_options['classname'].'-image-link',
				'title' => $instance['title'],
			);
			$attr = apply_filters('image_widget_link_attributes', $attr, $instance );
			$attr = array_map( 'esc_attr', $attr );
			$output = '<a';
			foreach ( $attr as $name => $value ) {
				$output .= sprintf( ' %s="%s"', $name, $value );
			}
			$output .= '>';
		}

		$size = $this->get_image_size( $instance );
		if ( is_array( $size ) ) {
			$instance['width'] = $size[0];
			$instance['height'] = $size[1];
		} elseif ( !empty( $instance['attachment_id'] ) ) {
			//$instance['width'] = $instance['height'] = 0;
			$image_details = wp_get_attachment_image_src( $instance['attachment_id'], $size );
			if ($image_details) {
				$instance['imageurl'] = $image_details[0];
				$instance['width'] = $image_details[1];
				$instance['height'] = $image_details[2];
			}
		}
		$instance['width'] = abs( $instance['width'] );
		$instance['height'] = abs( $instance['height'] );

		$attr = array();
		$attr['alt'] = $instance['title'];
		if (is_array($size)) {
			$attr['class'] = 'attachment-'.join('x',$size);
		} else {
			$attr['class'] = 'attachment-'.$size;
		}
		$attr['style'] = '';
		if (!empty($instance['maxwidth'])) {
			$attr['style'] .= "max-width: {$instance['maxwidth']};";
		}
		if (!empty($instance['maxheight'])) {
			$attr['style'] .= "max-height: {$instance['maxheight']};";
		}
		if (!empty($instance['align']) && $instance['align'] != 'none') {
			$attr['class'] .= " align{$instance['align']}";
		}
		$attr = apply_filters( 'image_widget_image_attributes', $attr, $instance );

		// If there is an imageurl, use it to render the image. Eventually we should kill this and simply rely on attachment_ids.
		if ( !empty( $instance['imageurl'] ) ) {
			// If all we have is an image src url we can still render an image.
			$attr['src'] = $instance['imageurl'];
			$attr = array_map( 'esc_attr', $attr );
			$hwstring = image_hwstring( $instance['width'], $instance['height'] );
			$output .= rtrim("<img $hwstring");
			foreach ( $attr as $name => $value ) {
				$output .= sprintf( ' %s="%s"', $name, $value );
			}
			$output .= ' />';
		} elseif( abs( $instance['attachment_id'] ) > 0 ) {
			$output .= wp_get_attachment_image($instance['attachment_id'], $size, false, $attr);
		}

		if ( $include_link && !empty( $instance['link'] ) ) {
			$output .= '</a>';
		}

		return $output;
	}

	/**
	 * Assesses the image size in case it has not been set or in case there is a mismatch.
	 *
	 * @param $instance
	 * @return array|string
	 */
	private function get_image_size( $instance ) {
		if ( !empty( $instance['size'] ) && $instance['size'] != self::CUSTOM_IMAGE_SIZE_SLUG ) {
			$size = $instance['size'];
		} elseif ( isset( $instance['width'] ) && is_numeric($instance['width']) && isset( $instance['height'] ) && is_numeric($instance['height']) ) {
			$size = array(abs($instance['width']),abs($instance['height']));
			$size = array($instance['width'],$instance['height']);
		} else {
			$size = 'full';
		}
		return $size;
	}

	/**
	 * Establish the aspect ratio of the image.
	 *
	 * @param $instance
	 * @return float|number
	 */
	private function get_image_aspect_ratio( $instance ) {
		if ( !empty( $instance['aspect_ratio'] ) ) {
			return abs( $instance['aspect_ratio'] );
		} else {
			$attachment_id = ( !empty($instance['attachment_id']) ) ? $instance['attachment_id'] : $instance['image'];
			if ( !empty($attachment_id) ) {
				$image_details = wp_get_attachment_image_src( $attachment_id, 'full' );
				if ($image_details) {
					return ( $image_details[1]/$image_details[2] );
				}
			}
		}
	}
	
}