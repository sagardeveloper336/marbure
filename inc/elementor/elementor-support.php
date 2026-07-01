<?php
/**
 * Elementor integration.
 *
 * Hooks are registered directly (not inside elementor/loaded) because
 * elementor/loaded fires during plugins_loaded — before functions.php runs.
 * The category and widget hooks fire lazily when Elementor's managers
 * initialise, which is always after the theme has loaded.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

// ── Theme locations (Elementor Pro Theme Builder) ─────────────────────────────

add_action( 'elementor/theme/register_locations', function ( $mgr ) {
	$mgr->register_location( 'header' );
	$mgr->register_location( 'footer' );
	$mgr->register_location( 'single' );
	$mgr->register_location( 'archive' );
} );

// ── Widget category ───────────────────────────────────────────────────────────

add_action( 'elementor/elements/categories_registered', function ( $mgr ) {
	$mgr->add_category(
		'marbure',
		array(
			'title' => esc_html__( 'Marbure', 'marbure' ),
			'icon'  => 'fa fa-plug',
		)
	);
} );

// ── Vendor scripts & styles ───────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', function () {
	// Swiper — local copy so it works without internet (WAMP / offline).
	if ( ! wp_style_is( 'swiper', 'registered' ) ) {
		wp_register_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '11.0.0' );
	}
	if ( ! wp_script_is( 'swiper', 'registered' ) ) {
		wp_register_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), '11.0.0', true );
	}

	// GLightbox (Gallery Grid)
	if ( ! wp_style_is( 'glightbox', 'registered' ) ) {
		wp_register_style( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3/dist/css/glightbox.min.css', array(), '3.3.0' );
	}
	if ( ! wp_script_is( 'glightbox', 'registered' ) ) {
		wp_register_script( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3/dist/js/glightbox.min.js', array(), '3.3.0', true );
	}
}, 5 );

// ── Custom controls ───────────────────────────────────────────────────────────

add_action( 'elementor/controls/register', function ( $mgr ) {
	require_once get_template_directory() . '/inc/elementor/controls/control-image-select.php';
	$mgr->register( new Marbure_Control_Image_Select() );
} );

// ── Load and register all 10 widgets ─────────────────────────────────────────

add_action( 'elementor/widgets/register', function ( $mgr ) {
	$dir = get_template_directory() . '/inc/elementor/widgets/';

	$map = array(
		'widget-hero-slider'          => 'Marbure_Widget_Hero_Slider',
		'widget-stat-counter'         => 'Marbure_Widget_Stat_Counter',
		'widget-team-card'            => 'Marbure_Widget_Team_Card',
		'widget-testimonial-carousel' => 'Marbure_Widget_Testimonial_Carousel',
		'widget-cta-band'             => 'Marbure_Widget_Cta_Band',
		'widget-marquee-strip'        => 'Marbure_Widget_Marquee_Strip',
		'widget-gallery-grid'         => 'Marbure_Widget_Gallery_Grid',
	);

	foreach ( $map as $file => $class ) {
		$path = $dir . $file . '.php';
		if ( file_exists( $path ) ) {
			require_once $path;
		}
		if ( class_exists( $class ) ) {
			$mgr->register( new $class() );
		}
	}
} );
