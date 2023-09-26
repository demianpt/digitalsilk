<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */
defined('ABSPATH') || exit;

global $product;

$columns            = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id  = $product->get_image_id();
$slider_direction   = get_field('single_product_gallery', 'options') ?? 'horizontal';
$wrapper_classes    = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		$slider_direction,
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	)
);

if ($post_thumbnail_id) {
	$html = ds_wc_get_gallery_image_html($post_thumbnail_id, true);
} else {
	$html = '<div class="woocommerce-product-gallery__image--placeholder">';
	$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
	$html .= '</div>';
}

$attachment_ids = $product->get_gallery_image_ids();
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-direction="<?php echo esc_attr($slider_direction); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="swiper woocommerce-product-gallery__wrapper">
		<figure class="swiper-wrapper">
			<?php echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped 
			?>

			<?php
			if ($attachment_ids && $product->get_image_id()) {
				foreach ($attachment_ids as $attachment_id) {
					echo ds_wc_get_gallery_image_html($attachment_id, true);
				}
			}
			?>
		</figure>
	</div>

	<?php
	$number_of_images = count($attachment_ids) + 1;

	if ($attachment_ids) : ?>
		<div class="swiper woocommerce-product-gallery__nav" data-items="<?php echo $number_of_images; ?>">
			<figure class="swiper-wrapper">
				<?php
				$src = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
				$alt = trim(wp_strip_all_tags(get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true)));
				?>
				<div class="woocommerce-product-gallery__image swiper-slide">
					<img src="<?php echo esc_url($src[0]); ?>" alt="<?php echo $alt; ?>">
				</div>

				<?php foreach ($attachment_ids as $attachment_id) :
					$src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
					$alt = trim(wp_strip_all_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
				?>
					<div class="woocommerce-product-gallery__image swiper-slide">
						<img src="<?php echo esc_url($src[0]); ?>" alt="<?php echo $alt; ?>">
					</div>
				<?php endforeach; ?>
			</figure>

			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	<?php endif; ?>
</div>