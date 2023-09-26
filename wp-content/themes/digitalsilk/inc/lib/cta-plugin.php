<?php
/**
 * Add button into Wysiwyg to generate CTA HTML
 *
 * @since custom 1.1
 */

if ( ! class_exists( 'DS_WysiwygCTA' ) ) {

    class DS_WysiwygCTA
    {
        public function __construct()
        {
            add_action('admin_head', array( __CLASS__, 'wdm_add_mce_button' ) );
        }

        public static function wdm_add_mce_button()
        {
            // check user permissions
            if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
                return;
            }
            // check if WYSIWYG is enabled
            if ( 'true' == get_user_option( 'rich_editing' ) ) {
                add_filter( 'mce_external_plugins', array( __CLASS__, 'wdm_add_tinymce_plugin' ) );
                add_filter( 'mce_buttons', array( __CLASS__, 'wdm_register_mce_button' ) );
            }
        }

        // register new button in the editor
        public static function wdm_register_mce_button( $buttons )
        {
            array_push( $buttons, 'wdm_mce_button' );
            return $buttons;
        }

        // declare a script for the new button
        // the script will insert the shortcode on the click event
        public static function wdm_add_tinymce_plugin( $plugin_array )
        {
            $plugin_array['wdm_mce_button'] = get_stylesheet_directory_uri() .'/admin/js/wysiwyg-cta-button.js';
            return $plugin_array;
        }

    }

    new DS_WysiwygCTA();
}

