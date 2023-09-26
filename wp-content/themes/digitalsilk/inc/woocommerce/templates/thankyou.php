<?php

/**
 * Change Single Product Page
 */

class DS_WooThankyou
{

	public function __construct()
	{
		add_filter('woocommerce_thankyou_order_received_text', array($this, 'order_received_title'), 10, 2 );
	}

	public function order_received_title( $var, $order ){

		$var = "<h1>".__( 'Order received.', 'woocommerce' )."</h1>";

		$var .= __( 'Thank you. Your order has been received.', 'woocommerce' );

		$var .= "<a class='c-btn -primary' href='".get_permalink( wc_get_page_id( 'shop' ) )."'>".__( 'Back to shop', 'woocommerce' )."</a>";

		return $var;
	}

}

new DS_WooThankyou();
