<?php
/**
 * Add mime types
 *
 * @param $existing_mimes
 * @return mixed
 */
if( ! function_exists( 'theme_mime_types' ) ){
    function theme_mime_types( $existing_mimes ) {
        $existing_mimes['webp']     = 'video/webp';
        $existing_mimes['svg']      = 'image/svg+xml';
        $existing_mimes['svgz']     = 'image/svg+xml';

        return $existing_mimes;
    }
    add_filter( 'upload_mimes', 'theme_mime_types' );
}

/**
 * Remove [] from the_excerpt();
 *
 * @param $more
 * @return string
 */
if( ! function_exists( 'theme_excerpt_more' ) ) {
    function theme_excerpt_more( $more ) {
        return '...';
    }
    add_filter( 'excerpt_more', 'theme_excerpt_more' );
}

/**
 * Add special classes to pages
 *
 * @param $classes
 * @return mixed
 */
if( ! function_exists( 'theme_body_class' ) ) {
    function theme_body_class( $classes ) {
        if( is_home() ) $classes[] = 'home';

        return $classes;
    }
    add_filter( 'body_class', 'theme_body_class' );
}

/**
 * Rename default post type to Blog Posts
 *
 * @param object $labels
 * @hooked post_type_labels_post
 * @return object $labels
 */
if( ! function_exists( 'ds_blog_rename_labels' ) ) {
    function ds_blog_rename_labels($labels)
    {
        $labels->menu_name = 'Blog Posts';
        $labels->all_items = 'All Blog Posts';
        $labels->name_admin_bar = 'Blog Posts';

        return $labels;
    }

    add_filter('post_type_labels_post', 'ds_blog_rename_labels');
}

/**
 * Rename default post type labels
 *
 * @param string $title,
 * @hooked enter_title_here
 * @return string $title
 */
if( ! function_exists( 'ds_blog_new_title_text' ) ) {
    function ds_blog_new_title_text($title, $post)
    {
        if ('post' == $post->post_type) {
            $title = 'Add Headline/H1';
        }

        return $title;
    }

    add_filter('enter_title_here', 'ds_blog_new_title_text', 10, 2);
}

/**
 * Transforms absolute link to relative.
 *
 * @param $results
 * @param $query
 *
 * @return array
 */
if ( !function_exists('custom_wp_link_query') ) {
    add_filter('wp_link_query', 'custom_wp_link_query', 10, 2);
    function custom_wp_link_query($results, $query) {
        $results_filtered = $results;

        if ($results && is_array($results)) {
            $results_filtered = array();
            if (is_multisite()) {
                $site_url = network_site_url();
            } else {
                $site_url = site_url();
            }

            foreach ($results as $result) {
                if (!empty($result['permalink'])) {
                    $result['permalink'] = str_replace($site_url, '', $result['permalink']);
                }
                $results_filtered[] = $result;
            }
        }

        return $results_filtered;
    }
}

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );



/**
 * Filter WP title to ensure no blank title is present
 */
if ( !function_exists('ds_filter_wp_title') ) {
    add_filter( 'wp_title', 'ds_filter_wp_title', 10, 2 );
    function ds_filter_wp_title( $title, $separator ) {
        // Don't affect wp_title() calls in feeds.
        if ( is_feed() )
            return $title;

        // The $paged global variable contains the page number of a listing of posts.
        // The $page global variable contains the page number of a single post that is paged.
        // We'll display whichever one applies, if we're not looking at the first page.
        global $paged, $page;

        if ( is_search() ) {
            // If we're a search, let's start over:
            $title = sprintf( __( 'Search results for %s', 'dstheme' ), '"' . get_search_query() . '"' );
            // Add a page number if we're on page 2 or more:
            if ( $paged >= 2 )
                $title .= " $separator " . sprintf( __( 'Page %s', 'dstheme' ), $paged );
            // Add the site name to the end:
            $title .= " $separator " . get_bloginfo( 'name', 'display' );
            // We're done. Let's send the new title back to wp_title():
            return $title;
        }

        // Otherwise, let's start by adding the site name to the end:
        $title .= get_bloginfo( 'name', 'display' );

        // If we have a site description and we're on the home/front page, add the description:
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title .= " $separator " . $site_description;

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            $title .= " $separator " . sprintf( __( 'Page %s', 'dstheme' ), max( $paged, $page ) );

        // Return the new title to wp_title():
        return $title;
    }
}



/**
 * Extract SVG width and height from viewBox for inline SVG files
 * to avoid missing width/height notices
 */
add_filter( 'wp_get_attachment_image_src', 'ds_fix_wp_get_attachment_image_svg', 10, 4 );
function ds_fix_wp_get_attachment_image_svg($image, $attachment_id, $size, $icon) {
   if (is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1) {
       if(is_array($size)) {
           $image[1] = $size[0];
           $image[2] = $size[1];
        } else {
            $url_parts = parse_url(home_url());
            $domain = '';
            if(isset($url_parts['host'])){
                $domain = $url_parts['host'];
            }
            $context_args = array();
            if($domain == 'dsstaging1.com' || $domain == 'dsstaging2.com' || $domain == 'dsstaging3.com'){
                $context_args['http'] = array(
                    "header" => "Authorization: Basic ".base64_encode( "digital:silk" ).""
                );
            }
            $context_args['ssl'] = array(
                "verify_peer" => false,
                "allow_self_signed" => true,
                "verify_peer_name" => false,
            );

            $context = stream_context_create( $context_args );

            libxml_set_streams_context($context);

            $xml = simplexml_load_file($image[0]);

            if($xml !== false){
                $attr = $xml->attributes();
                $viewbox = explode(' ', $attr->viewBox);
                $image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
                $image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
            } else {
                $image[1] = $image[2] = null;
            }
        }
   }
   return $image;
}

/**
 * Wrap Embeds
 */
if ( ! function_exists( 'ds_add_div_on_oembed_filter' ) ) {
    add_filter( 'embed_oembed_html', 'ds_add_div_on_oembed_filter', 10, 4 ) ;
    function ds_add_div_on_oembed_filter($html, $url, $attr, $post_ID) {
        $return = '<div class="video-container ds-embed-wrap">'.$html.'</div>';
        return $return;
    }
}

/**
 * Remove unused default image sizes
 * We are removing unused image sizes to optimize storage space, availeble default sizes are:
 * thumbnail, medium, medium_large, large, 1536x1536, 2048x2048
 */
add_filter('fallback_intermediate_image_sizes', '__return_false');
add_filter('intermediate_image_sizes', function($sizes) {
    return array_diff($sizes, ['medium_large', '1536x1536', '2048x2048']);
});
