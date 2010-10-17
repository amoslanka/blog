<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
       	<h2><?php the_title(); ?></h2>
           <div class="content">
           	<div class="post">
				<?php the_content(''); ?>
			</div>
			<div class="comments">
				<?php // comments_template(); ?>
			</div>
           </div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>