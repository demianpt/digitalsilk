<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php wp_title('|', true, 'right'); ?>
    </title>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="https://use.typekit.net/dij0kpe.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<a class="skip-link" href="#main-content"><?php esc_html_e( 'Skip to content', 'dstheme' ); ?></a>

<div class="wrapper">

    <header class="site-header" role="banner" data-sticky="sticky">

        <div class="site-header__top">
            <div class="site-header__row inner-frame">
                <div class="site-header__col -left"> HEADER TOP ROW => LEFT WIDGETS (remove if no items)</div>
                <div class="site-header__col -right"> HEADER TOP ROW => RIGHT WIDGETS</div>
            </div>
        </div>

        <div class="site-header__main">

            <div class="site-header__row inner-frame">
                <div class="site-header__col -left">
                    <?php $logo = get_field('logo', 'options') ?: THEME_URL . '/assets/_src/images/logo.svg';
                    if (!empty($logo)) : ?>
                        <a href="<?php echo home_url(); ?>" class="site-header__logo"> <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>" class="logo-img"/> </a>
                    <?php endif; ?>
                </div>

                <!-- <div class="site-header__col -center"> </div>-->

                <div class="site-header__col -right">

                    <div class="nav-main__wrap">

                        <div class="nav-main">
                            <?php if (has_nav_menu('header-menu')) : ?><?php wp_nav_menu(
                                array(
                                    'theme_location' => 'header-menu',
                                    'container' => 'ul',
                                    'menu_class' => 'nav-main__links'
                                )
                            );
                                ?><?php endif; ?>
                        </div>
                    </div>

                    <?php get_template_part('woocommerce/header/ecommerce-nav'); ?>

                    <div class="site-header__search">
                        <div class="site-search -toggle">
                            <div class="site-search__inner is-hidden" data-js="search-target">
                                <a href="#" role="button" class="site-search__close" data-js="search-close">x</a>
                                <?php get_search_form(); ?>
                            </div>
                            <button role="button" class="site-search__toggle" data-js="search-trigger">
                                <span aria-hidden="true" class="sr-only">Open Search</span>
                                <?php echo get_svg(array('icon' => 'search', 'class' => 'site-search__icon')); ?>
                            </button>
                        </div>
                    </div>

                    <button type="button" class="nav-main__btn js-mobileNav -mobile" aria-expanded="false" aria-label="Menu" aria-controls="mainnav"> <!-- burger navigation icon -->
                        <span class="burger-icon"><span></span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

	<?php do_action( 'ds_before_content' ) ?>

    <main class="site-content" role="main" id="main-content">
