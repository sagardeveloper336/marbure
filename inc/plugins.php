<?php
/**
 * Plugin recommendations and dependency notices.
 *
 * Marbure requires Elementor for all page layouts. This file outputs a
 * dismissible admin notice when Elementor is not active, with a direct link
 * to install or activate it.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

/**
 * Show an admin notice when Elementor is not active.
 */
function marbure_plugin_notice() {
	if ( defined( 'ELEMENTOR_VERSION' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( $screen && 'themes' === $screen->base ) {
		return;
	}

	$slug          = 'elementor';
	$plugins       = get_plugins();
	$plugin_file   = 'elementor/elementor.php';
	$is_installed  = array_key_exists( $plugin_file, $plugins );
	$install_url   = wp_nonce_url(
		add_query_arg(
			array(
				'action' => 'install-plugin',
				'plugin' => $slug,
			),
			admin_url( 'update.php' )
		),
		'install-plugin_' . $slug
	);
	$activate_url  = wp_nonce_url(
		add_query_arg(
			array(
				'action'        => 'activate',
				'plugin'        => rawurlencode( $plugin_file ),
				'plugin_status' => 'all',
				'paged'         => '1',
			),
			admin_url( 'plugins.php' )
		),
		'activate-plugin_' . $plugin_file
	);

	if ( $is_installed ) {
		$action_url   = $activate_url;
		$action_label = esc_html__( 'Activate Elementor', 'marbure' );
	} else {
		$action_url   = $install_url;
		$action_label = esc_html__( 'Install Elementor', 'marbure' );
	}

	printf(
		'<div class="notice notice-warning is-dismissible"><p>%s <a href="%s" class="button button-primary">%s</a></p></div>',
		sprintf(
			/* translators: %s: theme name */
			esc_html__( 'The %s theme requires the Elementor page builder to display page content. Please install and activate it.', 'marbure' ),
			'<strong>Marbure</strong>'
		),
		esc_url( $action_url ),
		$action_label
	);
}
add_action( 'admin_notices', 'marbure_plugin_notice' );
