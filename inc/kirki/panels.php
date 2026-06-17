<?php
/**
 * Kirki panel registration.
 *
 * The top-level "Theme Options" panel shown in Appearance → Customize,
 * alongside WordPress's default panels (Site Identity, Menus, Widgets).
 * Every section in /inc/kirki/sections/ attaches to this panel id.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_panel(
	'marbure_theme_options_panel',
	array(
		'title'    => esc_html__( 'Theme Options', 'marbure' ),
		'priority' => 10,
	)
);
