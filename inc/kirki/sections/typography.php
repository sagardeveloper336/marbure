<?php
/**
 * Kirki section: Typography.
 *
 * Body and heading font controls (Kirki's typography field gives a
 * full Google Fonts picker + weight/size/line-height in one control).
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_typography',
	array(
		'title'    => esc_html__( 'Typography', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 40,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'typography',
		'settings' => 'body_typography',
		'label'    => esc_html__( 'Body Font', 'marbure' ),
		'section'  => 'marbure_section_typography',
		'default'  => array(
			'font-family'    => 'inherit',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'line-height'    => '1.6',
			'letter-spacing' => 'normal',
			'color'          => '',
		),
		'priority' => 10,
		'output'   => array(
			array(
				'element' => 'body',
			),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'typography',
		'settings' => 'heading_typography',
		'label'    => esc_html__( 'Heading Font', 'marbure' ),
		'section'  => 'marbure_section_typography',
		'default'  => array(
			'font-family'    => 'inherit',
			'variant'        => '700',
			'font-size'      => '32px',
			'line-height'    => '1.3',
			'letter-spacing' => 'normal',
			'color'          => '',
		),
		'priority' => 20,
		'output'   => array(
			array(
				'element' => 'h1, h2, h3, h4, h5, h6',
			),
		),
	)
);
