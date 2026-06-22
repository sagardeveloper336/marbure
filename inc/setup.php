<?php
/**
 * Theme setup: supports, image sizes, content width.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_setup() {
	load_theme_textdomain( 'marbure', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );

	// Block patterns from the /patterns directory are auto-loaded by WP 6.0+.
	add_theme_support( 'core-block-patterns' );

	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 220,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	// Custom image sizes used across templates.
	add_image_size( 'marbure-hero',      1920, 900,  true );
	add_image_size( 'marbure-service',    600, 400,  true );
	add_image_size( 'marbure-team',       400, 500,  true );
	add_image_size( 'marbure-blog',       800, 500,  true );
	add_image_size( 'marbure-portfolio',  700, 500,  true );
	add_image_size( 'marbure-thumb',      400, 300,  true );
}
add_action( 'after_setup_theme', 'marbure_setup' );

function marbure_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'marbure_content_width', 1200 );
}
add_action( 'after_setup_theme', 'marbure_content_width', 0 );
