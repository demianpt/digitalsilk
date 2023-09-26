<div class="footer-bottom">
    <div class="footer-bottom__inner container">

        <?php if ( $socials = get_field('social_icons', 'options') ) : ?>
            <div class="footer-col social-list">
                <?php foreach ( $socials as $social ) : ?>
                <div class="social-list__item">
                    <?php if ( !empty($social['url']) && !empty($social['icon']) ) :
                        echo acf_button( ['title'=>'','url'=>$social['url']], array('rel' => 'nofollow','target'=>'_blank','class'=>'social-list__link'), get_svg(array('icon' => 'social-'.$social['icon'], 'class' => '-'.$social['icon'].' social-list__icon')) );
                    endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php $copyright = get_field('copyright', 'options');
        if (!empty($copyright)) : ?>
            <div class="footer-col copyright"><?php echo do_shortcode($copyright); ?></div>
        <?php endif; ?>


        <div class="footer-col footer-by">Web Design by <a href="https://digitalsilk.com" target="_blank" rel="noopener"><strong>Digital Silk</strong></a></div>
    </div>
</div>
