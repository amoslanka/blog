<?php get_header(); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
        	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="content">
            	<?php the_content(''); ?>
            </div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>