<?php

/**
 * Change Single Product Page
 */

class DS_WooGlobalItems {

	public function __construct()
	{
		add_action('woocommerce_before_quantity_input_field', array($this, 'qty_before'), 99 );
		add_action('woocommerce_after_quantity_input_field', array($this, 'qty_after'), 0 );
	}

	public function qty_before(){
		?><span class="item_qty minus" value="-">-</span><?php
	}
	public function qty_after(){
		?><span class="item_qty plus" value="+">+</span><?php
	}

}

new DS_WooGlobalItems();
