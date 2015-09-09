<?php 
/* Default loop template */
if(!isset($template_args['args'])){
	$args = array(
		'post_type'=>'post',
		'posts_per_page'=>'-1'
	);
}
else{
	$args = $template_args['args'];
}

$the_query = new Wp_Query($args);

if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); 
?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<!-- post title -->
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->

		<?php frontcore_excerpt('frontcore_index'); // Build your custom callback length in functions.php ?>
		<div class="postDetails">
			<!-- post details -->
			<span><i class="fa fa-calendar"></i> <?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span><i class="fa fa-user"></i> <?php _e( 'Published by', 'frontcore' ); ?> <?php the_author_posts_link(); ?></span>
			<span><i class="fa fa-commenting-o"></i> <?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'frontcore' ), __( '1 Comment', 'frontcore' ), __( '% Comments', 'frontcore' )); ?></span>
			<!-- /post details -->
		</div>
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
