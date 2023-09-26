<div class="cart-products-list">
    <?php foreach ( WC()->cart->cart_contents as $item ):
        $product = wc_get_product( !empty($item["variation_id"]) ? $item["variation_id"] : $item["product_id"] );
        ?>
        <div class="cart-product">
            <div class="cart-product-image">
                <?php
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $item['product_id'] ), 'single-post-thumbnail' );
                $image_src = ( !$image ) ? wc_placeholder_img_src() : $image[0];
                ?>
                <a href="<?php echo get_permalink( $item['product_id'] ); ?>"><img width="100" height="100" src="<?php echo $image_src; ?>" alt="<?php echo get_the_title( $item['product_id'] ); ?>"></a>
            </div>
	        <div class="cart-product-content">
		        <div class="cart-product-info">
			        <a href="<?php echo get_permalink( $item['product_id'] ); ?>"><?php echo get_the_title( $item['product_id'] ); ?></a>

			        <p class="cart-product-info-attr"><?php echo $item['data']->attribute_summary; ?></p>
		        </div>

		        <div class="cart-product-total">
			        <span><?php echo get_woocommerce_currency_symbol(); ?></span><?php echo $item['line_total']; ?>
		        </div>

		        <div class="cart-product-edit">
			        <div class="cart-product-edit-quantity quantity">
				        <a href="javascript:;" class="ds-qty-button ds-btn-sub">-</a>
				
					        <?php echo woocommerce_quantity_input(
					                array(
					                        'min_value'     => 0,
					                        'max_value'     => $product->get_max_purchase_quantity(),
                                            'input_value'   => $item['quantity'],
                                            'input_name'    => "cart[{$item['key']}][qty]"),
                                    $product,
                                    false ); ?>
	
	                    <a href="javascript:;" class="ds-qty-button ds-btn-inc">+</a>
			        </div>
                </div>
                <div class="cart-product-edit-delete">
                    <a href="javascript:;" data-remove="<?php echo wc_get_cart_remove_url( $item['key'] ); ?>" class="remove-item remove_from_cart_button" ><?php _e( 'Remove', 'woocommerce' ); ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="cart-products-subtotal">
        <p class="cart-products-subtotal-text"><?php _e( 'Total:', 'dstheme' ); ?></p>
        <p class="cart-products-subtotal-summ"><?php echo get_woocommerce_currency_symbol(); ?><?php echo WC()->cart->cart_contents_total; ?></p>
    </div>
</div>
