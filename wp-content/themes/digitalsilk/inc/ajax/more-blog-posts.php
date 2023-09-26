<?php

if( !function_exists('ds_more_blog_posts') ){

    add_action( 'wp_ajax_more_blog_posts', 'ds_more_blog_posts' );
    add_action( 'wp_ajax_nopriv_more_blog_posts', 'ds_more_blog_posts' );

    function ds_more_blog_posts(){

    }
}