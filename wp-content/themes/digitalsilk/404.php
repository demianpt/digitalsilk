<?php
/**
 * The template for displaying an 404 page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DS_Theme
 */

get_header(); ?>

<div class="page-content p-404">

    <div class="p-404__inner inner-frame">

        <h1 class="page-title p-404__title"><?php _e('404', 'dstheme'); ?></h1>

        <div class="p-404__text">
            <?php _e('Oops! The page you\'re looking for appears to have moved, been deleted or does not exists.', 'dstheme'); ?>
        </div>

        <div class="p-404__btn">
            <?php echo get_search_form(); ?>
        </div>

        <div class="p-404__btn">
            <a href="/" class="c-btn -primary">
                Go To Homepage
                <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
            </a>
        </div>

    </div>

</div>

<?php get_footer(); ?>

