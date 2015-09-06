<?php get_header(); ?>

	<main role="main" class="container">
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-9">

				<!-- article -->
				<article id="post-404">

					<h1><?php _e( 'Page not found', 'frontcore' ); ?></h1>
					<h2>
						<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'frontcore' ); ?></a>
					</h2>

				</article>
				<!-- /article -->

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
