<div class="cart-popup" aria-expanded="false">
    <?php if( WC()->cart->cart_contents_count > 0 ): ?>
        <?php get_template_part( 'woocommerce/header/cart-popup-items' ); ?>

	    <div class="cart-checkout">
		    <a href="<?php echo wc_get_checkout_url(); ?>" class="cart-product-order btn-primary c-btn -primary">
			    <?php _e( 'Checkout', 'dstheme' ); ?>
			    <span class="c-btn__ico">
				    <svg width="30" height="30" class="icon icon-lib-icon-arrow1 " aria-hidden="true" role="img">
					    <use xlink:href="#lib-icon-arrow1"></use>
				    </svg>
			    </span>
		    </a>
	    </div>

    <?php else: ?>

        <div class="no-products"><?php _e('No products in the cart.'); ?></div>

    <?php endif; ?>
</div>
