<?php
/**
 * Kirki section: Header.
 *
 * Sticky header behaviour and an optional top bar above the main header.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_header',
	array(
		'title'    => esc_html__( 'Header', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 20,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'switch',
		'settings'    => 'sticky_header',
		'label'       => esc_html__( 'Sticky Header', 'marbure' ),
		'description' => esc_html__( 'Keep the header fixed to the top of the viewport on scroll.', 'marbure' ),
		'section'     => 'marbure_section_header',
		'default'     => false,
		'priority'    => 10,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'switch',
		'settings'    => 'show_top_bar',
		'label'       => esc_html__( 'Show Top Bar', 'marbure' ),
		'description' => esc_html__( 'Display a slim bar above the main header (contact info, social links).', 'marbure' ),
		'section'     => 'marbure_section_header',
		'default'     => false,
		'priority'    => 20,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'color',
		'settings' => 'header_background_color',
		'label'    => esc_html__( 'Header Background Color', 'marbure' ),
		'section'  => 'marbure_section_header',
		'default'  => '#ffffff',
		'priority' => 30,
		'choices'  => array( 'alpha' => true ),
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--header-bg',
			),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'select',
		'settings' => 'header_variant',
		'label'    => esc_html__( 'Header Variant', 'marbure' ),
		'section'  => 'marbure_section_header',
		'default'  => 'default',
		'priority' => 40,
		'choices'  => array(
			'default'     => esc_html__( 'Default (white bg)', 'marbure' ),
			'transparent' => esc_html__( 'Transparent (over hero)', 'marbure' ),
			'centered'    => esc_html__( 'Centered', 'marbure' ),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'text',
		'settings' => 'header_cta_label',
		'label'    => esc_html__( 'CTA Button Label', 'marbure' ),
		'section'  => 'marbure_section_header',
		'default'  => esc_html__( 'Free Consultation', 'marbure' ),
		'priority' => 50,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'link',
		'settings' => 'header_cta_url',
		'label'    => esc_html__( 'CTA Button URL', 'marbure' ),
		'section'  => 'marbure_section_header',
		'default'  => '/contact',
		'priority' => 60,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'text',
		'settings' => 'topbar_phone',
		'label'    => esc_html__( 'Top Bar Phone Number', 'marbure' ),
		'section'  => 'marbure_section_header',
		'default'  => '',
		'priority' => 70,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'text',
		'settings' => 'topbar_email',
		'label'    => esc_html__( 'Top Bar Email', 'marbure' ),
		'section'  => 'marbure_section_header',
		'default'  => '',
		'priority' => 80,
	)
);
