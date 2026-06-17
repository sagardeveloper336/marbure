<?php
/**
 * Kirki section: Footer.
 *
 * Widget column count, copyright text, and back-to-top toggle.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_footer',
	array(
		'title'    => esc_html__( 'Footer', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 30,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'select',
		'settings' => 'footer_widget_columns',
		'label'    => esc_html__( 'Footer Widget Columns', 'marbure' ),
		'section'  => 'marbure_section_footer',
		'default'  => '4',
		'priority' => 10,
		'choices'  => array(
			'1' => esc_html__( '1 Column', 'marbure' ),
			'2' => esc_html__( '2 Columns', 'marbure' ),
			'3' => esc_html__( '3 Columns', 'marbure' ),
			'4' => esc_html__( '4 Columns', 'marbure' ),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'textarea',
		'settings'    => 'footer_copyright_text',
		'label'       => esc_html__( 'Copyright Text', 'marbure' ),
		'description' => esc_html__( 'Plain text or simple HTML shown in the footer bottom bar.', 'marbure' ),
		'section'     => 'marbure_section_footer',
		'default'     => esc_html__( 'All rights reserved.', 'marbure' ),
		'priority'    => 20,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'switch',
		'settings' => 'show_back_to_top',
		'label'    => esc_html__( 'Show Back-to-Top Button', 'marbure' ),
		'section'  => 'marbure_section_footer',
		'default'  => true,
		'priority' => 30,
	)
);
