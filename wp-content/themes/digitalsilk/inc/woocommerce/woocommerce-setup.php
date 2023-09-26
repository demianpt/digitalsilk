<?php

/**
 * Configure woocommerce functionality and supports
 */
require_once ( 'class-install-woocommerce.php' );

/**
 * Include woocommerce filters
 */
require_once ( 'woocommerce-filters.php' );

/**
 * Include woocommerce helper functions
 */
require_once('woocommerce-helpers.php');

/**
 * Include woocommerce templates classes
 */
require_once('woocommerce-templates.php');

/**
 * Woocommerce ajax functions
 */
foreach (glob(get_template_directory() . '/inc/woocommerce/ajax/*.php') as $filename) {
	include_once $filename;
}

/**
 * Registered ACF groups for woocommerce objects
 */
add_action('acf/init', function () {
	foreach (glob(get_template_directory() . '/inc/woocommerce/acf-php/*.php') as $filename) {
		include_once $filename;
	}
});