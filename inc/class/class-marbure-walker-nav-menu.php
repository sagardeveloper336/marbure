<?php
/**
 * Custom nav menu walker — adds mega menu support and BEM class names.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Open a list item <li>.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item   = $data_object;
		$indent = str_repeat( "\t", $depth );

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'nav-menu__item';

		if ( in_array( 'menu-item-has-children', $classes, true ) ) {
			$classes[] = ( 0 === $depth ) ? 'nav-menu__item--has-mega' : 'nav-menu__item--has-sub';
		}

		if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-parent', $classes, true ) ) {
			$classes[] = 'nav-menu__item--active';
		}

		$class_names = implode( ' ', array_filter( array_map( 'sanitize_html_class', $classes ) ) );

		$output .= $indent . '<li class="' . esc_attr( $class_names ) . '">';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';
		$atts['class']  = 'nav-menu__link';

		if ( in_array( 'menu-item-has-children', $classes, true ) && 0 === $depth ) {
			$atts['aria-expanded'] = 'false';
			$atts['aria-haspopup'] = 'true';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attr_str = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$attr_str .= ' ' . esc_attr( $attr ) . '="' . esc_attr( $value ) . '"';
			}
		}

		$item_output  = isset( $args->before ) ? $args->before : '';
		$item_output .= '<a' . $attr_str . '>';
		$item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . apply_filters( 'the_title', $item->title, $item->ID ) . ( isset( $args->link_after ) ? $args->link_after : '' );

		// Dropdown chevron for top-level items with children.
		if ( in_array( 'menu-item-has-children', $classes, true ) && 0 === $depth ) {
			$item_output .= ' <i class="fa-solid fa-chevron-down nav-menu__chevron" aria-hidden="true"></i>';
		}

		$item_output .= '</a>';
		$item_output .= isset( $args->after ) ? $args->after : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Open the sub-menu <ul>.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth + 1 );
		$class   = ( 0 === $depth ) ? 'nav-menu__mega' : 'nav-menu__dropdown';
		$output .= "\n$indent<ul class=\"$class\">\n";
	}

	/**
	 * Close the sub-menu <ul>.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth + 1 );
		$output .= "$indent</ul>\n";
	}
}
