<?php
/**
 * Enqueue scripts and styles for the front end.
 *
 * @since custom 1.2
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'DS_ThemeAssets' ) ) {

    Class DS_ThemeAssets
    {

        public function __construct()
        {
            /**
             * Enqueue theme assets
             */
            add_action( 'wp_enqueue_scripts', array( __CLASS__, 'theme_assets' ), 99 );

            /**
             * Enqueue Admin panel additional styles and scripts
             */
            add_action( 'admin_enqueue_scripts', array( __CLASS__, 'theme_admin_assets' ) );

            /**
             * Emoticons will still work and emoji’s will still work in browsers which have built in support for them.
             * This action simply removes the extra code bloat used to add support for emoji’s in older browsers.
             */
            add_action( 'init', array( __CLASS__, 'theme_disable_emojis' ) );

            /**
             * Disable standard plugin scripts.
             * For example remove Contact Form 7 css and ajax functionality
             */
            add_action( 'wp_footer', array( __CLASS__, 'theme_deregister_scripts' ) );
            add_action( 'wp_print_styles', array( __CLASS__, 'theme_deregister_styles' ), 99 );

            /**
             * Optimize JS and CSS files
             */
            add_filter( 'script_loader_tag', array( __CLASS__, 'deferJS_parser' ), 11, 1 );
            add_filter( 'style_loader_tag', array( __CLASS__, 'loadCSS_parser' ) );
        }

        /**
         * Enqueue scripts and styles for the front end.
         */
        public static function theme_assets()
        {
            wp_enqueue_script( 'loadCSS', get_template_directory_uri() . '/assets/vendors/cssrelpreload.js', false, null, false );
            wp_enqueue_script( 'jquery' );

            global $wp_query;
            $ds_vars = array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'query'    => json_encode($wp_query->query_vars),
            );
            if (class_exists('woocommerce')) {
                $ds_vars['isCart']          = is_cart();
                $ds_vars['isShop']          = false;
                $ds_vars['isSingleProduct'] = is_product();
                $ds_vars['isCheckout']      = is_checkout();
            }
            wp_localize_script('jquery', 'ds', $ds_vars);

            wp_enqueue_style('site-critical', get_template_directory_uri() . '/assets/_dist/css/critical.css', array(), '1.8' );

            if ( is_home() || is_category() || is_single() || is_search() || is_post_type_archive( 'post' ) ) {
                wp_enqueue_script( 'blog-scripts', get_template_directory_uri() . '/assets/_dist/js/app_blog.js', true, true, true );
                wp_enqueue_style( 'blog-styles', get_template_directory_uri() . '/assets/_dist/css/blog.css', array(), '1.8' );
            }

            wp_enqueue_script( 'modernizr-webp', get_template_directory_uri() . '/assets/vendors/modernizr-custom.js', false, null, false );

            wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/_dist/css/main.css', array(), '1.8' );

            wp_enqueue_script('aos-js', get_template_directory_uri() . '/assets/vendors/aos/aos.js', true, true, true );
            wp_enqueue_style('aos-css', get_template_directory_uri() . '/assets/vendors/aos/aos.css', array(), '1.8' );

            wp_enqueue_script('swiper-js', get_template_directory_uri() . '/assets/vendors/swiper/swiper-bundle.min.js', true, true, true );
            wp_enqueue_style('swiper-css', get_template_directory_uri() . '/assets/vendors/swiper/swiper-bundle.min.css', array(), '1.8' );

            wp_enqueue_script('js-floatbox', get_template_directory_uri() . '/assets/vendors/floatbox/floatbox.js', true, true, false );
            wp_enqueue_style('css-floatbox', get_template_directory_uri() . '/assets/vendors/floatbox/floatbox.css', array(), '1.8' );

            wp_enqueue_script('js-lazyload', get_template_directory_uri() . '/assets/vendors/lazyload/lazyload.min.js', true, true, true );

            wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/_dist/js/app.js', array('jquery'), true, true ); //theme js scripts

            /* Woocommerce */
            if ( class_exists( 'woocommerce' ) ) {

                wp_enqueue_script( 'woocommerce-scripts', get_template_directory_uri() . '/assets/_dist/js/app_woocommerce.js', true, true, true );

                if (
                    is_cart() || is_checkout() || is_account_page() || is_shop() || is_product() ||
                    is_product_category() || is_wc_endpoint_url() || is_wishlist()
                ) {
                    wp_enqueue_script( 'woocommerce-scripts', get_template_directory_uri() . '/assets/_dist/js/app_woocommerce.js', true, true, true );
                    wp_enqueue_style( 'woocommerce-styles', get_template_directory_uri() . '/assets/_dist/css/woocommerce/woocommerce.css', array(), '1.8' );
                    wp_enqueue_style( 'woocommerce-specific-styles', get_template_directory_uri() . '/assets/_dist/css/woocommerce/woocommerce-specific/woocommerce-specific.css', array(), '1.8' );

                    wp_enqueue_script( 'fancybox-scripts', get_template_directory_uri() . '/assets/vendors/fancybox/jquery.fancybox.min.js', true, true, true );
                    wp_enqueue_style( 'fancybox-styles', get_template_directory_uri() . '/assets/vendors/fancybox/jquery.fancybox.min.css', array(), '1.8' );
                }
            }
        }

        /**
         * Load Admin Panel styles and js
         */
        public static function theme_admin_assets()
        {
            wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/admin/css/theme.css', array(), 1.0 );
            wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/admin/js/theme.js', array() , 1.0, true );

            $issetPluginACF = class_exists( 'Acf' );
            wp_localize_script( 'admin-js', 'theme_js_params', array(
                'is_acf_exist' => $issetPluginACF,
                'theme_path' => get_stylesheet_directory_uri()
            ) );
        }

        /**
         * Disable the emoji's
         */
        public static function theme_disable_emojis()
        {
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );
            remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
            remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
            remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        }

        /**
         * Dequeue Ajax scripts for the front end.
         */
        public static function theme_deregister_scripts()
        {
            //wp_dequeue_script( 'contact-form-7' );

            //if ( !is_page( array( 'contact-us', 'contact' ) ) ) {
            //    wp_dequeue_script('google-recaptcha');
            //}
        }

        /**
         * Dequeue Styles for the front end.
         */
        public static function theme_deregister_styles()
        {
            wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
            //wp_dequeue_style( 'contact-form-7' );
        }

        /**
         * Convert CSS scripts for use with loadCSS library - https://github.com/filamentgroup/loadCSS
         *
         * @param string $tag
         * @return string $tag
         */
        public static function loadCSS_parser( $tag )
        {
            if (is_admin()) return $tag;

            // do not edit, if not a stylesheet
            if (FALSE === strpos($tag, "rel='stylesheet'")) return $tag;

            // ** Excluded files
            // Of if tag includes any of these file names do not load via LoadCSS:
            // if ( strpos( $tag, "specificfilename.min.css" ) ) return $tag;
            if ( strpos( $tag, "critical.css" ) ) return $tag;
            if ( strpos( $tag, "dashicons.min.css" ) ) return $tag;
            if ( strpos( $tag, "buttons.min.css" ) ) return $tag;
            if ( strpos( $tag, "forms.min.css" ) ) return $tag;
            if ( strpos( $tag, "login.min.css" ) ) return $tag;

            // Set a variable which will hold the default script for a '<noscript>' tag
            $noscript = '<noscript>' . $tag . '</noscript>';
            // Change 'rel' value from 'stylesheet' to 'preload'
            $tag = preg_replace("/='stylesheet'/", '="preload"', $tag);
            // Add 'as' and 'onload' attributes
            $tag = preg_replace("/type='text\/css'/", 'as="style" onload="this.onload=null;this.rel=\'stylesheet\'"', $tag);
            // Remove media attribute
            $tag = preg_replace("/media='.*'/", '', $tag);

            return $tag . $noscript;
        }

        /**
         * Defer parsing for js files - https://www.w3schools.com/tags/att_script_defer.asp
         *
         * @param string $url,
         * @return string $url
         */
        public static function deferJS_parser( $url )
        {
            if ( is_user_logged_in() ) return $url;

            // do not edit if not a js files
            if (FALSE === strpos($url, '.js')) return $url;
            if (strpos($url, 'jquery.js')) return $url;

            return str_replace( ' src', ' defer src', $url );
        }

    }

    new DS_ThemeAssets();
}

