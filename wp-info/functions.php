<?php
/*
	Plugin Name: WP Info in Admin Footer
	Plugin URI: https://github.com/pschfr/wp-plugins
	Description: Shows PHP and WordPress info in WP Admin Footer
	Version: 1.0
	Author: Paul Schaefer
	Author URI: https://paulmakesthe.net/
	License: GPLv3
*/
function formatBytes($size, $precision = 2) {
	$base = log($size, 1024);
	$suffixes = array('', 'K', 'M', 'G', 'T'); 

	return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function wp_info_admin() {
	// PHP memory used
	$php_mem = formatBytes(memory_get_usage());

	// IP Address
	$server_ip_address = (!empty($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : "");
	if ($server_ip_address == "") // Added for IP Address in IIS
		$server_ip_address = (!empty($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : "");

	// PHP Version
	$php_ver = phpversion();

	// PHP OS
	$php_os = php_uname();

	// Return text
	return "<em>" . $php_mem . " used, " . WP_MEMORY_LIMIT . " limit | IP: " . $server_ip_address . " | PHP " . $php_ver . "<br/>" . $php_os . "</em>\n";
}
add_filter('admin_footer_text', 'wp_info_admin');