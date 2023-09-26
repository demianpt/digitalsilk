<?php
define( 'THEME_URL', get_stylesheet_directory_uri() );

/**
 * Main theme functions: assets including, post types, walkers etc.
 */
require_once( 'inc/theme-setup.php' );

/**
 * Woocommerce Files and Classes
 * Enable for Woocommerce projects
 */
if ( class_exists( 'woocommerce' ) ) {
	include_once( 'inc/woocommerce/woocommerce-setup.php' );
}
