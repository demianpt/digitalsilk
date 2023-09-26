<?php

/**
 * Add additional data to menu items
 * $caption
 * $image aka icon
 * $hash to the url
 */
if ( ! function_exists( 'ds_add_extra_items_to_menu' ) ) {
	function ds_add_extra_items_to_menu( $items, $args ) {
		foreach ( $items as &$item ) {
			if ( $anchor = get_field( 'anchor', $item ) ) {
				$item->url .= '#'.$anchor;
			}

			if ( $caption = get_field( 'caption', $item ) ) {
				$item->title = '<span class="menu-item-title">' . $item->title . '</span><span class="menu-item-caption">' . $caption . '</span>';
			}

			if ( $image = get_field( 'icon', $item ) ) {
				$item->title = '<div class="menu-item-img-wrapper"><img data-src="' . $image . '" class="menu-item-image"></div><div class="menu-item-content">' . $item->title . '</div>';
			}
		}

		return $items;
	}

	add_filter( 'wp_nav_menu_objects', 'ds_add_extra_items_to_menu', 10, 2 );
}

/**
 * Adjust the <a> tag to be span in case the link is set as #
 */
if ( ! function_exists( 'ds_change_a_tag_to_span' ) ) {
	function ds_change_a_tag_to_span( $item_output, $item, $depth, $args ) {
		if ( $item->url === '#' ) {
			return "<div class='plain-menu-item'>{$item->post_title}</div>";
		}

		return $item_output;
	}

	add_filter( 'walker_nav_menu_start_el', 'ds_change_a_tag_to_span', 10, 4 );
}