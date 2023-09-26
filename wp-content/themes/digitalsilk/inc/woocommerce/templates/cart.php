<?php
/**
 * Change Cart Page
 */

class DS_Cart {

	public function __construct()
	{
		add_filter('woocommerce_cross_sells_total', array( $this, 'cart_cross_sell_total' ) );
	}

	public function cart_cross_sell_total( $total ): int
	{
		return 3;
	}

}

new DS_Cart();