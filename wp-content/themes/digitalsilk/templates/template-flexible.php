<?php
/**
 * Template Name: Flexible Content
 */

get_header(); ?>

<?php get_template_part('templates/parts/subheader' ); ?>

<?php if ( have_rows('flexible_content') ): ?>

	<?php while ( have_rows('flexible_content') ): the_row(); ?>

		<?php if( get_row_layout() ){
			get_template_part('templates/flexible/' . get_row_layout() );
		}
		?>

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer();