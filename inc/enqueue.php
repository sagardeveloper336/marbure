<?php
/**
 * Enqueue scripts and styles.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_scripts() {

	// ── Fonts ─────────────────────────────────────────────────────────────────
	// Skip Google Fonts when the user opts out (GDPR compliance).

	$disable_google_fonts = (bool) marbure_option( 'disable_google_fonts', false );

	if ( ! $disable_google_fonts ) {
		wp_enqueue_style(
			'marbure-fonts',
			'https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap',
			array(),
			null
		);
	}

	// ── Font Awesome 6 (icons used in header, footer, cards) ─────────────────

	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(),
		'6.5.2'
	);

	// ── AOS — Animate on Scroll ───────────────────────────────────────────────

	wp_enqueue_style(
		'aos',
		'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
		array(),
		'2.3.4'
	);
	wp_enqueue_script(
		'aos',
		'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
		array(),
		'2.3.4',
		true
	);

	// ── Swiper 11 — hero slider + testimonials carousel ───────────────────────
	// Loaded on front page and pages that use Swiper.

	if ( is_front_page() || is_singular( 'marbure_testimonial' ) || marbure_page_uses_swiper() ) {
		wp_enqueue_style(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
			array(),
			'11.0.0'
		);
		wp_enqueue_script(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
			array(),
			'11.0.0',
			true
		);
	}

	// ── GLightbox — video lightbox on hero ────────────────────────────────────

	if ( is_front_page() ) {
		wp_enqueue_style(
			'glightbox',
			'https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/css/glightbox.min.css',
			array(),
			'3.3.0'
		);
		wp_enqueue_script(
			'glightbox',
			'https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/js/glightbox.min.js',
			array(),
			'3.3.0',
			true
		);
	}

	// ── Main Stylesheet ───────────────────────────────────────────────────────

	$style_deps = $disable_google_fonts ? array( 'font-awesome', 'aos' ) : array( 'marbure-fonts', 'font-awesome', 'aos' );

	wp_enqueue_style(
		'marbure-style',
		get_stylesheet_uri(),
		$style_deps,
		MARBURE_VERSION
	);
	wp_style_add_data( 'marbure-style', 'rtl', 'replace' );

	// ── Organized CSS files ───────────────────────────────────────────────────
	// core.css   — CSS custom properties, reset, base typography, animations, grid.
	// theme.css  — All component & layout styles (header, footer, cards, pages…).
	// responsive.css — All @media queries.

	wp_enqueue_style(
		'marbure-core',
		get_template_directory_uri() . '/css/core.css',
		array( 'marbure-style' ),
		MARBURE_VERSION
	);

	wp_enqueue_style(
		'marbure-theme',
		get_template_directory_uri() . '/css/theme.css',
		array( 'marbure-core' ),
		MARBURE_VERSION
	);

	wp_enqueue_style(
		'marbure-responsive',
		get_template_directory_uri() . '/css/responsive.css',
		array( 'marbure-theme' ),
		MARBURE_VERSION
	);

	// ── Main Script ───────────────────────────────────────────────────────────

	wp_enqueue_script(
		'marbure-main',
		get_template_directory_uri() . '/js/main.js',
		array(),
		MARBURE_VERSION,
		true
	);

	wp_localize_script(
		'marbure-main',
		'marbureParams',
		array(
			'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
			'nonce'        => wp_create_nonce( 'marbure_nonce' ),
			'stickyHeader' => (bool) marbure_option( 'sticky_header', true ),
			'backToTop'    => (bool) marbure_option( 'show_back_to_top', true ),
			'isFrontPage'  => (bool) is_front_page(),
			'i18n'         => array(
				'prevSlide' => esc_html__( 'Previous slide', 'marbure' ),
				'nextSlide' => esc_html__( 'Next slide', 'marbure' ),
			),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'marbure_scripts' );

/**
 * Check if the current page template is a home variant.
 *
 * @return bool
 */
function marbure_page_uses_swiper() {
	if ( ! is_page() ) return false;
	$tpl = get_page_template_slug();
	return in_array( $tpl, array(
		'page-templates/page-home.php',
		'page-templates/page-home-v2.php',
		'page-templates/page-home-v3.php',
	), true );
}

// ── Preconnect hints for Google Fonts ────────────────────────────────────────

function marbure_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type && ! (bool) marbure_option( 'disable_google_fonts', false ) ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => true );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'marbure_resource_hints', 10, 2 );

// ── Customizer preview script ─────────────────────────────────────────────────
// Note: marbure_customize_preview_js() is defined in inc/customizer.php and
// registered there. This file intentionally does not re-add the action.
