<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post">
		        <div class="post-header">
	        		<h2><?php the_title(); ?></h2>
	            	<span class="date">––<span class="text">&nbsp;&nbsp;&nbsp;<?php the_date('','',''); ?></span></span>
				</div>
	            <div class="content">
	            	<div class="post">
						<?php the_content(''); ?>
					</div>
					<div class="divider">---</div>
					<div class="comments">
						<?php comments_template(); ?>
					</div>
	            </div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<p>...uhm. This page doesn't exist. </p>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php endif; ?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>