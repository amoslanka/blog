<?php
/*
Plugin Name: DashBoard Google Analitycs
Plugin URI: http://wiki.nisi.ro/my-wordpress-plugins/wp-dashboard-google-analytics/
Description: Easy managemant system for Google analytics code and statistics
Author: Nisipeanu Mihai
Version: 1.1
Author URI: http://www.nisi.ro/
*/
require_once('wp_plugin.php');
$wp_gapluginObj = new wp_gaplugin();
define('gapgversion', '1.0');

function gapg_tools(){
	$wppg = & $GLOBALS['wp_gapluginObj'];
	$wppg->addAdminHeader();
	add_management_page("DashBoard Google Analytics ".gapgversion, 'DashBoard Google Analytics', 9, $wppg->getDir().'/ga-dashboard.php');
}

function addgoogleanalyticscode(){
	echo get_option('dbga_traking_code');	
}
add_action('admin_menu', 'gapg_tools');
add_action('wp_head', 'addgoogleanalyticscode');

/*
switch ($options['position']) {
	case 'manual':
		// No need to insert here, bail NOW.
		break;
	case 'header':
	default:
		add_action('wp_head', array('GA_Filter','spool_analytics'),2);
		break;
}
*/
?>