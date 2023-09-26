<?php
/**
 * Change User Account Layout
 */

class DS_UserAccount {

	public function __construct() {
		add_filter( 'woocommerce_account_menu_items', array( $this, 'user_menu_items' ), 10, 1 );

		add_action( 'woocommerce_before_account_navigation', array( $this, 'open_navigation_wrapper' ), 10 );
		add_action( 'woocommerce_after_account_navigation', array( $this, 'close_navigation_wrapper' ), 99 );
	}

	public function user_menu_items( $items ) {
		unset( $items['downloads'] );

		return $items;
	}

	public function open_navigation_wrapper() {
		echo '<div class="woocommerce-navigation-wrapper">';
	}

	public function close_navigation_wrapper() {
		echo '</div>';
	}

}

new DS_UserAccount();