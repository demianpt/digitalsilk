<div class="footer-top">

    <div class="footer-top__inner container">

        <?php $logo_footer = get_field('footer_logo', 'options') ?: THEME_URL.'/assets/_src/images/logo.svg';
        if ( !empty( $logo_footer ) ) : ?>
        <div class="footer-col">
            <div class="footer-title">Title Placeholder</div>
            <img src="<?php echo esc_url( $logo_footer ); ?>" class="logo-img" alt="<?php bloginfo( 'name' ); ?>" />
        </div>
        <?php endif; ?>

        <?php if (has_nav_menu('footer-menu')) : ?>
            <div class="footer-col">
                <div class="footer-title">Title Placeholder</div>
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'container' => 'ul',
                        'menu_class' => 'footer-nav',
                    )
                );
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
