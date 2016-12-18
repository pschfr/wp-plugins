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
		$paths[] = "<td style='font-weight:bold'>{$plugin['Name']}</td><td>" . (is_plugin_active($p_basename) ? 'Active</td>' : 'Disabled</td>');
	}
	echo "<h3><a href='" . admin_url('plugins.php') . "'>" . count(get_plugins()) . " Installed Plugins</a></h3>\n";
	echo "<table><tbody>";
	foreach($paths as $plugin) {
		echo "<tr>" . $plugin . "</tr>\n";
	}
	echo "</tbody></table>";
}

function add_widget() {
	wp_add_dashboard_widget('installed_plugin_widget', 'Installed Plugins', 'display_installed_plugins');
}
add_action('wp_dashboard_setup', 'add_widget');
