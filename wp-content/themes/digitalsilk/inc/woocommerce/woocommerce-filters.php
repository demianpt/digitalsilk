<?php
/**
 * Change Woocommerce Breadcrumbs display settings
 */
if( !function_exists('ds_custom_woocommerce_breadcrumbs') ){
    add_filter( 'woocommerce_breadcrumb_defaults', 'ds_custom_woocommerce_breadcrumbs' );
    function ds_custom_woocommerce_breadcrumbs() {
        return array(
            'delimiter'   => '<span class="delimiter">&#47</span>',
            'wrap_before' => '<div class="container"><nav class="woocommerce-breadcrumb">',
            'wrap_after'  => '</nav></div>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
    }
}

/**
 * Standard filter view "Any color" or "Any type"
 * Filter removing "Any" word from Woocommerce filter widget
 */
if( !function_exists('ds_remove_any_from_filter_dropdown') ) {
    add_filter('woocommerce_layered_nav_any_label', 'ds_remove_any_from_filter_dropdown', 10, 3);
    function ds_remove_any_from_filter_dropdown($sprintf, $taxonomy_label, $taxonomy){

        // 'Any %s' by default
        $sprintf = sprintf(__('%s', 'woocommerce'), $taxonomy_label);
        return $sprintf;
    }
}