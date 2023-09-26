<?php
/**
 * The template for displaying page marked as Front Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package DS_Theme
 */

get_header(); ?>

<?php if ( have_rows('flexible_content') ): ?>

	<?php while ( have_rows('flexible_content') ): the_row(); ?>

		<?php if( get_row_layout() ){
			get_template_part('templates/flexible/' . get_row_layout() );
		}
		?>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();