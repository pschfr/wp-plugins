<?php
/**
 * @package CPT_At_A_Glance
 * @version 1.0
 */
/*
Plugin Name: Custom Post Types at a Glance
Plugin URI: https://github.com/pschfr/wp-plugins
Description: Displays Custom Post Types in At a Glance widget in wp-admin
Author: Paul Schaefer
Version: 1.0
Author URI: https://paulmakesthe.net/
*/

function cpt_at_a_glance() {
	$post_types = get_post_types(array(
		'public'   => true,
		'_builtin' => false
	), 'object', 'and');

	foreach ($post_types as $post_type) {
		$num_posts = wp_count_posts($post_type->name);
		$num = number_format_i18n($num_posts->publish);
		$text = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
		if (current_user_can('edit_posts')) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
			echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
		}
	}
}
add_action('dashboard_glance_items', 'cpt_at_a_glance');
