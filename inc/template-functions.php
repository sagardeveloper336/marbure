<?php
/**
 * Functions which enhance the theme by hooking into WordPress.
 * Also wires all Kirki performance option toggles.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

// ── Body Classes ─────────────────────────────────────────────────────────────

function marbure_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( ! is_active_sidebar( 'sidebar-main' ) ) {
		$classes[] = 'no-sidebar';
	}

	$layout = marbure_option( 'site_layout', 'wide' );
	$classes[] = 'layout-' . sanitize_html_class( $layout );

	if ( is_singular( array( 'marbure_service', 'marbure_portfolio', 'marbure_team' ) ) ) {
		$classes[] = 'cpt-single';
	}

	return $classes;
}
add_filter( 'body_class', 'marbure_body_classes' );

// ── Pingback Header ──────────────────────────────────────────────────────────

function marbure_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'marbure_pingback_header' );

// ── CSS Custom Properties ────────────────────────────────────────────────────
// Outputs CSS vars that Kirki can't target directly (e.g. container width).

function marbure_inline_css_vars() {
	$width = (int) marbure_option( 'container_width', 1200 );
	echo '<style id="marbure-css-vars">:root{--container-width:' . $width . 'px}</style>' . "\n";
}
add_action( 'wp_head', 'marbure_inline_css_vars', 5 );

// ── Excerpt Length ───────────────────────────────────────────────────────────

function marbure_custom_excerpt_length( $length ) {
	return (int) marbure_option( 'excerpt_length', 30 );
}
add_filter( 'excerpt_length', 'marbure_custom_excerpt_length', 999 );

// ── Performance: Disable Emojis ───────────────────────────────────────────────

function marbure_disable_emojis() {
	if ( ! marbure_option( 'disable_emojis', false ) ) return;

	remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles',     'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles',  'print_emoji_styles' );
	remove_filter( 'the_content_feed',    'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss',    'wp_staticize_emoji' );
	remove_filter( 'wp_mail',             'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins',       'marbure_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints',      'marbure_disable_emojis_dns_prefetch', 10, 2 );
}
add_action( 'init', 'marbure_disable_emojis' );

function marbure_disable_emojis_tinymce( $plugins ) {
	return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
}

function marbure_disable_emojis_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

// ── Performance: Disable oEmbed ──────────────────────────────────────────────

function marbure_disable_embeds() {
	if ( ! marbure_option( 'disable_embeds', false ) ) return;

	remove_action( 'rest_api_init',  'wp_oembed_register_route' );
	add_filter(    'embed_oembed_discover', '__return_false' );
	remove_filter( 'oembed_dataparse',      'wp_filter_oembed_result', 10 );
	remove_action( 'wp_head',        'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head',        'wp_oembed_add_host_js' );
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}
add_action( 'init', 'marbure_disable_embeds' );

// ── Pagination ───────────────────────────────────────────────────────────────

function marbure_pagination( $args = array() ) {
	global $wp_query;
	$total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	if ( $total <= 1 ) return;

	$defaults = array(
		'mid_size'           => 2,
		'prev_text'          => '<i class="fas fa-arrow-left" aria-hidden="true"></i> ' . esc_html__( 'Prev', 'marbure' ),
		'next_text'          => esc_html__( 'Next', 'marbure' ) . ' <i class="fas fa-arrow-right" aria-hidden="true"></i>',
		'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'marbure' ) . ' </span>',
	);

	echo '<nav class="pagination" role="navigation" aria-label="' . esc_attr__( 'Posts pagination', 'marbure' ) . '">';
	echo paginate_links( wp_parse_args( $args, $defaults ) );
	echo '</nav>';
}

// ── Performance: Lazy-Load Images ────────────────────────────────────────────
// WordPress adds loading="lazy" natively since 5.5 for post thumbnails.
// This filter ensures it's applied to all images in the_content() too.

function marbure_add_lazy_load( $content ) {
	if ( ! marbure_option( 'lazy_load_images', true ) ) return $content;
	if ( is_admin() ) return $content;

	return preg_replace( '/<img(?![^>]*loading=)/', '<img loading="lazy"', $content );
}
add_filter( 'the_content', 'marbure_add_lazy_load' );
