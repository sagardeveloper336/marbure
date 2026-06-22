<?php
/**
 * Elementor integration.
 *
 * Fires on the `elementor/loaded` action so nothing breaks when Elementor is
 * absent. Sets up: theme locations (Pro), Marbure widget category, vendor
 * script registration, and all 9 custom widget registrations.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

add_action( 'elementor/loaded', 'marbure_elementor_setup' );

function marbure_elementor_setup() {

	// ── Theme locations (Elementor Pro Theme Builder) ─────────────────────────

	add_action( 'elementor/theme/register_locations', function ( $mgr ) {
		$mgr->register_location( 'header' );
		$mgr->register_location( 'footer' );
		$mgr->register_location( 'single' );
		$mgr->register_location( 'archive' );
	} );

	// ── Widget category ───────────────────────────────────────────────────────

	add_action( 'elementor/elements/categories_registered', function ( $mgr ) {
		$mgr->add_category(
			'marbure',
			array(
				'title' => esc_html__( 'Marbure', 'marbure' ),
				'icon'  => 'fa fa-plug',
			)
		);
	} );

	// ── Vendor scripts & styles (register so widgets can declare dependencies) ─

	add_action( 'wp_enqueue_scripts', function () {
		if ( ! wp_style_is( 'swiper', 'registered' ) ) {
			wp_register_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
		}
		if ( ! wp_script_is( 'swiper', 'registered' ) ) {
			wp_register_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );
		}
	}, 5 );

	// ── Load and register all 9 widgets ───────────────────────────────────────

	add_action( 'elementor/widgets/register', function ( $mgr ) {
		$dir = get_template_directory() . '/inc/elementor/widgets/';

		$map = array(
			'widget-hero-slider'          => 'Marbure_Widget_Hero_Slider',
			'widget-service-card'         => 'Marbure_Widget_Service_Card',
			'widget-stat-counter'         => 'Marbure_Widget_Stat_Counter',
			'widget-team-card'            => 'Marbure_Widget_Team_Card',
			'widget-testimonial-carousel' => 'Marbure_Widget_Testimonial_Carousel',
			'widget-case-card'            => 'Marbure_Widget_Case_Card',
			'widget-faq-accordion'        => 'Marbure_Widget_Faq_Accordion',
			'widget-cta-band'             => 'Marbure_Widget_Cta_Band',
			'widget-marquee-strip'        => 'Marbure_Widget_Marquee_Strip',
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
}
