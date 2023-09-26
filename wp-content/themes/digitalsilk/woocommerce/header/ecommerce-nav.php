<?php if( class_exists( 'WooCommerce' ) ) : ?>
    <div class="site-header__account">
        <?php if( get_field('cart_link', 'options' ) == 'enable' ): ?>
            <div class="site-header__account-cart">
                <div class="hover-cart">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="open-cart" id="ds-toggle-cart">
                        <svg class="icon" width="30" height="30">
                            <use xlink:href="#shopping-cart" />
                        </svg>
                        <p class="site-header__account-text">
                            <?php if( $cart_icon_link_title = get_field('cart_icon_link_title', 'options') )
                                _e( $cart_icon_link_title, 'woocommerce' ); ?>

                            <span class="cart-value" <?php if (WC()->cart->cart_contents_count == 0) echo 'style="display:none;"';?>><?php echo WC()->cart->get_cart_contents_count(); ?></span
                        </p>
                    </a>

                    <?php get_template_part( 'woocommerce/header/cart-popup' ); ?>
                    <div class="cart-notify">
                        <span><?php _e( 'Item added to the cart', 'woocommerce' ); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if( get_field('my_account_link', 'options' ) == 'enable' ): ?>

            <?php if( is_user_logged_in() ): ?>
                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"
                   class="desktop-header">
                    <svg class="icon" width="30" height="30">
                        <use xlink:href="#user-circle" />
                    </svg>
                    <?php if( $account_icon_link_title = get_field('account_icon_link_title', 'options') ): ?>
                        <p class="site-header__account-text">
                            <?php _e( $account_icon_link_title, 'woocommerce' ); ?>
                        </p>
                    <?php endif; ?>
                </a>

                <a href="<?php echo esc_url( wc_logout_url() ); ?>" class="desktop-header">
                    <svg class="icon" width="30" height="30">
                        <use xlink:href="#sign-in-alt" />
                    </svg>
                    <?php if( $logout_icon_link_title = get_field('logout_icon_link_title', 'options') ): ?>
                        <p class="site-header__account-text">
                            <?php _e( $logout_icon_link_title, 'woocommerce' ); ?>
                        </p>
                    <?php endif; ?>
                </a>
            <?php else: ?>
                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"
                   class="desktop-header">
                    <svg class="icon" width="30" height="30">
                        <use xlink:href="#user-circle" />
                    </svg>
                    <?php if( $login_icon_link_title = get_field('login_icon_link_title', 'options') ): ?>
                        <p class="site-header__account-text">
                            <?php _e( $login_icon_link_title, 'woocommerce' ); ?>
                        </p>
                    <?php endif; ?>
                </a>

                <?php if( get_option('woocommerce_enable_myaccount_registration') == 'yes' ): ?>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"
                       class="desktop-header">
                        <svg class="icon" width="30" height="30">
                            <use xlink:href="#sign-in-alt" />
                        </svg>
                        <?php if( $register_icon_link_title = get_field('register_icon_link_title', 'options') ): ?>
                            <p class="site-header__account-text">
                                <?php _e( $register_icon_link_title, 'woocommerce' ); ?>
                            </p>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>

            <?php endif; ?>

        <?php endif; ?>
    </div>
<?php endif; ?>
