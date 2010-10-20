<?php
/*
Plugin Name: Peter's Blog URL Shortcodes
Plugin URI: http://www.theblog.ca/blog-url-shortcodes
Description: Adds shortcodes [blogurl] and [posturl] for WordPress 2.6 and up. Use [blogurl] to generate your site URL. It offers the parameters "slash" and "noslash" (to add a trailing slash), as well as "uploads" to produce the URL of the uploads folder. Use [posturl id=3] (replace "3" with a post ID) to generate the permalink for any post.
Author: Peter Keung
Version: 0.1
Change Log:
2008-11-16  0.1: First release
Author URI: http://www.theblog.ca/
*/

/* -----------------------
Start of settings
------------------------*/

$blogurl_settings = array(); // Do not change this line

// This is the value if you enter [blogurl]
$blogurl_settings['siteurl'] = get_option('siteurl');

// Set this to true if you are comfortable with [blogurl]wp-content/etc
// Set this to false if you are more comfortable with [blogurl]/wp-content/etc
$blogurl_settings['insertslash'] = true;

// It's best not to touch this if / else statement
if (get_option('upload_url_path') != '') {
    // This is set in Settings > Miscellaneous > Full URL path to files
    $blogurl_settings['uploads'] = get_option('upload_url_path');
}
else {
    $blogurl_settings['uploads'] = get_option('siteurl') . '/' . get_option('upload_path');
}

// To define your own upload URL path (for [blogurl uploads], comment out the line below
// $blogurl_settings['uploads'] = 'http://yoursite.com/wp-content/uploads';

/* -----------------------
End of settings
------------------------*/

// [blogurl slash noslash uploads]
function blogurl_func($attributes) {
    global $blogurl_settings;

    if (is_array($attributes)) {
        $attributes = array_flip($attributes);
    }
    
    if (isset($attributes['uploads'])) {
        $return_blogurl = $blogurl_settings['uploads'];
    }
    else {
        $return_blogurl = $blogurl_settings['siteurl'];
    }

    if (isset($attributes['slash']) || ($blogurl_settings['insertslash'] && !isset($attributes['noslash']))) {
        $return_blogurl .= '/';
    }

    return $return_blogurl;
}

add_shortcode('blogurl', 'blogurl_func');

// [posturl id=3]
// 3 being the ID of the post to link to

function posturl_func($attributes) {

    $post_id = intval($attributes['id']);
    $return_posturl = get_permalink($post_id);

    return $return_posturl;
}

add_shortcode('posturl', 'posturl_func');