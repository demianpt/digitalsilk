<?php
/**
 * The template for displaying product inquiry link with form in popup
 */

defined( 'ABSPATH' ) || exit;

global $product;

$request = get_field('product_request_a_quote', 'options');
if ( is_product() && (!empty($request['request_a_quote']) && $request['request_a_quote'][0] == 'enable' && $request['gravity_form']) ) : ?>

	<?php echo acf_button([
		'url'   => 'javascript:;',
		'title' => $request['button_title']
	],
	[
		'class' => '',
		'onclick' => "jQuery('#product_inquiry').toggle()"
	],
	false
	); ?>

	<div id="product_inquiry" style="display: none;">
		<?php echo do_shortcode( "[gravityforms id='{$request['gravity_form']}']" ); ?>
	</div>

<?php endif; ?>