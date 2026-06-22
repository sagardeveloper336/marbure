<?php
/**
 * Theme helper / utility functions.
 * Note: marbure_option() is defined in inc/kirki/helpers.php.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cached wrapper around marbure_option() — avoids repeated get_option() calls
 * for the same key within a single request.
 *
 * @param string $key     Option key.
 * @param mixed  $default Fallback value.
 * @return mixed
 */
function marbure_get_option( $key, $default = '' ) {
	static $cache = array();
	if ( ! array_key_exists( $key, $cache ) ) {
		$cache[ $key ] = marbure_option( $key, $default );
	}
	return $cache[ $key ];
}

/**
 * Build the CSS class string for the <header> element.
 *
 * @return string Space-separated class names.
 */
function marbure_header_classes() {
	$classes = array( 'site-header' );

	if ( marbure_option( 'sticky_header', true ) ) {
		$classes[] = 'is-sticky';
	}
	if ( marbure_option( 'show_top_bar', true ) ) {
		$classes[] = 'has-topbar';
	}

	$variant = marbure_option( 'header_variant', 'default' );
	$classes[] = 'header-' . sanitize_html_class( $variant );

	return implode( ' ', array_map( 'esc_attr', $classes ) );
}

/**
 * Return the page header background image URL.
 * Prefers the current page's featured image; falls back to the Kirki option.
 *
 * @return string Image URL or empty string.
 */
function marbure_page_header_bg() {
	if ( ! is_archive() && ! is_home() && has_post_thumbnail() ) {
		return get_the_post_thumbnail_url( null, 'marbure-hero' );
	}
	return marbure_option( 'page_header_bg_image', '' );
}

/**
 * Render a single social icon link.
 *
 * @param string $network  Network slug: facebook, twitter, instagram, linkedin, youtube.
 * @param string $url      Profile URL.
 * @param bool   $echo     Whether to echo or return.
 * @return string
 */
function marbure_social_link( $network, $url, $echo = true ) {
	if ( empty( $url ) ) {
		return '';
	}

	$icons = array(
		'facebook'  => 'fab fa-facebook-f',
		'twitter'   => 'fab fa-x-twitter',
		'instagram' => 'fab fa-instagram',
		'linkedin'  => 'fab fa-linkedin-in',
		'youtube'   => 'fab fa-youtube',
	);

	$icon = isset( $icons[ $network ] ) ? $icons[ $network ] : 'fas fa-link';

	$html = sprintf(
		'<a href="%1$s" class="social-link social-link--%2$s" target="_blank" rel="noopener noreferrer" aria-label="%3$s"><i class="%4$s" aria-hidden="true"></i></a>',
		esc_url( $url ),
		esc_attr( $network ),
		esc_attr( ucfirst( $network ) ),
		esc_attr( $icon )
	);

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	return $html;
}

/**
 * Render all configured social links as a group.
 *
 * @param bool $echo Whether to echo or return.
 * @return string
 */
function marbure_social_links( $echo = true ) {
	$networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
	$html     = '<div class="social-links">';

	foreach ( $networks as $network ) {
		$url   = marbure_option( 'social_' . $network, '' );
		$html .= marbure_social_link( $network, $url, false );
	}

	$html .= '</div>';

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	return $html;
}

/**
 * Return the number of columns class for a CPT archive grid.
 *
 * @param string $type   CPT type key: service, portfolio, team.
 * @param int    $default Default column count.
 * @return string CSS class, e.g. 'col-md-4' for 3 columns.
 */
function marbure_grid_col_class( $type, $default = 3 ) {
	$col_map = array(
		'2' => 'col-md-6',
		'3' => 'col-md-4',
		'4' => 'col-md-3',
	);
	$cols = marbure_option( $type . '_columns', (string) $default );
	return isset( $col_map[ $cols ] ) ? $col_map[ $cols ] : 'col-md-4';
}

/**
 * Render star rating HTML.
 *
 * @param int $rating Integer 1–5.
 * @return string
 */
function marbure_star_rating( $rating ) {
	$rating = max( 1, min( 5, (int) $rating ) );
	$html   = '<span class="star-rating" aria-label="' . esc_attr( sprintf( __( '%d out of 5 stars', 'marbure' ), $rating ) ) . '">';

	for ( $i = 1; $i <= 5; $i++ ) {
		$class  = $i <= $rating ? 'fas fa-star' : 'far fa-star';
		$html  .= '<i class="' . esc_attr( $class ) . '" aria-hidden="true"></i>';
	}

	$html .= '</span>';
	return $html;
}
