<?php
/**
 * Setup Wordpress Functionality
 */
require_once 'functions-theme-setup.php';

/**
 * Include custom Theme Filters
 */
include_once 'functions-filters.php';

/**
 * ACF json auto sync
 */
include_once 'class-acf-json-autosync.php';

/**
 * ACF GravityForms field
 */
include_once 'class-acf-field-gf.php';

/**
 * Include theme helpers.
 * Additional functions for plugins ot update standard WP functionality
 */
include_once 'functions-helpers.php';

/**
 * Include site JS and CSS (frontend and admin panel side)
 */
include_once 'class-assets.php';

/**
 * Add functionality to require plugins in theme
 */
include_once 'class-default-plugins.php';

/**
 * Add ACF Fields with php arrays instead off JSON
 */
add_action( 'acf/init', function () {
	foreach ( glob( get_template_directory() . '/inc/acf-php/*.php' ) as $filename ) {
		include_once $filename;
	}
	foreach ( glob( get_template_directory() . '/inc/acf-php/*/*.php' ) as $filename ) {
		include_once $filename;
	}
}, 10 );

/**
 * Classes with customizations for Custom Post Types and Custom Taxonomies
 */
foreach ( glob( get_template_directory() . '/inc/post_types/*.php' ) as $filename ) {
    include_once $filename;
}

/**
 * Add PHP Libs to theme
 */
foreach ( glob( get_template_directory() . '/inc/lib/*.php' ) as $filename ) {
    include_once $filename;
}

/**
 * Separated ajax functions
 * Each file for single ajax action
 */
foreach ( glob( get_template_directory() . '/inc/ajax/*.php' ) as $filename ) {
    include_once $filename;
}

/**
 * Separated Shortcodes functions
 */
foreach ( glob( get_template_directory() . '/inc/shortcodes/*.php' ) as $filename ) {
    include_once $filename;
}

/**
 * Add Module Menu Walkers
 */
foreach ( glob( get_template_directory() . '/inc/walkers/*.php' ) as $filename ) {
    include_once $filename;
}

/**
 * ACF json auto sync
 */
//include_once 'class-acf-json-autosync.php';
