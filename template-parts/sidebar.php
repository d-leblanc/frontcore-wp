<!-- sidebar -->
<aside class="sidebar" role="complementary">
	<?php get_template_part('searchform'); ?>

	<div class="sidebar-widget">
		<?php 
			if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('main-widget-area')) 
		?>
	</div>
</aside>
<!-- /sidebar -->
