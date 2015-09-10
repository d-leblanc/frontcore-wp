<?php get_header(); ?>

	<main role="main" class="container">
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-9">

				<h1><?php the_title(); ?></h1>

				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>


						<br class="clear">

						<?php edit_post_link(); ?>

					</article>
					<!-- /article -->

				<?php endwhile; ?>

				<?php else: ?>

					<!-- article -->
					<article>

						<h2><?php _e( 'Sorry, nothing to display.', 'frontcore' ); ?></h2>

					</article>
					<!-- /article -->

				<?php endif; ?>

			</section>
			<!-- /section -->
			<!-- aside -->
			<aside class="col-sm-12 col-md-3">
				<?php get_sidebar(); ?>
			</aside>
			<!-- /aside -->
		</div>
	</main>
<?php get_footer(); ?>
