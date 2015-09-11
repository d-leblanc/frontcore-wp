<?php
	/* Template Name: Blog Posts */
	get_header(); 
?>

	<main role="main" class="container">
		
		
		
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-8">
				<h1 class="mb-40"><?php _e( 'Archives', 'frontcore' ); ?></h1>
				<?php 
				get_template_part('template-parts/loops/loop'); 
				?>

			</section>
			<!-- /section -->
			
			<!-- aside -->
			<aside class="col-sm-12 col-md-3 col-md-offset-1">
				<?php get_template_part('template-parts/sidebar'); ?>
			</aside>
			<!-- /aside -->
		</div>
	</main>

<?php get_footer(); ?>

