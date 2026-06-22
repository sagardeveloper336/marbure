<?php
/**
 * Kirki section: Social Media.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_social',
	array(
		'title'    => esc_html__( 'Social Media', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 70,
	)
);

$marbure_social_networks = array(
	'facebook'  => esc_html__( 'Facebook URL', 'marbure' ),
	'twitter'   => esc_html__( 'Twitter / X URL', 'marbure' ),
	'instagram' => esc_html__( 'Instagram URL', 'marbure' ),
	'linkedin'  => esc_html__( 'LinkedIn URL', 'marbure' ),
	'youtube'   => esc_html__( 'YouTube URL', 'marbure' ),
);

$marbure_priority = 10;
foreach ( $marbure_social_networks as $key => $label ) {
	Kirki::add_field(
		'marbure_theme_options',
		array(
			'type'     => 'link',
			'settings' => 'social_' . $key,
			'label'    => $label,
			'section'  => 'marbure_section_social',
			'default'  => '',
			'priority' => $marbure_priority,
		)
	);
	$marbure_priority += 10;
}
unset( $marbure_social_networks, $marbure_priority );
