<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php echo sprintf( __( '%s Search Results for ', 'wpcore' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

			<?php get_template_part('shared/loop'); ?>

			<?php get_template_part('shared/pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
