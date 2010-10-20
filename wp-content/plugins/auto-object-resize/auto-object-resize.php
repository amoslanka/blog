<?php
/*
Plugin Name: Object Embed Automatic Resizer (Modified for StruckAxiom)
Version: 0.3
Author: Original: Josh Betz. Modified for StruckAxiom
Description: Finds embedded object in the post content and resizes them to a specified width, keeping the correct width-height ratio. This happens automatically, no need for quicktags or direct calls.
*/


if ( is_admin() ){ // admin actions
  add_action('admin_menu', 'resize_vimeo_menu');
  add_action( 'admin_init', 'register_rv_settings' );
} else {
  add_filter( 'the_content', 'resize_vimeo', 500 );
}



function resize_vimeo($content) {
	$new_width = get_option('rv_width');

	// -- for the mobile version
	if (function_exists("wpmp_switcher_outcome")) {
		if (wpmp_switcher_outcome() == WPMP_SWITCHER_MOBILE_PAGE) :
			$new_width = get_option('rv_mobile_width');
		endif;
	}
	if( $new_width == '' ) $new_width = 500;
	
	// do objects.
	$objects = preg_split( '/object/', $content );
	foreach( $objects as $number => $object ) {
		if( preg_match( '/embed/', $object)) {
			$onlyobjects[$number] = $object;
			$dimensionsobject = $object;
			
			preg_match_all('/width="[0-9]+"/', $dimensionsobject, $width);
			preg_match_all('/[0-9]+/', $width[0][0], $width);
			preg_match_all('/height="[0-9]+"/', $dimensionsobject, $height);
			preg_match_all('/[0-9]+/', $height[0][0], $height);
			
			$width = $width[0][0];
			$height = $height[0][0];
			
			if( $width != 0 ) $ratio = $height / $width;
			else $ratio = 1;
			
			$new_height = round($ratio * $new_width);
			$object = str_replace( $height, $new_height, $object );
			$object = str_replace( $width, $new_width, $object );
			$newobject[$number] = $object;
		}
	}
	$print = str_replace( $onlyobjects, $newobject, $content );

	$onlyobjects = null;
	$newobject = null;
	$content = $print;
	
	// do iframes
	$objects = preg_split( '/iframe/', $content );
	foreach( $objects as $number => $object ) {

		if ( preg_match( '(src="http://player.vimeo.com)', $object)) {
			$onlyobjects[$number] = $object;
			$dimensionsobject = $object;
		
			preg_match_all('/width="[0-9]+"/', $dimensionsobject, $width);
			preg_match_all('/[0-9]+/', $width[0][0], $width);
			preg_match_all('/height="[0-9]+"/', $dimensionsobject, $height);
			preg_match_all('/[0-9]+/', $height[0][0], $height);
		
			$width = $width[0][0];
			$height = $height[0][0];
		
			if( $width != 0 ) $ratio = $height / $width;
			else $ratio = 1;
		
			$new_height = round($ratio * $new_width);
			$object = str_replace( $height, $new_height, $object );
			$object = str_replace( $width, $new_width, $object );
			$newobject[$number] = $object;
		}
	}
	
	
	
	
	$print = str_replace( $onlyobjects, $newobject, $content );
	return $print;
}

function register_rv_settings() { // whitelist options
  register_setting( 'resize-vimeo-group', 'rv_width' );
  register_setting( 'resize-vimeo-group', 'rv_mobile_width' );
}

function resize_vimeo_menu() {
  add_options_page('Resize Object Options', 'Object Embed Automatic Resizer', 'administrator', 'rv-options-page', 'resize_vimeo_options');
}

function resize_vimeo_options() { ?>
	
	<div class="wrap">
	<h2>Object Embed Automatic Resizer</h2>
	<p>This plugin finds embedded object in the post content and resizes them to a specified width, keeping the correct width-height ratio. This happens automatically, no need for quicktags or direct calls, just specify a width on this page and the rest is handled automatically.</p>
	<p><em>Original plugin by Josh Betz. Modified for StruckAxiom.</em></p>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	
	<table class="form-table">
	
		<tr valign="top">
		<th scope="row">Object Width</th>
		<td><input type="text" name="rv_width" value="<?php echo get_option('rv_width'); ?>" /></td>
		</tr>
		<tr valign="top">
		<th scope="row">Object Width on Mobile <em>(depends on WP Mobile Pack plugin)</th>
		<td><input type="text" name="rv_mobile_width" value="<?php echo get_option('rv_mobile_width'); ?>" /></td>
		</tr>
		
	</table>
	
	<?php settings_fields( 'resize-vimeo-group' ); ?>
	
	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
	
	</form>
	</div>
	
<?php } ?>