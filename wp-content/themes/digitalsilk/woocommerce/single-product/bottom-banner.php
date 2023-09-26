<?php
/**
 * The template for displaying common product CTA banner right before site footer
 */

defined( 'ABSPATH' ) || exit;

if ( is_product() ) {
	$banner = get_field('product_cta_banner', 'options');
	if (!empty($banner['cta_banner']) && $banner['cta_banner'][0] == 'enable') {
		?>
		<div class="product-cta" style="background-image: url(<?php echo $banner['background_image'] ?>)">
			<div class="inner-frame">
				<h3 class="product-cta__title"><?php echo $banner['title']; ?></h3>
				<div class="product-cta__subtitle"><?php echo $banner['text']; ?></div>

				<?php echo acf_button($banner['link']); ?>
			</div>
		</div>
		<?php
	}
}