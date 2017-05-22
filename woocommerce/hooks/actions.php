<?php 
/**
 * Ajax remove item from woocommerce neko header cart
 */
if(!function_exists('neko_woocommerce_ajax_remove_from_cart')){

	function neko_woocommerce_ajax_remove_from_cart() {
		global $woocommerce;

		$woocommerce->cart->set_quantity( $_POST['remove_item'], 0 );

		$wc_ajax = new WC_AJAX();
		$wc_ajax->get_refreshed_fragments();

		die();
	}

	add_action('wp_ajax_woocommerce_remove_from_cart','neko_woocommerce_ajax_remove_from_cart',1000);
	add_action('wp_ajax_nopriv_woocommerce_remove_from_cart', 'neko_woocommerce_ajax_remove_from_cart',1000);

}
