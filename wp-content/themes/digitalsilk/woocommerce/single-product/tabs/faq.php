<?php
/**
 * Description
 */

defined( 'ABSPATH' ) || exit;

global $post;

$faq = get_field('faq');

if ( empty( $faq ) ){
	return;
}

$heading = get_field( 'faq_heading' );
?>

<?php if( !empty( $heading['title'] ) ): ?>
	<div class="c-heading -h2">
		<h2 class="c-heading__title"><?php echo $heading['title']; ?></h2>
	</div>
<?php endif; ?>

<?php if( $heading['subtitle'] ): ?>
	<p><?php echo $heading['subtitle']; ?></p>
<?php endif; ?>

<div class="m-accordion">

	<div class="m-accordion__container container">
        <div class="l-accordion js-acc-wrapper icons-plus-minus" data-animation="js" data-close="true">

			<div class="c-accordion ">

				<?php $count = 0;
				foreach ( $faq as $i => $item ): ?>

					<div class="accordion__item js-acc-item <?php echo ( $count === 0 ) ? 'is-active' : ''; ?>">
						<?php if ( ! empty( $item->post_title ) ): ?>
							<div class="c-accordion__title-wrap -h4">
                                <button class="js-acc-button c-accordion__title">
                                    <?php echo $item->post_title; ?>
                                </button>
                            </div>
						<?php endif; ?>

						<div class="js-acc-content">
							<?php if ( ! empty( $item->post_content ) ): ?>
								<div class="accordion__content">
									<div class="is-wysiwyg">
										<?php echo apply_filters( 'the_content', $item->post_content ); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<?php $count ++;
				endforeach; ?>

			</div>

		</div>
	</div>
</div>

