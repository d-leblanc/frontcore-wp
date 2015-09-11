<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>
		<!-- Static navbar -->
	    <nav class="navbar navbar-inverse navbar-static-top no-margin">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	        <?php 
	        
	        /* Primary navigation */
	     
				wp_nav_menu( array( 
					'walker' => new Bootstrap_Nav(),
					'menu_class' => 'nav navbar-nav'
				));
			
				?>
	         </div><!--/.nav-collapse -->
	      </div>
	    </nav>
	    <!-- BreadCrumb -->
	    <?php custom_breadcrumbs('breadcrumb','breadcrumb') ?>
		<!-- /BreadCrumb -->

