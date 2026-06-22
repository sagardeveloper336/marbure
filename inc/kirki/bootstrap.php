<?php
/**
 * Kirki integration bootstrap.
 *
 * Single entry point for the theme's Kirki setup — required from
 * functions.php after the Kirki framework itself has loaded. Loads
 * config, panel, helper, then every section in /sections, in order.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

// Bail if the Kirki framework didn't load (e.g. `composer install` hasn't been run yet).
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

if ( ! defined( 'MARBURE_KIRKI_DIR' ) ) {
	define( 'MARBURE_KIRKI_DIR', get_template_directory() . '/inc/kirki/' );
}

require_once MARBURE_KIRKI_DIR . 'helpers.php';
require_once MARBURE_KIRKI_DIR . 'config.php';
require_once MARBURE_KIRKI_DIR . 'panels.php';

$marbure_kirki_sections = array(
	'sections/general.php',
	'sections/header.php',
	'sections/homepage.php',
	'sections/footer.php',
	'sections/typography.php',
	'sections/blog.php',
	'sections/performance.php',
	'sections/social.php',
	'sections/page-header.php',
	'sections/cpts.php',
);

foreach ( $marbure_kirki_sections as $marbure_kirki_section ) {
	require_once MARBURE_KIRKI_DIR . $marbure_kirki_section;
}

unset( $marbure_kirki_sections, $marbure_kirki_section );
