<?php

function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action( 'admin_head', 'fix_svg' );

/**
 * Add SVG definitions to the footer.
 */
function include_svg_icons() {
    // Define SVG sprite file.
    $svg_icons = get_parent_theme_file_path( '/assets/_dist/images/svg-icons/sprite/sprite-symbol.svg.php' );

    // If it exists, include it.
    if ( file_exists( $svg_icons ) ) { ?>
        <div class="svg-sprite"><?php get_template_part( '/assets/_dist/images/svg-icons/sprite/sprite-symbol.svg' ); ?></div>

        <?php /*echo preg_replace("/<\\?xml.*\\?>/",'', $svg_icons,1); */?>
    <?php }
}
add_action( 'wp_head', 'include_svg_icons', 9999 );

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function get_svg( $args = array() ) {
    // Make sure $args are an array.
    if ( empty( $args ) ) {
        return __( 'Please define default parameters in the form of an array.', 'massey' );
    }

    // Define an icon.
    if ( false === array_key_exists( 'icon', $args ) ) {
        return __( 'Please define an SVG icon filename.', 'massey' );
    }

    // Set defaults.
    $defaults = array(
        'icon'        => '',
        'title'       => '',
        'desc'        => '',
        'aria_hidden' => true, // Hide from screen readers.
        'fallback'    => false,
        'class'       => '',
    );

    // Parse args.
    $args = wp_parse_args( $args, $defaults );

    // Set aria hidden.
    $aria_hidden = '';

    if ( true === $args['aria_hidden'] ) {
        $aria_hidden = ' aria-hidden="true"';
    }

    // Set ARIA.
    $aria_labelledby = '';

    if ( $args['title'] && $args['desc'] ) {
        $aria_labelledby = ' aria-labelledby="title desc"';
    }

    // Begin SVG markup.
    $svg = '<svg class="icon icon-'.esc_attr($args['icon']).' '.esc_attr($args['class']).'" '.$aria_hidden . $aria_labelledby . ' role="img">';

    // If there is a title, display it.
    if ( $args['title'] ) {
        $svg .= '<title>' . esc_html( $args['title'] ) . '</title>';
    }

    // If there is a description, display it.
    if ( $args['desc'] ) {
        $svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
    }

    $svg .= '<use xlink:href="#' . esc_html( $args['icon']) .'"></use>';

    // Add some markup to use as a fallback for browsers that do not support SVGs.
    if ( $args['fallback'] ) {
        $svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) .'"></span>';
    }

    $svg .= '</svg>';

    return $svg;
}
