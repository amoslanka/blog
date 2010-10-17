<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_date('','',''); ?>"><?php 
				$title = get_the_title(); 
				if (!$title) $title = '(untitled)';
				echo $title;
				?></a></h2>
	            <!-- <span class="date">––<span class="text"> <?php the_date('','',''); ?></span></span> -->

		<?php endwhile; ?>
			<?php print_pagination(); ?>
	<?php else : ?>
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>