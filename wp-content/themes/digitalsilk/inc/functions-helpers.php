<?php
/**
 * Display post excerpt with custom characters amount
 *
 * @returns string
 */
if( ! function_exists( 'ds_the_excerpt' ) ) {
    function ds_the_excerpt( $length = 90, $post_id = NULL ){
        if( !$post_id ) $post_id = get_the_ID();
        if( !$post_id ) return false;

        $page_object = get_post( $post_id );
        echo substr( strip_tags( $page_object->post_content ),0,$length ) . '...';
    }
}

/**
 * Pagination for archive.php templates
 *
 * @returns string
 */
if( ! function_exists( 'ds_pagination' ) ) {
    function ds_pagination(){
        if (is_singular())
            return;

        global $wp_query;

        /** Stop execution if there's only 1 page */
        if ($wp_query->max_num_pages <= 1)
            return;

        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $max = intval($wp_query->max_num_pages);

        /** Add current page to the array */
        if ($paged >= 1)
            $links[] = $paged;

        /** Add the pages around the current page to the array */
        if ($paged >= 3) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if (($paged + 2) <= $max) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<div class="navigation"><ul>' . "\n";

        /** Previous Post Link */
        if (get_previous_posts_link())
            printf('<li class="prev">%s</li>' . "\n", get_previous_posts_link());

        /** Link to first page, plus ellipses if necessary */
        if (!in_array(1, $links)) {
            $class = 1 == $paged ? ' class="active"' : '';

            printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

            if (!in_array(2, $links))
                echo '<li>…</li>';
        }

        /** Link to current page, plus 2 pages in either direction if necessary */
        sort($links);
        foreach ((array)$links as $link) {
            $class = $paged == $link ? ' class="active"' : '';
            printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
        }

        /** Link to last page, plus ellipses if necessary */
        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links))
                echo '<li>…</li>' . "\n";

            $class = $paged == $max ? ' class="active"' : '';
            printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
        }

        /** Next Post Link */
        if (get_next_posts_link())
            printf('<li class="next">%s</li>' . "\n", get_next_posts_link());

        echo '</ul></div>' . "\n";

    }
}

/**
 * Simple functions to display ACF field type "link"
 *
 * @param $button "acf link field - array"
 * @param $args "attributes array"
 * @param $icon "icon tag"
 * @returns string
 */
if ( ! function_exists( 'acf_button' ) ) {
    function acf_button($button, $args = [], $icon = ''){
        if( !isset($button['title']) && !isset($button['url']) ) return;

        $attrs = '';
        foreach ($args as $attr => $value) {
            $attrs .= $attr . '="' . $value . '"';
        }
        $target = !empty($button['target']) ? 'target="' . $button['target'] . '"' : false;
        return sprintf('<a href="%2$s" %3$s %4$s>%1$s %5$s</a>', $button['title'], $button['url'], $target, $attrs, $icon);
    }
}

/**
 * Drupal Library to display cropped images images
 *
 * @param $options
 * @returns string
 */
if ( ! function_exists( 'ds_image' ) ) {
    function ds_image( $options ) {
        // Set up global image variables
        $width             = ( $options['width'] ? $options['width'] : 800 );
        $height            = ( $options['height'] ? $options['height'] : 500 );
        $class             = ( ! empty( $options['class'] ) ? $options['class'] : '' );
        $altText           = strip_tags( ( $options['alt'] ? $options['alt'] : get_bloginfo( 'name' ) ) );
        $placeholder_image = get_field( 'placeholder_image', 'options' );

        // Set up image
        if ( ! $options['image'] && $placeholder_image ) {
            // if no image specified, output placeholder from options page
            $image = $placeholder_image;

        } else if ( ! $options['image'] && ! $placeholder_image ) {
            // if no image specified, and no placeholder in options page
            $image = get_template_directory_uri() . '/img/placeholder.jpg';

        } else {
            // otherwise specified crop the image and output it
            $imageArray = matthewruddy_image_resize( $options['image'], $width, $height, false, false );
            $image      = $imageArray['url'];
        }
        ?>
        <figure class="img<?php echo $class ? ' ' . $class : ''; ?>"
                style="background-image:url(<?php echo $image; ?>);">
            <img width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="<?php echo $image; ?>"
                 alt="<?php echo $altText; ?>"/>
        </figure>
        <?php
    }
}


