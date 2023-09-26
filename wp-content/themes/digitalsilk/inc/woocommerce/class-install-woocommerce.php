<?php
/**
 * Prepare Woocommerce to use in theme
 */

if ( ! class_exists( 'ThemeWoocommerceInstall' ) ) {

    Class ThemeWoocommerceInstall {

        public function __construct() {
            add_action( 'after_setup_theme', array( $this, 'woo_add_support' ) );

            add_action( 'init', array( $this, 'disable_woocommerce_sidebar' ) );

            // add_filter( 'woocommerce_enqueue_styles', array( $this, 'woo_dequeue_styles' ) );
	        add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	        add_action( 'acf/init', array( $this, 'options_page' ) );
        }

        public function woo_add_support() {
			add_theme_support( 'woocommerce' );
//			add_theme_support( 'wc-product-gallery-zoom' );
//			add_theme_support('wc-product-gallery-lightbox');
//			add_theme_support('wc-product-gallery-slider');
        }

        public function woo_dequeue_styles( $enqueue_styles ) {
            //unset( $enqueue_styles[ 'woocommerce-layout' ] );        // Remove the layout

            return $enqueue_styles;
        }

        public function disable_woocommerce_sidebar() {
            remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
        }

	    public function options_page(){
		    if( function_exists('acf_add_options_sub_page') ) {
			    $current_user = wp_get_current_user();
			    if ( strpos( $current_user->user_email, '@digitalsilk.com' ) ) {
				    acf_add_options_sub_page( array(
					    'page_title'  => __( 'Theme Settings' ),
					    'menu_title'  => __( 'Theme Settings' ),
					    'menu_slug'   => 'ds-woo-settings',
					    'parent_slug' => 'woocommerce',
				    ) );

				    acf_add_options_sub_page( array(
					    'page_title'  => __( 'Theme Content' ),
					    'menu_title'  => __( 'Theme Content' ),
					    'menu_slug'   => 'ds-woo-content',
					    'parent_slug' => 'woocommerce',
				    ) );
			    }
		    }
	    }

    }

    new ThemeWoocommerceInstall();

}