<?php
/**
 * Widget template. This template can be overriden using the "sp_template_image-widget_widget.php" filter.
 * See the readme.txt file for more info.
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo trim( $before_widget );

if ( !empty( $title ) ) { echo trim( $before_title ) . trim( $title ) . trim( $after_title ); }

echo trim( $this->get_image_html( $instance, true ) );

if ( !empty( $description ) ) {
	echo '<div class="'.$this->widget_options['classname'].'-description" >';
	echo wpautop( $description );
	echo "</div>";
}
echo trim( $after_widget );
?>