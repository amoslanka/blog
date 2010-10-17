<?php get_header(); ?>
	<!-- <div id="twitter_div">
		<ul id="twitter_update_list"><li>&nbsp;</li></ul>
	</div> -->
	<!-- <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
	<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php getTwitter(); ?>.json?callback=twitterCallback2&amp;count=1"></script> -->
	-<br /> 
    
<!-->    <div class="navigate">
    	<b>Recent</b>
		<?php
			global $post;
			$myposts = get_posts('numberposts=3');
			foreach($myposts as $post) :
		?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
 		<?php endforeach; ?><a href="#" onclick="openAndHide('olderposts')">- Load the rest</a><div class="clear"></div>
    	<div class="hidden" id="olderposts">
		<?php
			global $post;
			$myposts = get_posts('offset=3&numberposts=999999999');
			foreach($myposts as $post) :
		?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
 		<?php endforeach; ?>
		</div>
        <?php displayCategories(); ?><div class="clear"></div>
        <b>Pages</b><ul id="thePages"><?php wp_list_pages('title_li='); ?></ul><div class="clear"></div>
	</div>
-->

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
        <div class="post-header">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<!--<?php edit_post_link('Edit This Post', '<p style="margin:10px 0 10px 0;">', '</p>'); ?>-->
            <span class="date"><a class="permalink" href="<?php the_permalink() ?>" rel="bookmark">––</a><span class="text"> <?php the_date('','',''); ?></span></span>
			<div class="clear"></div>
        </div>
        
        <?php if(is_category() || is_archive()) {
			 the_excerpt();
		 } else {
			 the_content("Read more");
		 } ?>

		<div class="divider">---</div>

		<!-- <div class="meta">
            <p>
				<span class = "meta-category">Posted Under <?php print the_category(', ') ?></span>
				<span class = "meta-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><span>
			</p>
        </div> -->

    </div>
	<?php endwhile; ?>
	
		<?php print_pagination(); ?>
	
	<?php else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
