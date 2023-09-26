<?php
/**
 * Change Shop Page
 */

class DS_CartPopup {

	public function __construct() {
		add_action( 'woocommerce_add_to_cart_fragments', array( $this, 'ds_woocommerce_cart_popup_products_count' ) );
		add_action( 'woocommerce_add_to_cart_fragments', array( $this, 'ds_woocommerce_cart_popup_products_list' ) );
	}

	public function ds_woocommerce_cart_popup_products_count( $fragments ) {
		ob_start(); ?>

        <span class="cart-value" <?php echo ( WC()->cart->cart_contents_count == 0 ) ? 'style="display:none;"' : ''; ?>><?php echo WC()->cart->get_cart_contents_count(); ?></span>

		<?php $fragments['span.cart-value'] = ob_get_clean();

		return $fragments;
	}

	public function ds_woocommerce_cart_popup_products_list( $fragments ) {
		ob_start();

		get_template_part( 'woocommerce/header/cart-popup' );

		$fragments['div.cart-popup'] = ob_get_clean();

		return $fragments;
	}

}

new DS_CartPopup();