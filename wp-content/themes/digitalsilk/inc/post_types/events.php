<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'DS_PostTypes_Events' ) ) {

    class DS_PostTypes_Events {

        function __construct(){
            add_action( 'init', array( __CLASS__, 'register_post_types' ) );
            add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );

            if ( class_exists('acf') && is_admin() ) {
                add_filter( 'manage_events_posts_columns', array(__CLASS__, 'event_admin_columns') );
                add_action( 'manage_events_posts_custom_column' , array(__CLASS__, 'event_admin_columns_data'), 10, 2 );
            }
        }

        public static function register_post_types() {
            if ( !is_blog_installed() ) return;

            if ( !post_type_exists( 'events' ) ) {
                register_post_type(
                    'events',
                    array(
                        'labels'       => array(
                            'name'                  => __( 'Events', 'dstheme' ),
                            'singular_name'         => _x( 'Event', 'Site post type singular name', 'dstheme' ),
                            'add_new'               => __( 'Add Event', 'dstheme' ),
                            'add_new_item'          => __( 'Add New Event', 'dstheme' ),
                            'edit'                  => __( 'Edit', 'dstheme' ),
                            'edit_item'             => __( 'Edit Event', 'dstheme' ),
                            'new_item'              => __( 'New Event', 'dstheme' ),
                            'view'                  => __( 'View Events', 'dstheme' ),
                            'view_item'             => __( 'View Events', 'dstheme' ),
                            'search_items'          => __( 'Search Events', 'dstheme' ),
                            'not_found'             => __( 'No Events found', 'dstheme' ),
                            'not_found_in_trash'    => __( 'No Events found in trash', 'dstheme' ),
                            'parent'                => __( 'Parent Events', 'dstheme' ),
                            'menu_name'             => _x( 'Events', 'Admin menu name', 'dstheme' ),
                            'filter_items_list'     => __( 'Filter Events', 'dstheme' ),
                            'items_list_navigation' => __( 'Events navigation', 'dstheme' ),
                            'items_list'            => __( 'Events list', 'dstheme' ),
                        ),
                        'menu_position'         => 4,
                        'menu_icon'             => 'dashicons-calendar',
                        'public'                => true,
//                        'exclude_from_search'   => true,
//                        'publicly_queryable'    => false,
//                        'show_in_nav_menus'     => false,
//                        'show_in_rest'          => false,
//                        'has_archive'           => false,
                        'supports'              => array( 'title', 'author' ),
                        'rewrite'       => array(
	                        'slug'       => 'events',
	                        'with_front' => false
                        )
                    )
                );
            }
        }

        public static function event_admin_columns($columns) {
            unset( $columns['author'] );
            unset( $columns['date'] );

            $columns['event_date']  = __( 'Event Date', 'dstheme' );
            $columns['author']      = __( 'Event Author', 'dstheme' );
            $columns['date']        = __( 'Publish Date', 'dstheme' );

            return $columns;
        }

        public static function event_admin_columns_data( $column, $post_id ) {
            switch ( $column ) {
                case 'event_date' :
                    $date = date( 'd M, Y', strtotime(get_field( 'event_date', $post_id )) );
                    echo '<strong>'.$date.'</strong>';
                    break;
            }
        }

        public static function register_taxonomies() {
            if ( !is_blog_installed() ) return;

            register_taxonomy(
                'events_category',
                array( 'events' ),
                array(
                    'label'              => 'Categories',
                    'hierarchical'       => true,
                )
            );

        }

    }

    new DS_PostTypes_Events();

}