<?php
/*
	Plugin Name: Display Installed Plugins
	Plugin URI: https://github.com/pschfr/wp-plugins
	Description: Displays Installed Plugins in At a Glance widget in wp-admin
	Version: 1.0
	Author: Paul Schaefer
	Author URI: https://paulmakesthe.net/
	License: GPLv3
*/
function display_installed_plugins() {
	$paths = array();
	foreach(get_plugins() as $p_basename => $plugin) {
		$paths[] = "<td style='font-weight:bold'>{$plugin['Name']}</td><td style='text-align: right'>" . (is_plugin_active($p_basename) ? '<span style="color:green">Active</span></td>' : '<span style="color:red">Disabled</span></td>');
	}
	echo "<table style='width: 100%'><tbody>";
	foreach($paths as $plugin) {
		echo "<tr>" . $plugin . "</tr>\n";
	}
	echo "</tbody></table>";
	echo "<p><a href='" . admin_url('plugins.php') . "'>View all Installed Plugins (" . count(get_plugins()) . ")</a></p>\n";
}

function add_widget() {
	wp_add_dashboard_widget('installed_plugin_widget', 'Installed Plugins', 'display_installed_plugins');
}
add_action('wp_dashboard_setup', 'add_widget');
