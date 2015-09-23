<?php

// Load frontcore styles
function frontcore_styles()
{
    //Font Awesome CDN
    wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), false, 'all');
    wp_enqueue_style('fontawesome'); // Enqueue it!
    
    //Flat theme bootstrap
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap/theme/flat.css', array(), false, 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!
    
    wp_register_style('frontcore-style', get_template_directory_uri() . '/style.css', array(), false, 'all');
    wp_enqueue_style('frontcore-style'); // Enqueue it!
	
	wp_register_style('frontcore', get_template_directory_uri() . '/assets/css/frontcore.css', array(), false, 'all');
    wp_enqueue_style('frontcore'); // Enqueue it!
    
    wp_register_style('wpelements', get_template_directory_uri() . '/assets/css/wpelements.css', array(), false, 'all');
    wp_enqueue_style('wpelements'); // Enqueue it!
}

// Load frontcore scripts
function frontcore_scripts()
{
    if (!is_admin()) {
    	wp_deregister_script('jquery');
    	wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js');
        wp_enqueue_script('jquery'); // Enqueue it!
    }
    
    wp_register_script('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js');
    wp_enqueue_script('bootstrap'); // Enqueue it!
    
    wp_register_script('fcscripts', get_template_directory_uri() . '/assets/js/frontcore.js');
    wp_enqueue_script('fcscripts'); // Enqueue it!
}

add_action('wp_enqueue_scripts', 'frontcore_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'frontcore_scripts'); // Add Theme Javascripts