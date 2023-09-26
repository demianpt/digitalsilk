<?php
$title          = get_sub_field( 'title' );
$subtitle       = get_sub_field( 'subtitle' );
$testimonials   = get_sub_field( 'testimonials' );

if( !empty( $testimonials ) ): ?>

<section class="section-testimonials gap-top gap-bottom">

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

        <div class="m-slider m-testimonials">
            <div class="swiper js-slider--with-nav js-slider-simple"
                 data-slider-thumbs="true"
                 data-slider-navigation="outer-arrows">
                <div class="swiper-wrapper">

                    <?php $flag = 0; foreach ( $testimonials as $post ): setup_postdata( $post );
                        $name              = get_the_title();
                        $quote             = get_field( 'quote', get_the_ID() );
                        $testimonial_image = get_field( 'testimonial_main_image' );
                        $full_story_type   = get_field( 'full_story_type' );
                        $full_story        = get_field( 'full_story' );
                        $company_position  = get_field( 'company_position' )
                        ?>

                        <div class="m-slider__slide swiper-slide">
                            <blockquote class="l-testimonials">
                                <figure class="c-quote">

                                    <blockquote class="c-quote__content">
                                        <?php if ( $quote ): ?>
                                            <p class="c-quote__text"><?php echo $quote; ?></p>
                                        <?php endif; ?>

                                        <?php if ( ($full_story_type === 'content' && !empty($full_story['content'])) || $full_story_type === 'video' ): ?>
                                            <a class="c-btn -link naked floatbox" href="#testimonial_<?php echo $flag; ?>" data-fb-options="width:800 height:auto colorTheme:white outerBorderRadius:8 padding:25"><?php the_field( 'full_story_cta_label' ); ?></a>
                                        <?php endif; ?>

                                        <!--popup start-->
                                        <?php if ( $full_story_type === 'content' ): ?>
                                            <div class="popup" data-popup="testimonial_<?php echo $flag; ?>" id="testimonial_<?php echo $flag; ?>" style="display: none">
                                                <?php echo $full_story['content']; ?>
                                            </div>
                                        <?php elseif ( $full_story_type === 'video' ): ?>
                                            <div class="popup">
                                                <?php $video_url = '';
                                                if ( $full_story['video']['popup_video_type'] === 'file' ) {
                                                    $video_url = $full_story['video']['popup_video_file']['url'] ?? '';
                                                } else {
                                                    $iframe = wp_oembed_get( $full_story['video']['popup_video_url'] );
                                                    // Use preg_match to find iframe src.
                                                    preg_match( '/src="(.+?)"/', $iframe, $matches );
                                                    $video_url = ! empty( $matches ) ? $matches[1] : $full_story['video']['popup_video_url'];
                                                }
                                                ?>
                                                <a href="<?php echo $video_url; ?>" class="c-controls__link c-btn -link floatbox naked" data-fb-options="">
                                                    <span class="c-controls__play" title="Play/Pause"></span>
                                                    <span class="c-controls__label"><?php _e( 'Play','dstheme' ) ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </blockquote>

                                    <figcaption class="c-quote__profile">
                                        <div class="c-quote__photo">
                                            <?php if ( ! empty( get_post_thumbnail_id() ) ): ?>
                                                <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'full' ); ?>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ( ! empty( $name ) || ! empty( $company_position ) ): ?>
                                            <div class="c-quote__info">
                                                <div class="c-quote__name"><?php echo $name; ?></div>
                                                <?php if ( ! empty( $company_position ) ): ?>
                                                    <span class="c-quote__company"><?php echo $company_position; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                    </figcaption>

                                </figure>

                                <?php if ( $testimonial_image ): ?>
                                    <div class="c-image">
                                        <div class="c-image__media c-image__primary">
                                            <img class="c-image__src" loading="lazy" src="<?php echo $testimonial_image['url']; ?>" alt="<?php echo $testimonial_image['alt'] ?: $testimonial_image['title']; ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </blockquote>
                        </div>
                    <?php $flag++; endforeach;
                    wp_reset_postdata(); ?>

                </div>
                <div class="m-slider__pagination swiper-pagination"></div>
            </div>
            <div class="m-slider__nav is-round">
                <div class="m-slider__arrows -prev swiper-button-prev">
                    <?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?>
                </div>
                <div class="m-slider__arrows -next swiper-button-next">
                    <?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?>
                </div>
            </div>

        </div>

    </div>

</section>

<?php endif; ?>
