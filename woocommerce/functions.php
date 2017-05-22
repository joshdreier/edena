<?php
/**
 * Roll over on loop thumbnails 
 */
if( !function_exists('woocommerce_template_loop_product_thumbnail()') ){
	function woocommerce_template_loop_product_thumbnail(){
			?>
				<figure class="img-hover romeo">
		  			<?php echo woocommerce_get_product_thumbnail(); ?>
		  			<figcaption>
		  				<span class="animated opacityZero full-link"><i class="neko-icon-glyph-26"></i></span>
		  			</figcaption>
		  	</figure>
	    <?php
	}
}
