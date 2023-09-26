<?php
/**
 * The template for displaying banner with product shipping information
 */

defined( 'ABSPATH' ) || exit;

global $product;

$shipping_bar = get_field('shipping_bar', 'options');
if (empty($shipping_bar['shipping_bar']) || $shipping_bar['shipping_bar'][0] != 'enable'){
	return;
}

$className = '';
if ( $shipping_bar['shipping_is_sticky'][0] == 'enable' ) {
	$className .= " sticky";
	if ( $shipping_bar['shipping_expendable'][0] == 'enable' ) {
		$className .= " expandable";
	}
}

$dataPosition = $shipping_bar['shipping_position'];

$content = get_field('shipping_bar_content') ?? $shipping_bar['content'];

if ( empty( $content ) ){
	return;
}
?>

<div id="shipping-bar" class="shipping-bar <?php echo $className; ?>" data-position="<?php echo $dataPosition; ?>">
	<div class="shipping-bar__wrapper">

		<?php foreach( $content as $item ): ?>
			<div class="shipping-bar__item">
				<img src="<?php echo $item['icon']; ?>">
				<div class="shipping-bar__body">
					<p class="shipping-bar__body_title"><?php echo $item['title']; ?></p>

					<?php if( !empty($item['text']) ): ?>
						<p class="shipping-bar__body_text"><?php echo $item['text']; ?></p>
					<?php endif; ?>

					<?php if( !empty($item['link']) ): ?>
						<p class="shipping-bar__body_text"><?php echo acf_button( $item['link'] ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>

	</div>
</div>