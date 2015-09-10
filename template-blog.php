<?php
	/* Template Name: Blog Posts */
	get_header(); 
?>

	<main role="main" class="container">
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-9">

	
				<h1><?php _e( 'Archives', 'frontcore' ); ?></h1>

				<?php
				$args = array(
					'post_type'=>'post',
					'posts_per_page'=>'-1'	
				);
				
				frontcore_get_template_part('template-parts/loops/loop',array(
						'args'=>$args,
					)
				);
				?>

				<?php get_template_part('template-parts/pagination'); ?>

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
