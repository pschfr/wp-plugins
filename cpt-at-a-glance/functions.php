<?php
/*
	Plugin Name: Custom Post Types at a Glance
	Plugin URI: https://github.com/pschfr/wp-plugins
	Description: Displays Custom Post Types in At a Glance widget in wp-admin
	Version: 1.0
	Author: Paul Schaefer
	Author URI: https://paulmakesthe.net/
*/

function cpt_at_a_glance() {
	$post_types = get_post_types(array(
		'public'   => true,
		'_builtin' => false
	), 'object', 'and');

	if (current_user_can('edit_posts')) {
		echo "<style>
			#dashboard_right_now li a:before { content: ''; }
			#dashboard_right_now li div.wp-menu-image { display: inline; }
			#dashboard_right_now li div.wp-menu-image:before { color: #a0a5aa; padding: 0; }
		</style>\n";
	}

	foreach ($post_types as $post_type) {
		$num_posts = wp_count_posts($post_type->name);
		$num = number_format_i18n($num_posts->publish);
		$text = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
		if (current_user_can('edit_posts')) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
			echo '<li><div class="wp-menu-image dashicons-before ' . $post_type->menu_icon . '"></div>' . $output . '</li>';
		}
	}
}
add_action('dashboard_glance_items', 'cpt_at_a_glance');
