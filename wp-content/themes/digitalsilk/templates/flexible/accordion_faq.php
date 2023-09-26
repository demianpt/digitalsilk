<?php
$title      = get_sub_field( 'title' );
$subtitle   = get_sub_field( 'subtitle' );
$accordion  = get_sub_field( 'accordion_content' );

if( !empty( $accordion ) ): ?>
    <section class="section-accordion gap-top gap-bot">

        <div class="container">

            <div class="c-heading -h2 text-center">
                <!-- <div class="c-heading__pre">Pretitle Text Content</div>-->

                <?php if( $title ): ?>
                    <h2 class="c-heading__title"><?php echo $title; ?></h2>
                <?php endif; ?>

                <?php if( $subtitle ): ?>
                    <div class="c-heading__sub">
                        <?php echo $subtitle; ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="m-accordion">
                <div class="l-accordion js-acc-wrapper icons-plus-minus" data-animation="js" data-close="true">
                    <div class="c-accordion">
                        <?php $accId = 0; foreach ( $accordion as $value ): ?>
                            <div class="c-accordion__item js-acc-item <?php echo $accId === 0 ? ' is-active' : ''; ?>">
                                <div class="c-accordion__title-wrap -h4">
                                    <button class="js-acc-button c-accordion__title">
                                        <?php echo $value->post_title; ?>
                                    </button>
                                </div>
                                <div class="js-acc-content">
                                    <div class="c-accordion__content is-wysiwyg">
                                        <?php echo $value->post_content; ?>
                                    </div>
                                </div>
                            </div>
                        <?php $accId++; endforeach; ?>
                    </div>
                </div>
            </div>

        </div>

    </section>
<?php endif; ?>

