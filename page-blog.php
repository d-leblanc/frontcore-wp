<?php 
get_header(); 
?>

	<main role="main" class="container">
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-9">

	
				<h1><?php _e( 'Archives', 'wpcore' ); ?></h1>

				<?php 
				// Exemple use of wpcore_get_template_part to pass arguments in template parts
				wpcore_get_template_part('template-parts/loops/loop',array(
					'wp_query_args'=>array('post_type'=>'post','posts_per_page'=>'-1')
					)
				);
				?>

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
