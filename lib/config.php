<?php

// custom admin login logo
function custom_login_logo($src) {
	echo '<style type="text/css">
	h1 a { background-image: url('.$src.') !important; }
	</style>';
}

add_action('login_head', 'custom_login_logo'); // Custom Admin login logo