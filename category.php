<?php get_header(); ?>

	<main role="main" class="container">
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-9">


				<h1><?php _e( 'Categories for ', 'wpcore' ); single_cat_title(); ?></h1>

				<?php get_template_part('template-parts/loops/loop'); ?>

				<?php get_template_part('template-parts/pagination'); ?>

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
