

<?php function print_pagination() { ?>
	<div id="nav-below" class="navigation">
		<div><?php next_posts_link('View older posts.') ?></div>
		<div><?php previous_posts_link('View newer posts.') ?></div>
	</div>	
	
<?php } ?>