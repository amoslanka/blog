<?php
/**
 * @package el_flickr
 * @author Bard Aase, modified by amoslanka
 * @version 0.0.1
 */
/*
Plugin Name: El Flickr (modified for amoslanka)
Plugin URI: http://blog.elzapp.com
Description: Integration with flickr
Author: Bård Aase
Version: 0.0.1
Author URI: http://blog.elzapp.com/
*/

function el_flickr_insert_image($atts, $content){
    /**
     * This function gathers information about a flickr image, and complies with the
     * shortcode API in Wordpress.
     * @param $atts array of options
     *   Options:    pid: picture id
     *               version: Small, Medium or Large (default:Medium)
     *               class: class to apped to the <div class="image "> so you can style it
     *               url: You can use an URL instead of a picture id, the pid will be 
     *                     extracted
     */
    $FLICKR_APIKEY=get_option("el_flickr_apikey");

	// -- set default size property. 
 	if (is_single()) {
		$default_size = get_option("el_flickr_default_size","Medium");
	} else {
		$default_size = get_option("el_flickr_archive_page_size","");
	}
	
    extract(shortcode_atts(array(
    "pid" => $atts[0],
    "size"=> $default_size,
    "align"=>get_option("el_flickr_alignment_class", "alignnone"), 
	"class"=>"",
    "url"=>"",
    "search"=>"",
	"alt"=>''
    ), $atts));

    if($search !=""){
      $licenses=rawurlencode("1,2,3,4,5,6,7");
      $s=rawurlencode($search); 
      $pid=get_option("elflickr_search_".$s,"");
      if($pid ==""){
        $s_url="http://api.flickr.com/services/rest/?method=flickr.photos.search"
            ."&api_key={$FLICKR_APIKEY}&text={$s}&license={$licenses}&per_page=1";
        $s_xml=file_get_contents($s_url);
        $s_obj=new SimpleXMLElement($s_xml);
        $s_result=$s_obj->xpath("//photo/@id");
        $pid=$s_result[0];
        add_option("elflickr_search_".$s,$pid);
      }
    }

    if($url != ""){
       $e=explode("/",$url);
       $pid=$e[5];
    }
    /* broken into several lines to look better on the blog */
    $sizes_url="http://api.flickr.com/services/rest/?method=flickr.photos.getSizes";
    $sizes_xml=file_get_contents("{$sizes_url}&api_key={$FLICKR_APIKEY}&photo_id=$pid");
    $info_url="http://api.flickr.com/services/rest/?method=flickr.photos.getInfo";
    $info_xml=file_get_contents("{$info_url}&api_key={$FLICKR_APIKEY}&photo_id=$pid");
    $c=new SimpleXMLElement($info_xml);
    $sizes=new SimpleXMLElement($sizes_xml);

    $un=$c->xpath("//owner/@username");
    $rn=$c->xpath("//owner/@realname");
    $uid=$c->xpath("//owner/@nsid");
    $t=$c->xpath("//title");
    $u=$c->xpath("//url");

    $image=elflickr_getImagePath($sizes, $size);
    $width=elflickr_getImageWidth($sizes, $size);
    $height=elflickr_getImageHeight($sizes, $size);
	
	// -- build the class string.
	$persistent_class = trim(get_option("el_flickr_persistent_class","flickr-image"));
	if ($persistent_class) { $class .= ' ' . $persistent_class; }
	if ($align) { $class .= ' ' . $align; }
	if ($size) { $class .= ' size-' . $size; }
	$class = trim($class);
	
	$r = "";

if (get_query_var("debug")=="true") {
	$image_count = count($image);
	$print_xml = $c->asXML();
	$r.=<<<EOT
	<div class="debug">pid: {$pid}</div>
	<div class="debug">size string: {$size}</div>
	<div class="debug">username: {$username}</div>
	<div class="debug">image_count: {$image_count}</div>
EOT;
	print '<div class="debug">xml: <code>';
	// var_dump($c);
	// print $sizes->asXML();
	// $thing = $sizes->xpath("//size[@label='$size']");
	// print $thing->asXML();
	print '</code>';
}

	if (!$alt) $alt = $t[0] . ' by ' . $rn[0] . ' on flickr';

    $r.=<<<EOT
<div class="{$class}" style="width:{$width[0]}px">
	<img src="{$image[0]}" width="100%" alt="{$alt}" />
	<div class="caption">
		<span class="title"><a href="{$u[0]}">{$t[0]}</a></span> 
    	<span class="author">by {$rn[0]} (<a href="http://flickr.com/photos/{$uid[0]}">{$un[0]}</a> on flickr)</span>
		<span class="content">{$content}</span>
</div>
</div>
EOT;

// Original dump:
//     $r=<<<EOT
// <div class="image imageclass{$fontsize} {$class}" style="width:{$width[0]}px">
// <img src="{$image[0]}" width="{$width[0]}" height="{$height[0]}"><div class="caption">
// <span class="title"><a href="{$u[0]}">{$t[0]}</a></span> 
//     <span class="author">by {$rn[0]} ( 
//     <a href="http://flickr.com/photos/{$uid[0]}">{$un[0]}</a> on flickr)</span>
// </div>
// </div>
// EOT;


    return $r;
}



/* 
	These methods retrieve attributes based on the size. 
	If the request doesn't include the size (and it might not)
	the node will not be in the retrieved xml and the strings 
	would return empty. A temp fix is to check the returned val
	and if its empty, return the original size. THIS SHOULD BE FIXED LATER.
*/
function elflickr_getImagePath($sizes, $size) {
	$r = $sizes->xpath("//size[@label='$size']/@source");
	if ($r) { return $r; }
	// if not found, return original size.
	return $sizes->xpath("//size[@label='Original']/@source");
}
function elflickr_getImageWidth($sizes, $size) {
	$r = $sizes->xpath("//size[@label='$size']/@width");
	if ($r) { return $r; }
	// if not found, return original size.
	return $sizes->xpath("//size[@label='Original']/@width");
}
function elflickr_getImageHeight($sizes, $size) {
	$r = $sizes->xpath("//size[@label='$size']/@height");
	if ($r) { return $r; }
	// if not found, return original size.
	return $sizes->xpath("//size[@label='Original']/@height");
}




add_shortcode(get_option("el_flickr_shortcode","flickr"),"el_flickr_insert_image");


function el_flickr_options_page(){
  // lala
  include(dirname(__FILE__)."/options.php");
}

function el_flickr_menu(){
    add_options_page('El Flickr Options', "El Flickr","administrator", __FILE__, 'el_flickr_options_page');
}

add_action("admin_menu","el_flickr_menu");

?>
