<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DS_Theme
 */

get_header(); ?>

    <?php get_template_part( 'templates/parts/subheader' ); ?>

    <?php if ( have_posts() ) : ?>

    <div class="container">
        <div class="blog-grid l-posts">

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('templates/content/content', 'archive'); ?>

            <?php endwhile; ?>

        </div>
    </div>

    <?php get_template_part('templates/parts/pagination', 'archive');

else :

    get_template_part('templates/content/content', 'none');

endif; ?>

<?php get_footer(); ?>
