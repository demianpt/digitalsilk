<?php

function ds_alter_quantity() {
    $quantity = filter_var(filter_input(INPUT_POST, 'quantity'), FILTER_VALIDATE_INT);
    $cart_item_key = filter_input(INPUT_POST, 'cart_item_key');

    WC()->cart->set_quantity( $cart_item_key, $quantity );

    echo json_encode( WC()->cart->get_cart_item($cart_item_key) );
    exit;
}
add_action( 'wp_ajax_nopriv_ds_alter_quantity', 'ds_alter_quantity' );
add_action( 'wp_ajax_ds_alter_quantity', 'ds_alter_quantity' );


function ds_delete_item_checkout() {
    preg_match('/remove_item=(.*)&/', $_POST['data_remove_link'], $match);
    $cart_item_key = $match[1];

    WC()->cart->remove_cart_item( $cart_item_key );
    woocommerce_cart_totals();

    exit;
}
add_action( 'wp_ajax_nopriv_ds_delete_item_checkout', 'ds_delete_item_checkout' );
add_action( 'wp_ajax_ds_delete_item_checkout', 'ds_delete_item_checkout' );