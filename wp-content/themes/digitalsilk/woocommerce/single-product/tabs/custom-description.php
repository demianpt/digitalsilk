<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$description = get_field( 'description' );

if ( empty( $description ) ){
	return;
}
?>

<div class="pdp-list">
	<?php foreach ( $description as $item ): ?>
		<div class="pdp-list__item <?php echo !empty( $item['image'] ) ? 'image_position_'.$item['image_position'] : 'no_image'; ?> ">

			<?php if( !empty( $item['image'] ) ): ?>
				<div class="pdp-list__img">
					<img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['name']; ?>" loading="lazy">
				</div>
			<?php endif; ?>

			<div class="pdp-list__content">
				<?php if( !empty( $item['title'] ) ): ?>
					<h3 class="pdp-list__title"><?php echo $item['title']; ?></h3>
				<?php endif; ?>

				<?php if( !empty( $item['description'] ) ): ?>
					<div class="pdp-list__full is_wysiwyg"><?php echo apply_filters( 'the_content', $item['description'] ); ?></div>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>

