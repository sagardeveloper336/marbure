<?php
/**
 * JSON-LD structured data output — expanded in Phase 6.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_schema_output() {
	// Site-wide LegalService + LocalBusiness schema.
	$schema = array(
		'@context' => 'https://schema.org',
		'@type'    => array( 'LegalService', 'LocalBusiness' ),
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
	);

	// TODO Phase 6: pull address/phone/geo from Kirki options and extend schema.
	// TODO Phase 6: add Attorney, FAQPage, Article, AggregateRating schemas per template.

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'marbure_schema_output' );
