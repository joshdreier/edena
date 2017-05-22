<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		Netwakies
 * @package 	WooCommerce-NW-ADCart/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<div id="neko-cart-drop-content">

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="neko-cart-list">

	<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

		<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

			$_product = $cart_item['data'];
			$quantity = $cart_item['quantity'];
			// Only display if allowed
			
			if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
				continue;

			// Get price
			$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
			$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
			?>


			<div class="neko-cart-product-title clearfix">
				<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

					<div style="width:50px; float:left; margin-right:10px;">
						<?php echo $_product->get_image(); ?>
					</div>

					<div class="product-info" tyle="float:left;">
					<?php 
					echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); 
					echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); 
					?>
					</div>

				</a>

				<?php 
				
				echo sprintf('<a href="javascript:void(0);" rel="'.$cart_item_key.'" class="ajax-remove-item remove" title="%s">&times;</a>', esc_html__( 'Remove this item', 'neko' ) ); 
				?>

			</div>

			



		<?php endforeach; ?>

	<?php else : ?>

		<?php esc_html_e( 'Your cart is empty !', 'neko' ); ?>

	<?php endif; ?>

</div><!-- end product list -->

<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
	

	<div class="total"><strong><?php esc_html_e( 'Subtotal', 'neko' ); ?>:</strong> <?php echo $woocommerce->cart->get_cart_subtotal(); ?></div>

	
	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="buttons">
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="btn"><?php esc_html_e( 'View Cart', 'neko' ); ?></a>
		<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="btn checkout"><?php esc_html_e( 'Checkout', 'neko' ); ?></a>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
</div>