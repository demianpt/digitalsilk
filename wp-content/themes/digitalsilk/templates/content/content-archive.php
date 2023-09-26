<article id="post-<?php the_ID(); ?>" <?php post_class( "blog-grid__item" ); ?> >
	<div class="c-block">
        <div class="c-block__media">
            <a href="<?php the_permalink(); ?>" class="c-block__media-link">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
        <div class="c-block__body">
            <div class="blog-meta">
                <div class="c-block__date"><?php echo get_the_date( 'F j, Y' ); ?></div>
                <?php if ( get_the_title() ) { ?>
                    <h4 class="c-block__title">
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_title() ?></a>
                    </h4>
                <?php } ?>
            </div>
        </div>
	</div>
</article>
