<?php
/*
	Plugin Name: Custom Post Types at a Glance
	Plugin URI: https://github.com/pschfr/wp-plugins
	Description: Displays Custom Post Types in At a Glance widget in wp-admin
	Version: 1.0
	Author: Paul Schaefer
	Author URI: https://paulmakesthe.net/
	License: GPLv3
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


// Generates Custom Post Type for Weekly Bulletins and Sermons
function bulletins_post_type() {
	$labels = array(
		'name'                  => 'Bulletins',
		'singular_name'         => 'Bulletin',
		'menu_name'             => 'Bulletins',
		'name_admin_bar'        => 'Bulletin',
		'archives'              => 'Bulletin Archives',
		'attributes'            => 'Bulletin Attributes',
		'parent_item_colon'     => 'Parent Bulletin:',
		'all_items'             => 'All Bulletins',
		'add_new_item'          => 'Add New Bulletin',
		'add_new'               => 'Add New',
		'new_item'              => 'New Bulletin',
		'edit_item'             => 'Edit Bulletin',
		'update_item'           => 'Update Bulletin',
		'view_item'             => 'View Bulletin',
		'view_items'            => 'View Bulletins',
		'search_items'          => 'Search Bulletins',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into bulletin',
		'uploaded_to_this_item' => 'Uploaded to this bulletin',
		'items_list'            => 'Bulletins list',
		'items_list_navigation' => 'Bulletins list navigation',
		'filter_items_list'     => 'Filter bulletins list',
	);
	$args = array(
		'label'                 => 'Bulletin',
		'description'           => 'PDF of this week\\\'s bulletin',
		'labels'                => $labels,
		'supports'              => array('title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-media-document',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type('bulletin', $args);
}
add_action('init', 'bulletins_post_type', 0);

function sermons_post_type() {
	$labels = array(
		'name'                  => 'Sermons',
		'singular_name'         => 'Sermon',
		'menu_name'             => 'Sermons',
		'name_admin_bar'        => 'Sermon',
		'archives'              => 'Sermon Archives',
		'attributes'            => 'Sermon Attributes',
		'parent_item_colon'     => 'Parent Sermon:',
		'all_items'             => 'All Sermons',
		'add_new_item'          => 'Add New Sermon',
		'add_new'               => 'Add New',
		'new_item'              => 'New Sermon',
		'edit_item'             => 'Edit Sermon',
		'update_item'           => 'Update Sermon',
		'view_item'             => 'View Sermon',
		'view_items'            => 'View Sermons',
		'search_items'          => 'Search Sermons',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into sermon',
		'uploaded_to_this_item' => 'Uploaded to this sermon',
		'items_list'            => 'Sermons list',
		'items_list_navigation' => 'Sermons list navigation',
		'filter_items_list'     => 'Filter sermon list',
	);
	$args = array(
		'label'                 => 'Sermon',
		'description'           => 'Audio of this week\\\'s sermon',
		'labels'                => $labels,
		'supports'              => array('title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type('sermon', $args);
}
add_action('init', 'sermons_post_type', 0);