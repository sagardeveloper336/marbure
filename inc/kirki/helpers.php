<?php
/**
 * Kirki options accessor.
 *
 * Templates should read theme options through marbure_option() rather
 * than calling get_option( 'marbure_theme_options' ) directly — keeps
 * the storage key in one place if it ever changes.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'marbure_option' ) ) {
	/**
	 * Get a single Theme Options value.
	 *
	 * @param string $key     Field key (matches a field's 'settings' arg).
	 * @param mixed  $default Fallback value if unset.
	 * @return mixed
	 */
	function marbure_option( $key, $default = '' ) {
		$options = get_option( 'marbure_theme_options', array() );

		return isset( $options[ $key ] ) ? $options[ $key ] : $default;
	}
}
