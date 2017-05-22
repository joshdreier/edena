<?php
/**
 * The template for displaying search forms in neko-framework
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <fieldset>
          <input type="text" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search...', 'neko' ); ?>" />
          <button name="search" id="search" type="submit"><?php esc_html_e( 'Submit', 'neko' ); ?></button>
      </fieldset>
</form>
