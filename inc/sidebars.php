<?php
/**
 * Register widget areas (sidebars).
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_widgets_init() {
	$sidebars = array(
		array(
			'name'        => esc_html__( 'Main Sidebar', 'marbure' ),
			'id'          => 'sidebar-main',
			'description' => esc_html__( 'Appears on blog archive and single post pages.', 'marbure' ),
		),
		array(
			'name'        => esc_html__( 'Service Sidebar', 'marbure' ),
			'id'          => 'sidebar-service',
			'description' => esc_html__( 'Appears on service single pages.', 'marbure' ),
		),
		array(
			'name'        => esc_html__( 'Footer Column 1', 'marbure' ),
			'id'          => 'footer-col-1',
			'description' => esc_html__( 'Footer first column — logo, about text, social links.', 'marbure' ),
		),
		array(
			'name'        => esc_html__( 'Footer Column 2', 'marbure' ),
			'id'          => 'footer-col-2',
			'description' => esc_html__( 'Footer second column — quick links.', 'marbure' ),
		),
		array(
			'name'        => esc_html__( 'Footer Column 3', 'marbure' ),
			'id'          => 'footer-col-3',
			'description' => esc_html__( 'Footer third column — services list.', 'marbure' ),
		),
		array(
			'name'        => esc_html__( 'Footer Column 4', 'marbure' ),
			'id'          => 'footer-col-4',
			'description' => esc_html__( 'Footer fourth column — newsletter and contact info.', 'marbure' ),
		),
	);

	$defaults = array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);

	foreach ( $sidebars as $sidebar ) {
		register_sidebar( array_merge( $defaults, $sidebar ) );
	}
}
add_action( 'widgets_init', 'marbure_widgets_init' );
