<?php
/**
 * Template Name: Fullbredde
 *
 * @package smart
 */

get_header(); ?>

	<main id="primary" <?php smart_layout('fullwidth'); ?> role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		<?php do_action( 'after_entry_content', $post->ID, 'after_entry_content' ); ?>

	</main><!-- #primary -->

<?php get_footer(); ?>
