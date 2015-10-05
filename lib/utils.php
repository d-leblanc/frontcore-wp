<?php
/* Assets helper */
function assets(){
    return get_stylesheet_directory_uri().'/assets';
}

/* Render Nav for bootsrap */
class Bootstrap_Nav extends Walker_Nav_Menu {

   function start_lvl(&$output, $depth = 0, $args = array()) {
      $output .= "\n<ul class=\"dropdown-menu\">\n";
   }

   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
       $element_html = '';
       parent::start_el($element_html, $item, $depth, $args);
       if ( $item->is_dropdown && $depth === 0 ) {
           $element_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $element_html );
           $element_html = str_replace( '</a>', ' <b class="caret"></b></a>', $element_html );
       }
       $output .= $element_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        if ( $element->current ) {
            $element->classes[] = 'active';
        }
        $element->is_dropdown = !empty( $children_elements[$element->ID] );
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

/* Render quick mobile menu */
function mobile_menu($theme_class) {
    
    if($theme_class == "fade-in-out"){
        echo "<script>";
        echo '
        $(function(){
            $("body").append(\'<div class="'.$theme_class.' mobile-menu-overlay"><div class="close-trigger"><i class="fa fa-close"></i></div></div>\');
            $(\'.mobile-menu-trigger, .close-trigger\').click(function(e){
                e.preventDefault();
                $(\'body\').toggleClass(\'showMainMenu\');
            });
        });
        ';
        echo"</script>";
        echo"</script>";
        echo '<nav class="mobile-menu '.$theme_class.'">';
        wp_nav_menu(array('theme_location' => 'mobile_menu'));
        echo '</nav>';
    }
    else{
        echo "<script>";
        echo '
        $(function(){
            $(".mobile-menu").nextUntil("body").wrapAll("<div class=\'wrapper\' />");
            $("body").append(\'<div class="'.$theme_class.' mobile-menu-overlay"></div>\');
            $(".mobile-menu-trigger, .close-trigger, .mobile-menu-overlay").click(function(e){
                e.preventDefault();
                $("body").toggleClass("showMainMenu");
            });
        });
        ';
        echo"</script>";
        echo '<nav class="mobile-menu '.$theme_class.'">';
        echo '<div class="close-trigger"><i class="fa fa-close"></i></div>';
        wp_nav_menu(array('theme_location' => 'mobile_menu'));
        echo '</nav>';
    }
    
    

    
}

// Breadcrumb
function custom_breadcrumbs($breadcrums_id = 'breadcrumb',$breadcrums_class = 'breadcrumb',$home_title = 'Accueil', $custom_taxonomy = null) {
        
        if (!is_home()) {
                echo '<div class="container mt-10">';
                echo '<ol class="'.$breadcrums_class.'" id="'.$breadcrums_id.'">';
                echo '<li><strong>Vous êtes ici :</strong></li><li><a href="';
                echo get_option('home');
                echo '">';
                echo $home_title;
                echo "</a></li>";
                if (is_category() || is_single()) {
                        echo '<li>';
                        the_category(' </li><li> ');
                        if (is_single()) {
                                echo "</li><li>";
                                the_title();
                                echo '</li>';
                        }
                } elseif (is_page()) {
                        echo '<li>';
                        echo the_title();
                        echo '</li>';
                }
            if (is_tag()) {single_tag_title();}
            elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
            elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
            elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
            elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
            elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
            elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
            echo '</ol>';
            echo '</div>';
        }
        
}


// Add google analytics to footer
function frontcore_ga($ua) {
	$ga = '<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>';
	$ga .= '<script type="text/javascript">';
	$ga .= 'var pageTracker = _gat._getTracker('.$ua.');';
	$ga .= 'pageTracker._trackPageview();';
	$ga .= '</script>';
	
	return $ga;
}

// Get Template parts with args
/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function frontcore_get_template_part( $file, $template_args = array(), $cache_args = array() ) {
    $template_args = wp_parse_args( $template_args );
    $cache_args = wp_parse_args( $cache_args );
    if ( $cache_args ) {
        foreach ( $template_args as $key => $value ) {
            if ( is_scalar( $value ) || is_array( $value ) ) {
                $cache_args[$key] = $value;
            } else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
                $cache_args[$key] = call_user_method( 'get_id', $value );
            }
        }
        if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
            if ( ! empty( $template_args['return'] ) )
                return $cache;
            echo $cache;
            return;
        }
    }
    $file_handle = $file;
    do_action( 'start_operation', 'hm_template_part::' . $file_handle );
    if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
        $file = get_stylesheet_directory() . '/' . $file . '.php';
    elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
        $file = get_template_directory() . '/' . $file . '.php';
    ob_start();
    $return = require( $file );
    $data = ob_get_clean();
    do_action( 'end_operation', 'hm_template_part::' . $file_handle );
    if ( $cache_args ) {
        wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
    }
    if ( ! empty( $template_args['return'] ) )
        if ( $return === false )
            return false;
        else
            return $data;
    echo $data;
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}


// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
if ( ! function_exists( 'frontcore_pagination' ) ) :
function frontcore_pagination() {
	global $wp_query;
	$big = 999999999; // This needs to be an unlikely integer
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5,
		'prev_next' => true,
	    'prev_text' => __( '&laquo;', 'frontcore' ),
	    'next_text' => __( '&raquo;', 'frontcore' ),
		'type' => 'list',
	) );
	$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination'>", $paginate_links );
	$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
	$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='active'><a href='#'>", $paginate_links );
	$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
	$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
	$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
	// Display the pagination if more than one page is found.
	if ( $paginate_links ) {
		echo $paginate_links;
	}
}
endif;

// Truncate characters
function frontcore_truncate_char($string=null,$nbChars=20,$after="..."){
    $excerpt = $string;
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $the_str = substr($excerpt, 0, $nbChars);
    return $the_str.$after;
}

// Custom Excerpts
function frontcore_index($length) // Create 20 Word Callback for Index page Excerpts, call using frontcore_excerpt('frontcore_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using frontcore_excerpt('frontcore_custom_post');
function frontcore_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function frontcore_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function frontcore_blank_view_article($more)
{
    global $post;
    return '...<br /><a class="btn btn-default" href="' . get_permalink($post->ID) . '">' . __('View Article', 'frontcore') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function frontcore_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function frontcoregravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function frontcorecomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'frontcore_pagination'); // Add our frontcore Pagination
add_action('wp_footer', 'frontcore_ga'); // Google analytics in footer

// Add Filters
add_filter('avatar_defaults', 'frontcoregravatar'); // Custom Gravatar in Settings > Discussion
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'frontcore_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'frontcore_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images