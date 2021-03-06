<?php get_header(); ?>

	<main role="main" class="container">
		<div class="row">
			<!-- section -->
			<section class="col-sm-12 col-md-8">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" class="post">
					<!-- post title -->
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
					<div class="postDetails">
						<!-- post details -->
						<span><i class="fa fa-calendar"></i> <?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
						<span><i class="fa fa-user"></i> <?php _e( 'Published by', 'frontcore' ); ?> <?php the_author_posts_link(); ?></span>
						<span><i class="fa fa-commenting-o"></i> <?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'frontcore' ), __( '1 Comment', 'frontcore' ), __( '% Comments', 'frontcore' )); ?></span>
						<!-- /post details -->
					</div>
					<!-- /post title -->
					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->
		
					
		
					
		
					<?php the_content(); // Dynamic Content ?>
		
					<?php the_tags( __( 'Tags: ', 'frontcore' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
		
					<p><?php _e( 'Categorised in: ', 'frontcore' ); the_category(', '); // Separated by commas ?></p>
		
					<p><?php _e( 'This post was written by ', 'frontcore' ); the_author(); ?></p>
		
					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
		
					<?php comments_template(); ?>
		
				</article>
				<!-- /article -->
		
			<?php endwhile; ?>
		
			<?php else: ?>
		
				<!-- article -->
				<article>
		
					<h1><?php _e( 'Sorry, nothing to display.', 'frontcore' ); ?></h1>
		
				</article>
				<!-- /article -->
		
			<?php endif; ?>

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