/**
 * Helper function to output logs to debug.log
 * 
 * WP_DEBUG should be enabled, recommended configuration in wp-config.php:
 * define( 'WP_DEBUG', true );
 * define( 'WP_DEBUG_LOG', true );
 * define( 'WP_DEBUG_DISPLAY', false );
 */

if (!function_exists('ds_write_log')) {
    function ds_write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                if(is_bool($log)){
                    error_log($log ? 'true' : 'false');
                }else{
                    error_log($log);
                }
            }
        }
    }
}

/**
 *  Helper function to generate image based on attachment ID
 * @var int $image_id attachment id
 * @var string $size desired image size (register new if needed)
 * @var string $fallback_size placeholder fallback if $image_id is null, empty, false. example '300x300'
 * @var bool $html_output output <img> (true) or just the image URL (false), use false for background images
 * @var bool $lazy should the image be lazy loaded
 * @var string $css_class add class or multiple classes to <img>, class1 class2 class3
 * 
 */
if ( ! function_exists( 'ds_generate_image' ) ) {
    function ds_generate_image($image_id, $size = 'full', $fallback_size = '', $html_output = true, $lazy = true, $css_class = ''){

        $html = '';
        $image_src = '';
        $alt = '';
        $img_size = 'full';
        $img_src = '';
        $lazy_attr = '';
        $srcset_attr = '';
        $srcset = '';
        $class_attr = '';
        $css_classes = array();

        if($size){
            $img_size = $size;
        }

        if($image_id){
            // Get image source
            $srcset = wp_get_attachment_image_srcset($image_id, $size );
            $image_src_a = wp_get_attachment_image_src( $image_id, $size );
           
            if($image_src_a){
                $image_src = $image_src_a[0];
                $img_width = $image_src_a[1];
                $img_height = $image_src_a[2];
            }
            // Get image alt
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
            if($image_alt !==''){
                $alt = $image_alt;
            }else{
                $alt = get_the_title($image_id);
            }

            if($srcset){
                $srcset_attr = 'srcset="'.$srcset.'"';

                if($lazy){
                    $srcset_attr = 'data-srcset="'.$srcset.'"';
                }
            }
        }
        if($css_class){
            $css_classes[] = $css_class;
        }

        if($image_src !=='' || $fallback_size !==''){

            if($image_src){
                $img_src = $image_src;
                $src_attr = 'src="'.$img_src.'"';
            }

            if($lazy){
                $lazy_attr = 'loading="lazy"';
                $css_classes[] = 'lazy';
                if($img_src){
                    $src_attr = 'data-src="'.$img_src.'"';
                }
            }

            if(!empty($css_classes)){
                $class_attr = 'class="'.implode(' ', $css_classes ).'"';
            }

            if($image_src){
                $html .= '<img '.$class_attr.' '.$lazy_attr.' '.$src_attr.' '.$srcset_attr.' alt="'.$alt.'" width="'.$img_width.'" height="'.$img_height.'"/>';

            }else if($fallback_size){
                $placeholder_image = get_field('placeholder_image', 'options');
                $img_width = '';
                $img_height = '';
                $fallback_size_attr =  explode('x', $fallback_size);
                $available_sizes = ds_get_image_sizes();
                
                if(in_array($fallback_size_attr, $available_sizes) && $placeholder_image){
                    $image_src_placeholder_a = wp_get_attachment_image_src( $placeholder_image, $size );

                    if($image_src_placeholder_a){
                        $img_src = $image_src_placeholder_a[0];
                        $img_width = $image_src_placeholder_a[1];
                        $img_height = $image_src_placeholder_a[2];
                    }
                }else{
                    if (filter_var($fallback_size, FILTER_VALIDATE_URL) === FALSE) {
                        $wh_attr = explode('x', $fallback_size);
                        if($wh_attr){
                            $img_width = $wh_attr[0];
                            $img_height = $wh_attr[1];
                        }
                        $img_src = 'https://via.placeholder.com/'.$fallback_size.'';
                    }else{
                        $img_src = $fallback_size;  
                    }
                }
                
                $html .= '<img '.$class_attr.' src="'.$img_src.'" alt="placeholder" width="'.$img_width.'" height="'.$img_height.'" />';
            }
        }

        if($html_output){
            return $html;
        }else{
            return $img_src;
        }
    }
}

