<?php
/**
 * The template for displaying single pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DS_Theme
 */

get_header(); ?>

	<?php if ( have_posts() ) :

		while ( have_posts() ) : the_post();

            get_template_part( 'templates/content/content', 'single' );

	    endwhile;

		get_template_part( 'templates/parts/pagination', 'single' );

	endif; ?>

<?php get_footer();