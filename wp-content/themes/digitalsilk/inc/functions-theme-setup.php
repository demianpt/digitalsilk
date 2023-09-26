<?php
/**
 * Sets up theme defaults and registers the various WordPress features that
 * custom supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since custom 1.0
 */
if( ! function_exists( 'theme_setup_functions' ) ){

    add_action( 'after_setup_theme', 'theme_setup_functions' );
    function theme_setup_functions(){
        /*
         * Makes custom available for translation.
         *
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on custom, use a find and
         * replace to change 'custom' to the name of your theme in all
         * template files.
         */
        load_theme_textdomain('custom', get_template_directory() . '/languages');

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Switches default core markup for search form, comment form,
         * and comments to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        register_nav_menus(array(
            'header-menu' => __('Header Menu', 'dstheme'),
            'footer-menu' => __('Footer Menu', 'dstheme'),
        ));

        /*
         * This theme uses a custom image size for featured images, displayed on
         * "standard" posts and pages.
         */
        add_theme_support('post-thumbnails');

        set_post_thumbnail_size(300, 400, true);

        // add_image_size( 'first_post_thumbnail', 814, 407, true );
        // add_image_size( 'second_post_thumbnail', 380, 407, array('center', 'center') );
    }

}

/**
 * Init Theme Widgets
 */
if( ! function_exists( 'register_theme_widgets' ) ) {
    function register_theme_widgets(){
        register_sidebar( array(
            'name'          => __('Widgets'),
            'id'            => 'widgets',
            'description'   => 'Main Widget Area',
            'class'         => '',
        ) );
    }
    add_action( 'widgets_init', 'register_theme_widgets' );
}

/**
 * Register Options page for ACF groups
 */
if ( ! function_exists( 'ds_register_theme_option_page' ) ) {
    function ds_register_theme_option_page() {
        if ( function_exists( 'acf_add_options_page' ) ) {
            // Register options page.
            $option_page = acf_add_options_page( array(
                'page_title' => __( 'Theme Options' ),
                'menu_title' => __( 'Theme Options' ),
                'menu_slug'  => 'theme-options',
                'position'   => '59',
            ) );
        }
    }
    add_action( 'acf/init', 'ds_register_theme_option_page' );
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wdc_comments(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since WDC 1.0
 */
if ( ! function_exists( 'wdc_comments' ) ) {
    function wdc_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
            <div class="comment-wrap">
                <div class="comment-img">
                    <?php echo get_avatar($comment,$args['avatar_size'],null,null,array('class' => array('img-responsive', 'img-circle') )); ?>
                </div>
                <div class="comment-body">
                    <h4 class="comment-author"><?php echo get_comment_author_link(); ?></h4>
                    <span class="comment-date"><?php printf(__('%1$s at %2$s', 'wdc'), get_comment_date(),  get_comment_time()) ?></span>
                    <?php if ($comment->comment_approved == '0') { ?><em><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <?php _e('Comment awaiting approval', 'wdc'); ?></em><br /><?php } ?>
                    <?php comment_text(); ?>
                    <span class="comment-reply"> <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'wdc'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?></span>
                </div>
            </div>
        </li>
    <?php }
}