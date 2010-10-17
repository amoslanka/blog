<?php
/*
Plugin Name: SchmancyBox
Description: <a href="http://www.geenius.co.uk">SchmancyBox</a> is a WP-Plugin that allows users to easily take control of FancyBox features.
Version: 1.0
Author: George Wiscombe
Author URI: http://geenius.co.uk/
License: Creative Commons Attribution-ShareAlike
*/
add_action('wp_head', 'geequery_wp_head');
add_action('admin_menu', 'mt_add_pages');

// action function for above hook
function mt_add_pages() {
    // Add a new submenu under Options:
    add_options_page('SchmancyBox', 'SchmancyBox', 8, 'schmancybox', 'geequery_wp_displayform');
}
	
	$jal_db_version = "1.0";
	// Guess the location
	$geequerypluginpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';

	//----\\
	function geequery_init_locale()
	{
		load_plugin_textdomain('geequery', $geequerypluginpath);
	}


	register_activation_hook(__FILE__,'jal_install');
	function jal_install ()
	{
		global $wpdb;
		global $jal_db_version;

		$table_name = $wpdb->prefix . "fancybox";
		if($wpdb->get_var("show tables like '$table_name'") != $table_name)
		{
			$sql = "CREATE TABLE " . $table_name . " (
			`FB_ID` int(11) NOT NULL auto_increment,
			`FB_NAME` varchar(50) NOT NULL,
			`FB_WIDTH` int(11) NOT NULL,
			`FB_HEIGHT` int(11) NOT NULL,
			`FB_OVERLAYSHOW` int(11) NOT NULL,
			`FB_OVERLAYOPACITY` int(11) NOT NULL,
			`FB_HIDEONZOOM` int(11) NOT NULL,
			PRIMARY KEY  (`FB_ID`)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);

			$welcome_name = "Mr. Wordpress";
			$welcome_text = "Congratulations, you just completed the installation!";

			$insert = "INSERT INTO " . $table_name .
			" (FB_NAME, FB_WIDTH, FB_HEIGHT, FB_OVERLAYSHOW, FB_OVERLAYOPACITY, FB_HIDEONZOOM) " .
			"VALUES ('gallery','450','300','0','10','1')";

			$results = $wpdb->query( $insert );

			add_option("jal_db_version", $jal_db_version);
		}
	}
	

	function geequery_wp_initform()
	{
		$url =  get_bloginfo('wpurl');
		$fancybox_target = '.query-gallery';

		// Will retrieve the information saved in the db
		global $wpdb;
		$table_name = $wpdb->prefix . "fancybox";
		$sql="SELECT * FROM ".$table_name." WHERE FB_ID=1";
		$req = mysql_query($sql) or die("SQL Error!<br>".$sql."<br>".mysql_error());
		while($data = mysql_fetch_assoc($req))
		{
			$fbname		=$data['FB_NAME'];
			$fbwidth	=$data['FB_WIDTH'];
			$fbheight	=$data['FB_HEIGHT'];
			$ovshow		=$data['FB_OVERLAYSHOW'];
			$ovopac		=$data['FB_OVERLAYOPACITY'];
			$hideonz	=$data['FB_HIDEONZOOM'];
		}
		if(empty($fbname))	{ $fbname=LightBox;	}
		if(empty($fbwidth))	{ $fbwidth=500; 	}
		if(empty($fbheight)){ $fbheight=200; 	}
		if(empty($ovopac))	{ $ovopac=50; 		}
		$params=array('fbname'=>$fbname,'fbwidth'=>$fbwidth,'fbheight'=>$fbheight,'ovshow'=>$ovshow,'ovopac'=>$ovopac,'hideonz'=>$hideonz);
		return $params;
	}


	
	function geequery_wp_head()
	{
		$params=geequery_wp_initform();
		$fbname=$params['fbname']; $fbwidth=$params['fbwidth']; $fbheight=$params['fbheight'];
		$ovshow=$params['ovshow']; $ovopac=$params['ovopac']; $hideonz=$params['hideonz'];
		echo '
		<script type="text/javascript" src="'. get_bloginfo('wpurl') .'/wp-content/plugins/schmancybox/fancybox/js/jquery.fancybox-1.0.0.js"></script>
		<script type="text/javascript" src="'. get_bloginfo('wpurl') .'/wp-content/plugins/schmancybox/fancybox/js/jquery.pngFix.pack.js"></script>';

		echo'
		<script type="text/javascript">
		$(document).ready(function() {
		$(".'.$fbname.'").fancybox({
		\'overlayOpacity\':	'.($ovopac/100).',
		\'hideOnContentClick\': '; if($hideonz==1){ echo 'true'; } else{ echo 'false'; }
		echo ',
		\'frameWidth\': '.$fbwidth.',
		\'frameHeight\': '.$fbheight.',
		\'overlayShow\': ';	if($ovshow==1){ echo 'true'; } else{ echo 'false'; }
		echo'
		});
		});
		</script>';

		echo'
		<link rel="stylesheet" href="'. get_bloginfo('wpurl') .'/wp-content/plugins/schmancybox/fancybox/css/fancy.css" type="text/css" media="screen" />';

		//innerfade

	}

	//geequery_wp_displayform();
	function geequery_wp_displayform()
	{
			global $wpdb;
		global $jal_db_version;
	if(!empty($_POST)){
	
			//Will be called only if the user clicks the submit button
			$fbname			= htmlentities($_POST['fb-name'],ENT_QUOTES);
			$iframewidth	= htmlentities($_POST['iframe-width'],ENT_QUOTES);
			$iframeheight	= htmlentities($_POST['iframe-height'],ENT_QUOTES);
			$overlayshow	= htmlentities($_POST['overlay-show'],ENT_QUOTES);
			$overlayopacity	= htmlentities($_POST['overlay-opacity'],ENT_QUOTES);
			$hideonzoom		= htmlentities($_POST['hide-on-zoom'],ENT_QUOTES);
	
			if(!empty($fbname))
			{
				//Query to insert the values into the database
				$table_name = $wpdb->prefix . "fancybox";
				$sql="
				UPDATE ".$table_name."
				SET FB_NAME = '$fbname',
				FB_WIDTH = '$iframewidth',
				FB_HEIGHT = '$iframeheight',
				FB_OVERLAYSHOW = '$overlayshow',
				FB_OVERLAYOPACITY = '$overlayopacity',
				FB_HIDEONZOOM = '$hideonzoom'
				WHERE FB_ID=1";
				//$req = mysql_query($sql) or die("SQL Error!<br>".$sql."<br>".mysql_error());
				if($req = mysql_query($sql)){$postresult="success";}
				else {$postresult="failed";}
			}
		
	}
		$params=geequery_wp_initform();
		//print_r($params);
		$fbname=$params['fbname']; $fbwidth=$params['fbwidth']; $fbheight=$params['fbheight'];
		$ovshow=$params['ovshow']; $ovopac=$params['ovopac']; $hideonz=$params['hideonz'];
		//Overlay show tick
		if($ovshow==1) $tickovshow="CHECKED";

		//Hide on zoom tick
		if($hideonz==1) $tickhoz="CHECKED";

		// Opacity list
		$opcaopt="";
		for($i=1;$i<=10;$i++)
		{
			$j=$i*10;
			if($j==$ovopac) $opacopt.='<option selected value="'.$j.'">'.$j.'%</option>';
			else	$opacopt.='<option value="'.$j.'">'.$j.'%</option>';
		}
		echo'
		<form name="form1" id="form1" action="" method="post">
		<div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; width:590px; margin:0 auto;">
		<fieldset style="border:1px solid #fff">
		<legend style="font-size:27px; text-align:center; color:#666; font-family:Times New Roman, Times, serif"><img src="http://schmancybox.geenius.co.uk/images/schmancy-header.png" alt="SchmancyBox"/>
</legend>';

		if($postresult=="success"){
			echo'<div style="background-color:#E9FFD9; border:1px solid #D5F5BB; width:510px; text-align:center; padding:10px 0;; margin:10px auto;">Your settings have been saved.</div>';	
		}
		elseif($postresult=="failed"){
			echo'<div style="background-color:#FFD4C8; border:1px solid #F5B3B3; width:510px; text-align:center; padding:10px 0;; margin:10px auto;">Uhoh, your settings have not saved!</div>';	
		}
		
		echo'
		<table width="510" border="0" bordercolor="#FFFFFF" cellspacing="0" style="margin:30px 40px">
		<tr bgcolor="#eaf3fa">
		<td style="text-align:right; padding:10px;"><label for="fb-name" style="padding-top:3px;"><label for="fb-name"><strong>Class for Lightboxing:</strong></label>					</td>
		<td style="padding:10px 10px 10px 0;"><input type="text" name="fb-name" id="fb-name" size="25" maxlength="25" tabindex="1" value="'.$fbname.'"/></td>
		</tr>
		<tr bgcolor="#fff">
		<td style="text-align:right; padding:10px;"><label for="iframe-width"><strong>Default iFrame Dimensions:</strong><br /><small>(<a href="http://schmancybox.geenius.co.uk/schmancy-box-how-to.pdf">guide to changing individually</a>)</small></label></td>
		<td><input name="iframe-width" type="text" value="'.$fbwidth.'" size="6" tabindex="3" />x<input name="iframe-height" type="text" value="'.$fbheight.'" size="6" tabindex="4" /></td>
		</tr>
		<tr bgcolor="#eaf3fa">
		<td style="text-align:right; padding:10px;"><label for="overlay-show"><strong>Overlay Show:</strong><br /><small>(false by default)</small></label></td>
		<td><input '.$tickovshow.' name="overlay-show" type="checkbox" value="1"  /></td>
		</tr>
		<tr>
		<td style="text-align:right; padding:10px;"><label for="overlay-opacity"><strong>Overlay Opacity</strong><br /><small>(Opacity colour is <a href="http://schmancybox.geenius.co.uk/schmancy-box-how-to.pdf">defined in the css</a>)</small></label></td>
		<td>
		<select name="overlay-opacity" onchange="">
		'.$opacopt.'
		</select>
		</td>
		</tr>
		<tr bgcolor="#eaf3fa">
		<td style="text-align:right; padding:10px;"><label for="fb-name" style="padding-top:3px; margin-right:10px;"><label for="hide-on-zoom"><strong>Hide Lightbox when clicked on zoomed item:</strong><br /><small>(true by default)</small></label>   </td>
		<td><input '.$tickhoz.' style="margin-top:6px;" name="hide-on-zoom" type="checkbox" value="1" tabindex="2" /></td>
		</tr>

		<tr>
		<td>&nbsp;</td>
		<td style="text-align:right; padding:10px;"><div style="clear:both;"><input class="formInputButton" type="submit" name="submitButtonName" id="submitButtonName" value="Save Settings" tabindex="9"/></div></td>
		</tr>

		</table>

		</fieldset>
		
		<div style="background-color:#FFFEEB; border:1px solid #ccc; width:510px; text-align:center; padding:10px 0;; margin:10px auto;">
		
		<p style="margin:0 0 5px 0;"><strong><a href="http://schmancybox.geenius.co.uk/schmancy-box-how-to.pdf" style="color:#464646">Download the SchmancyBox User Guide</a></strong></p>
		<small>Schmancy<strong>Box</strong> v1.0 &copy; Copyright 2008</small></div>
		
		</div>
		</form>
		';
	}

?>