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
		$paths[] = "{$plugin['Name']}: " . (is_plugin_active($p_basename) ? 'Active' : 'Disabled');
	}
	echo "<li>&nbsp;</li><li>&nbsp;</li>\n";
	echo "<li><strong>" . count(get_plugins()) . " Installed Plugins</strong></li><li>&nbsp;</li>\n";
	echo "<li>" . implode('</li><li>', $paths) . "</li>\n";
	echo "<li>&nbsp;</li><li>&nbsp;</li>\n";
}
add_action('dashboard_glance_items', 'display_installed_plugins');
