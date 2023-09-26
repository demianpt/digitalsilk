<?php
/**
 * Class to customize my account whishlist page for a plugin TI-Whishlist
 *
 * https://wordpress.org/plugins/ti-woocommerce-wishlist/
 */

class DS_Wishlist {
	public function __construct() {
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_filter( 'woocommerce_account_menu_item_classes', array( $this, 'wishlist_navigation_class' ), 10, 2 );
		add_action( 'tinvwl_before_wishlist', array( $this, 'wishlist_before' ) );
		add_action( 'tinvwl_after_wishlist', array( $this, 'wishlist_after' ) );

	}

	public function body_class( $classes ) {
		if ( is_wishlist() ) {
			$classes[] = 'woocommerce woocommerce-account woocommerce-wishlist';
		}

		return $classes;
	}

	public function wishlist_before() {
		?>
        <div class="woocommerce">
            <?php woocommerce_account_navigation(); ?>
            <div class="woocommerce-MyAccount-content">
		<?php
	}

	public function wishlist_after() {
		?>
            </div>
        </div>
		<?php
	}

	public function wishlist_navigation_class( $classes, $endpoint ) {

		if ( $endpoint === 'dashboard' && is_wishlist() ) {
			$active_class_key = array_search( 'is-active', $classes );
			if ( $active_class_key !== false ) {
				unset( $classes[ $active_class_key ] );
			}
		}

		if ( $endpoint === 'tinv_wishlist' && is_wishlist() ) {
			$classes[] = 'is-active';
		}

		return $classes;
	}
}

new DS_Wishlist();