/*
* You can add standart plugin from core
*
* example:
*
*
* Adds Masonry to handle vertical alignment of footer widgets.
* wp_enqueue_script( 'jquery-masonry' );
*
*
*
* Adds JavaScript to pages with the comment form to support
* sites with threaded comments (when in use).
*
* if (is_singular() && comments_open() && get_option('thread_comments')) {
*      wp_enqueue_script('comment-reply');
* }
*
*
*
* Full scripts list(scripts inclide in wp-includes/script-loader.php file):
*
utils                     /wp-admin/js/utils.js
common                    /wp-admin/js/common.js
sack                      /wp-includes/js/tw-sack.js
quicktags                 /wp-includes/js/quicktags.js
colorpicker               /wp-includes/js/colorpicker.js
editor                    /wp-admin/js/editor.js
wp-fullscreen             /wp-admin/js/wp-fullscreen.js
prototype                 /wp-includes/js/prototype.js
wp-ajax-response          /wp-includes/js/wp-ajax-response.js
wp-pointer                /wp-includes/js/wp-pointer.js
autosave                  /wp-includes/js/autosave.js
wp-lists                  /wp-includes/js/wp-lists.js
scriptaculous-root        /wp-includes/js/scriptaculous/wp-scriptaculous.js
scriptaculous-builder     /wp-includes/js/scriptaculous/builder.js
scriptaculous-dragdrop    /wp-includes/js/scriptaculous/dragdrop.js
scriptaculous-effects	/wp-includes/js/scriptaculous/effects.js
scriptaculous-slider	/wp-includes/js/scriptaculous/slider.js
scriptaculous-sound	/wp-includes/js/scriptaculous/sound.js
scriptaculous-controls	/wp-includes/js/scriptaculous/controls.js
scriptaculous	scriptaculous-dragdrop, scriptaculous-slider, scriptaculous-controls, scriptaculous-root
cropper                   /wp-includes/js/crop/cropper.js
jquery                    /wp-includes/js/jquery/jquery.js
jquery-ui-core            /wp-includes/js/jquery/ui/jquery.ui.core.min.js
jquery-effects-core	/wp-includes/js/jquery/ui/jquery.effects.core.min.js
jquery-effects-blind	/wp-includes/js/jquery/ui/jquery.effects.blind.min.js
jquery-effects-bounce	/wp-includes/js/jquery/ui/jquery.effects.bounce.min.js
jquery-effects-clip	/wp-includes/js/jquery/ui/jquery.effects.clip.min.js
jquery-effects-drop	/wp-includes/js/jquery/ui/jquery.effects.drop.min.js
jquery-effects-explode	/wp-includes/js/jquery/ui/jquery.effects.explode.min.js
jquery-effects-fade	/wp-includes/js/jquery/ui/jquery.effects.fade.min.js
jquery-effects-fold	/wp-includes/js/jquery/ui/jquery.effects.fold.min.js
jquery-effects-highlight	/wp-includes/js/jquery/ui/jquery.effects.highlight.min.js
jquery-effects-pulsate	/wp-includes/js/jquery/ui/jquery.effects.pulsate.min.js
jquery-effects-scale	/wp-includes/js/jquery/ui/jquery.effects.scale.min.js
jquery-effects-shake	/wp-includes/js/jquery/ui/jquery.effects.shake.min.js
jquery-effects-slide	/wp-includes/js/jquery/ui/jquery.effects.slide.min.js
jquery-effects-transfer	/wp-includes/js/jquery/ui/jquery.effects.transfer.min.js
jquery-ui-accordion	/wp-includes/js/jquery/ui/jquery.ui.accordion.min.js
jquery-ui-autocomplete	/wp-includes/js/jquery/ui/jquery.ui.autocomplete.min.js
jquery-ui-button          /wp-includes/js/jquery/ui/jquery.ui.button.min.js
jquery-ui-datepicker	/wp-includes/js/jquery/ui/jquery.ui.datepicker.min.js
jquery-ui-dialog          /wp-includes/js/jquery/ui/jquery.ui.dialog.min.js
jquery-ui-draggable	/wp-includes/js/jquery/ui/jquery.ui.draggable.min.js
jquery-ui-droppable	/wp-includes/js/jquery/ui/jquery.ui.droppable.min.js
jquery-ui-mouse           /wp-includes/js/jquery/ui/jquery.ui.mouse.min.js
jquery-ui-position	/wp-includes/js/jquery/ui/jquery.ui.position.min.js
jquery-ui-progressbar	/wp-includes/js/jquery/ui/jquery.ui.progressbar.min.js
jquery-ui-resizable	/wp-includes/js/jquery/ui/jquery.ui.resizable.min.js
jquery-ui-selectable	/wp-includes/js/jquery/ui/jquery.ui.selectable.min.js
jquery-ui-slider          /wp-includes/js/jquery/ui/jquery.ui.slider.min.js
jquery-ui-sortable	/wp-includes/js/jquery/ui/jquery.ui.sortable.min.js
jquery-ui-tabs            /wp-includes/js/jquery/ui/jquery.ui.tabs.min.js
jquery-ui-widget      	/wp-includes/js/jquery/ui/jquery.ui.widget.min.js
jquery-form               /wp-includes/js/jquery/jquery.form.js
jquery-color              /wp-includes/js/jquery/jquery.color.js
jquery-query              /wp-includes/js/jquery/jquery.query.js
jquery-serialize-object	/wp-includes/js/jquery/jquery.serialize-object.js
jquery-hotkeys            /wp-includes/js/jquery/jquery.hotkeys.js
jquery-table-hotkeys	/wp-includes/js/jquery/jquery.table-hotkeys.js
jquery-masonry            /wp-includes/js/jquery/jquery.masonry.min.js
suggest                   /wp-includes/js/jquery/suggest.js
schedule                  /wp-includes/js/jquery/jquery.schedule.js
thickbox                  /wp-includes/js/thickbox/thickbox.js
jcrop                     /wp-includes/js/jcrop/jquery.Jcrop.js
swfobject                 /wp-includes/js/swfobject.js
plupload                  /wp-includes/js/plupload/plupload.js
plupload-html5            /wp-includes/js/plupload/plupload.html5.js
plupload-flash            /wp-includes/js/plupload/plupload.flash.js"
plupload-silverlight	/wp-includes/js/plupload/plupload.silverlight.js
plupload-html4            /wp-includes/js/plupload/plupload.html4.js
plupload-full	plupload, plupload-html5, plupload-flash, plupload-silverlight, plupload-html4
plupload-handlers         /wp-includes/js/plupload/handlers.js
swfupload                 /wp-includes/js/swfupload/swfupload.js
swfupload-swfobject	/wp-includes/js/swfupload/plugins/swfupload.swfobject.js
swfupload-queue           /wp-includes/js/swfupload/plugins/swfupload.queue.js
swfupload-speed           /wp-includes/js/swfupload/plugins/swfupload.speed.js
swfupload-all             /wp-includes/js/swfupload/swfupload-all.js
swfupload-handlers	/wp-includes/js/swfupload/handlers.js
comment-reply             /wp-includes/js/comment-reply.js
json2                     /wp-includes/js/json2.js
imgareaselect             /wp-includes/js/imgareaselect/jquery.imgareaselect.js
password-strength-meter	/wp-admin/js/password-strength-meter.js
user-profile              /wp-admin/js/user-profile.js
admin-bar                 /wp-includes/js/admin-bar.js
wplink                    /wp-includes/js/wplink.js
wpdialogs                 /wp-includes/js/tinymce/plugins/wpdialogs/js/wpdialog.js
wpdialogs-popup           /wp-includes/js/tinymce/plugins/wpdialogs/js/popup.js
word-count                /wp-admin/js/word-count.js
media-upload              /wp-admin/js/media-upload.js
*
*/

