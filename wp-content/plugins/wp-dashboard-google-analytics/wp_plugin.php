<?php
class wp_gaplugin{
	function __construct(){
	}	
	
	public function __destruct(){
	}	
	
	public function addAdminHeader(){
		if (!defined('_getDir'))
			define('_getDir', $this->getDir());
	}
	
	public function getDir(){
		$_temp 	= preg_replace('/^.*wp-content[\\\\\/]plugins[\\\\\/]/', '', __FILE__);
		$_temp 	= str_replace(basename(__FILE__), '', $_temp);
		$_temp  = str_replace('\\','/',$_temp);
		return $_temp;
	}
}
?>