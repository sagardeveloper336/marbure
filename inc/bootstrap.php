<?php
/**
 * Central bootstrap — single entry point required by functions.php.
 * Load order matters: setup and helpers first, Kirki last.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

require_once get_template_directory() . '/inc/class/class-marbure-walker-nav-menu.php';
require_once get_template_directory() . '/inc/class/class-marbure-breadcrumb.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/nav-menus.php';
require_once get_template_directory() . '/inc/sidebars.php';
require_once get_template_directory() . '/inc/cpts.php';
require_once get_template_directory() . '/inc/taxonomies.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/breadcrumb.php';
require_once get_template_directory() . '/inc/schema.php';
require_once get_template_directory() . '/inc/og-meta.php';
require_once get_template_directory() . '/inc/customizer.php';

// Kirki framework + theme options (helpers defines marbure_option(), loaded by kirki/bootstrap).
if ( file_exists( get_template_directory() . '/vendor/kirki-framework/kirki/kirki.php' ) ) {
	require_once get_template_directory() . '/vendor/kirki-framework/kirki/kirki.php';
}
require_once get_template_directory() . '/inc/kirki/bootstrap.php';

// helpers.php uses marbure_option() so it loads after Kirki.
require_once get_template_directory() . '/inc/helpers.php';

// enqueue.php uses marbure_option() in a wp_enqueue_scripts hook — safe after Kirki.
require_once get_template_directory() . '/inc/enqueue.php';

// Jetpack compatibility — only when Jetpack is active.
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once get_template_directory() . '/inc/jetpack.php';
}

// Plugin recommendations (Elementor notice when not active).
require_once get_template_directory() . '/inc/plugins.php';

// Elementor integration — hooks are registered inside via elementor/loaded action.
require_once get_template_directory() . '/inc/elementor/elementor-support.php';
