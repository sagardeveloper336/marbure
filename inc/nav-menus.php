<?php
/**
 * Register navigation menu locations.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_register_nav_menus() {
	register_nav_menus(
		array(
			'primary'         => esc_html__( 'Primary Menu', 'marbure' ),
			'mobile'          => esc_html__( 'Mobile Menu', 'marbure' ),
			'footer-links'    => esc_html__( 'Footer Links', 'marbure' ),
			'footer-services' => esc_html__( 'Footer Services', 'marbure' ),
		)
	);
}
add_action( 'after_setup_theme', 'marbure_register_nav_menus' );
