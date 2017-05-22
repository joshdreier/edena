<?php 
/*add_filter( 'woocommerce_page_title', 'neko_woo_shop_page_title');

function neko_woo_shop_page_title( $page_title ) {
		return "";
}
*/

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */

if( !function_exists('neko_wcmenucart') ){
	function neko_wcmenucart($menu, $args) {

		if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
			return $menu;

		ob_start();
		global $woocommerce;

		$start_shopping = __('Start shopping', 'neko');
		$cart_url = $woocommerce->cart->get_cart_url();

		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );

		$menu_item = '<li class="right neko-cart-link" id="neko-cart-link"><a class="cart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
		$menu_item .= '<i class="neko-icon-glyph-120"></i> ';
		$menu_item .= '</a><div id="neko-cart-drop-content"></a></li>';

		echo $menu_item;

		$social = ob_get_clean();
		return $menu . $social;

	}

	add_filter('wp_nav_menu_items','neko_wcmenucart', 10, 2);
}



/* Ensure cart contents update when products are added to the cart via AJAX */
if( !function_exists('neko_header_add_to_cart_fragment') ){
		function neko_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
			<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html__( 'View your shopping cart', 'neko' ); ?>">
				<i class="neko-icon-glyph-120"></i> 

				<?php if( WC()->cart->get_cart_contents_count() > 0 ) { ?>
					<?php echo sprintf ('<span class="badge">%d</span>', WC()->cart->get_cart_contents_count() ); ?> 
				<?php } ?>

			</a> 
		<?php
		$fragments['a.cart-contents'] = ob_get_clean();

		ob_start();
		include_once( get_template_directory() . '/woocommerce/neko-template/header-cart-content.php');

		$fragments['div#neko-cart-drop-content'] = ob_get_clean();

		return $fragments;
	}

	add_filter( 'woocommerce_add_to_cart_fragments', 'neko_header_add_to_cart_fragment' );

}




