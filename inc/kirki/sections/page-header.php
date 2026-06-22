<?php
/**
 * Kirki section: Page Header (breadcrumb band).
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_page_header',
	array(
		'title'    => esc_html__( 'Page Header', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 80,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'switch',
		'settings'    => 'show_page_header',
		'label'       => esc_html__( 'Show Page Header', 'marbure' ),
		'description' => esc_html__( 'Display the page title and breadcrumb bar on all inner pages.', 'marbure' ),
		'section'     => 'marbure_section_page_header',
		'default'     => true,
		'priority'    => 10,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'image',
		'settings' => 'page_header_bg_image',
		'label'    => esc_html__( 'Default Background Image', 'marbure' ),
		'section'  => 'marbure_section_page_header',
		'default'  => '',
		'priority' => 20,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'color',
		'settings' => 'page_header_overlay_color',
		'label'    => esc_html__( 'Overlay Color', 'marbure' ),
		'section'  => 'marbure_section_page_header',
		'default'  => 'rgba(10,30,63,0.75)',
		'priority' => 30,
		'choices'  => array( 'alpha' => true ),
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--page-header-overlay',
			),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'slider',
		'settings' => 'page_header_min_height',
		'label'    => esc_html__( 'Minimum Height (px)', 'marbure' ),
		'section'  => 'marbure_section_page_header',
		'default'  => 300,
		'priority' => 40,
		'choices'  => array( 'min' => 150, 'max' => 600, 'step' => 10 ),
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--page-header-min-height',
				'units'    => 'px',
			),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'select',
		'settings' => 'page_header_align',
		'label'    => esc_html__( 'Title Alignment', 'marbure' ),
		'section'  => 'marbure_section_page_header',
		'default'  => 'left',
		'priority' => 50,
		'choices'  => array(
			'left'   => esc_html__( 'Left', 'marbure' ),
			'center' => esc_html__( 'Center', 'marbure' ),
		),
	)
);
