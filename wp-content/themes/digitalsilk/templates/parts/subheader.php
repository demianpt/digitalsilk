<?php

if( is_category() ){
    $term           = get_queried_object();
    $title          = get_field( 'title', $term );
    $subtitle       = get_field( 'subtitle', $term );
	$background     = get_field( 'background', $term );
}
else{
    $page_id = ( is_home() ) ? get_option( 'page_for_posts' ) : get_the_ID();
    $title          = get_field( 'title', $page_id );
    $subtitle       = get_field( 'subtitle', $page_id );
	$background     = get_field( 'background', $page_id );
}

if( $background ){
	$background = "style='background-image: url({$background});'";
}

if( $title || $subtitle ): ?>

    <div class="m-banner m-banner--small header-lap has-overlay colors-inverted">
        <div class="m-banner__media" <?php echo $background; ?>>
<!--            <picture class="m-banner__picture">
                <source media="(min-width: 1500px)" srcset="https://placehold.co/1920x450">
                <source media="(min-width: 1024px)" srcset="https://placehold.co/1200x350">
                <source media="(min-width: 768px)" srcset="https://placehold.co/1024x400">
                <source media="(min-width: 300px)" srcset="https://placehold.co/560x200">
                <img src="https://placehold.co/1920x450" alt="" />
            </picture>-->
        </div>
        <div class="m-banner__container container">
            <div class="l-banner text-center">
                <div class="c-heading -h1">
                    <?php if( $title ): ?>
                        <h1 class="c-heading__title"><?php echo $title; ?></h1>
                    <?php endif; ?>

                    <?php if( $subtitle ): ?>
                        <div class="c-heading__sub"><?php echo $subtitle; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
