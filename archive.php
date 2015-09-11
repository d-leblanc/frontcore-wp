<?php get_header(); ?>

	<main role="main" class="container">
		
		<h1><?php _e( 'Archives', 'frontcore' ); ?></h1>
		
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-9">
				<?php get_template_part('template-parts/loops/loop'); ?>

			</section>
			<!-- /section -->
			
			<!-- aside -->
			<aside class="col-sm-12 col-md-3">
				<?php get_template_part('template-parts/sidebar'); ?>
			</aside>
			<!-- /aside -->
		</div>
	</main>

<?php get_footer(); ?>
