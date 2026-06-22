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

// ── Products ───────────────────────────────────────────────────────────────
Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'product_columns',
		'label'    => esc_html__( 'Product Archive Columns', 'marbure' ),
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
		'settings' => 'product_show_excerpt',
		'label'    => esc_html__( 'Show Excerpt on Product Cards', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => true,
		'priority' => 20,
	)
);

// ── Projects ───────────────────────────────────────────────────────────────
Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'radio-buttonset',
		'settings' => 'project_columns',
		'label'    => esc_html__( 'Project Archive Columns', 'marbure' ),
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
		'settings' => 'project_filter',
		'label'    => esc_html__( 'Enable Project Filter Tabs', 'marbure' ),
		'section'  => 'marbure_section_cpts',
		'default'  => true,
		'priority' => 40,
	)
);
