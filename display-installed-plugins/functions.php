<?php
/*
	Plugin Name: Display Installed Plugins
	Plugin URI: https://github.com/pschfr/wp-plugins
	Description: Displays Installed Plugins in a widget in wp-admin
	Version: 1.1
	Author: Paul Schaefer
	Author URI: https://paulmakesthe.net/
	License: GPLv3
*/
function display_installed_plugins() {
	$active = 0;
	$disabled = 0;
	echo "<table style='width: 100%'><tbody>";

	foreach(get_plugins() as $p_basename => $plugin) {
		$paths  = "<tr>";
		$paths .= "<td><strong>" . $plugin['Name'] . "</strong> " . $plugin['Version'] . "</td>";
		$paths .= "<td style='text-align: right'>";

		if (is_plugin_active($p_basename)) {
			$paths .= '<a href="' . get_site_url() . '/wp-admin/plugins.php?action=deactivate&plugin=' . $p_basename . '&plugin_status=all&paged=1&s&_wpnonce=' . wp_create_nonce('deactivate') . '" style="color:green">Active</a>';
			$active++;
		} else {
			$paths .= '<a href="' . get_site_url() . '/wp-admin/plugins.php?action=activate&plugin=' . $p_basename . '&plugin_status=all&paged=1&s&_wpnonce=' . wp_create_nonce('activate') . '" style="color:red">Disabled</a>';
			$disabled++;
		}

		$paths .= '</td>';
		$paths .= "</tr>";
		echo $paths;
	}

	echo "</tbody></table>";

	echo "<p><a href='" . admin_url('plugins.php') . "'>" . count(get_plugins()) . " installed plugins: " . $active . " active and " . $disabled . " disabled</a></p>\n";
}

function add_widget() {
	wp_add_dashboard_widget('installed_plugin_widget', 'Installed Plugins', 'display_installed_plugins');
}
add_action('wp_dashboard_setup', 'add_widget');
