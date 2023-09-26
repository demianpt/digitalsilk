<?php

if( is_shop() ){
	$title          =  get_field( 'shop_title', 'options' ) ?: get_the_title( get_option( 'woocommerce_shop_page_id' ) );
	$description    =  get_field( 'shop_subtitle', 'options' );
}
else{
	$term           = get_queried_object();
	$title          = $term->name;
	$description    = $term->description;
}

$background         = get_field( 'shop_background', 'options' );

if( $title || ! empty( $description ) ): ?>

<div class="shop_subheader" <?php if( !empty($background) ): ?>style="background-image: url(<?php echo $background; ?>)"<?php endif; ?>>
    <?php if( $title ): ?>
        <h1><?php echo $title; ?></h1>
    <?php endif; ?>

    <?php if( ! empty( $description ) ): ?>
        <div><?php echo $description; ?></div>
    <?php endif; ?>
</div>

<?php endif; ?>
