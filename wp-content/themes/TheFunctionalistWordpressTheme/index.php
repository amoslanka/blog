<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
        <div class="post-header">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php edit_post_link('Edit This Post', '<p style="position:absolute; left:5px">', '</p>'); ?>
            <span class="date"><a class="permalink" href="<?php the_permalink() ?>" rel="bookmark">––</a><span class="text"> <?php the_date('','',''); ?></span></span>
            <div class="clear"></div>
        </div>
        
        <?php if(is_category() || is_archive()) {
            the_excerpt();
        } else {
            the_content("Read more");
        } ?>
        <div class="divider">---</div>
        <div class="meta hidden">
            <p>
                <span class = "meta-category">Posted Under <?php print the_category(', ') ?></span>
                <span class = "meta-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><span>
            </p>
        </div>
    </div>
    <?php endwhile; ?>
        <?php print_pagination(); ?>
    <?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
