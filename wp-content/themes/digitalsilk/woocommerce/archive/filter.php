<div class="shop-filters">
	<ul class="products_shop_filter">
		<?php dynamic_sidebar('woocommerce-filter'); ?>
	</ul>

	<button class="btn mobile-filter"><?php _e( 'Filter', 'woocommerce' ); ?></button>
	<button class="close-filter">
		<?php echo get_svg( array( 'icon' => 'close', 'class' => 'icon-stroke-blue icon-fill-none' ) ); ?>
	</button>
</div>