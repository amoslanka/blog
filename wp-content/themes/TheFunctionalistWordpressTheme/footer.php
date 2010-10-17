	<div class="clear"></div>
	<div id="footer">
		<ul class="sidebar">
		<?php if ( !function_exists('dynamic_sidebar')
		        || !dynamic_sidebar() ) : ?>
		<?php endif; ?>
		</ul>
		<div class="clear"></div>
		<div id="search">
			<?php get_search_form(); ?>
		</div>
		<div class="divider clear"></div>
	</div>
    </div>
</body>
</html>
	
<!-- Theme based on Funcionalist by Greg Ponchak http://gregponchak.com/ -->