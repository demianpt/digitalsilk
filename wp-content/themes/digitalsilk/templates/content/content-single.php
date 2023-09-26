<div class="container">
    <div class="content-single">
        <article id="post-<?php the_ID(); ?>" <?php post_class(""); ?> >

            <?php the_title('<h1 class="c-heading -h1">', '</h1>'); ?>

            <div class="post-info">
                <?php if (!empty(get_field('show_or_hide_post_author')) && get_field('show_or_hide_post_author') == 'Show'): ?>
                    <div class="post-info__author"><?php _e('Posted By:'); ?> <span class="detail-name"><?php the_author(); ?></span></div>
                <?php endif; ?>

                <div class="post-info__cat"><?php _e('Category:', 'dstheme'); ?> <span class="detail-name"><?php echo get_the_category_list(', '); ?></span></div>

                <div class="post-info__data"><?php _e('Last Updated:', 'dstheme'); ?> <span class="detail-name"><?php _e('On ', 'dstheme'); ?><?php echo date('F d, Y', strtotime(get_the_date())); ?></span></div>
            </div>

            <div class="is-wysiwyg">

                <?php the_content(); ?>

            </div>

        </article>
    </div>
</div>
