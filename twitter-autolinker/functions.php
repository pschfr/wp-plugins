<?php
/*
	Plugin Name: Twitter AutoLinker
	Plugin URI: https://github.com/pschfr/wp-plugins
	Description: Automatically links Twitter usernames throughout WordPress
	Version: 1.0
	Author: Paul Schaefer
	Author URI: https://paulmakesthe.net/
	License: GPLv3
*/
 
function twtreplace($content) {
	$twtreplace = preg_replace('/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/', "$1<a href=\"https://twitter.com/$2\" target=\"_blank\" rel=\"noopener noreferrer nofollow\">@$2</a>", $content);
	return $twtreplace;
}
add_filter('the_content', 'twtreplace');
add_filter('the_excerpt', 'twtreplace');
add_filter('comment_text', 'twtreplace');