/**
 * Helper function to convert pipe | to break
 * Example Line 1|Line 2
 */
if ( ! function_exists( 'lineToBreak' ) ) {
    function lineToBreak($title){
        $title1 = str_replace('|', "<br>", $title);
        return $title1;
    }
}


/**
 * Helprer function to wrap string encapsulated into pipes to span
 * Example: hello i'm a |span|
 */
if ( ! function_exists( 'lineToSpan' ) ) {
    function lineToSpan($title){
        $title1 = preg_replace("/\|(.+?)\|/", "<span>$1</span>", $title);
        return $title1;
    }
}


/**
 * Helper function to generate cta based on ACF CTA Group
 * @var string $cta_class The class of your CTA
 * @var array $cta Array containing the CTA, such as cta_label, cta_link, cta_image
 * @var bool $container Should your CTA be encapsulated in a wrapper div
 */
if ( ! function_exists( 'ds_generate_cta' ) ) {
    function ds_generate_cta($cta_class = 'cta-primary', $cta = array(), $container = false){
        $html = '';
        if(!empty($cta)){
            if($container){
                $html .= '<div class="cta-wrap">';
            }
            $cta_label = '';
            $cta_link = array();
            $cta_icon = '';
            if(isset($cta['cta_icon'])){
                $cta_icon = $cta['cta_icon'];
            }
            if(isset($cta['cta_label'])){
                $cta_label = $cta['cta_label'];
            }
            if(isset($cta['cta_link'])){
                $cta_link = $cta['cta_link'];
            }

            $title = '';
            $url = '#';
            $target = '';
            $cta_attributes = array();

            if(!empty($cta_link)){
                if(isset($cta_link['title'])){
                    $title = $cta_link['title'];
                }
                if(isset($cta_link['url'])){
                    $url = $cta_link['url'];
                }
                if(isset($cta_link['target'])){
                    $target = $cta_link['target'];
                }
            }

            if($url){
                $cta_attributes[] = 'href="'.$url.'"';
            }
            if($title){
                $cta_attributes[] = 'title="'.$title.'"';
            }
            if($target){
                $cta_attributes[] = 'target="'.$target.'"';
            }
            
            if($cta_label){
                $html .= '<a class="'.trim($cta_class).'" '.implode(' ', $cta_attributes).'>';

                if($cta_icon){
                    $html .= get_svg(array( 'icon'  => $cta_icon, 'class' => 'cta-icon'));
                }

                $html .= '<span>'.$cta_label.'</span>';

                $html .= '</a>';
            }

            if($container){
                $html .= '</div>';
            }
        }

        return $html;
    }
}



/**
 * Get information about available image sizes
 */
function ds_get_image_sizes( $size = '' ) {
    $wp_additional_image_sizes = wp_get_additional_image_sizes();
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
            $size_array = array(
                get_option( $_size . '_size_w' ),
                get_option( $_size . '_size_h' ),
            );
            $sizes[] = $size_array;
        } elseif ( isset( $wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[] = array( 
                $wp_additional_image_sizes[ $_size ]['width'],
                $wp_additional_image_sizes[ $_size ]['height'],
            );
        }
    }
 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
