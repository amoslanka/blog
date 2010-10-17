<?php
	//$wpdb =& $GLOBALS['wpdb'];
	
	if (isset($_POST['bt_save'])){
		if ($_POST['edit_account'])
			if ( get_option('dbga_account') != $_POST['edit_account']) 
				update_option('dbga_account', $_POST['edit_account']);
		if ($_POST['edit_password'])
			if ( get_option('dbga_password') != $_POST['edit_password']) 	
				update_option('dbga_password', $_POST['edit_password']);	
		if ($_POST['traking_code'])
			if ( get_option('dbga_traking_code') != $_POST['traking_code']) 	
				update_option('dbga_traking_code', $_POST['traking_code']);		
	}
	
	if (( get_option('dbga_account') != '') && ( get_option('dbga_password') != '')){
		require 'gapi-1.3/gapi.class.php';
		
		try{
		$ga = new gapi(get_option('dbga_account'), get_option('dbga_password'));
		if ($ga->getAuthToken()!==null ){
			$ga->requestAccountData();
		}
		}catch(Exception $e){
			
		}
	}
?>

<div style="background-color:#FFF; padding-bottom: 10px; padding-top: 6px;">
<img src="../wp-content/plugins/wp-dashboard-google-analytics/img/gaforwp.jpg" />
</div>
<div style="margin-top:20px;" class="postbox">
	<h3 style="margin:0px; padding: 5px;"><span>Google Analytics Dashboard</span></h3>
	<div class="inside">
		<ul>
			<li>
            <?php
				if (is_object($ga)){
			?>
              <label for="ids" style="margin-left: 5px;">View Reports:</label> 
			  <select name="ids" id="ids" class="idsz">
              <?php
					foreach($ga->getResults() as $result){
					  echo '<option value="'.$result->getProfileId().'">'.$result.'</option>';
					}			  	
			  ?>
		      </select>
            <?php
				}else{
				echo('Go to insert your Google Analytics username, password and your tracking code in order to start using this plugin');
				}
			?>
            </li>
            <li>
            <div id="graph_place"></div>
            </li>
            <li>Want more complex statistics? Go to: <a href="http://www.google.com/analytics/" target="_new">http://www.google.com/analytics/</a></li>
		</ul>
	</div>
</div>

<div style="margin-top:20px;" class="postbox">
	<h3 style="margin:0px; padding: 5px;"><span>Options</span></h3>
	<div class="inside">
<form method="post" action="" style=" margin-bottom: 10px;">
<p>Fill the form with Email and password for your Google Analytics account (this will not create a new one you have to have one already)<br/>
  If you dont have a Google Analitics account go to <a href="http://www.google.com/analytics/" target="_new">http://www.google.com/analytics/</a></p>
<table width="500" border="0" cellspacing="0" cellpadding="0" style="padding: 5px">
  <tr>
    <td>E-mail</td>
    <td><label for="edit_account"></label>
      <input type="text" name="edit_account" id="edit_account" value="<?php echo(get_option('dbga_account')); ?>"/></td>    
  </tr>
  <tr>
    <td>Password</td>
    <td><label for="edit_password"></label>
      <input type="password" name="edit_password" id="edit_password" value="<?php echo(get_option('dbga_password')); ?>"/></td>    
  </tr>
  <tr>
    <td>Google Analitics Tracking Code</td>
    <td><label for="traking_code"></label>
      <textarea name="traking_code" id="traking_code" cols="45" rows="5"><?php echo(get_option('dbga_traking_code'));?></textarea></td>
  </tr>  
</table>
<input type="submit" name="bt_save" id="bt_save" value="Save Options" class="button" style="margin-left: 5px">
<input type="reset" name="bt_reset" id="bt_reset" value="Reset Options" class="button" style="margin-left: 20px">
</form>

	</div>
</div>

<form method="post" action="">
<p>&nbsp;</p>
</form>

<div class="postbox" style="margin-top: 5px">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
    <tr>
      <td width="18%" align="center" valign="middle">
	        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7124263">
                <img src="../wp-content/plugins/wp-dashboard-google-analytics/img/icon-paypal.gif" border="0" alt="help me to develop this free software!"/></a> 
            <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7124263">Donate with PayPal</a>
      </td>
      <td width="14%"><a href="http://wiki.nisi.ro/my-wordpress-plugins/wp-dashboard-google-analytics/" target="_blank">Plugin Home Page</a></td>
      <td width="68%"><a href="http://wiki.nisi.ro/wordpress/" target="_blank">My Other Plugins for Wordpress</a></td>
    </tr>
  </table>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.idsz').change(function() {
		jQuery('#graph_place').html('<img src="../wp-content/plugins/wp-dashboard-google-analytics/img/ajax-loader.gif" alt="Loading data from Google Analytics Server">');
	  jQuery('#graph_place').load('../wp-content/plugins/wp-dashboard-google-analytics/graph1.php?user=<?php echo(get_option('dbga_account')) ?>&pass=<?php echo(get_option('dbga_password')); ?>&gaprofileid='+this.value);
	});	
});
</script>