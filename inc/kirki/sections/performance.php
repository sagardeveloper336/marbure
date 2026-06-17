<?php
/**
 * Kirki section: Performance.
 *
 * Lightweight on/off toggles for built-in WP features that cost
 * performance but aren't always needed. Reading these values back
 * (e.g. via marbure_option( 'disable_emojis' )) is wired up in
 * inc/template-functions.php as a later step — this section only
 * registers the controls.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_performance',
	array(
		'title'    => esc_html__( 'Performance', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 60,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'switch',
		'settings'    => 'disable_emojis',
		'label'       => esc_html__( 'Disable Emoji Script', 'marbure' ),
		'description' => esc_html__( 'Removes the wp-emoji-release.js script and related inline CSS.', 'marbure' ),
		'section'     => 'marbure_section_performance',
		'default'     => false,
		'priority'    => 10,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'switch',
		'settings'    => 'lazy_load_images',
		'label'       => esc_html__( 'Lazy-Load Images', 'marbure' ),
		'section'     => 'marbure_section_performance',
		'default'     => true,
		'priority'    => 20,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'switch',
		'settings'    => 'disable_embeds',
		'label'       => esc_html__( 'Disable oEmbed Discovery', 'marbure' ),
		'description' => esc_html__( 'Removes the wp-embed.js script loaded on every page.', 'marbure' ),
		'section'     => 'marbure_section_performance',
		'default'     => false,
		'priority'    => 30,
	)
);
