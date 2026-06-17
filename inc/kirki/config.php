<?php
/**
 * Kirki configuration.
 *
 * Defines the single Kirki config every panel/section/field in this
 * theme attaches to. Using 'option_type' => 'option' with a single
 * 'option_name' stores every field as one serialized row in wp_options
 * (read back via marbure_option()) instead of one row per setting —
 * the same storage pattern premium panels (WoodMart/Avada/The7) use,
 * while still rendering natively inside Appearance → Customize.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_config(
	'marbure_theme_options',
	array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'option',
		'option_name' => 'marbure_theme_options',
	)
);
