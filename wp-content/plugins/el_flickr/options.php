<div class="wrap">
  <h2>El Flickr configuration options</h2>
  <form method="post" action="options.php">
    <?php wp_nonce_field("update-options"); ?>
    <table class="form-table">
       <tr valign="top">
         <th scope="row">Flickr API key:</th>
         <td><input type="text" name="el_flickr_apikey" value="<?php echo get_option("el_flickr_apikey"); ?>" size="75"></td>
       </tr>
       <tr>
         <th scope="row">Shortcode:<br><em>The shortcode to use for embedding a flickr image. </em></th>
         <td><input type="text" name="el_flickr_shortcode" value="<?php echo get_option("el_flickr_shortcode","flickr"); ?>" size="75"></td>
       </tr>
       <tr>
         <th scope="row">Default Size: <br><em>See <a href="http://www.flickr.com/services/api/flickr.photos.getSizes.html" target="_blank">http://www.flickr.com/services/api/flickr.photos.getSizes.html</a> for more info.</em></th>
		<?php $selected_default_size = get_option("el_flickr_default_size","Medium"); ?>
		<td>
			<select name="el_flickr_default_size" >
				<option<?php if ('Square' == $selected_default_size) { echo ' selected'; } ?> value="Square">Square 75x75</option>
				<option<?php if ('Thumbnail' == $selected_default_size) { echo ' selected'; } ?> value="Thumbnail">Thumbnail 100x75</option>
				<option<?php if ('Small' == $selected_default_size) { echo ' selected'; } ?> value="Small">Small 240x180</option>
				<option<?php if ('Medium' == $selected_default_size) { echo ' selected'; } ?> value="Medium">Medium 500x375</option>
				<option<?php if ('Large' == $selected_default_size) { echo ' selected'; } ?> value="Large">Large</option>
			</select>
		</td>
       </tr>
       <tr>
         <th scope="row">Archive Page Size: <br><em>Size to display on archive or index page. Leave blank if the size should be the same as default size.</em></th>
		<?php $selected_default_size = get_option("el_flickr_archive_page_size",""); ?>
		<td>
			<select name="el_flickr_archive_page_size" >
				<option<?php if ('' == $selected_default_size) { echo ' selected'; } ?> value="">[ same as default ]</option>
				<option<?php if ('Square' == $selected_default_size) { echo ' selected'; } ?> value="Square">Square 75x75</option>
				<option<?php if ('Thumbnail' == $selected_default_size) { echo ' selected'; } ?> value="Thumbnail">Thumbnail 100x75</option>
				<option<?php if ('Small' == $selected_default_size) { echo ' selected'; } ?> value="Small">Small 240x180</option>
				<option<?php if ('Medium' == $selected_default_size) { echo ' selected'; } ?> value="Medium">Medium 500x375</option>
				<option<?php if ('Large' == $selected_default_size) { echo ' selected'; } ?> value="Large">Large</option>
			</select>
		</td>
       </tr>
       <tr>
         <th scope="row">Default Alignment Class: <br><em><!-- You may want to use the standard Wordpress media alignments, "alignnone", "alignleft", "aligncenter", or "alignright". --></em></th>
		<?php $selected_align_class = get_option("el_flickr_alignment_class","alignnone"); ?>
		 <td><select name="el_flickr_alignment_class" >
			<option<?php if ('' == $selected_align_class) { echo ' selected'; } ?> value="">[ none ]</option>
			<option<?php if ('alignnone' == $selected_align_class) { echo ' selected'; } ?>>alignnone</option>
			<option<?php if ('alignleft' == $selected_align_class) { echo ' selected'; } ?>>alignleft</option>
			<option<?php if ('aligncenter' == $selected_align_class) { echo ' selected'; } ?>>aligncenter</option>
			<option<?php if ('alignright' == $selected_align_class) { echo ' selected'; } ?>>alignright</option>
		</select></td>
       </tr>
       <tr>
         <th scope="row">Persistent Class: <br><em>Classes applied across the board to every flickr embed.</em></th>
         <td><input type="text" name="el_flickr_persistent_class" value="<?php echo get_option("el_flickr_persistent_class","flickr-image"); ?>" size="75"></td>
       </tr>
    </table>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="el_flickr_apikey,el_flickr_shortcode,el_flickr_persistent_class,el_flickr_alignment_class,el_flickr_default_size,el_flickr_archive_page_size" />
    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e('Save changes'); ?>" />
    </p>    
  </form>
</div>
