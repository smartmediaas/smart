<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package smart
 */

get_header(); ?>

	<main id="primary" <?php smart_layout(); ?> role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'smart' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'list', 'posts' ); ?>

			<?php endwhile; ?>

			<?php smart_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</main><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
