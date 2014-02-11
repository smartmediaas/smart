<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail()) : // Post with thumbnail ?>
		<div class="row">
			<div class="columns medium-6"><?php smart_img('thumbnail', 'post-thumbnail', 320, 230, 1, 0); ?></div>
			<div class="columns medium-6">
					<header class="entry-header">
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h1>

						<div class="entry-meta">
							<?php smart_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->
					
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
			</div>
		</div>

	<?php else : // Post without thumbnail ?>

		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<div class="entry-meta">
				<?php smart_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php endif; ?>

</article><!-- #post-## -->