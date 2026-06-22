<?php
/**
 * Kirki section: General.
 *
 * Global layout settings — container width and sidebar position.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_general',
	array(
		'title'    => esc_html__( 'General', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 10,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'radio',
		'settings'    => 'site_layout',
		'label'       => esc_html__( 'Site Layout', 'marbure' ),
		'section'     => 'marbure_section_general',
		'default'     => 'wide',
		'priority'    => 10,
		'choices'     => array(
			'wide'  => esc_html__( 'Wide', 'marbure' ),
			'boxed' => esc_html__( 'Boxed', 'marbure' ),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'slider',
		'settings'    => 'container_width',
		'label'       => esc_html__( 'Container Width', 'marbure' ),
		'description' => esc_html__( 'Max width of the page container, in pixels.', 'marbure' ),
		'section'     => 'marbure_section_general',
		'default'     => 1200,
		'priority'    => 20,
		'choices'     => array(
			'min'  => 960,
			'max'  => 1600,
			'step' => 10,
		),
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--container-width',
				'units'    => 'px',
			),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'select',
		'settings'    => 'default_sidebar_position',
		'label'       => esc_html__( 'Default Sidebar Position', 'marbure' ),
		'section'     => 'marbure_section_general',
		'default'     => 'right',
		'priority'    => 30,
		'choices'     => array(
			'left'  => esc_html__( 'Left', 'marbure' ),
			'right' => esc_html__( 'Right', 'marbure' ),
			'none'  => esc_html__( 'No Sidebar', 'marbure' ),
		),
	)
);
