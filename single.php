<?php
/**
 * The Template for displaying all single posts.
 *
 * @package smart
 */

get_header(); ?>

	<main id="primary" <?php smart_layout(); ?> role="main">
		
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php smart_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</main><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>