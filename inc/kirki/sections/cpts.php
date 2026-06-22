<?php
/**
 * Kirki section: CPT Settings.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_cpts',
	array(
		'title'    => esc_html__( 'CPT Settings', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 90,
	)
);

// ── Practice Areas ─────────────────────────────────────────────────────────
Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'service_columns',
		'label'    => esc_html__( 'Service Archive Columns', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => '3',
		'priority' => 10,
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'switch',
		'settings' => 'service_show_excerpt',
		'label'    => esc_html__( 'Show Excerpt on Service Cards', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => true,
		'priority' => 20,
	)
);

// ── Case Results ───────────────────────────────────────────────────────────
Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'portfolio_columns',
		'label'    => esc_html__( 'Portfolio Archive Columns', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => '3',
		'priority' => 30,
		'choices'  => array(
			'2' => '2',
			'3' => '3',
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'switch',
		'settings' => 'portfolio_filter',
		'label'    => esc_html__( 'Enable Portfolio Filter Tabs', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => true,
		'priority' => 40,
	)
);

// ── Team ────────────────────────────────────────────────────────────────────
Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'team_columns',
		'label'    => esc_html__( 'Team Archive Columns', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => '3',
		'priority' => 50,
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'switch',
		'settings' => 'team_show_socials',
		'label'    => esc_html__( 'Show Social Links on Team Cards', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => true,
		'priority' => 60,
	)
);
