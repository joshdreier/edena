<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */
?>	

<?php do_action( 'before_sidebar' ); ?>
<?php if ( generated_dynamic_sidebar() ) : endif; ?>
<?php do_action( 'after_sidebar' ); ?>